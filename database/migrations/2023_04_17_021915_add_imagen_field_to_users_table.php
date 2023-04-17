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

     //esat migracion es para adicionarle a la tabla usuarios una nueva columna para adicionar la imagen
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //nullable quiere decir que es un campo que no es obligatorio y puede llegar nulo
           $table->string('imagen')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('imagen');
        });
    }
};
