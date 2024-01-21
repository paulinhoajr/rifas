@extends('site.layouts.site')

@section('head')
    <style>

    </style>
@endsection

@section('content')

    <div class="container">
        <div class="row mb-3">

            <h2 class="mt-3">Campanha {{ $campanha->nome }}</h2>

            @include('_partials.message')

            <div class="col-md-8">
                <div class="row mb-3">
                    @foreach($campanha->premios as $premio)
                    <div class="col-sm-6">
                        {{--<h2 class="mt-5">Fotos</h2>--}}
                        <h3>{{ $premio->nome }}</h3>
                        <div id="carouselCampanha{{ $premio->id }}" class="carousel slide">
                            <div class="carousel-inner">
                                    @foreach($premio->imagens as $imagem)
                                        <div class="carousel-item {{$loop->first ? "active" : ""}}">
                                            <img src="/storage/images/premios/{{ $imagem->caminho }}" class="d-block " width="100%" alt="{{ $campanha->nome }}">
                                        </div>
                                    @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselCampanha{{ $premio->id }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselCampanha{{ $premio->id }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="col-md-4">

                <h2 class="mt-5">Descrição</h2>

                {!! $campanha->descricao !!}

            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">

            <h2 class="mt-3">Números</h2>
            @php
                $total = strlen($campanha->bilhete->quantidade);
            @endphp

            <form id="form" name="form" action="{{ route('site.pagamentos.pagar') }}" method="post" onSubmit="document.getElementById('avancar').disabled=true;">

                @csrf

                <input type="hidden" name="id" value="{{ $campanha->id }}">

                <div class="col-md-12 mb-2 text-center">
                @foreach($campanha->bilhetes as $bilhete)
                    <a {{--{{ $bilhete->situacao > 0 ? "" : "" }}--}} id="{{ $bilhete->id }}" class="btn mb-2 mr-2 numeros {{ $bilhete->situacao==1 ? "btn-warning reservado" : ($bilhete->situacao==2 ? "btn-success escolhido" : "btn-outline-info") }}">{{ mb_str_pad($bilhete->numero, $total, '0', STR_PAD_LEFT) }}</a>
                @endforeach
                </div>

                <div class="col-md-12 mb-2">
                    <button class="btn btn-success btn-lg" id="avancar">Avançar</button>
                </div>
            </form>
        </div>

    </div>

@endsection




@section('scripts')

    <script>

        $(function() {

            /*$( "#avancar" ).on( "click", function() {

                $(".selecionado").each(function() {
                    alert(this.id);


                });

            });*/

            $( ".numeros" ).on( "click", function() {

                let id = this.id;

                if ($("#"+id).hasClass("selecionado")) {

                    $("#" + id).removeClass("selecionado");
                    $("#" + id).removeClass("btn-primary");
                    $("#" + id).addClass("btn-outline-info");

                    $( "#num_"+id ).remove();

                }else if ($("#"+id).hasClass("escolhido")){

                    mostraMensagem("Este número ja foi escolhido.", "success");

                }else if ($("#"+id).hasClass("reservado")){

                    mostraMensagem("Este número ja foi reservado.", "warning");

                }else{

                    //console.log(id);

                    $("#"+id).removeClass( "btn-outline-info" );
                    $("#"+id).addClass( "selecionado" );
                    $("#"+id).addClass( "btn-primary" );

                    $('<input>', {
                        type: 'hidden',
                        id: "num_"+id,
                        name: 'numeros[]',
                        value: id
                    }).appendTo('form');

                }
            } );



        });

        function mostraMensagem(mensagem, tipo, tempo = 5000){
            $.showNotification({
                body: mensagem,
                type: tipo,
                duration: tempo
            });
        }

        /*$("#cpf").mask("999.999.999-99");
        $('#whatsapp').mask('(99) 9 9999-9999');
        $("#data").mask("99/99/9999 99:99:99");
        $("#nascimento").mask("99/99/9999");
        $("#assoc_vencimento").mask("99/99/9999");
        $("#cr_vencimento").mask("99/99/9999");
        $('#telefone').mask('(99) 9999-9999');
        $('#cep').mask('99999-999');*/

        /*jQuery('#tempo').keyup(function () {
            this.value = this.value.replace(/(?!^-)[^0-9]/g, "");
        });*/

    </script>

@endsection