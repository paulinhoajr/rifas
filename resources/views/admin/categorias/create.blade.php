@extends('admin.layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Nova Categoria</h1>
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

        <form action="{{ route('admin.categorias.store') }}" method="post">

            @csrf

            <div class="row g-3">

                <div class="col-sm-4">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="{{ old('nome') }}" required>
                </div>


            </div>

            <hr class="my-4">

            <button class="float-end btn btn-primary" type="submit">Criar Categoria</button>
        </form>
    </div>
@endsection

@section('scripts')

    <script>

        /*$("#cpf").mask("999.999.999-99");
        $('#whatsapp').mask('(99) 9 9999-9999');
        $("#data").mask("99/99/9999 99:99:99");*/

        jQuery('#valor').keyup(function () {
            this.value = this.value.replace(/(?!^-)[^0-9]/g, "");
        });


    </script>

@endsection
