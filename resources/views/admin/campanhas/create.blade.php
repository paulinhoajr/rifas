@extends('admin.layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Nova Campanha</h1>
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

        <form action="{{ route('admin.campanhas.store') }}" method="post">
            @csrf

            <div class="row g-3">

                <div class="col-sm-4">
                    <label for="categoria_id" class="form-label">Categorias</label>
                    <select class="form-select" id="categoria_id" name="categoria_id">
                        @foreach($categorias as $categoria)
                            <option {{ old('categoria_id') == $categoria->id ? "selected" : "" }} value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-4">
                    <label for="bilhete_id" class="form-label">Bilhetes</label>
                    <select class="form-select" id="bilhete_id" name="bilhete_id">
                        @foreach($bilhetes as $bilhete)
                            <option {{ old('bilhete_id') == $bilhete->id ? "selected" : "" }} value="{{ $bilhete->id }}">{{ $bilhete->quantidade }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-4">
                    <label for="sorteio_id" class="form-label">Sorteio</label>
                    <select class="form-select" id="sorteio_id" name="sorteio_id">
                        @foreach($sorteios as $sorteio)
                            <option {{ old('sorteio_id') == $sorteio->id ? "selected" : "" }} value="{{ $sorteio->id }}">{{ $sorteio->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-6">
                    <label for="modelo" class="form-label">Modelo</label>
                    <select class="form-select" id="modelo" name="modelo">
                        <option {{ old('modelo') == 0 ? "selected" : "" }} value="0">Cliente escolhe os bilhetes manualmente</option>
                        <option {{ old('modelo') == 1 ? "selected" : "" }} value="1">Sistema escolhe os bilhetes aleatóriamente</option>
                    </select>
                </div>

                <div class="col-sm-6">
                    <label for="filtro" class="form-label">Filtro</label>
                    <select class="form-select" id="filtro" name="filtro">
                        <option {{ old('filtro') == 0 ? "selected" : "" }} value="0">Mostrar todos os bilhetes</option>
                        <option {{ old('filtro') == 1 ? "selected" : "" }} value="1">Mostrar somente bilhetes disponíveis</option>
                    </select>
                </div>

                <div class="col-sm-4">
                    <label for="nome" class="form-label">Nome da Campanha</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="{{ old('nome') }}" required>
                </div>

                <div class="col-sm-4">
                    <label for="whatsapp" class="form-label">WhatsApp</label>
                    <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="{{ old('whatsapp') }}" required>
                </div>

                <div class="col-sm-4">
                    <label for="preco" class="form-label">Preço</label>
                    <input type="text" class="form-control" id="preco" name="preco"  value="{{ old('preco') }}" required>
                </div>

                <div class="col-sm-4">
                    <label for="minima" class="form-label">Mínima</label>
                    <input type="text" class="form-control" id="minima" name="minima"  value="{{ old('minima') }}" required>
                </div>

                <div class="col-sm-4">
                    <label for="maxima" class="form-label">Máxima</label>
                    <input type="text" class="form-control" id="maxima" name="maxima" value="{{ old('maxima') }}" required>
                </div>

                <div class="col-sm-4">
                    <label for="data" class="form-label">Data</label>
                    <input type="text" class="form-control" id="data" name="data" value="{{ old('data') ? dateTimeUsParaDateTimeBr(old('data')) : "" }}">
                </div>

                <div class="col-sm-4">
                    <label for="tempo" class="form-label">Tempo para Pagamento</label>
                    <input type="text" class="form-control" id="tempo" name="tempo" value="{{ old('tempo') }}">
                </div>

                <div class="col-sm-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                </div>

                <div class="col-sm-4">
                    <label for="situacao" class="form-label">Situação</label>
                    <select class="form-select" id="situacao" name="situacao">
                        <option {{ old('situacao') == 1 ? "selected" : "" }} value="1">Ativo</option>
                        <option {{ old('situacao') == 0 ? "selected" : "" }} value="0">Inativo</option>
                    </select>
                </div>

                {{--<hr class="my-4">--}}
                <div class="col-sm-12">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea type="text" class="form-control" id="descricao" name="descricao" rows="6" required>{{ old('descricao') }}</textarea>
                </div>

                <div class="col-sm-12">
                    <label for="inicial" class="form-label">Página inicial</label>
                    <select class="form-select" id="inicial" name="inicial">
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </select>
                </div>

            </div>

            <hr class="my-4">

            <button class="float-end btn btn-primary" type="submit">Criar Campanha</button>
        </form>
    </div>
@endsection

@section('scripts')

    <script>

        $("#cpf").mask("999.999.999-99");
        $('#whatsapp').mask('(99) 9 9999-9999');
        $("#data").mask("99/99/9999 99:99:99");

        /*$("#nascimento").mask("99/99/9999");
        $("#assoc_vencimento").mask("99/99/9999");
        $("#cr_vencimento").mask("99/99/9999");
        $('#telefone').mask('(99) 9999-9999');
        $('#cep').mask('99999-999');*/

        jQuery('#tempo').keyup(function () {
            this.value = this.value.replace(/(?!^-)[^0-9]/g, "");
        });
        jQuery('#minima').keyup(function () {
            this.value = this.value.replace(/(?!^-)[^0-9]/g, "");
        });
        jQuery('#maxima').keyup(function () {
            this.value = this.value.replace(/(?!^-)[^0-9]/g, "");
        });
        jQuery('#preco').keyup(function () {
            this.value = this.value.replace(/(?!^-)[^0-9.]/g, "");
        });

    </script>

@endsection
