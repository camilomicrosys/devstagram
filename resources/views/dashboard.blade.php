@extends('layout.app')
@section('titulos')
Tu cuenta
@endsection
@section('titulopag')
Perfil  {{ $user->username}}
@endsection

@section('contenido')
<div class="container">
    <div class="row">
      <div class="col-6">
        <img style="height:100px;" src="{{asset('img/users.png')}}" alt="imagen usuario">
      </div>
      <div class="col-6">
        {{ auth()->user()->username}}
      </div>
    </div>
    <!--Imprimimos el usaurio que se esta vistando que viene de la ruta  /{user:username}-->
    <div>
    usuario visitado :{{$user->username}}
    <p>seguidors: 1</p>
    <p>post: 2</p>
    </div>
  </div>
@endsection