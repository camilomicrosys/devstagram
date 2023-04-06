<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
//esto es de una libreria que se importa video con composer video 97
use Intervention\Image\Facades\Image;
class ImagenController extends Controller
{
    //

    public function almacenarImagen(Request $request){
   
      
        $imagen=$request->file('file');
        $nombre_imagen=Str::uuid().".".$imagen->extension();
        $imagen_servidor=Image::make($imagen);
        $imagen_servidor->fit(1000,1000);
        $imagenPath=public_path('uploads').'/'.$nombre_imagen;
        $imagen_servidor->save($imagenPath);
       return response()->json(['imagenes'=>$nombre_imagen]);
           
     }
   

}
