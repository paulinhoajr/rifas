<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Campanha;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoriasController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $categorias = Categoria::where('nome', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $categorias = Categoria::latest()->paginate($perPage);
        }

        return view('admin.categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('admin.categorias.create');
    }

    public function store(Request $request)
    {

        $requestData = $request->all();

        $categoria = new Categoria;
        $categoria->nome = $requestData['nome'];
        $categoria->save();

        return redirect('admin/categorias')->with('flash_message', 'Categoria added!');
    }

    public function show($id)
    {
        $categoria = Categoria::findOrFail($id);

        return view('admin.categorias.show', compact('categoria'));
    }

    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);

        return view('admin.categorias.edit', compact('categoria'));
    }

    public function update(Request $request)
    {

        $requestData = $request->all();

        $categoria = Categoria::findOrFail($request->categoria_id);
        $categoria->nome = $requestData['nome'];
        $categoria->save();

        return redirect('admin/categorias')->with('flash_message', 'Categoria updated!');
    }

    public function delete($id): View
    {
        $categoria = Categoria::where('id', $id)->first();

        return view('admin.categorias.delete', [
            'categoria' => $categoria
        ]);
    }

    public function destroy($id)
    {
        Categoria::destroy($id);

        return redirect('admin/categorias')->with('flash_message', 'Categoria deleted!');
    }
}
