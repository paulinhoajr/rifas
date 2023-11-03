<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Sorteio;
use Illuminate\Http\Request;

class SorteiosController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $sorteios = Sorteio::where('nome', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $sorteios = Sorteio::latest()->paginate($perPage);
        }

        return view('admin.sorteios.index', compact('sorteios'));
    }

    public function create()
    {
        return view('admin.sorteios.create');
    }

    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        Sorteio::create($requestData);

        return redirect('admin/sorteios')->with('flash_message', 'Sorteio added!');
    }

    public function show($id)
    {
        $sorteio = Sorteio::findOrFail($id);

        return view('admin.sorteios.show', compact('sorteio'));
    }

    public function edit($id)
    {
        $sorteio = Sorteio::findOrFail($id);

        return view('admin.sorteios.edit', compact('sorteio'));
    }

    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $sorteio = Sorteio::findOrFail($id);
        $sorteio->update($requestData);

        return redirect('admin/sorteios')->with('flash_message', 'Sorteio updated!');
    }

    public function destroy($id)
    {
        Sorteio::destroy($id);

        return redirect('admin/sorteios')->with('flash_message', 'Sorteio deleted!');
    }
}
