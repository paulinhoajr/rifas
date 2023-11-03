<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Promoco;
use Illuminate\Http\Request;

class PromocoesController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $promocoes = Promoco::where('campanha_id', 'LIKE', "%$keyword%")
                ->orWhere('quantidade', 'LIKE', "%$keyword%")
                ->orWhere('valor', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $promocoes = Promoco::latest()->paginate($perPage);
        }

        return view('admin.promocoes.index', compact('promocoes'));
    }

    public function create()
    {
        return view('admin.promocoes.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
			'campanha_id' => 'required'
		]);
        $requestData = $request->all();

        Promoco::create($requestData);

        return redirect('admin/promocoes')->with('flash_message', 'Promoco added!');
    }

    public function show($id)
    {
        $promoco = Promoco::findOrFail($id);

        return view('admin.promocoes.show', compact('promoco'));
    }

    public function edit($id)
    {
        $promoco = Promoco::findOrFail($id);

        return view('admin.promocoes.edit', compact('promoco'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'campanha_id' => 'required'
		]);
        $requestData = $request->all();

        $promoco = Promoco::findOrFail($id);
        $promoco->update($requestData);

        return redirect('admin/promocoes')->with('flash_message', 'Promoco updated!');
    }

    public function destroy($id)
    {
        Promoco::destroy($id);

        return redirect('admin/promocoes')->with('flash_message', 'Promoco deleted!');
    }
}
