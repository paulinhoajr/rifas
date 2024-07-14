@extends('admin.layouts.admin')

@section('head')
    <style>
        .riscado {
            text-decoration: line-through;
            color: red;
        }
    </style>
@endsection

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Lista de Prêmios</h1>
        {{--<div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1">
                <svg class="bi"><use xlink:href="#icon_calendar3"/></svg>
                This week
            </button>
        </div>--}}
    </div>

    <div class="table-responsive small">

        @include('_partials.message')

        <a href="{{ route('admin.premios.create') }}" type="button" class="float-end ri btn btn-outline-secondary btn-sm">
            <svg class="bi"><use xlink:href="#icon_usuario"/></svg> NOVO PRÊMIO</a>

        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Campanha</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($premios as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nome }}</td>
                    <td>
                        @if($item->campanha)
                            #{{ $item->campanha->id }} {{ $item->campanha->nome }}
                        @else
                            <p class="riscado">deletado</p>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group float-end" role="group" aria-label="">
                            {{--<a href="{{ route('admin.premios.show', ['id'=>$item->id]) }}" type="button" class="ri btn btn-outline-success btn-sm"><svg class="bi"><use xlink:href="#icon_mostrar"/></svg> MOSTRAR</a>--}}
                            <a href="{{ route('admin.premios.images', ['id'=>$item->id]) }}" type="button" class="ri btn btn-outline-warning btn-sm"><svg class="bi"><use xlink:href="#icon_images"/></svg> FOTOS</a>
                            <a href="{{ route('admin.premios.edit', ['id'=>$item->id]) }}" type="button" class="ri btn btn-outline-primary btn-sm"><svg class="bi"><use xlink:href="#icon_editar"/></svg> EDITAR</a>
                            <a href="{{ route('admin.premios.delete', ['id'=>$item->id]) }}" type="button" class="btn btn-outline-danger btn-sm"><svg class="bi"><use xlink:href="#icon_excluir"/></svg> EXCLUIR</a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $premios->onEachSide(1)->links('_partials.pagination') }}
    </div>
@endsection
