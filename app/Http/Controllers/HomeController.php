<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller


{

     //este constructor es para ejecutar el validador y que inicie sesion alguien autenticado esto protege a todos los metodos de esta clase
     public function __construct(){
        $this->middleware('auth');
    }

    //el invoike se usa similar a un constructor se usa en clase que solo tendra un metodo y en la ruta solo se pasa la
    //clase ya que el metodo que ejecutara sera el unico que tiene
    public function __invoke(){
        //obtener las personas que seguimos simplemente del usuario autenticado  se usa el metodo que creamos en el modelo user para esta relacion rara que se usa para seguidores y seguidos
        //y le ponemos to array para que nos de los que estamos siguiendo en array dd(auth()->user()->followings->toArray()); asi me trae todos los seguidores

        //como yo nececito traer los post de los que sigo, entonces agrego prluc id, para que solo me traiga los id de los que sigo
        //pluc es propio de laravel para traer los campos que queramos del arreglo retornado
        $ids=auth()->user()->followings->pluck('id')->toArray();
        //obtenemos los post de las personas que estamos siguiendo como los id puede ser uno o muchos pasamos que 
        //nos trainga post in es lo normal de sql que trae todo lo que este in  osea todos los ids, y e user id es el campo en la tabla post
        //aca podia poner paginate o get para traerlos todos y el latest propio de laravel sirve para que me salgan de reciente a antiguas
        $posts=Post::whereIn('user_id',$ids)->latest()->paginate(5);
        $data=[
            'posts'=>$posts
        ];
        
        return view('home',$data);
    }
}
