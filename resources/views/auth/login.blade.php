@extends('layout.app')
@section('titulos')
Login
@endsection
@section('titulopag')
Login
@endsection

@section('contenido')
<div class="container card">
    <div>
        <img style="height:200px;" src="{{asset('img/registrar.jpg')}}"  alt="">
    </div>
    <div class="card-body">
        <form action="{{route('procesarLogin')}}" method="post">
            @csrf
            
            <label for="email">email</label><input value="{{old('email')}}" type="email" id="email" name="email" >
            @error('email')
            {{$message}}
           @enderror
           <br>
            <label for="name">password</label><input type="password" id="password" name="password" >
            @error('password')
            {{$message}}
                
            @enderror

            @if(session('mensaje'))
              {{ session('mensaje') }}
            @endif
           
            <button class="btn btn-success">Iniciar sesion</button>
        </form>
    </div>

</div>
@endsection