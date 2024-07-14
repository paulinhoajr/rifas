<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Campanha;
use App\Models\Categoria;
use App\Models\Imagem;
use App\Models\Premio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Intervention\Image\ImageManagerStatic as Image;

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
        $campanhas = Campanha::orderByDesc('id')->get(); // where('situacao', 1)

        return view('admin.premios.create',[
            'campanhas' => $campanhas
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
			'campanha_id' => 'required',
			'nome' => 'required',
		]);

        $premio = new Premio();
        $premio->campanha_id = $request->campanha_id;
        $premio->nome = $request->nome;
        $premio->descricao = $request->descricao;
        $premio->save();

        return redirect()->route('admin.premios.index')->with('message', 'Premio inserido!');
    }

    public function show($id)
    {
        $premio = Premio::findOrFail($id);

        return view('admin.premios.show', compact('premio'));
    }

    public function edit($id)
    {
        $premio = Premio::findOrFail($id);
        $campanhas = Campanha::withTrashed()->orderByDesc('id')->get();

        return view('admin.premios.edit', [
            'premio' => $premio,
            'campanhas' => $campanhas
        ]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'premio_id' => 'required',
            'campanha_id' => 'required',
            'nome' => 'required',
        ]);

        $premio = Premio::findOrFail($request->premio_id);

        $premio->campanha_id = $request->campanha_id;
        $premio->nome = $request->nome;
        $premio->descricao = $request->descricao;
        $premio->save();

        return back()->with('message', 'Premio atualizado!');
    }

    public function delete($id): View
    {
        $premio = Premio::findOrFail($id);

        return view('admin.premios.delete', [
            'premio' => $premio
        ]);
    }

    public function destroy($id)
    {
        Premio::destroy($id);

        return redirect()->route('admin.premios.index')->with('message', 'Premio excluído!');
    }

    public function images($id){

        $premio = Premio::findOrFail($id);

        return view('admin.premios.images', compact('premio'));

    }

    public function upload(Request $request)
    {

        if ($request->hasFile('images')) {

            $files = $request->file('images');

            foreach($files as $file) {

                $ext = strtolower($file->getClientOriginalExtension());

                $filename = uniqid();

                $imagem_nome = $filename.'.'.$ext;

                $file_name = "/images/premios/$imagem_nome";
                $thumbs = "/images/premios/thumbs/$imagem_nome";

                //Storage::disk('public_campanhas')->put($file_name , File::get($file));
                Storage::disk('public')->put($file_name, File::get($file));

                $img = Image::make(storage_path('app/public/'.$file_name));
                $img->orientate();
                $img->resize(366, 244);
                $img->save(storage_path('app/public/'.$thumbs));

                $imagem = new Imagem();
                $imagem->premio_id = $request->premio_id;
                $imagem->caminho     = $imagem_nome;
                $imagem->situacao     = 1;
                $imagem->save();

            }
        }
    }

    public function list($id){

        $premio = Premio::findOrFail($id);

        return json_encode($premio->imagens);

    }

    public function remove($id)
    {
        $image = Imagem::find($id);

        Storage::disk('public')->delete('/images/premios/thumbs/'.$image->caminho);
        Storage::disk('public')->delete('/images/premios/'.$image->caminho);

        if($image->delete()){
            return "success";
        }

        return "error";

    }
}
