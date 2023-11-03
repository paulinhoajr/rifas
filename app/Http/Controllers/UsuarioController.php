<?php

namespace App\Http\Controllers;


use App\Http\Requests\Site\UsuarioStoreRequest;
use App\Http\Requests\Site\UsuarioUpdateRequest;
use App\Models\Usuario;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Illuminate\Auth\Events\Registered;

class UsuarioController extends Controller
{
    public function index()
    {

        return view('site.usuarios.index');
    }

    public function create()
    {

        return view('site.usuarios.create');
    }

    public function store(UsuarioStoreRequest $request): RedirectResponse
    {

        $usuario = Usuario::where('cpf', $request->cpf)->first();

        if ($usuario){
            return redirect()->route('login')
                ->with('message_alert', "Usuário já cadastrado.");
        }

        try {

            DB::beginTransaction();

            $usuario = new Usuario();
            $usuario->nome = $request->nome;
            $usuario->cpf = only_numbers($request->cpf);
            $usuario->email = $request->email;
            $usuario->password = Hash::make($request->password);
            $usuario->role = "ROLE_USUARIO";
            $usuario->save();

            //envia email
            //$usuario->sendEmailVerificationNotification();
            event(new Registered($usuario));

            DB::commit();

            Auth::loginUsingId($usuario->id);

            return redirect()->route('site.index')
                ->with('message', "Conta criada com sucesso, consulte seu email para ativar sua conta.");

        }catch (\Exception $e){
            DB::rollBack();

            //dd($e->getMessage());

            return back()->with('message_fail', "Houve um erro: ". $e->getMessage());
        }

    }

    public function edit(): View
    {
        $usuario = Usuario::where('id', Auth::user()->id)
            ->first();

        return view('site.usuarios.edit', [
            'usuario' => $usuario,
        ]);
    }

    public function update(UsuarioUpdateRequest $request): RedirectResponse
    {
        $usuario = Usuario::where('id', Auth::user()->id)
            ->first();

        $usuario->nome = $request->nome;
        $usuario->email = $request->email;

        if ($request->password != null) {
            $usuario->password = Hash::make($request->password);
        }

        $usuario->save();

        return back()->with('message', "Usuário atualizado com sucesso.");
    }

    public function logout(): RedirectResponse
    {
        if(Auth::check())
        {
            Auth::logout();
            Session::flush();
            Session::regenerate();
        }

        return redirect()->route('login');
    }

}
