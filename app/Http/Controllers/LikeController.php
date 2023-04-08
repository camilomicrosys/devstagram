<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    //dar me gusta el post viene por la url /{$post}/likes
    public function darMegusta(Post $post){
     //id del post que le dieron me gusta 
     $id_post=$post->id;
     //id de quien da me gusta
     $id_user_me_gusta=auth()->user()->id;
     //validamos si ya existe es por que dio me gusta y lo borramos y si no es por que no le ah dado me gusta y creamos el registro
     $likeExistente = Like::where('user_id', $id_user_me_gusta)
                     ->where('post_id', $id_post)
                     ->first();
                     if ($likeExistente) {
                        $likeExistente->delete();
                    }
                    //si no existe creamos el me gusta en db en la tabla likes
                    if (!$likeExistente) {
                        Like::create([
                            'user_id' => $id_user_me_gusta,
                            'post_id' => $id_post
                        ]);
                    }

          return back();
    }
}
