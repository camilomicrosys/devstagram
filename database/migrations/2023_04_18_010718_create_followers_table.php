<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followers', function (Blueprint $table) {
            $table->id();
            //seguidor
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            //como seguidor y seguido son user_id se crea esta nueva por que no pueden haber dos columnas iguales
            //entonces aca se crea el campo como quiera llamarloy en contarin se mete la tabla a la que hace relacion
            //se le dice en la tabla users encontarras la columna follower_id a la que hago referencia
            $table->foreignId('follower_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('followers');
    }
};
