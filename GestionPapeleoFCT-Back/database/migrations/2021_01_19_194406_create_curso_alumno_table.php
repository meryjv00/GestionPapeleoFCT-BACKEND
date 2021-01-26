<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursoAlumnoTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('curso_alumno', function (Blueprint $table) {
            $table->unsignedBigInteger('idCurso');
            $table->foreign('idCurso')
                    ->references('id')
                    ->on('cursos')
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
        Schema::dropIfExists('curso_alumno');
    }

}
