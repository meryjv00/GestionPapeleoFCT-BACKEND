<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasPerfilesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('empresas_perfiles', function (Blueprint $table) {
            $table->unsignedBigInteger('idEmpresa');
            $table->string('nombreRepresentante');
            $table->string('nombreResponsable');
            $table->foreign('idEmpresa')
                    ->references('id')
                    ->on('empresas')
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
        Schema::dropIfExists('empresas_perfiles');
    }

}
