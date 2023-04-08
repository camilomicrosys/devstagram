<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'post_id',
        'comentario'
    ];
    //un comentario estara asociado solo a un post
    public function post(){
        return  $this->belongsTo(Post::class);
    }
   //un comentario tiene asociado un usuario
    public function user(){
        return  $this->belongsTo(User::class);
    }

   
}
