<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <!--esto para dropson -->
  <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <title>Laravel 9 @yield('titulos')</title>
  </head>
  <body>
    <!--propia de blade para validar si esta autentcado o no  y al guest para no autenticados-->
   @auth
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="#">Devstagram</a> 
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
             
             
              <li class="nav-item dropdown">
                <form action="{{route('cerrarsesion')}}" method="post">
                  @csrf
                <button class="btn btn-primary">Cerar sesion</button>
                </form>
                
              
              </li>
            
            </ul>
            
              <strong>Hola {{auth()->user()->username}}</strong>
              <a style="margin:5px;" href="{{route('crearPost')}}">crearPost </a>
          </div>
        </nav>
   @endauth

   <!--Si no esta autenticado le mostramos el nav  solo con login y crear -->
   @guest
   <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Devstagram</a> 
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a href="{{route('login')}}">Login</a>
            
        </li>
        <li class="nav-item">
            <a href="{{ route('crearCuentaformulario')}}">Crear cuenta</a>
        </li>
      
      
      </ul>
      
    </div>
  </nav>
   @endguest
    
 
    

     

    <h1 class="container">@yield('titulopag')</h1>
  
    <main>
        @yield('contenido')
    </main>
    

     <footer class="container">
        Devcamilo -{{ now()->year }}
     </footer>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->

    <!--Esto para dropson -->
    <script>
      Dropzone.autoDiscover=false;
  
      Dropzone.autoDiscover=false;
  
  const dropzone = new Dropzone('#dropzone',{
  dictDefaultMessage:"Carga aca imagenes",
  acceptedFiles:".png,.jpg,.jpeg,.gif",
  addRemoveLinks:true,
  dictRemoveFile:"EliminarArchivo",
  maxFiles:1,
  uploadMultiple:false,
  init:function(){
   if(document.querySelector('[name="imagen"]').value.trim()){
     const imagenPublicada={};
     imagenPublicada.size=1234;
     imagenPublicada.name=document.querySelector('[name="imagen"]').value;
  
     this.options.addedfile.call(this,imagenPublicada);
     
     this.options.thumbnail.call(this,imagenPublicada,`/uploads/${imagenPublicada.name}`);
  
     imagenPublicada.previewElement.classList.add("dz-success","dz-complete");
   }
  },
  }) ;
  //indicar que vamos a cargar un archivo
  dropzone.on('sending',function(file,xhr,formData){
   console.log(file)
  });
  
  //obtener respuesta de cargue exitoso
  dropzone.on('success',function(file,response){
  
   
   document.querySelector('[name="imagen"]').value=response.imagenes;
  });
  //en caso de que alla un error y no me suba el archivo
  dropzone.on('error',function(file,message){
  
   console.log(message);
   
  });
  //cuando subi un archivo y le doy eliminar que me diga archivo eliminado
  dropzone.on('removedfile',function(file,message){
      document.querySelector('[name="imagen"]').value="";
  });
  </script>
  </body>
</html>