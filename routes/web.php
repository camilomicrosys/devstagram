<?php
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ImagenController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//autenticacion registro y login
Route::get('/crear-cuenta',[RegisterController::class,'index'])->name('crearCuentaformulario');
Route::post('/registrar-cuenta',[RegisterController::class,'store'])->name('registararCuenta');

//login
Route::get('/',[LoginController::class,'index'])->name('login');
Route::post('/procesar-login',[LoginController::class,'procesarLogin'])->name('procesarLogin');
//se pone en post y se envia con formulario para hacerlo seguro con @csrf
Route::post('/cerrar-sesion',[LoginController::class,'cerrarSesion'])->name('cerrarsesion');


//muro//inicio despues de loguear
Route::get('/{user:username}',[PostController::class,'index'])->name('inicioapp');
Route::get('/post/crear',[PostController::class,'crearPost'])->name('crearPost');
//este es para mostrar la informacion de un solo post cuando se clikee la imagen
Route::get('/{user:username}/post/{post}',[PostController::class,'mostrarpost'])->name('mostrarpost');


//proceso de imagenes de dropzon
//imagen    
Route::post('/almacenar-imagen',[ImagenController::class,'almacenarImagen'])->name('almacenar.imagen');
//insertar la imagen en la db
Route::post('/crear/insertarImagenDb',[PostController::class,'insertarImagenDb'])->name('post.insertarImagenDb');





