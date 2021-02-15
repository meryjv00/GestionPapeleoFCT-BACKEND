<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresaCursoTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('empresa_curso', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idEmpresa');
            $table->foreign('idEmpresa')
                    ->references('id')
                    ->on('empresas')
                    ->onDelete('cascade');
            $table->unsignedBigInteger('idCurso');
            $table->foreign('idCurso')
                    ->references('id')
                    ->on('cursos')
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
        Schema::dropIfExists('empresa_curso');
    }

}
