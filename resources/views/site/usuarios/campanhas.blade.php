@extends('site.layouts.site')

@section('content')

    <div class="row mb-5">

        <div class="col-md-12">

            <h2 class="mt-3">Minhas Campanhas</h2>

            @include('_partials.message')

            <div class="row mb-2 mt-5">
                <div class="col-md-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Nome</th>
                                <th>Números</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($campanhas as $campanha)
                                <tr>
                                    <td>{{ $campanha->id }}</td>
                                    <td>{{ $campanha->nome }}</td>
                                    <td>
                                        <div class="row mb-2 mt-1">
                                            @foreach($campanha->bilhetes as $bilhete)
                                                <div class="col-sm-2 text-center">
                                                    <a class="btn btn-md mb-2 numeros btn-{{ $bilhete->situacao == 1 ? "warning" : "success" }}" title="{{ $bilhete->situacao == 1 ? "Reservado" : "Pago" }}">
                                                        {{ mb_str_pad($bilhete->numero, $campanha->total, '0', STR_PAD_LEFT) }}
                                                    </a><br>
                                                    @php
                                                        $pixs = \App\Models\Pix::where('situacao', 0)->whereJsonContains('lista', $bilhete->id)->first();
                                                    @endphp
                                                    <a onclick="return confirm(&quot;Deseja realmente excluir este número?&quot;)"
                                                       href="{{ route('site.pagamentos.excluir_numero', ['id'=>$bilhete->id]) }}"
                                                       class="mb-2 btn btn-sm {{ ($bilhete->situacao == 2) ? "btn-secondary disabled" : ($pixs!=null ? "btn-secondary disabled" : "btn-danger") }}">Excluir</a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>
                                        @if($campanha->pix_aberto!=null)
                                        <a href="{{route('site.pagamentos.imprimirPix', ['pix_id'=>$campanha->pix_aberto->id])}}"
                                           class="btn btn-outline-danger btn-sm">
                                            <i class="fa fa-money fa-lg" aria-hidden="true"></i>
                                            COPIA E COLA / QRCODE - PIX
                                        </a>
                                        @else
                                            @if($campanha->abertosTotal > 0)
                                                @if($campanha->promocao and ($campanha->abertosTotal >= $campanha->promocao->quantidade))
                                                    <a href="{{ route('site.pagamentos.pagar_selecionar', ['id'=>$campanha->id]) }}" class="btn btn-primary btn-sm">Pagar R$ {{ dollar_to_real($campanha->abertosTotal * $campanha->promocao->valor) }}</a>
                                                @else
                                                    <a href="{{ route('site.pagamentos.pagar_selecionar', ['id'=>$campanha->id]) }}" class="btn btn-primary btn-sm">Pagar R$ {{ dollar_to_real($campanha->abertosTotal * $campanha->preco) }}</a>
                                                @endif
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
