@extends('site.layouts.site')

@section('content')

    <div class="container-fluid">
        <div class="alert alert-warning">
            <p><strong>Atenção</strong>.<br>
                Esse método de pagamento deve ser feito via aplicativo de celular na área PIX por QR Code ou Copia e Cola.</p>
        </div>
        <div class="alert alert-warning">
            <p><strong>Validade</strong>.<br>
                Os códigos tem validade de 24 horas a partir do horário que foram gerados, caso tenha ultrapassado esse tempo entre em contato conosco para intruções de como realizar o pagamento.</p>
        </div>
    </div>

    <div class="row mb-5">

        <div class="col-md-12">

            <h2 class="mt-3">PIX - Código QR Code</h2>

            @include('_partials.message')

            <div class="row mb-2 mt-5">
                <div class="col-md-4">
                    <img src="/images/logo_pix.png"><br><br>
                    <img src="{{ route('site.pagamentos.imprimirQRCODE', ['pix_id'=>$pix_id]) }}" alt="Imagem Carregada do Base64"> <br><br>
                </div>
                <div class="col-md-8">
                    <span style="color: red;">PIX - Chave do tipo (Copia e Cola)</span> <br>
                    <textarea class="text-monospace w-100" id="brcodepix" rows="{{$linhas}}"  onclick="copiar()">{{$chave}}</textarea><br>
                    <button type="button" id="clip_btn" class="btn btn-primary" onclick="copiar()"><i class="fa fa-clipboard"></i> Copiar Chave</button>
                </div>
            </div>

            <a onclick="return confirm(&quot;Deseja realmente excluir esta compra e cancelar o PIX?&quot;)"
               href="{{ route('site.pagamentos.excluir_compra', ['id'=>$pix_id]) }}" class="btn btn-danger">Cancelar Compra</a>

        </div>

    </div>

@endsection

@section('scripts')
    <script>
        function copiar() {
            var copyText = document.getElementById("brcodepix");
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */
            document.execCommand("copy");
        }
    </script>

@endsection
