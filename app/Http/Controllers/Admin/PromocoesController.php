<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Campanha;
use App\Models\Promocao;
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
            $promocoes = Promocao::where('campanha_id', 'LIKE', "%$keyword%")
                ->orWhere('quantidade', 'LIKE', "%$keyword%")
                ->orWhere('valor', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $promocoes = Promocao::latest()->paginate($perPage);
        }

        return view('admin.promocoes.index',[
            'promocoes' => $promocoes
        ]);
    }

    public function create()
    {
        $campanhas = Campanha::orderByDesc('id')->get();

        return view('admin.promocoes.create', [
            'campanhas' => $campanhas
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
			'campanha_id' => 'required',
			'quantidade' => 'required',
			'valor' => 'required',
		]);

        $campanha = Campanha::findOrFail($request->campanha_id);

        if ($campanha){
            return back()->with('message_alert', 'Essa campanha já tem uma promoção!');
        }

        $promocao = new Promocao();
        $promocao->campanha_id = $request->campanha_id;
        $promocao->quantidade = $request->quantidade;
        $promocao->valor = $request->valor;
        $promocao->save();

        return redirect()->route('admin.promocoes.index')->with('message', 'Promoção inserida!');
    }

    public function show($id)
    {
        $promoco = Promocao::findOrFail($id);

        return view('admin.promocoes.show', compact('promoco'));
    }

    public function edit($id)
    {
        $promoco = Promocao::findOrFail($id);

        return view('admin.promocoes.edit', compact('promoco'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'campanha_id' => 'required'
		]);
        $requestData = $request->all();

        $promoco = Promocao::findOrFail($id);
        $promoco->update($requestData);

        return redirect('admin/promocoes')->with('flash_message', 'Promocao updated!');
    }

    public function destroy($id)
    {
        Promocao::destroy($id);

        return redirect('admin/promocoes')->with('flash_message', 'Promocao deleted!');
    }
}
