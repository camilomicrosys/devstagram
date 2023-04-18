<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    //esta es para seguir a un usuario
    public function index(User $user){

        //aplicamos la relacion de eloquent de users contra followers que es mismo metodo de useres como users contra users ya que followers hace el query contra mismo User
        //como esto de seguidores es diferente por que es user contra user en los id no funciona save entonces con atach guarda
        //con esto a este usario que estamos visitando le almacenamos en follower id el id del autentciado que es quien lo esta siguiendo
        //follwers() es para acceder al metodo que se creo, y sin los ()  es para acceder a la info asi como hemos venido con tinker
        $user->followers()->attach(auth()->user()->id);
        return back();

    }
//este no soporta delete por la relacion ya que fuye un caso diferente al crear la foranea con esto se hace el delete
    public function dejarDeSeguir(User $user){
        $user->followers()->detach(auth()->user()->id);
        return back();
    }
}
