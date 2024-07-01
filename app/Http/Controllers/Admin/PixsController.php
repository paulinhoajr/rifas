<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pix;
use Illuminate\Http\Request;

class PixsController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        //$keyword = $request->get('search');
        $perPage = 50;

        if (!empty($keyword)) {
            //$sorteios = Pix::where('nome', 'LIKE', "%$keyword%")
            $pixs = Pix::where('nome', 'LIKE', "%$keyword%")
                ->latest()
                ->paginate($perPage);
        } else {
            $pixs = Pix::latest()
                ->paginate($perPage);
        }

        return view('admin.pixs.index', [
            'pixs' => $pixs
        ]);
    }


    public function show($id)
    {
        $sorteio = Sorteio::findOrFail($id);

        return view('admin.sorteios.show', compact('sorteio'));
    }

}
