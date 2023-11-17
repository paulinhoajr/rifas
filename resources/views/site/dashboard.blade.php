@extends('site.layouts.site')

@section('content')

    <div class="row mb-5">

        <div class="col-md-12">

            <h2 class="mt-5">Últimas Campanhas</h2>

            @include('_partials.message')

            <div class="row mb-2">
                @foreach($campanhas as $campanha)
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('site.campanha', ['id'=>$campanha->id, 'nome'=>urlClear($campanha->nome)]) }}">
                            <img src="/storage/images/campanhas/thumbs/{{ $campanha->imagens->pluck('caminho')->first() }}" width="100%" />
                        </a>
                    </div>
                @endforeach
            </div>

        </div>

    </div>

@endsection
