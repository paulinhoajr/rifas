@extends('site.layouts.site')

@section('content')

    <div class="container">
        <div class="row mb-5">

        <h2 class="mt-5">Campanha {{ $campanha->nome }}</h2>

        @include('_partials.message')

        <div class="col-md-6">

            <h2 class="mt-5">Fotos</h2>

            <div id="carouselCampanha" class="carousel slide">
                <div class="carousel-inner">
                    @foreach($campanha->imagens as $imagem)
                        <div class="carousel-item {{$loop->first ? "active" : ""}}">
                            <img src="/storage/images/campanhas/{{ $imagem->caminho }}" class="d-block w-100" alt="{{ $campanha->nome }}">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselCampanha" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselCampanha" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

        </div>
        <div class="col-md-6">

            <h2 class="mt-5">Sobre</h2>

            bla bla


        </div>


    </div>
    </div>

    <div class="container-fluid">
        <div class="row">

            <h2 class="mt-5">Números</h2>
            @php
                $total = strlen($campanha->bilhete->quantidade);
            @endphp

            <div class="col-md-12 mb-2">
            @foreach($campanha->bilhetes as $bilhete)
                <button class="btn btn-outline-info mb-2 mr-2">{{ mb_str_pad($bilhete->numero, $total, '0', STR_PAD_LEFT) }}</button>
            @endforeach
            </div>

        </div>
    </div>

@endsection
