<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('personas', function (Blueprint $table) {
            $table->string('dni')->primary();
            $table->string('apellidos');
            $table->string('nombre');
            $table->string('localidad');
            $table->string('residencia');
            $table->string('correo')->unique();
            $table->string('tlf')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('personas');
    }

}
