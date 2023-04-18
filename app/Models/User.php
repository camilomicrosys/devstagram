<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //un user puede tener muchos post one to many  hasmany
    public function posts(){
        return  $this->hasMany(Post::class);
    }

    //un user puede tener muchos comentarios en un solo post
    public function comentarios(){
        return  $this->hasMany(Post::class);
    }
   
    //relacion con seguidores para almacenar los que seguimos y los seguidores, como en seguidores ambos son id_user toca salir
    //de lo normal de eloquent y crear la de seguidores de diferente manera

    //alamcena seguidores de un usuario
    //un usuario puede tener muchos seguidores se tira contara usuarios por que cuando creamos la migracion
    //pusimos el constarined users  en esto toco salir de la convesnion de laravel 
    //LE DECIMOS QUE LA RELACION USER coja la tabla followerd , donde User:userid este foraneo relacionado con folowrer_id
    public function followers(){
        return $this->belongsToMany(User::class,'followers','user_id','follower_id');
    }

    //metodo para comprobar si un usuario ya sigue a otro
    public function siguiendo(User $user){
        //esto accede al metodo de arribita y valida automaticamente si este usuario que esta entrando ya sigue a este osea si ya ha registo, 
        //devuelve true o false y ya en dashboard pasamos el user autenticado por parametro a esta funcion
        return $this->followers->contains($user->id);

    }


    //almacena los que seguimos es la misma de los seguidores solo que a la inversa follower primero y luego user id
    public function followings(){
        return $this->belongsToMany(User::class,'followers','follower_id','user_id');
    }
  
}
