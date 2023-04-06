@extends('layout.app')
@section('titulos')
registrar
@endsection
@section('titulopag')
registrar usuarios
@endsection

@section('contenido')
<div class="container card">
    <div>
        <img style="height:200px;" src="{{asset('img/registrar.jpg')}}"  alt="">
    </div>
    <div class="card-body">
        <form action="{{route('registararCuenta')}}" method="post">
            @csrf
            <label for="username">nombre</label><input type="text" id="username" name="name" value="{{old('name')}}" >
            @error('name')
             <p style="background-color:#E1531A; color:white;">{{$message}}</p>
            @enderror
        
            <br>
            <label for="email">email</label><input value="{{old('email')}}" type="email" id="email" name="email" >
            @error('email')
            {{$message}}
           @enderror
            <br>
            <label for="name">username</label><input value="{{old('username')}}" type="text" id="name" name="username" >
            @error('username')
                {{$message}}
            @enderror
            <br>

            <label for="name">password</label><input type="password" id="password" name="password" >
            @error('password')
            {{$message}}
                
            @enderror
            <br>
            <label for="name">Repetir password</label><input type="password_confirmation" id="password_confirmation" name="password_confirmation" ><br>
            <button class="btn btn-success">Crear cuenta</button>
        </form>
    </div>

</div>
@endsection