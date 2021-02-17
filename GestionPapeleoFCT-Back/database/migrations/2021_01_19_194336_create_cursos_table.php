<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('dniTutor')->nullable();
            $table->foreign('dniTutor')
                    ->references('dni')
                    ->on('users')
                    ->onDelete('cascade');
            $table->string('familiaProfesional');
            $table->string('cicloFormativo');
            $table->string('cicloFormativoA');
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
        Schema::dropIfExists('cursos');
    }

}
