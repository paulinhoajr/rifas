<?php

namespace App\Http\Controllers\Admin;

use App\Equipamento;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Image;
use App\Imagem;
use App\Marca;
use App\Motor;
use App\Produto;
use App\State;
use App\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Crops;
use function GuzzleHttp\Psr7\str;

class ProdutoController extends Controller
{
    private $state;
    private $imagem;

    public function __construct(State $state, Imagem $imagem)
    {

        $this->state = $state;
        $this->imagem = $imagem;
    }

    public function index()
    {
        //$user_id = Auth::user()->id;
        $produto = Produto::latest()->get(); //where('user_id', $user_id)->

        //testando som 123

        return view('admin.produtos.index', compact('produto'));
    }

    public function create()
    {
        $states = $this->state->all();
        $equipamentos = Equipamento::all();
        $marcas = Marca::all();

        return view('admin.produtos.create',compact('states', 'equipamentos', 'marcas'));
    }

    public function store(Request $request)
    {
        //dd($request->all());

        $this->validate($request, [
			//'user_id' => 'required',
			'equipamento_id' => 'required',
			'state_id' => 'required',
			'city_id' => 'required',
		]);

        //$id = Auth::user()->id;

        if (! File::exists(public_path().'/images/produtos/thumbs/')) {
            File::makeDirectory(public_path().'/images/produtos/thumbs/');
        }

        if (! File::exists(public_path().'/images/produtos/')) {
            File::makeDirectory(public_path().'/images/produtos/');
        }

        $imagem_nome = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = strtolower($file->getClientOriginalExtension());
            $filename = uniqid();
            $imagem_nome = $filename.'.'.$ext;
            $file_name = "/$imagem_nome";

            Storage::disk('public_temp')->put('/temps/'.$file_name , File::get($file));

            $path = public_path().'/temps'.$file_name;

            /*try {
                $cropped = Crops::make($path)->fit(645, 290, function ($c) {
                    $c->upsize();
                })->encode('jpg', 80);
            }catch (\Exception $e){
                dd($e->getMessage());
            }*/

            $img = \Intervention\Image\ImageManagerStatic::make($path);

            //$img->resize(1024, null)->encode($ext, 80);
            $img->resize(645, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode($ext, 80);

            Storage::disk('public_root')->put('/images/produtos/'.$file_name, (string) $img);

            //$this->imagem->criarMiniatura($imagem_nome, $id, 360, 234,'produtos');

            Storage::disk('public_temp')->delete('/temps/'.$file_name);

            $imagem_nome = '/images/produtos/'.$imagem_nome;
        }

        $valor = str_replace('.','', $request->valor);
        $valor = str_replace(',','.', $valor);

        $data = [
            //"user_id" => $id,
            "equipamento_id" => $request->equipamento_id,
            "motor_id" => $request->motor_id,
            "elevacao" => $request->elevacao,
            "tipo_id" => $request->tipo_id,
            "marca_id" => $request->marca_id,
            "marca" => $request->marca,
            "capacidade" => $request->capacidade,
            "state_id" => $request->state_id,
            "city_id" => $request->city_id,
            "uso" => $request->uso,
            "valor" => $valor,
            "ano" => $request->ano,
            "horimetro" => $request->horimetro,
            "description" => $request->description,
            "image" => $imagem_nome,
            "status" => $request->status,
        ];

        $produto = Produto::create($data);

        if ($request->hasFile('images')) {
            $files = $request->file('images');
            foreach($files as $file) {

                $ext = strtolower($file->getClientOriginalExtension());
                $filename = uniqid();
                $imagem_nome = $filename.'.'.$ext;
                $file_name = "/$imagem_nome";
                try {

                    Storage::disk('public_temp')->put('/temps/'.$file_name , File::get($file));

                    $path = public_path().'/temps'.$file_name;

                    $img = \Intervention\Image\ImageManagerStatic::make($path);

                    //$img->resize(1024, null)->encode($ext, 80);
                    $img->resize(1024, null, function ($constraint) { //750, 500
                        $constraint->aspectRatio();
                    })->encode($ext, 80);

                    Storage::disk('public_root')->put('/images/produtos/'.$file_name, (string) $img);

                    $this->imagem->criarMiniaturaProduto($imagem_nome, 187, 140,'produtos');

                    Storage::disk('public_temp')->delete('/temps/'.$file_name);

                    $data = [
                        'produto_id'=>$produto->id,
                        'image'=>$imagem_nome
                    ];

                    Image::create($data);
                }catch (Exception $e){
                    //dd('');
                }
            }
        }

        return redirect()->route('produtos.index', ['id'=>$produto->id])->with('flash_message', 'Produto added!')->withInput();
    }

