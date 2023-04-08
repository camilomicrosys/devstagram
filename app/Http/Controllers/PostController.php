<?php
namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
     //este constructor es para ejecutar el validador y que inicie sesion alguien autenticado esto protege a todos los metodos de esta clase
     public function __construct(){
        $this->middleware('auth');
        }
         //esto para obtener el usaurio por la url ya que consulta el modelo user y no hay nececidad de ir a bscarlos por id sino que ya llega
    public function index(User $user){
      //como la varibale user que viene de la ruta user:username   ya tiene los datos del usaurio sacamos el id del user que viene porurl
      //y luego sacamos la relacion de user con post
      //sacamos los post de este user id que viene por la url que visiatamos se usa el get para que traiga los resultados
      //como estan relacionadas con eloquent se pasa asi los post del user_id como lo vamos a paginar mejor le ponemos paginate
     //$posts=Post::where('user_id',$user->id)->get();
     //lo paginamos y en la vista ponemos el paginados que es {{$posts->links}}
     $posts=Post::where('user_id',$user->id)->paginate(2);
    //mandamos a la vista el usuario que viene por la url y sus post
      $data=[
        'user'=>$user,
        'posts'=>$posts
    
    ];

        
        return view('dashboard',$data);
}

public function crearPost(){
   return view('posts.create');
}

//insertar el post en db y su respectiva imagen


   public function insertarImagenDb(Request $request){
    $this->validate($request,[
    'titulo'=>'required|max:255',
    'descripcion'=>'required|min:2',
    'imagen'=>'required'
  
    ]);
  
    Post::create(
      [
        'titulo'=>$request->titulo,
        'descripcion'=>$request->descripcion,
        'imagen'=>$request->imagen,
        'user_id'=>auth()->user()->id
      ]
    );
  
    return redirect()->route('inicioapp',auth()->user()->username);
  }

  //este para mostrar un solo post l info al clikear la imagen de post como la ruta es {user:username}/post/{post} esta accediendo al modelo pos lo accedemos y ya tenemos los datos de relacion
  //y tambien ponemos el de user para tener accedo a ambos modelos importante colocar estos dos en el mismo orden de la url {user:username}/post/{post} primero user luego post
  public function mostrarpost(User $user,Post $post){
 $data=[
  'post'=>$post,
  'user'=>$user
];
  return view('posts.mostrarunpost',$data);

  }


  //eliminar post este viene por url con el modelo post/posteliminar/{post}
  public function eliminarpost(Post $post){
    //borramos la imagen fisica del servidor
    $imagen_a_borrar=$post->imagen;
    $ruta_imagen = public_path('uploads/' . $imagen_a_borrar);

    if (file_exists($ruta_imagen)) {
        unlink($ruta_imagen);
    }
   //borramos el post
   $post->delete();
   
   return redirect()->route('inicioapp',auth()->user()->username)->with('mensaje', 'Post eliminado correctamente.');
  }

  

}
