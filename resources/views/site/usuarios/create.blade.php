@extends('site.layouts.guest')

@section('content')

    <div class="row mb-5 mt-5">

        <div class="col-md-6 offset-md-3">

            <h2 class="mt-5">Cadastrar {{--em {{ $espera->escola->nome }}--}}</h2>

            @include('_partials.message')

            <form method="POST" action="{{ route('site.usuarios.store') }}" class="mt-3">
                @csrf

                <div class="form-floating">
                    <input name="cpf" type="text" class="form-control" id="cpf" value="{{ old('cpf') }}" placeholder="000.000.000-00" required>
                    <label for="cpf">CPF</label>
                </div>
                <div class="form-floating mt-3">
                    <input name="phone" type="text" class="form-control" id="phone" value="{{ old('phone') }}" placeholder="(00) 0 0000-0000" required>
                    <label for="phone">CELULAR</label>
                </div>
                <div class="form-floating mt-3">
                    <input name="nome" type="text" class="form-control" id="nome" placeholder="Fulano de tal" value="{{ old('nome') }}" required>
                    <label for="nome">Nome</label>
                </div>
                <div class="form-floating mt-3">
                    <input name="email" type="email" class="form-control" id="email" placeholder="nome@exemplo.com.br" value="{{ old('email') }}" required>
                    <label for="email">Email</label>
                </div>
                <div class="form-floating mt-3">
                    <input name="password" type="password" class="form-control" id="senha" placeholder="Senha" required autocomplete="new-password">
                    <label for="senha">Senha</label>
                </div>
                <div class="form-floating mt-3">
                    <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="Repita Senha">
                    <label for="password_confirmation">Repita Senha</label>
                </div>

                <button class="btn btn-primary w-100 py-2 mt-3" type="submit">Cadastrar</button>
            </form>

            @include('_partials.back', ['rota' => route('site.index')])
        </div>

    </div>

@endsection

@section('scripts')

    <script>

        $("#cpf").mask("999.999.999-99");
        $('#phone').mask('(99) 9 9999-9999');
        /*$("#nascimento").mask("99/99/9999");
        $("#assoc_data").mask("99/99/9999");
        $("#assoc_vencimento").mask("99/99/9999");
        $("#cr_vencimento").mask("99/99/9999");

        $('#whatsapp').mask('(99) 9 9999-9999');
        $('#cep').mask('99999-999');*/

    </script>

@endsection
