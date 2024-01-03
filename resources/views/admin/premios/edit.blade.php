@extends('admin.layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Alterar Prêmio</h1>
        {{--<div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1">
                <svg class="bi"><use xlink:href="#calendar3"/></svg>
                This week
            </button>
        </div>--}}
    </div>
    <div class="">

        @include('_partials.message')

        <form action="{{ route('admin.premios.update') }}" method="post">

            @csrf
            <input type="hidden" name="premio_id" value="{{ $premio->id }}">

            <div class="row g-3">

                <div class="col-sm-4">
                    <label for="campanha_id" class="form-label">Campanhas</label>
                    <select class="form-select" id="campanha_id" name="campanha_id">
                        @foreach($campanhas as $campanha)
                            <option {{ $premio->campanha_id == $campanha->id ? "selected" : "" }} value="{{ $campanha->id }}">#{{ $campanha->id }} {{ $campanha->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-4">
                    <label for="nome" class="form-label">Nome do Prêmio</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="{{ $premio->nome }}" required>
                </div>

                {{--<hr class="my-4">--}}
                <div class="col-sm-12">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea type="text" class="form-control" id="descricao" name="descricao" rows="6" >{{ $premio->descricao }}</textarea>
                </div>

            </div>

            <hr class="my-4">

            <button class="float-end btn btn-primary" type="submit">Alterar Prêmio</button>
        </form>
    </div>
@endsection

@section('scripts')

    <script>

        /*$("#cpf").mask("999.999.999-99");
        $('#whatsapp').mask('(99) 9 9999-9999');
        $("#data").mask("99/99/9999 99:99:99");*/

        /* jQuery('#tempo').keyup(function () {
             this.value = this.value.replace(/(?!^-)[^0-9]/g, "");
         });
         */

    </script>

@endsection
