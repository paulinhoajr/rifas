<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Bilhete;
use App\Models\Campanha;
use App\Models\CampanhaBilhete;
use App\Models\Categoria;
use App\Models\Imagem;
use App\Models\Sorteio;
use App\Models\Usuario;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Intervention\Image\ImageManagerStatic as Image;

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
                ->orWhere('descricao', 'LIKE', "%$keyword%")
                ->orderByDesc('id')
                ->paginate($perPage);
        } else {
            $campanhas = Campanha::orderByDesc('id')->paginate($perPage);
        }

        return view('admin.campanhas.index', compact('campanhas'));
    }

    public function create()
    {
        $bilhetes = Bilhete::all();
        $categorias = Categoria::all();
        $sorteios = Sorteio::all();

        return view('admin.campanhas.create', [
            'bilhetes' => $bilhetes,
            'categorias' => $categorias,
            'sorteios' => $sorteios
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
			'bilhete_id' => 'required',
			'categoria_id' => 'required',
            'sorteio_id' => 'required',
			'modelo' => 'required',
			'filtro' => 'required',
            'nome' => 'required',
            'whatsapp' => 'required',
            'preco' => 'required',
            'minima' => 'required',
            'maxima' => 'required',
            'data' => 'required',
            'tempo' => 'required',
            'email' => 'required',
            'descricao' => 'required',
            'situacao' => 'required',
            'inicial' => 'required',
		]);

        try {

            if ($request->inicial==1){
                $camp = Campanha::where('inicial', 1)->first();
                if ($camp){
                    $camp->inicial = 0;
                    $camp->save();
                }
            }

            DB::beginTransaction();

            $campanha = new Campanha();
            $campanha->categoria_id = $request->categoria_id;
            $campanha->bilhete_id = $request->bilhete_id;
            $campanha->sorteio_id = $request->sorteio_id;
            $campanha->modelo = $request->modelo;
            $campanha->filtro = $request->filtro;
            $campanha->nome = $request->nome;
            $campanha->whatsapp = $request->whatsapp;
            $campanha->preco = $request->preco;
            $campanha->minima = $request->minima;
            $campanha->maxima = $request->maxima;
            $campanha->data = dateTimeBrParaDateTimeUs($request->data);
            $campanha->tempo = $request->tempo;
            $campanha->email = $request->email;
            $campanha->descricao = $request->descricao;
            $campanha->inicial = $request->inicial;
            $campanha->situacao = $request->situacao;
            $campanha->save();

            $bilhetes = $campanha->bilhete->quantidade - 1;

            for ($i=0;$i<=$bilhetes;$i++){
                $bilhete = new CampanhaBilhete();
                $bilhete->numero = $i;
                $bilhete->campanha_id = $campanha->id;
                $bilhete->save();
            }

            DB::commit();

            return redirect()
                ->route('admin.campanhas.edit', ['id'=>$campanha->id])
                ->with('message', 'Campanha inserida com sucesso.');

        }catch (\Exception|QueryException $e){

            DB::rollBack();

            return back()->with('message_fail', 'Error: '. $e->getMessage());
        }

    }

    public function show($id)
    {
        $campanha = Campanha::findOrFail($id);

        return view('admin.campanhas.show', compact('campanha'));
    }

    public function edit($id)
    {
        $campanha = Campanha::findOrFail($id);

        $bilhetes = Bilhete::all();
        $categorias = Categoria::all();
        $sorteios = Sorteio::all();

        return view('admin.campanhas.edit', [
            'campanha' => $campanha,
            'bilhetes' => $bilhetes,
            'categorias' => $categorias,
            'sorteios' => $sorteios
        ]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            //'bilhete_id' => 'required',
            'categoria_id' => 'required',
            'sorteio_id' => 'required',
            'modelo' => 'required',
            'filtro' => 'required',
            'nome' => 'required',
            'whatsapp' => 'required',
            'preco' => 'required',
            'minima' => 'required',
            'maxima' => 'required',
            'data' => 'required',
            'tempo' => 'required',
            'email' => 'required',
            'descricao' => 'required',
            'situacao' => 'required',
            'inicial' => 'required',
        ]);

       // dd($request->all());

        try {

            if ($request->inicial==1){
                $camp = Campanha::where('inicial', 1)->first();
                if ($camp){
                    $camp->inicial = 0;
                    $camp->save();
                }
            }

            $campanha = Campanha::where('id', $request->id)->first();

            if (!$campanha){
                return back()->with('message_fail', 'Campanha não encontrada.');
            }

            DB::beginTransaction();

            $campanha->categoria_id = $request->categoria_id;
            //$campanha->bilhete_id = $request->bilhete_id;
            $campanha->sorteio_id = $request->sorteio_id;
            $campanha->modelo = $request->modelo;
            $campanha->filtro = $request->filtro;
            $campanha->nome = $request->nome;
            $campanha->whatsapp = $request->whatsapp;
            $campanha->preco = $request->preco;
            $campanha->minima = $request->minima;
            $campanha->maxima = $request->maxima;
            $campanha->data = dateTimeBrParaDateTimeUs($request->data);
            $campanha->tempo = $request->tempo;
            $campanha->email = $request->email;
            $campanha->descricao = $request->descricao;
            $campanha->inicial = $request->inicial;
            $campanha->situacao = $request->situacao;
            $campanha->save();


            DB::commit();

            //dd($campanha);

            return redirect()
                ->route('admin.campanhas.edit', ['id'=>$campanha->id])
                ->with('message', 'Campanha alterada com sucesso.');

        }catch (\Exception|QueryException $e){

            DB::rollBack();

            return back()->with('message_fail', 'Error: '. $e->getMessage());
        }
    }

    public function delete($id): View
    {
        $campanha = Campanha::where('id', $id)->first();

        return view('admin.campanhas.delete', [
            'campanha' => $campanha
        ]);
    }

    public function destroy($id): RedirectResponse
    {
        $campanha = Campanha::where('id', $id)->first();

        if ($campanha){

            /*if (file_exists(public_path().'/images/noticias/'. $noticia->pasta)) {
                File::deleteDirectory(public_path().'/images/noticias/'.$noticia->pasta);
            }*/

            $campanha->delete();

            return redirect()
                ->route('admin.campanhas.index')
                ->with('message', 'Campanha excluída com sucesso.');
        }

        return back()->with('message_fail', 'A Campanha não pode ser excluída.');

    }




}
