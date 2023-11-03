<?php

namespace App\Http\Controllers\Admin;

use App\Empresa;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;

class EmpresasController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $empresas = Empresa::where('name', 'LIKE', "%$keyword%")
                ->orWhere('teste', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $empresas = Empresa::latest()->paginate($perPage);
        }

        return view('admin.empresas.index', compact('empresas'));
    }

    public function create()
    {
        return view('admin.empresas.create');
    }

    public function store(Request $request)
    {

        $requestData = $request->all();

        Empresa::create($requestData);

        return redirect('admin/empresas')->with('flash_message', 'Empresa added!');
    }

    public function show($id)
    {
        $empresa = Empresa::findOrFail($id);

        return view('admin.empresas.show', compact('empresa'));
    }

    public function edit($id)
    {
        $empresa = Empresa::findOrFail($id);

        return view('admin.empresas.edit', compact('empresa'));
    }

    public function update(Request $request, $id)
    {

        $requestData = $request->all();

        $empresa = Empresa::findOrFail($id);
        $empresa->update($requestData);

        return redirect('admin/empresas')->with('flash_message', 'Empresa updated!');
    }

    public function destroy($id)
    {
        Empresa::destroy($id);

        return redirect('admin/empresas')->with('flash_message', 'Empresa deleted!');
    }
}
