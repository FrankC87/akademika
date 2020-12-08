<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votos', function (Blueprint $table) {
            $table->id();                       
            $table->integer('aprendiz_id')->nullable();
            $table->integer('maestro_id')->nullable();
            $table->integer('tema_id')->nullable();
            $table->integer('coleccion_id')->nullable();
            $table->integer('comentario_id')->nullable();
            $table->boolean('like')->default(false);  
            $table->boolean('dislike')->default(false);  
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
        Schema::dropIfExists('votos');
    }
}