    public function show($id)
    {
        //$user_id = Auth::user()->id;
        $produto = Produto::where('id', $id)->first();//where('user_id', $user_id)->

        return view('admin.show', compact('produto'));
    }

    public function active($id)
    {
        //$user_id = Auth::user()->id;
        $produto = Produto::where('id', $id)->first();//where('user_id', $user_id)->

        if ($produto->status==0){
            $produto->update(['status'=>1]);
            return redirect()->back()->with('flash_message', 'Produto ativado!');
        }else{
            $produto->update(['status'=>0]);
            return redirect()->back()->with('flash_message', 'Produto desativado!');
        }

    }

    public function confere($id)
    {
        //$user_id = Auth::user()->id;
        $produto = Produto::where('id', $id)->first();//where('user_id', $user_id)->

        return view('admin.produtos.show', compact('produto'));
    }

    public function edit($id)
    {
        //$user_id = Auth::user()->id;
        $produto = Produto::where('id', $id)->first();//where('user_id', $user_id)->

        $states = $this->state->all();
        $equipamentos = Equipamento::all();
        $marcas = Marca::all();

        return view('admin.produtos.edit', compact('produto', 'states', 'equipamentos', 'marcas'));
    }

    /*public function image($id)
    {
        $user_id = Auth::user()->id;
        $produto = Produto::where('user_id', $user_id)->where('id', $id)->first();

        return view('admin.produtos.image', compact('produto'));
    }*/

