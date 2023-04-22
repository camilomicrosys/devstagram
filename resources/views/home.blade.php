@extends('layout.app')
@section('titulos')
Home
@endsection
@section('titulopag')

@endsection

@section('contenido')
<!--Mostramos los post con los componentes de blade de esta manera comunicamos variables  -->
<x-Listar-post :posts="$posts"/>
  
 





@endsection