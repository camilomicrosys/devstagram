<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
      public function index(){
        return view('auth.login');
      }

    public function procesarLogin(Request $request){
            //validamos los campos del formulario
            
            $this->validate($request,[
              
              'email'=>'required',
              'password'=>'required'
          ]);
 
        //creamos la sesion de login autenticado esta hace el query contra db para ver si esta o no autorizado
        //validamos si esta corecto los datos en la db que solo valide en db contra estos 2 datos
        if(!auth()->attempt($request->only('email','password'))){
           return back()->with('mensaje','credenciales incorrectas');
        }

     //si esta logueado correctamente lo redireccionamos a la vista principal de la app mandamos el user autneticado que es lo que declaramos en ruta para que en la url se muestre ese user
     return redirect()->route('inicioapp',auth()->user()->username);
  
  }

  public function cerrarSesion(){
    auth()->logout();
    return redirect()->route('login');
  }
}