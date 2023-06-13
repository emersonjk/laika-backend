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
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->string('nome');
            $table->string('idade');
            $table->string('peso');
            $table->string('especie');
            $table->string('raca');
            $table->string('sexo');
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
        Schema::table('petientes',function (Blueprint $table){
            $table->dropForeign(['cliente_id']);
            $table->dropColumn('cliente_id');
        });
        Schema::dropIfExists('petientes');
    }
}
