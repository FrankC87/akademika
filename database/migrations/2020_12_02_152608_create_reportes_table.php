<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reportes', function (Blueprint $table) {
            $table->id();
            $table->text('motivo')->nullable();
            $table->boolean('leido')->default(false);
            $table->integer('maestro_id')->nullable();
            $table->integer('aprendiz_id')->nullable();
            $table->integer('tema_id')->nullable();
            $table->integer('coleccion_id')->nullable();
            $table->integer('comentario_id')->nullable();
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
        Schema::dropIfExists('reportes');
    }
}
