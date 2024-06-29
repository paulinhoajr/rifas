<?php

namespace App\Http\Controllers;

use App\Models\Campanha;
use App\Models\CampanhaBilhete;
use App\Models\Pix;
use Illuminate\Database\QueryException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Paulinhoajr\Cielo\Ecommerce\CieloEcommerce;
use Paulinhoajr\Cielo\Ecommerce\Environment;
use Paulinhoajr\Cielo\Ecommerce\Request\CieloRequestException;
use Paulinhoajr\Cielo\Merchant;

class HomeController extends Controller
{
    public function index()
    {
        $campanhas = Campanha::where('situacao', 1)
            ->take(8)
            ->orderByDesc('id')
            ->get();

        return view('site.dashboard', [
            'campanhas' => $campanhas
        ]);
    }

    public function campanha($id, $nome)
    {
        $campanha = Campanha::where('situacao', 1)
            ->where('id', $id)
            ->first();

        $total_disponivel = CampanhaBilhete::where('situacao', 0)
            ->where('campanha_id', $campanha->id)
            ->get();

        $total_reservados = CampanhaBilhete::where('situacao', 1)
            ->where('campanha_id', $campanha->id)
            ->get();

        $total_comprados = CampanhaBilhete::where('situacao', 2)
            ->where('campanha_id', $campanha->id)
            ->get();

        if (Auth::check()){
            $total_meus = CampanhaBilhete::where('situacao', 2)
                ->where('campanha_id', $campanha->id)
                ->where('usuario_id', Auth::user()->id)
                ->get();
        }else{
            $total_meus = collect([]);
        }


        return view('site.campanha', [
            'campanha' => $campanha,
            'total_disponivel' => $total_disponivel,
            'total_reservados' => $total_reservados,
            'total_comprados' => $total_comprados,
            'total_meus' => $total_meus,
        ]);
    }

    public function cielo_pix_consulta()
    {

        if ( config('app.merchant_ambient') == 1 ){
            $environment = Environment::production();
            $merchant = new Merchant(config('app.merchant_id'), config('app.merchant_key'));
        }else{
            $environment = Environment::sandbox();
            $merchant = new Merchant(config('app.merchant_id_sandbox'), config('app.merchant_key_sandbox'));
        }

        $pixs = Pix::where('situacao', 0)->get();

        if (!$pixs){
            dd("Nunhum PIX em aberto para consulta.");
        }

        try {

            DB::beginTransaction();

            foreach ($pixs as $pix){
                $sale = (new CieloEcommerce($merchant, $environment))->getSale($pix->paymentId);

                $bilhetes = CampanhaBilhete::whereIn('id', json_decode($pix->lista))
                    ->where('campanha_id', $pix->campanha_id)
                    ->where('situacao', 1)
                    ->get();

                if ($sale->getPayment()->getStatus()==2){
                    $pix->situacao = 1;
                    $pix->save();

                    //rodar itens e setar como pago

                    if ($bilhetes){
                        foreach ($bilhetes as $bilhete){
                            //seta pago os bilhetes
                            $bilhete->situacao = 2;
                            $bilhete->save();
                        }
                    }

                    echo "PIX ID:". $pix->id." foi pago.<br>";

                }else{

                    $date1 = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::parse($pix->created_at)->addHours(25));
                    $date2 = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now());

                    $result = $date2->gt($date1);

                    if (!$result){ //false ainda nao venceu

                        echo "PIX ID:". $pix->id." ainda não foi pago.<br>";

                    }else{ //desativa pix vencido
                        $pix->situacao = 2;
                        $pix->save();

                        //rodar itens e cancelar numeros
                        if ($bilhetes){
                            foreach ($bilhetes as $bilhete){
                                //seta pago os bilhetes
                                $bilhete->usuario_id = null;
                                $bilhete->situacao = 0;
                                $bilhete->expira = null;
                                $bilhete->save();
                            }
                        }
                    }
                }
            }

            DB::commit();

        } catch (CieloRequestException $e) {
            DB::rollBack();
            dd($e->getCieloError());
        }
    }

    public function numeros_reservados_consulta()
    {

        try {

            $bilhetes = CampanhaBilhete::where('situacao', 1)
                ->get();

            DB::beginTransaction();

            foreach ($bilhetes as $bilhete){

                $pix = Pix::where('situacao', 0)
                    ->whereJsonContains('lista', $bilhete->id)
                    ->where('campanha_id', $bilhete->campanha_id)
                    ->first();

                if ($pix){
                    continue;
                }

                $date1 = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::parse($bilhete->expira));
                $date2 = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now());

                $result = $date2->gt($date1);

                if ($result){
                    //rodar itens e cancelar numeros
                    dd("teste");
                    $bilhete->usuario_id = null;
                    $bilhete->situacao = 0;
                    $bilhete->save();
                }
            }

            DB::commit();

        } catch (\Exception|QueryException $e) {
            DB::rollBack();
            dd($e->getCieloError());
        }
    }

}
