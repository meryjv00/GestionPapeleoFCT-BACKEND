<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuloAlumnoTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('modulo_alumno', function (Blueprint $table) {
            $table->unsignedBigInteger('idModulo');
            $table->foreign('idModulo')
                    ->references('id')
                    ->on('modulos')
                    ->onDelete('cascade');
            $table->string('dniAlumno');
            $table->foreign('dniAlumno')
                    ->references('dni')
                    ->on('personas')
                    ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('modulo_alumno');
    }

}
