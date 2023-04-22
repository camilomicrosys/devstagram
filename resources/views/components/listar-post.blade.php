<div>
    <h1>Pagina principal</h1>
    <!--Si existen posts hacemos el foreach por que este usuario sigue a gente con posts -->
    @if ($posts->count()>0)
  
    <h2>Públicaciones</h2>
    @foreach ($posts as $post)
    <div>
      <!-- colocamos el href para que se vaya a consultar la info de la imagen clikeada pasamos ruta y post y ya sabe a que post esatmos clikeando
      el $user es el que viene desde postcontroller index, con el $user de relacion eloquent y el post es el de la vuelta de este foreach ahi se almacenan todos los atributos en x vuelta
      aca en esta  ruta aplicamos la relacion de este post a que user pertenece para pasarlo en el array de parametro
      aca pasa un objeto pero como en la ruta le decimos username laravel automaticamente saca e username en la url
      -->
      
      <a href="{{route('mostrarpost',['user'=>$post->user,'post'=>$post])}}">
      <img height="100px;" src="{{asset('uploads').'/'.$post->imagen}}" alt="Imagen del post {{$post->titulo}}">
    </a>
    <!--aplicamos la misma relacion de esta ruta este post pertenece a un user aca si accedemos por que es objeto mientras que en la anterior que es url laravel ya sabe que tiene que sacar el usar en esa ruta ya que se pasa el usarname como parametro -->
    <h2>Dueño del post {{$post->user->username}}</h2>
  ------------------------------------------------------------------------------------------
    </div>
      
    @endforeach
  <!--Creamos un div para paginar los post -->
    <div>
      {{$posts->links('pagination::bootstrap-4')}}
  </div>
        
        
   @else
   <!-- Esto si casualmente a las personas que yo sigo no han publicado nada-->
   <p>Aun no hay post</p>
   @endif
   
</div>