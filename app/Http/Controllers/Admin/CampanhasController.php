<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Campanha;
use Illuminate\Http\Request;

class CampanhasController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $campanhas = Campanha::where('nome', 'LIKE', "%$keyword%")
                ->orWhere('bilhete_id', 'LIKE', "%$keyword%")
                ->orWhere('categoria_id', 'LIKE', "%$keyword%")
                ->orWhere('preco', 'LIKE', "%$keyword%")
                ->orWhere('sorteio_id', 'LIKE', "%$keyword%")
                ->orWhere('whatsapp', 'LIKE', "%$keyword%")
                ->orWhere('modelo', 'LIKE', "%$keyword%")
                ->orWhere('descricao', 'LIKE', "%$keyword%")
                ->orWhere('minima', 'LIKE', "%$keyword%")
                ->orWhere('maxima', 'LIKE', "%$keyword%")
                ->orWhere('filtro', 'LIKE', "%$keyword%")
                ->orWhere('date', 'LIKE', "%$keyword%")
                ->orWhere('tempo', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $campanhas = Campanha::latest()->paginate($perPage);
        }

        return view('admin.campanhas.index', compact('campanhas'));
    }

    public function create()
    {
        return view('admin.campanhas.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
			'nome' => 'required',
			'bilhete_id' => 'required',
			'categoria_id' => 'required',
			'preco' => 'required',
			'sorteio_id' => 'required',
			'modelo' => 'required',
			'status' => 'required'
		]);
        $requestData = $request->all();

        Campanha::create($requestData);

        return redirect('admin/campanhas')->with('flash_message', 'Campanha added!');
    }

    public function show($id)
    {
        $campanha = Campanha::findOrFail($id);

        return view('admin.campanhas.show', compact('campanha'));
    }

    public function edit($id)
    {
        $campanha = Campanha::findOrFail($id);

        return view('admin.campanhas.edit', compact('campanha'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'nome' => 'required',
			'bilhete_id' => 'required',
			'categoria_id' => 'required',
			'preco' => 'required',
			'sorteio_id' => 'required',
			'modelo' => 'required',
			'status' => 'required'
		]);
        $requestData = $request->all();

        $campanha = Campanha::findOrFail($id);
        $campanha->update($requestData);

        return redirect('admin/campanhas')->with('flash_message', 'Campanha updated!');
    }

    public function destroy($id)
    {
        Campanha::destroy($id);

        return redirect('admin/campanhas')->with('flash_message', 'Campanha deleted!');
    }
}
