<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFctsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('fcts', function (Blueprint $table) {
            $table->id();
            $table->string('responsable');
            $table->unsignedBigInteger('idEmpresa');
            $table->foreign('idEmpresa')
                    ->references('id')
                    ->on('empresas')
                    ->onDelete('cascade');
            $table->unsignedBigInteger('idModulo');
            $table->foreign('idModulo')
                    ->references('id')
                    ->on('modulos')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('fcts');
    }

}
