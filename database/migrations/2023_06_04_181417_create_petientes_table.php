<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petientes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cliente_id');
            $table->string('nome');
            $table->string('raca');
            $table->string('especies');
            $table->string('porte');
            $table->string('sexo');
            $table->date('nascimento');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('petientes');
    }
}
