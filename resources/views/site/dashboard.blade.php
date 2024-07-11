@extends('site.layouts.site')

@section('content')

    <div class="row mb-5">

        <div class="col-md-12">

            <h2 class="mt-3 text-center underline">Campanhas</h2>

            @include('_partials.message')

            <div class="row mb-2">
                @foreach($campanhas as $campanha)
                    <div class="col-md-6 mb-3">
                        <div class="row mb-3">

                            <h2 class="mt-3 text-center underline">Campanha {{ $campanha->nome }}</h2>

                            @include('_partials.message')

                            <div class="col-md-6 mt-2">

                                    @foreach($campanha->premios->take(1) as $premio)

                                            {{--<h2 class="mt-5">Fotos</h2>--}}
                                            {{--<h3>{{ $premio->nome }}</h3>--}}
                                            <div id="carouselCampanha{{ $premio->id }}" class="carousel slide">
                                                <div class="carousel-inner">
                                                    @foreach($premio->imagens as $imagem)
                                                        <div class="carousel-item {{$loop->first ? "active" : ""}}">
                                                            <img src="/storage/images/premios/{{ $imagem->caminho }}" class="d-block " width="100%" alt="{{ $campanha->nome }}">
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselCampanha{{ $premio->id }}" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-bs-target="#carouselCampanha{{ $premio->id }}" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            </div>

                                    @endforeach

                            </div>

                            <div class="col-md-6">

                                <h2 class="mt-2">Informações</h2>
                                <small>
                                    - Mínimo de números: <strong>{{ $campanha->minima }}</strong><br>
                                    - Máximo de números: <strong>{{ $campanha->maxima }}</strong>
                                </small>

                                <h3 class="mt-4">- Preço R$ {{ dollar_to_real($campanha->preco) }}</h3>

                                <h5 class="mt-2">- Reserva limite em dias <strong>({{ $campanha->tempo }})</strong></h5>

                                @if($campanha->promocao)
                                    <h5 class="mt-2">- Promoção</h5>
                                    <small>* Comprando um mínimo de {{ $campanha->promocao->quantidade }} números,
                                        você pagará apenas R${{ dollar_to_real($campanha->promocao->valor) }}</small>
                                @endif

                                <h5 class="mt-2">- Sorteio: {{ $campanha->sorteio->nome }}</h5>

                                <h5 class="mt-2">- Descrição</h5>

                                {!! $campanha->descricao !!}

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

    </div>

@endsection
