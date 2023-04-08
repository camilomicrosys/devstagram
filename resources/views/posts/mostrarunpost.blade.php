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
                <br>
                <!--Esto lo hacemos con la relacion $post->likes y ahi nos entrega los like asociados a este post -->
                <strong>Total me gusta: {{$post->likes->count()}}</strong>
                <br>
                Me gusta:        
                <!--En modelo post creamos esta relacion esta funcion super vacan y sencillo esta funcion se hizo alla para validar si el user auth esta ya en la tabla si esta es por que ya dio me gusta checklike es la funcion que creamos en modelo post y ya con al relacion de $post podemos acceder a esa funcion-->
                @if ($post->checkLike(auth()->user())):
                  <!--Si ya dio like entonces le ponemos el formulario para que quite el like -->
                  <!-- este post es el que me entra aca por la relacion de eloquent viene de este controlador postController mostrarpost-->
                <form action="{{route('darMegusta',['post'=>$post])}}" method="post">
                  @csrf
                  <button> 👍</button>
                </form>
                @else
                  <!--Si no ah dado like le ponemos el formulario para que de like -->
                  <form action="{{route('darMegusta',['post'=>$post])}}" method="post">
                    @csrf
                    <button>  ✌ </button>
                  </form>
                @endif
                <br>
               

               

                <!--si el usuario autenticado es el creador del post le damos la oportunidad de borrarlo -->
                @if (auth()->user()->username==$post->user->username)
                <form action="{{route('eliminarpost',['post'=>$post])}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger">eliminarPublicacion</button>
                </form>
                @endif

               
            </div>
      </div>
      <div class="col-2">
        <!--Espacio en blanco -->
      </div>
      <div class="col-6">
         <div>
            <p>Agregar nuevo comentario </p>
            <!-- este user y post llegaron aca al clikear en la lista de post en la imagen de alguno en la imagen viene user y post como modelos -->
            <form action="{{route('crearComentario',['user'=>$user,'post'=>$post])}}" method="post">
                @csrf
                @error('comentario')
                {{$message}}
               @enderror
                <textarea name="comentario" id="comentario" cols="30" rows="10" placeholder="Agrega un comentario"></textarea><br>
                <button class="btn btn-primary">Comentar</button>

            </form>
             <!-- Para mostrar el exitoso cuando se realice un registro esta sesion viene del controaldor comentarios cuando se crea con un back->with('mensaje','exitoso')-->
             @if (session('mensaje'))
                <div class="alert alert-primary" role="alert">
                 
                        {{session('mensaje')}}
                  
                </div>
            @endif
         </div>
      </div>
    </div>
  </div>
<!-- comentarios del post , se sacan muy facilmente con la relacion de post->comentarios de eloquent en los modelos

y el autor del comentario sale de la relacion $post->comentarios[0]->user= $coment->user->username sonde $coment en el foreach
es relacion de post y comentarios $post->comentarios, como comentarios con user es uno a user se accede a relacion user y al username 
-->
  <div>
    <h6>Comentarios:</h6>
  @if ($post->comentarios->count())
    @foreach ($post->comentarios as $coment)
    <Strong>{{$coment->comentario}}</Strong><br>
    <p>Autor del comentario: {{$coment->user->username}}</p>
    <p>Publicado: {{$coment->updated_at->diffForHumans()}}</p>
    <!-- Si el usuario autenticado es quien publica le damos la opcion de eliminar el post -->
    @if (auth()->user()->username==$coment->user->username)
     <!--Mandamos el comentario con la relacion de eloquent -->
      <form action="{{route('eliminarComentario',['comentario'=>$coment])}}" method="post">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger">Eliminar</button>
      </form>
    
       
    @endif
        <br>
       ----------------------------------------------------------- 
       <br>
    @endforeach
      
  @endif
  </div>
@endsection