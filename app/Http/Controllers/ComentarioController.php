<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    //crear un comentario al post seleccionado recojo el user y post que son modelo de relacion en la url {user:username}/comentar/{post}
    //est esta muy vacano por que vamos pasando los modelos completos de una ruta a otra y no se hacen querys sino que se acceden en su relacion eloquent
  public function crearComentario(User $user,Post $post,Request $request){
   
    //validamos los campos del formulario
     
    $this->validate($request,[
        'comentario'=>'required'
          ]);

    Comentario::create(
        [
            'user_id'=>auth()->user()->id,
            //el metodo slug convierte el dato a url valido por que en este caso pondremos el user como un parametro rul juan-castro
            'post_id'=>$post->id,
            'comentario'=>$request->comentario
            ]);

   return back()->with('mensaje','Comentario registrado correctamente');


  }
   //eliminar un comentario este viene de la ruta /comentario/eliminar/{comentario}  el comentario sale del foreach cuando se muestran los comentarios y ahi lo mandamos aca para borrarlo con las relaciones de eloquent
   public function eliminarComentario(Comentario $comentario){
       //borramos el post
       $comentario->delete();
   
   return redirect()->route('inicioapp',auth()->user()->username)->with('mensaje', 'Comentario eliminado correctamente.');
   }
}