    public function update(Request $request, $id)
    {
        //dd($request->all());

        $this->validate($request, [
			//'user_id' => 'required',
			'equipamento_id' => 'required',
			'state_id' => 'required',
			'city_id' => 'required'
		]);

        //$user_id = Auth::user()->id;

        if (! File::exists(public_path().'/images/produtos/thumbs/')) {
            File::makeDirectory(public_path().'/images/produtos/thumbs/');
        }

        if (! File::exists(public_path().'/images/produtos/')) {
            File::makeDirectory(public_path().'/images/produtos/');
        }

        $produto = Produto::where('id', $id)->first(); //where('user_id', $user_id)->

        if ($request->hasFile('image')) {
            //if ($produto->image == null){
                $file = $request->file('image');
                $ext = strtolower($file->getClientOriginalExtension());
                $filename = uniqid();
                $imagem_nome = $filename.'.'.$ext;
                $file_name = "/$imagem_nome";

                Storage::disk('public_temp')->put('/temps/'.$file_name , File::get($file));

                $path = public_path().'/temps'.$file_name;

                /*try {
                    $cropped = Crops::make($path)->fit(645, 290, function ($c) {
                        $c->upsize();
                    })->encode('jpg', 80);
                }catch (\Exception $e){
                    dd($e->getMessage());
                }*/

                $img = \Intervention\Image\ImageManagerStatic::make($path);

                //$img->resize(1024, null)->encode($ext, 80);
                $img->resize(645, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->encode($ext, 80);

                Storage::disk('public_root')->put('/images/produtos/'.$file_name, (string) $img);

                //$this->imagem->criarMiniatura($imagem_nome, $id, 360, 234,'produtos');

                Storage::disk('public_temp')->delete('/temps/'.$file_name);

                $imagem_nome = '/images/produtos/'.$imagem_nome;
           // }
        }else{
            $imagem_nome = $produto->image;
        }

        $valor = str_replace('.','', $request->valor);
        $valor = str_replace(',','.', $valor);

        $data = [
            "equipamento_id" => $request->equipamento_id,
            "motor_id" => $request->motor_id,
            "elevacao" => $request->elevacao,
            "tipo_id" => $request->tipo_id,
            "marca_id" => $request->marca_id,
            "marca" => $request->marca,
            "capacidade" => $request->capacidade,
            "state_id" => $request->state_id,
            "city_id" => $request->city_id,
            "valor" => $valor,
            "ano" => $request->ano,
            "horimetro" => $request->horimetro,
            "description" => $request->description,
            "image" => $imagem_nome,
            "status" => $request->status,
        ];

        $produto->update($data);

        if ($request->hasFile('images')) {
            $files = $request->file('images');
            foreach($files as $file) {

                $ext = strtolower($file->getClientOriginalExtension());
                $filename = uniqid();
                $imagem_nome = $filename.'.'.$ext;
                $file_name = "/$imagem_nome";
                try {

                    Storage::disk('public_temp')->put('/temps/'.$file_name , File::get($file));

                    $path = public_path().'/temps'.$file_name;

                    $img = \Intervention\Image\ImageManagerStatic::make($path);

                    //$img->resize(1024, null)->encode($ext, 80);
                    $img->resize(1024, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode($ext, 80);

                    Storage::disk('public_root')->put('/images/produtos/'.$file_name, (string) $img);

                    $this->imagem->criarMiniaturaProduto($imagem_nome, 187, 140,'produtos');

                    Storage::disk('public_temp')->delete('/temps/'.$file_name);

                    $data = [
                        'produto_id'=>$produto->id,
                        'image'=>$imagem_nome
                    ];

                    Image::create($data);
                }catch (Exception $e){
                    //dd('');
                }
            }
        }

        return redirect()->back()->with('flash_message', 'Produto alterado!');
    }

    public function destroy($id)
    {

        $produto = Produto::findOrFail($id);

        $images = Image::where('produto_id',$produto->id)->get();
        $image = $produto->image;

        if($produto->delete()){
            Storage::disk('public_root')->delete($image);

            if ($images!=null){

                foreach ($images as $image){
                    Storage::disk('public_produtos')->delete('/thumbs/'.$image->image);
                    Storage::disk('public_produtos')->delete('/'.$image->image);
                    $image->delete();
                }


            }
        }

        return redirect()->back()->with('flash_message', 'Produto excluido!');
    }



    /*public function images($id){
        $produto = Produto::findOrFail($id);
        return view('admin.produtos.images', compact('produto'));
    }*/

    /*public function listImages($id){
        $produto = Produto::findOrFail($id);
        //print_r($news);exit;
        return json_encode($produto->images);
    }*/

    /*public function uploadImagem(Request $request)
    {
        //dd($request->all());
        $files = $request->file('images');
        $id = Auth::user()->id;

        if (! File::exists(public_path().'/images/produtos/thumbs/'.$id.'/')) {
            File::makeDirectory(public_path().'/images/produtos/thumbs/'.$id.'/');
        }

        if (! File::exists(public_path().'/images/produtos/'.$id.'/')) {
            File::makeDirectory(public_path().'/images/produtos/'.$id.'/');
        }


        foreach($files as $file) {

            //dd($file);

            $ext = strtolower($file->getClientOriginalExtension());
            $filename = uniqid();
            $imagem_nome = $filename.'.'.$ext;
            $file_name = "/$imagem_nome";

            Storage::disk('public_temp')->put('/temps/'.$file_name , File::get($file));
            //$this->imagem->interventionCrop($imagem_nome, 'vehicles', 600, 800);

            $path = public_path().'/temps'.$file_name;



            try {
                $cropped = Crops::make($path)->fit(750, 500, function ($c) {
                    $c->upsize();
                })->encode('jpg', 80);
            }catch (\Exception $e){
                dd($e->getMessage());
            }

            Storage::disk('public_root')->put('/images/produtos/'.$id.'/'.$file_name, (string) $cropped);
            //($imagem_nome, $maxlarguraP, $maxAlturaP, $module)
            $this->imagem->criarMiniatura($imagem_nome, $id, 360, 234,'produtos');
            //dd('');
            Storage::disk('public_temp')->delete('/temps/'.$file_name);

            $data = [
                'produto_id'=>$request->produto_id,
                'image'=>$imagem_nome
            ];

            Image::create($data);
        }
    }*/

    /*public function removeImagem($id)
    {
        $image = Image::findOrFail($id);

        $id = Auth::user()->id;
        Storage::disk('public_produtos')->delete('/'.$id.'/thumbs/'.$image->image);
        Storage::disk('public_produtos')->delete('/'.$id.'/'.$image->image);

        if($image->delete()){
            return "success";
        }

        return "error";
    }*/

    public function imageRemove($id)// unica
    {
        $produto = Produto::findOrFail($id);

        $image = $produto->image;

        $delete = $produto->update(['image'=>null]);

        if($delete){
            Storage::disk('public_root')->delete($image);
            return redirect()->back()->with('flash_message', 'Imagem deletada!');
        }else{
            return redirect()->back()->with('flash_message_error', 'Imagem não deletada!');
        }

    }

    public function imagesRemove($id)// unica
    {
        $imagem = Image::findOrFail($id);

        //$id = $imagem->produto->user->id;
        $image = $imagem->image;

        if($imagem->delete()){
            Storage::disk('public_produtos')->delete('/thumbs/'.$image);
            Storage::disk('public_produtos')->delete('/'.$image);
            return redirect()->back()->with('flash_message', 'Imagem deletada!');
        }else{
            return redirect()->back()->with('flash_message_error', 'Imagem não deletada!');
        }
    }

}
