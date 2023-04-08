<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];
    //relacion 1 a 1 1 post debe tener un usuario belong to a la inversa
    public function user(){
        return  $this->belongsTo(User::class)->select(['name','username']);
    }
    //un post puede tener muchos comentarios
    public function comentarios(){
        return $this->HasMany(Comentario::class);
    }

    //creamos la relacion de uno a muchos un post tiene muchos me gustas
    public function likes(){
        return $this->hasMany(Like::class);
    }

    //creamos un metodo para validar si un usuario ya le dio like
    public function checkLike(User $user){
        //este this likes es la funcion de arribita de la relacion likes()  y con contains valida con al relacion si ya dio like
        //entonces le decimos que valide si la tabla likes tiene en user_id este user->id
        //y esta funcion la pasamos alla en la vista donde tengo la manita de me gusta y le paso el user autenticado como parametro
    return $this->likes->contains('user_id',$user->id);

    }
}
