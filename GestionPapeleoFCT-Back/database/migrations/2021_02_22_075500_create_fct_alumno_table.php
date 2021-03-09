<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFctAlumnoTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('fct_alumno', function (Blueprint $table) {
            $table->unsignedBigInteger('idEmpresa');
            $table->foreign('idEmpresa')
                    ->references('id')
                    ->on('empresas')
                    ->onDelete('cascade');
            $table->string('dniAlumno');
            $table->foreign('dniAlumno')
                    ->references('dni')
                    ->on('personas')
                    ->onDelete('cascade');
            $table->string('dniResponsable');
            $table->foreign('dniResponsable')
                    ->references('dniResponsable')
                    ->on('empresas_perfiles')
                    ->onDelete('cascade');
            $table->string('horarioDiario');
            $table->integer('nHoras');
            $table->date('fechaComienzo');
            $table->date('fechaFin');
            $table->integer('desplazamiento');
            $table->integer('semiPresencial')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('fct_alumno');
    }

}