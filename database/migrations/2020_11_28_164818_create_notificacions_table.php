<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificacionsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('notificacions', function (Blueprint $table) {
            $table->id();
            $table->string('asunto');
            $table->text('contenido');
            $table->boolean('leido')->default(false);
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
    public function down() {
        Schema::dropIfExists('notificacions');
    }

}
