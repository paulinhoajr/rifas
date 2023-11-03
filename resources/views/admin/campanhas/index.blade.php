@extends('admin.layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Lista de Campanhas</h1>
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

        {{--<a href="{{ route('admin.usuarios.create') }}" type="button" class="float-end ri btn btn-outline-secondary btn-sm">
            <svg class="bi"><use xlink:href="#icon_usuario"/></svg> NOVO USUÁRIO</a>--}}

        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Bilhete Id</th>
                    <th>Categoria Id</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($campanhas as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nome }}</td>
                    <td>{{ $item->bilhete_id }}</td>
                    <td>{{ $item->categoria_id }}</td>
                    <td>
                        <a href="{{ url('/admin/campanhas/' . $item->id) }}" title="View Campanha"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                        <a href="{{ url('/admin/campanhas/' . $item->id . '/edit') }}" title="Edit Campanha"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>

                        <form method="POST" action="{{ url('/admin/campanhas' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Delete Campanha" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $campanhas->onEachSide(1)->links('_partials.pagination') }}
    </div>
@endsection
