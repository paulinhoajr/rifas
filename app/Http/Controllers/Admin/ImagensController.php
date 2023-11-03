<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Imagen;
use Illuminate\Http\Request;

class ImagensController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $imagens = Imagen::where('campanha_id', 'LIKE', "%$keyword%")
                ->orWhere('nome', 'LIKE', "%$keyword%")
                ->orWhere('caminho', 'LIKE', "%$keyword%")
                ->orWhere('ordem', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $imagens = Imagen::latest()->paginate($perPage);
        }

        return view('admin.imagens.index', compact('imagens'));
    }

    public function create()
    {
        return view('admin.imagens.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
			'campanha_id' => 'required'
		]);
        $requestData = $request->all();

        Imagen::create($requestData);

        return redirect('admin/imagens')->with('flash_message', 'Imagen added!');
    }

    public function show($id)
    {
        $imagen = Imagen::findOrFail($id);

        return view('admin.imagens.show', compact('imagen'));
    }

    public function edit($id)
    {
        $imagen = Imagen::findOrFail($id);

        return view('admin.imagens.edit', compact('imagen'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'campanha_id' => 'required'
		]);
        $requestData = $request->all();

        $imagen = Imagen::findOrFail($id);
        $imagen->update($requestData);

        return redirect('admin/imagens')->with('flash_message', 'Imagen updated!');
    }

    public function destroy($id)
    {
        Imagen::destroy($id);

        return redirect('admin/imagens')->with('flash_message', 'Imagen deleted!');
    }
}
