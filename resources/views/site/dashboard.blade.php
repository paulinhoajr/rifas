@extends('site.layouts.site')

@section('content')

    <div class="row mb-5">

        <div class="col-md-12">

            <h2 class="mt-3 text-center underline">Últimas Campanhas</h2>

            @include('_partials.message')

            <div class="row mb-2">
                @foreach($campanhas as $campanha)
                    <div class="col-md-12 mb-3">
                        <a href="{{ route('site.campanha', ['id'=>$campanha->id, 'nome'=>urlClear($campanha->nome)]) }}"><h2>{{ $campanha->nome }}</h2>
                           {{-- <img src="/storage/images/campanhas/thumbs/{{ /*$campanha->imagens->pluck('caminho')->first()*/ }}" width="100%" />--}}
                        </a>
                    </div>
                @endforeach
            </div>

        </div>

    </div>

@endsection
