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
        <h1 class="h2">Lista de Pixs</h1>
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

        {{--<a href="{{ route('admin.campanhas.create') }}" type="button" class="float-end ri btn btn-outline-secondary btn-sm">
            <svg class="bi"><use xlink:href="#icon_usuario"/></svg> NOVA CAMPANHA</a>
--}}
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>#</th>
                <th>Campanha</th>
                <th>Usuário</th>
                <th>Fone</th>
                <th>Números</th>
                <th>Expira</th>
                <th>Situação</th>
                {{--<th></th>--}}
            </tr>
            </thead>
            <tbody>
            @foreach($pixs as $item)
                <tr @if($item->situacao==2) class="riscado"  @endif>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->campanha->nome }}</td>
                    <td><a href="{{ route('admin.usuarios.show', ['id'=>$item->usuario->id]) }}">{{ $item->usuario->nome }}</a> </td>
                    <td>
                        <a target="_blank" href="https://wa.me/55{{$item->usuario->phone}}">{{ mascara($item->usuario->phone, "celular") }}</a>
                    </td>
                    <td>
                        @foreach($item->campanha->bilhetes->whereIn('id', json_decode($item->lista)) as $bilhete)
                            {{ $bilhete->numero }} -
                        @endforeach
                    </td>
                    <td>{{ expire_date($item->created_at, $item->expire) }}</td>
                    <td>
                        @if($item->situacao==0)
                            Novo
                        @elseif($item->situacao==1)
                            Pago
                        @else
                            Cancelado
                        @endif
                    </td>
                    {{--<td>
                        <div class="btn-group float-end" role="group" aria-label="">
                            <a href="{{ route('admin.campanhas.show', ['id'=>$item->id]) }}" type="button" class="ri btn btn-outline-success btn-sm"><svg class="bi"><use xlink:href="#icon_mostrar"/></svg> MOSTRAR</a>
                        </div>
                    </td>--}}
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $pixs->onEachSide(1)->links('_partials.pagination') }}
    </div>
@endsection
