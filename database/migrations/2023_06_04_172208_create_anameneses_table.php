<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnamenesesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anameneses', function (Blueprint $table) {
            $table->id();
            $table->integer('pet_id');
            $table->string('motivo');
            $table->string('sintomas');
            $table->string('cirurgias_ant');
            $table->text('doencas_prev');
            $table->string('med_em_uso');
            $table->text('comport_pet');
            $table->integer('repro_recente');
            $table->integer('viagem');
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
        Schema::dropIfExists('anameneses');
    }
}
