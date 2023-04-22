@extends('layout.app')
@section('titulos')
Edicion de perfil
@endsection
@section('contenido')
<p class="text-center">Formulario de edicion de usuario</p>

<form class="container" method="post" enctype="multipart/form-data" action="{{route('actualizarPerfil')}}">
  @csrf
    <div class="form-group">
        @error('username')
        {{$message}}
        @enderror
        <label for="exampleInputPassword1">Username</label>
        <input type="text" class="form-control" id="username" name="username"  value="{{auth()->user()->username}}">
      </div>
      <div class="form-group">
        @error('email')
        {{$message}}
        @enderror
        <label for="exampleInputPassword1">Email</label>
        <input type="text" class="form-control" id="email" name="email"  value="{{auth()->user()->email}}">
      </div>
    
      <div class="form-group">
        <label for="exampleInputPassword1">Imagen perfil</label>
        <!--El accept es propiedad propia de html y le decimos que tipo de extenciones puede aceptar -->
        <input type="file" class="form-control" id="imageperfil" name="imageperfil" accept=".jpg,.jpeg,.png" >
      </div>
   <button type="submit" class="btn btn-primary">Actualizar</button>
  </form>

@endsection