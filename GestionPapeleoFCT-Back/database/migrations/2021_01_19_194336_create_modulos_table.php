<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('modulos', function (Blueprint $table) {
            $table->id();
            $table->string('dniTutor');
            $table->foreign('dniTutor')
                    ->references('dni')
                    ->on('personas')
                    ->onDelete('cascade');
            $table->string('familiaProfesional');
            $table->string('cicloFormativo');
            $table->string('cursoAcademico');
            $table->integer('nHoras');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('modulos');
    }

}
