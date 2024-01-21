<?php

namespace App\Http\Controllers;


use App\Http\Requests\Site\PagarStoreRequest;
use App\Http\Requests\Site\UsuarioStoreRequest;
use App\Models\Campanha;
use App\Models\Usuario;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PagamentoController extends Controller
{
    public function pagar(PagarStoreRequest $request): RedirectResponse
    {

        dd($request->all());


        try {

            DB::beginTransaction();



            DB::commit();


            return redirect()->route('site.index')->with('message', "xxxxxxxxxxxxxxxxxxxx.");

        }catch (\Exception $e){
            DB::rollBack();

            //dd($e->getMessage());

            return back()->with('message_fail', "Houve um erro: ". $e->getMessage());
        }
    }



}
