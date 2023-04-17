<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

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
}