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
        $data=['user'=>$user];
        
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

}
