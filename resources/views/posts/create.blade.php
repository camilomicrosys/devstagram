@extends('layout.app')
@section('titulo')
Crear nuevo post
@endsection

<!--Esto es para montar la imagen por dropson -->
@section('contenido')
<div class="container">
    <div class="row">
      <div class="col-3">
  
        <form action="{{route('almacenar.imagen')}}" method="post" enctype="multipart/form-data" id="dropzone"
          class="dropzone border-dashed border-2">
          @csrf
        </form>
      </div>
      <div class="col-2">
  
      </div>
      <div class="col-7">
        <form method="POST" action="{{route('post.insertarImagenDb')}}" novalidate>
          @csrf
          <strong>Titulo</strong><input type="text" class="form-control" name="titulo" aria-describedby="emailHelp">
          @error('titulo')
          {{$message}}
          @enderror
          <br><strong>Descripcion</strong><textarea class="form-control" name="descripcion" id="" cols="30"
            rows="10"></textarea>
          @error('descripcion')
          {{$message}}
          @enderror
          <br>
  
          <button class="btn btn-success" type="submit"><svg style="height: 30px;" xmlns="http://www.w3.org/2000/svg"
              class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>CrearPost</button>
          <input type="hidden" name="imagen" value="{{ old('imagen')}}">
          @error('imagen')
          {{$message}}
          @enderror
        </form>
  
      </div>
    </div>
  </div>
  </div>
  
@endsection