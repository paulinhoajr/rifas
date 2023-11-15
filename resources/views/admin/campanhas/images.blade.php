@extends('admin.layouts.admin')


@section('head')
    <style>

        .btn-file {
            position: relative;
            overflow: hidden;
        }
        .btn-file input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            font-size: 100px;
            text-align: right;
            filter: alpha(opacity=0);
            opacity: 0;

            cursor: inherit;
            display: block;
        }

        .progress{
            margin-top: 20px;
            height: 30px;

        }
        .progress-bar{
            line-height: 30px;
        }

        .remover{
            margin-top: 10px;
            margin-bottom: 20px;
        }

    </style>
@endsection

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Imagens de {{ $campanha->nome }}</h1>

    </div>

    <div class="table-responsive small">

        <div class="">

            @include('_partials.message')

            <form action="{{ route('admin.campanhas.upload') }}" method="post" enctype="multipart/form-data">

                @csrf

                <input type="hidden" name="campanha_id" value="{{ $campanha->id }}">

                <div class="form-group">
                    <div class="col-md-12">
                        <label class="control-label">Escolher imagens</label>
                        <input class="form-control" id="arquivos1" type="file" name="images[]" multiple>
                    </div>
                </div>

                <div class="form-group">

                    <div class="col-md-12">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                                0%
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">

                    <div class="col-md-12 mt-3">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-check"></i> Enviar Imagens
                        </button>
                    </div>
                </div>

                <p>&nbsp;</p>

                <div class="form-group">

                    <div class="col-md-12">
                        <div class='row resultado'></div>
                    </div>
                </div>

            </form>

        </div>
        <hr class="my-4">

    </div>
@endsection

@section('scripts')

    <script src="/js/jquery.form.js"></script>

    <script>

        /*$("#cpf").mask("999.999.999-99");*/

        $(function() {

            var barra = $('.progress-bar');
            var status = $('#status');

            $('form').ajaxForm({

                beforeSend: function() {
                    status.empty();
                    var percentVal = '0%';
                    barra.width(percentVal)
                    barra.html(percentVal);
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    var percentVal = percentComplete + '%';
                    barra.width(percentVal)
                    barra.html(percentVal);
                    /*console.log(percentVal, position, total, event);*/
                },
                success: function() {
                    var percentVal = '100%';
                    barra.width(percentVal)
                    barra.html(percentVal);
                },
                complete: function(xhr) {
                    /*status.html(xhr.responseText);*/
                    $('#arquivos1').val("");
                    //$('#arquivos2').val("");
                    executaFuncao();
                }
            });

        });

        function  executaFuncao(){

            $('.resultado').empty();

            $.getJSON( "/admin/campanhas/list/{{ $campanha->id }}", function( data ) {

                $.each( data, function( key, val ) {

                    $('.resultado').append(
                        '<div class="col-md-3">' +
                        '<img src="/storage/images/campanhas/'+val.caminho+'" width="100%" />' +
                        '<a id="'+val.id+'" class="btn btn-sm btn-default remover remover_'+val.id+'"><svg class="bi"><use xlink:href="#icon_excluir"/></svg></a>' +
                        '</div>');

                    $('.resultado').on('click', '.remover_'+val.id, function(e) {
                        e.preventDefault();
                        $(this).parent().remove();

                        var id = $(this).attr('id');

                        $.ajax({
                            url: '/admin/campanhas/remove/'+id,
                            success: function(data) {
                                //console.log(data);
                            }
                        });
                        return false;
                    });
                });
            });
        }

        $(document).on('change', '.btn-file :file', function() {
            var input = $(this),
                numFiles = input.get(0).files ? input.get(0).files.length : 1,
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [numFiles, label]);
        });

        $(document).ready( function() {

            executaFuncao();

            $('.btn-file :file').on('fileselect', function(event, numFiles, label) {

                var input = $(this).parents('.input-group').find(':text'),
                    log = numFiles > 1 ? numFiles + ' files selected' : label;
                if( input.length ) {
                    input.val(log);
                } else {
                    if( log ) alert(log);
                }
            });
        });

    </script>

@endsection


