@extends('site.layouts.guest')

@section('content')

    <div class="row mb-5 mt-5">

        <div class="mb-4 text-sm">
            <p>
                Obrigado por criar uma conta! Antes de começar, você poderia verificar seu endereço de e-mail clicando no link que acabamos de enviar para você? Se você não recebeu o e-mail, teremos prazer em lhe enviar outro.
            </p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                <p>
                    Um novo link de verificação foi enviado para o endereço de e-mail que você forneceu durante o registro.
                </p>
            </div>
        @endif

        <div class="col-md-12 {{--offset-md-3--}}">

            @include('_partials.message')

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <button type="submit" class="btn btn-success">
                        {{ __('Reenviar email de verificação') }}
                    </button>
                </div>
            </form>

            <form class="mt-5" method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="btn btn-danger">
                    {{ __('Sair') }}
                </button>
            </form>

            {{--@include('site._partials.back', ['url'=> route('login')])--}}

        </div>

    </div>

@endsection
