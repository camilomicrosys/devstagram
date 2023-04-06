<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return  $this->belongsTo(User::class);
    }
}
