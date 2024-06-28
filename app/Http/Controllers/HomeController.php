<?php

namespace App\Http\Controllers;


use App\ApiPixSicredi\PixSicredi;
use App\Models\Campanha;


class HomeController extends Controller
{
    public function index()
    {
        $campanhas = Campanha::where('situacao', 1)
            ->take(8)
            ->orderByDesc('id')
            ->get();

        return view('site.dashboard', [
            'campanhas' => $campanhas
        ]);
    }

    public function teste()
    {
        $initPix  = [
            "producao" => 0, // 0 | 1
            "client_id" => "",
            "client_secret" => "",
            "crt_file" => "/certificado.pem",
            "key_file" => "/APLICACAO.key",
            "pass" => ""
        ];

        $pix         = new PixSicredi($initPix);

        $accessToken = $pix->accessToken();

        print_r($accessToken);
    }

    public function criar_cobranca()
    {
        $pix->updateWebhook('sua-url', 'sua-chave-pix');

        $cobranca  = [
            "calendario" => [
                "dataDeVencimento" => "2040-04-01",
                "validadeAposVencimento" => 1
            ],

            "valor" => [
                "original" => 10.00,
                "modalidadeAlteracao" => 1
            ],
            "chave" => "23711695000115",
            "solicitacaoPagador" => "Serviço realizado.",
            "infoAdicionais" => [
                [
                    "nome" => "cliente_id",
                    "valor" => "1234"
                ],
                [
                    "nome" => "fatura_id",
                    "valor" =>  123334
                ]
            ]
        ];

        $pix->token = $accessToken;
        $pix->criarCobranca($cobranca );

    }

    public function campanha($id, $nome)
    {
        $campanha = Campanha::where('situacao', 1)
            ->where('id', $id)
            ->first();

        return view('site.campanha', [
            'campanha' => $campanha
        ]);
    }



}
