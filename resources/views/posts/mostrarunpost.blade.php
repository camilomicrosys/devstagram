@extends('layout.app')
@section('titulos')
Informacion de post unico {{$post->titulo}}
@endsection
@section('titulopag')
Post: {{$post->titulo}}
@endsection


@section('contenido')
<div class="container">
   
    <div class="row">
      <div class="col4">
            <h6>{{$post->titulo}}</h6>
            <img height="100px;" src="{{asset('uploads').'/'.$post->imagen}}" alt="">
            <div>
                <p>8 Likes</p>
            </div>
            <div>
                 <!-- Aca aplicamos la relacion de eloquent de post contra user -->
                <p>Creador del Post: {{$post->user->username}}</p>  
                <br>
                <p>fecha actualización: {{ $post->updated_at->diffForHumans() }}</p>
                <br>
                <p>Descripcion: {{$post->descripcion}}</p>

               
            </div>
      </div>
      <div class="col-2">
        <!--Espacio en blanco -->
      </div>
      <div class="col-6">
        comentarios
      </div>
    </div>
  </div>
@endsection