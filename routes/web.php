<?php
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PerfilController;

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

//crear un comentario al post
Route::post('/{user:username}/comentar/{post}',[ComentarioController::class,'crearComentario'])->name('crearComentario');
//eliminar un comentario
Route::delete('/comentario/eliminar/{comentario}',[ComentarioController::class,'eliminarComentario'])->name('eliminarComentario');

        
 

//eliminar un post
Route::delete('/posts/eliminar/{post}',[PostController::class,'eliminarpost'])->name('eliminarpost');



//proceso de imagenes de dropzon
//imagen    
Route::post('/almacenar-imagen',[ImagenController::class,'almacenarImagen'])->name('almacenar.imagen');
//insertar la imagen en la db
Route::post('/crear/insertarImagenDb',[PostController::class,'insertarImagenDb'])->name('post.insertarImagenDb');


//Likes
//dar like a una foto  y quitar like
Route::post('/{post}/likes',[LikeController::class,'darMegusta'])->name('darMegusta');


//gestionar la edicion del perfil del usuario autenticado
//mostrar formulario para editar perfil al darle click en editar viala el nombre del usaurio para eso la url con el username
Route::get('/{user:username}/gestionPerfil',[PerfilController::class,'index'])->name('gestionarPerfil');
//actualizar el perfil
Route::post('/{user:username}/actualziarPerfil',[PerfilController::class,'actualizarPerfil'])->name('actualizarPerfil');





