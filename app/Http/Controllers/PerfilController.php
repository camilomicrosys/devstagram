<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class PerfilController extends Controller

{

     //protegemos la ruta con este codigo que solo puedan aceeder a los metodos de la clase usuarios autenticados
     public function __construct(){
        $this->middleware('auth');
    }
    //este user es el que viene de la url de la relacion de eloquent /{user:username}/actualziarPerfil
   public function index(User $user){

    $data=[
        'user'=>$user
    ];

    return view('perfil.index',$data);

   }

   public function actualizarPerfil(Request $request){

    //obtenemos el usaurio que vamos a modificar asi como en tinker para luego hacer la relacion con eloquent de su actualziacion
    $usuario=User::find(auth()->user()->id);

    //modificar el request para ponerle el slug que es una cadena valida para url
    $request->request->add(['username'=>Str::slug($request->username)]);
   /*  
   esta linea 'unique:users,username,'.auth()->user()->id es la que permite actualizar el mismo username si es del usuario autenticado se pasa id autenticado ya laravel por debajo lo asimila
   */
    $this->validate($request, [
        'username' => [
            'required','unique:users,username,'.auth()->user()->id,'min:3'
        ]
    ]);
    
    //validamos si viene imagen actualizamos imagen si no nada
    if($request->imageperfil){
         //eliminamos la imagen que tenga actual si es diferente de null o vacio ya que si es null o vacio pues no tiene es primer vez
         if( $usuario->imagen != "" && $usuario->imagen != null){
            // código a ejecutar si la imagen existe
            $imagen_a_borrar=$usuario->imagen;
            $ruta_imagen = public_path('perfiles/' . $imagen_a_borrar);
            //si el archivo existe lo borramos
            
                if (file_exists($ruta_imagen)) {
                    unlink($ruta_imagen);
                }
        }
        $imagen=$request->file('imageperfil');
        $nombre_imagen=Str::uuid().".".$imagen->extension();
        $imagen_servidor=Image::make($imagen);
        $imagen_servidor->fit(1000,1000);
        $imagenPath=public_path('perfiles').'/'.$nombre_imagen;
        $imagen_servidor->save($imagenPath);
      
    }

    //guardar cambios

    $usuario->username= $request->username;
    //si existe nombre de la imagen ponemos el nombre sino ponemos el del user auth si ese no tienen entonces dejamos null
    $usuario->imagen=$nombre_imagen?? auth()->user()->imagen??null;
    //actualizamos y redireccionamos al muro
    $usuario->save();
    //pasamos el username que pusimos aca por que puede que lo alla modificado y ese aun no tiene la sesion
    return redirect()->route('inicioapp',$usuario->username);
   }
}


     
