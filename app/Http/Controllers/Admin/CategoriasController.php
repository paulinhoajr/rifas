<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Categoria;
use Illuminate\Http\Request;

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
        
        Categoria::create($requestData);

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

    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $categoria = Categoria::findOrFail($id);
        $categoria->update($requestData);

        return redirect('admin/categorias')->with('flash_message', 'Categoria updated!');
    }

    public function destroy($id)
    {
        Categoria::destroy($id);

        return redirect('admin/categorias')->with('flash_message', 'Categoria deleted!');
    }
}
