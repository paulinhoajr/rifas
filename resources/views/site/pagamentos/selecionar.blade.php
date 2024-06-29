@extends('site.layouts.site')

@section('content')

    <div class="row mb-5">

        <div class="col-md-12">

            <h2 class="mt-3">Pagar com PIX</h2>

            @include('_partials.message')

            @php
                $total_char = strlen($campanha->bilhete->quantidade);
            @endphp

            <div class="row mb-2 mt-5">
                <div class="col-4">
                    <p>Números selecionados</p>
                    <div class="row mb-2">
                    @foreach($bilhetes as $bilhete)
                        <div class="col-2 btn mb-2 btn-outline-warning me-1">
                            {{ mb_str_pad($bilhete->numero, $total_char, '0', STR_PAD_LEFT) }}
                        </div>
                    @endforeach
                    </div>
                </div>
                <div class="col-8">
                    <div class="row mb-2">
                        <div class="col-12">
                            <form action="{{ route('site.pagamentos.pagar_pix_post') }}" method="post" onSubmit="document.getElementById('submit').disabled=true;">
                                @csrf

                                <input type="hidden" name="id" value="{{ $campanha->id }}">

                                @if($bilhetes != null)
                                    @foreach($bilhetes as $bilhete)
                                        <input type="hidden" name="numeros[]" value="{{ $bilhete->id }}">
                                    @endforeach

                                    @if($campanha->promocao and ($bilhetes->count() >= $campanha->promocao->quantidade))
                                        <input type="hidden" name="valor" value="{{ $bilhetes->count() * $campanha->promocao->valor }}">
                                    @else
                                        <input type="hidden" name="valor" value="{{ $bilhetes->count() * $campanha->preco }}">
                                    @endif
                                @endif

                                <div class="form-group">
                                    <h3>AVISO:<br> O QR Code que será gerado na próxima tela expira em 24 horas.</h3>
                                    <p>Ao clicar no botão abaixo o sistema gera um QR Code para pagamento.</p>
                                    <p>Esse método de pagamento deve ser feito via aplicativo de celular na área PIX por QR Code ou Copia e Cola.</p>
                                    <button type="submit" id="submit" class="btn btn-lg btn-success btn-block">
                                        <svg class="bi"><use xlink:href="#icon_qrcode"/></svg>
                                        <span style="color: #ffffff;">GERAR PIX R$
                                            @if($campanha->promocao and ($bilhetes->count() >= $campanha->promocao->quantidade))
                                                {{ dollar_to_real($bilhetes->count() * $campanha->promocao->valor) }}
                                            @else
                                                {{ dollar_to_real($bilhetes->count() * $campanha->preco) }}
                                            @endif
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                        {{--<div class="col-6">
                            <h3>Cartão de Crédito</h3>

                        </div>--}}
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection
