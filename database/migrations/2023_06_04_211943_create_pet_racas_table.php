<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetRacasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pet_racas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('especie_id');
            $table->foreign('especie_id')->references('id')->on('pet_especies');
            $table->string('nome');
            $table->string('extra');
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
        Schema::table('pet_racas', function (Blueprint $table) {
            $table->dropForeign(['especie_id']);
            $table->dropColumn('especie_id');
        });

        Schema::dropIfExists('pet_racas');
    }
}
