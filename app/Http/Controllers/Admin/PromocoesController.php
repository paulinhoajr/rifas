<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Campanha;
use App\Models\Categoria;
use App\Models\Promocao;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
            $promocaoes = Promocao::where('campanha_id', 'LIKE', "%$keyword%")
                ->orWhere('quantidade', 'LIKE', "%$keyword%")
                ->orWhere('valor', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $promocaoes = Promocao::latest()->paginate($perPage);
        }

        return view('admin.promocoes.index',[
            'promocoes' => $promocaoes
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

        $promocao = Promocao::where('campanha_id', $request->campanha_id)
            ->where('situcao', 1)
            ->first();

        if ($promocao){
            return back()->with('message_alert', 'Essa campanha já tem uma promoção!');
        }

        $promocao = new Promocao();
        $promocao->campanha_id = $request->campanha_id;
        $promocao->quantidade = $request->quantidade;
        $promocao->valor = $request->valor;
        $promocao->situcao = 1;
        $promocao->save();

        return redirect()->route('admin.promocoes.index')->with('message', 'Promoção inserida!');
    }

    public function show($id)
    {
        $promocao = Promocao::findOrFail($id);

        return view('admin.promocoes.show', compact('promocao'));
    }

    public function edit($id)
    {
        $promocao = Promocao::findOrFail($id);

        return view('admin.promocoes.edit', [
            'promocao' => $promocao,
            'campanhas' => Campanha::orderByDesc('id')->get()
        ]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
			'campanha_id' => 'required',
			'promocao_id' => 'required',
			'quantidade' => 'required',
			'valor' => 'required',
		]);

        $promocao = Promocao::findOrFail($request->promocao_id);
        $promocao->campanha_id = $request->campanha_id;
        $promocao->quantidade = $request->quantidade;
        $promocao->valor = $request->valor;
        $promocao->save();

        return redirect('admin/promocoes')->with('flash_message', 'Promocao updated!');
    }

    public function delete($id): View
    {
        $promocao = Promocao::findOrFail($id);

        return view('admin.promocoes.delete', [
            'promocao' => $promocao
        ]);
    }

    public function destroy($id)
    {
        Promocao::destroy($id);

        return redirect('admin/promocoes')->with('flash_message', 'Promocao deleted!');
    }
}
