<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMensajeEnviadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensaje_enviados', function (Blueprint $table) {
            $table->id();          
            $table->string('asunto');
            $table->text('contenido')->nullable();        
            $table->integer('emisor_a')->nullable();
            $table->integer('emisor_m')->nullable();
            $table->integer('receptor_a')->nullable();
            $table->integer('receptor_m')->nullable();
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
        Schema::dropIfExists('mensaje_enviados');
    }
}
