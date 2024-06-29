<?php

namespace App\Http\Controllers;


use App\Classes\Sicredi\SicrediConecta;
use App\Http\Requests\Site\PagarPixStoreRequest;
use App\Http\Requests\Site\PagarStoreRequest;
use App\Http\Requests\Site\UsuarioStoreRequest;
use App\Models\Bilhete;
use App\Models\Campanha;
use App\Models\CampanhaBilhete;
use App\Models\Pix;
use App\Models\Usuario;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Paulinhoajr\ApiPixSicredi\PixSicredi;
use Paulinhoajr\Cielo\Ecommerce\CieloEcommerce;
use Paulinhoajr\Cielo\Ecommerce\Environment;
use Paulinhoajr\Cielo\Ecommerce\Request\CieloRequestException;
use Paulinhoajr\Cielo\Ecommerce\Sale;
use Paulinhoajr\Cielo\Merchant;

class PagamentoController extends Controller
{
    public function avancar(PagarStoreRequest $request): RedirectResponse
    {

        $id = $request->get('id');

        $pix = Pix::where('campanha_id', $id)
            ->where('situacao', 0)
            ->first();

        if ($pix){
            return redirect()->route('site.usuarios.campanhas')->with('message_fail', "Você tem números ainda não pagos para essa mesma campanha (".$pix->campanha->nome."),
                por favor, cancele os números com PIX em aberto e tente novamente.");
        }

        $numeros = $request->get('numeros');
        $numeros = array_map('intval', $numeros);

        foreach ($numeros as $numero){
            $bilhete = CampanhaBilhete::where('id', $numero)
                ->first();

            if ($bilhete->situacao!=0){
                return back()->with('message_fail', "O número ". $bilhete->numero. "não está mais disponível.");
            }
        }

        try {

            DB::beginTransaction();

            foreach ($numeros as $numero){
                $bilhete = CampanhaBilhete::where('id', $numero)
                    ->where('situacao', 0)
                    ->first();

                $bilhete->situacao = 1;
                $bilhete->usuario_id = Auth::user()->id;
                $bilhete->expira = Carbon::now()->addHours(25);
                $bilhete->save();

            }

            DB::commit();

            return redirect()->route('site.pagamentos.pagar_selecionar', ['id'=>$id])
                ->with('message', "Números selecionados, efetue o pagamento dentro de 24 horas ou os números serão liberados pra venda.");

        }catch (\Exception $e){
            DB::rollBack();

            //dd($e->getMessage());

            return back()->with('message_fail', "Houve um erro: ". $e->getMessage());
        }
    }

    public function pagar_selecionar($id)
    {
        $campanha = Campanha::where('id', $id)->first();

        if (!$campanha){
            return throw new \Exception("Não encontrou campanha com este ID");
        }

        $bilhetes = CampanhaBilhete::where('situacao', 1)
            ->where('usuario_id', Auth::user()->id)
            ->where('campanha_id', $campanha->id)
            ->get();

        return view("site.pagamentos.selecionar", [
            'bilhetes' => $bilhetes,
            'campanha' => $campanha
        ]);
    }

    public function pagar_pix_post(PagarPixStoreRequest $request): RedirectResponse
    {

        try {

            $sicredi = new SicrediConecta();

            $token = $sicredi->conecta();

            $pix = new PixSicredi(null, $token);
            //asdfasdfasdfasdfasdfsadfasdfas

            /*$resposta = $pix->dadosDeCobranca("90d5dc07105d4d5a824ef63c7f51e9aa");
            dd($resposta);*/

            //$pix->updateWebhook('sua-url', 'sua-chave-pix');

            $txid = md5(uniqid());

            if (!preg_match('/^[a-zA-Z0-9]{26,35}$/', $txid)) {
                throw new \Exception('txid inválido, deve ser alfanumérico entre 26 e 35 caracteres');
            }

            $usuario = Usuario::where('id', Auth::user()->id)->first();

            $cobranca  = [
              "calendario" => [
                  //"dataDeVencimento" => "2040-04-01",
                  //"validadeAposVencimento" => 1
                  "expiracao" => 86401
              ],
              "devedor" => [
                  "cpf" => $usuario->cpf,
                  "nome" => $usuario->nome
              ],
              "valor" => [
                  "original" => any_to_dollar($request->valor),
                  "modalidadeAlteracao" => 1
              ],
              "chave" => config('app.sicredi_pix'),
              "solicitacaoPagador" => config('app.sicredi_pix_descricao')
              /*"infoAdicionais" => [
                  [
                      "nome" => "teste",
                      "valor" => "teste"
                  ]
              ]*/
          ];


            try {

                $resposta = $pix->criarCobranca($cobranca, null);

                $linhas = round(strlen($resposta['pixCopiaECola']) / 120) + 1;

                $numeros = $request->numeros;
                $numeros = array_map('intval', $numeros);

                DB::beginTransaction();

                $pix = new Pix();
                $pix->campanha_id = $request->id;
                $pix->linhas = $linhas;
                $pix->chave = $resposta['pixCopiaECola'];
                $pix->qrcode = $resposta['location'];
                $pix->lista = json_encode($numeros);
                $pix->txid = $txid;
                $pix->expire = 86401;
                $pix->situacao = 0;
                $pix->save();

                foreach ($numeros as $numero){
                    $bilhete = CampanhaBilhete::where('id', $numero)
                        ->first();

                    $bilhete->expira = Carbon::now()->addHours(24);
                    $bilhete->save();
                }

                DB::commit();

                return redirect()->route('site.usuarios.campanhas')->with('message', "Chave PIX gerada com sucesso");

            } catch (\Exception $e) {
                DB::rollBack();
                dd($e->getMessage());
            }

        } catch (\Exception $e) {
            return back()->with('message_fail', "ERROR: HOUVE UM ERRO AO GERAR CHAVE PIX: {$e->getMessage()}");
        }
    }

    /*public function pagar_pix_post(PagarPixStoreRequest $request): RedirectResponse
    {

        try {

            if ( config('app.merchant_ambient') == 1 ){
                $environment = Environment::production();
                $merchant = new Merchant(config('app.merchant_id'), config('app.merchant_key'));
            }else{
                $environment = Environment::sandbox();
                $merchant = new Merchant(config('app.merchant_id_sandbox'), config('app.merchant_key_sandbox'));
            }

            $merchantOrderId = uniqid();

            $sale = new Sale($merchantOrderId);

            $usuario = Usuario::where('id', Auth::user()->id)->first();

            $customers = $sale->customer($usuario->nome)->setName($usuario->nome);

            $customers->setIdentityType('CPF');
            $customers->setIdentity($usuario->cpf);
            $customers->setEmail($usuario->email);

            $payment_total = ($request->valor * 100);
            $payment = $sale->payment($payment_total);
            $payment->setType("Pix")->setAmount($payment_total);

            try {
                $sale = (new CieloEcommerce($merchant, $environment))->createSale($sale);

                $returnStatus = $sale->getPayment()->getStatus();
                $returnQrCodeString = $sale->getPayment()->getQrCodeString();
                //$returnQrCodeBase64Image = $sale->getPayment()->getQrCodeBase64Image();
                $paymentId = $sale->getPayment()->getPaymentId();

                $linhas = round(strlen($returnQrCodeString) / 120) + 1;

                $numeros = $request->numeros;
                $numeros = array_map('intval', $numeros);

                if ($returnStatus==12){

                    DB::beginTransaction();

                    $pix = new Pix();
                    $pix->campanha_id = $request->id;
                    $pix->chave = $returnQrCodeString;
                    $pix->linhas = $linhas;
                    $pix->lista = json_encode($numeros);
                    $pix->uniqid = $merchantOrderId;
                    $pix->paymentId = $paymentId;
                    $pix->situacao = 0;
                    $pix->save();

                    foreach ($numeros as $numero){
                        $bilhete = CampanhaBilhete::where('id', $numero)
                            ->first();

                        $bilhete->expira = Carbon::now()->addHours(25);
                        $bilhete->save();
                    }

                    DB::commit();

                    return redirect()->route('site.usuarios.campanhas')->with('message', "Chave PIX gerada com sucesso");
                }else{
                    DB::rollBack();
                    return back()->with('message_fail', "ERROR: HOUVE UM ERRO AO GERAR CHAVE PIX");
                }
            } catch (CieloRequestException $e) {
                DB::rollBack();
                dd($e->getCieloError());
            }

        } catch (\Exception $e) {
            return back()->with('message_fail', "ERROR: HOUVE UM ERRO AO GERAR CHAVE PIX");
        }
    }*/

    public function imprimirPix($pix_id)
    {

        $pix = Pix::findOrFail($pix_id);

        $chave = $pix->chave;
        $qrcode = $pix->qrcode;


        return view("site.pagamentos.pix", [
            'chave' => $chave,
            'qrcode' => $qrcode,
            'pix_id' => $pix_id,
        ]);
    }

    public function excluir_numero($id)
    {
        $bilhete = CampanhaBilhete::where('id', $id)
            ->where('usuario_id', Auth::user()->id)
            ->where('situacao', 1)
            ->first();

        $bilhete->usuario_id = null;
        $bilhete->situacao = 0;
        $bilhete->expira = null;
        $bilhete->save();

        return back()->with("message", "Número removido com sucesso.");
    }

    public function excluir_compra($id)
    {
        $pix = Pix::findOrFail($id);
        $bilhetes = CampanhaBilhete::whereIn('id', json_decode($pix->lista))
            ->where('usuario_id', Auth::user()->id)
            ->where('situacao', 1)
            ->get();

        try {
            DB::beginTransaction();

            foreach ($bilhetes as $bilhete){
                $bilhete->usuario_id = null;
                $bilhete->situacao = 0;
                $bilhete->expira = null;
                $bilhete->save();
            }

            $pix->situacao = 2;
            $pix->save();

            DB::commit();

            return redirect()->route('site.usuarios.campanhas')
                ->with("message", "Compra e PIX cancelados com sucesso.");

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }

    }

    /*public function pagar_cartao(PagarStoreRequest $request): RedirectResponse
    {

        try {

            DB::beginTransaction();


            DB::commit();

            return redirect()->route('site.index')->with('message', "xxxxxxxxxxxxxxxx");

        }catch (\Exception $e){
            DB::rollBack();

            //dd($e->getMessage());

            return back()->with('message_fail', "Houve um erro: ". $e->getMessage());
        }
    }*/

}

