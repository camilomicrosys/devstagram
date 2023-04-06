<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){
        return view('auth/register');
    }

    public function store(Request $request){
        

        //validamos los campos del formulario
     
        $this->validate($request,[
            'name'=>'required|min:5',
            'username'=>'required|unique:users|min:3',
            'email'=>'required|unique:users|email',
            'password'=>'required|confirmed'
        ]);
        User::create(
            [
                'name'=>$request->name,
                //el metodo slug convierte el dato a url valido por que en este caso pondremos el user como un parametro rul juan-castro
                'username'=>Str::slug($request->username),
                'email'=>$request->email,
                'password'=>Hash::make($request->password
                ) 
                ]);
      //creamos la sesion de login autenticado esta hace el query contra db para ver si esta o no autorizado
      auth()->attempt([
       'email'=>$request->email,
       'password'=>$request->password

      ]);

       //redireccionamos al muro
       return redirect()->route('inicioapp',auth()->user()->username);
     

    }

    
}
