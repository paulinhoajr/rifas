@extends('admin.layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Alterar Promoção</h1>
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

        <form action="{{ route('admin.promocoes.update') }}" method="post">

            @csrf
            <input type="hidden" name="promocao_id" value="{{ $promocao->id }}">

            <div class="row g-3">

                <div class="col-sm-4">
                    <label for="campanha_id" class="form-label">Campanhas</label>
                    <select class="form-select" id="campanha_id" name="campanha_id">
                        @foreach($campanhas as $campanha)
                            <option {{ $promocao->campanha_id == $campanha->id ? "selected" : "" }} value="{{ $campanha->id }}">#{{ $campanha->id }} {{ $campanha->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-4">
                    <label for="quantidade" class="form-label">QTD de números</label>
                    <input type="text" class="form-control" id="quantidade" name="quantidade" placeholder="QTD de números" value="{{ $promocao->quantidade }}" required>
                </div>

                {{--<hr class="my-4">--}}
                <div class="col-sm-12">
                    <label for="valor" class="form-label">Valor</label>
                    <input type="text" class="form-control" id="valor" name="valor" placeholder="Valor" value="{{ $promocao->valor }}" required>
                </div>

            </div>

            <hr class="my-4">

            <button class="float-end btn btn-primary" type="submit">Alterar Promoção</button>
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
