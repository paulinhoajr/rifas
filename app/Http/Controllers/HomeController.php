<?php

namespace App\Http\Controllers;


use App\Models\Campanha;
use App\Models\Certificado;

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
