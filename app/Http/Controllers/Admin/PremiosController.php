<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Premio;
use Illuminate\Http\Request;

class PremiosController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $premios = Premio::where('campanha_id', 'LIKE', "%$keyword%")
                ->orWhere('nome', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $premios = Premio::latest()->paginate($perPage);
        }

        return view('admin.premios.index', compact('premios'));
    }

    public function create()
    {
        return view('admin.premios.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
			'campanha_id' => 'required'
		]);
        $requestData = $request->all();

        Premio::create($requestData);

        return redirect('admin/premios')->with('flash_message', 'Premio added!');
    }

    public function show($id)
    {
        $premio = Premio::findOrFail($id);

        return view('admin.premios.show', compact('premio'));
    }

    public function edit($id)
    {
        $premio = Premio::findOrFail($id);

        return view('admin.premios.edit', compact('premio'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'campanha_id' => 'required'
		]);
        $requestData = $request->all();

        $premio = Premio::findOrFail($id);
        $premio->update($requestData);

        return redirect('admin/premios')->with('flash_message', 'Premio updated!');
    }

    public function destroy($id)
    {
        Premio::destroy($id);

        return redirect('admin/premios')->with('flash_message', 'Premio deleted!');
    }
}
