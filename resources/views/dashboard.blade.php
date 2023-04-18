@extends('layout.app')
@section('titulos')
Tu cuenta
@endsection
@section('titulopag')
Perfil  {{ $user->username}}
<!--validamos si el id de este perfil que se visita es el mismo del id autenticado para habilitarle el boton de editar -->
@if($user->id==auth()->user()->id):
 <a href="{{route('gestionarPerfil',['user'=>$user])}}">editarPerfil</a>
@else:
<!-- no mostramos nelace de edicion de usuario -->
@endif
@endsection

@section('contenido')
<div class="container">
    <div class="row">
      <div class="col-6">
        <!-- Validamos si el suario que va por la url al iniciar la app es el objeto de relacion de eloquent puede ser el logueado o el que visitamos si tiene imagen la mostramos sino mostramos el cosito de login el iconito-->
        @if($user->imagen !=""&& $user->imagen !=null):
       <img style="height:100px;" src="{{ asset('perfiles/' . $user->imagen) }}" alt="imagen usuario">
        @else
        <img style="height:100px;" src="{{asset('img/users.png')}}" alt="imagen usuario">
        @endif
      </div>
      <div class="col-6">
        {{ auth()->user()->username}}
      </div>
    </div>
    <!--Imprimimos el usaurio que se esta vistando que viene de la ruta  /{user:username}-->
    <div>
    usuario visitado :{{$user->username}}
    <!--Esta es la relacion eloquent user y en user esta followers-->
    <p>seguidors: {{$user->followers->count()}}</p>
    <br>
    <!--Esta es la relacion eloquent user y en user esta follwing que es la misma anterior solo que los id se hacen al contrario-->
    <p>Siguiendo: {{$user->followings->count()}}</p>
    <!-- unicamente tengo user que es el modelo que viene por url pero como user modelo tienen relacion con post modelo saco aca la cantidad con eloquent rebacano-->
    <p>post: {{$user->posts->count()}}</p>
   
    <!--Como en este dashboar entran los autenticados al loguearse o si visitamos algun usuario validamos que el autenticado sea defierente al user que entra por url, para no mostrar el boton de seguir-->
   @if ($user->id != auth()->user()->id):
     <!--En el modelo de users creamos la validacion para ver si est ya lo sigue y usamos la funcion creada en ese modelo -->
          <!--Le digo sino lo esta siguiendo muestra boton seguir si ya lo sigue muestre dejar de seguir -->
          @if(!$user->siguiendo(auth()->user()))

          <form action="{{route('seguir',['user'=>$user])}}" method="post">
              @csrf
              <button class="btn btn-info">Seguir</button>

            </form>
          @else
                <!--Este user es el que siempre emos manejado de la relacion con eloquentel que viaja por la url cuando nos logueamos o cuando visitamos un usuario-->
                <form  action="{{route('dejarDeSeguir',['user'=>$user])}}" method="post">
                  @method('DELETE')
                  @csrf
                  <button class="btn btn-danger">Dejar de Seguir</button>

                </form>
          @endif
   @endif  
    </div>
  </div>

  <!-- Para mostrar el exitoso se elimine un post redirecciona de nuevo aca -->
  @if (session('mensaje'))
  <div class="alert alert-primary" role="alert">
   
          {{session('mensaje')}}
    
  </div>
@endif
<!-- para mostrar publicaciones -->
 <section>
  <!-- validamos si no hay publicaciones le decimos que aun no hay publicaciones -->
 
@if ($posts->count()>0)
  

    <h2>Públicaciones</h2>
      @foreach ($posts as $post)
      <div>
        <!-- colocamos el href para que se vaya a consultar la info de la imagen clikeada pasamos ruta y post y ya sabe a que post esatmos clikeando
        el $user es el que viene desde postcontroller index, con el $user de relacion eloquent y el post es el de la vuelta de este foreach ahi se almacenan todos los atributos en x vuelta
        -->
        <a href="{{route('mostrarpost',['user'=>$user,'post'=>$post])}}">
        <img height="100px;" src="{{asset('uploads').'/'.$post->imagen}}" alt="Imagen del post {{$post->titulo}}">
      </a>
      </div>
        
      @endforeach
    <!--Creamos un div para paginar los post -->
      <div>
        {{$posts->links('pagination::bootstrap-4')}}
    </div>

  @else
   <h6>No hay publicaciones para mostrar...</h6>
  @endif
  

 </section>
@endsection