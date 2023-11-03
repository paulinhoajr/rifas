<?php

namespace App\Http\Controllers;


use App\Models\Certificado;

class HomeController extends Controller
{
    public function index()
    {

        return view('site.dashboard');
    }

}
