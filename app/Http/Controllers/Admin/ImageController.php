<?php

namespace App\Http\Controllers\Admin;

use App\Imagem;
use App\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    private $imagem;
    private $slider;

    public function __construct(Imagem $imagem, Slider $slider)
    {
        $this->imagem = $imagem;
        $this->slider = $slider;
    }

    public function upload_slider(Request $request)
    {

        if($request->has('slim') && $request->slim[0])
        {

             $output = $request->slim[0];
             $output = json_decode($output, TRUE);

             if(isset($output) && isset($output['output']) && isset($output['output']['image']))
                 $image = $output['output']['image'];

             if(isset($image))
             {

                 $data = $this->imagem->save_base64_image($image, 'sliders');
                 if($data['code'] == 0)
                 {

                     $slider = $this->slider->where('id',$request->slider_id)->first();

                     if($slider->image !== null){
                         Storage::disk('public_temp')->delete($slider->image);
                     }

                     $slider->where('id', $request->slider_id)->update([
                         'image' => $data['url']
                     ]);


                 }

                 return $data;
             }
             return 'No picture file';
        }
        return 'Non-use slim cropper crop';
    }

    public function delete_slider(Request $request)
    {
        $slider = $this->slider->where('id',$request->slider_id)->first();

        if($slider->image !== null){
            Storage::disk('public_temp')->delete($slider->image);
        }

        $slider->where('id', $request->slider_id)->update([
            'image' => ""
        ]);
    }

}
