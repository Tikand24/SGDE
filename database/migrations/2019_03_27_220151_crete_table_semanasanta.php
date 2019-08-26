<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreteTableSemanasanta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semana_santa', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('dia_eucaristia_id');
            $table->longText('description');
            $table->timestamps();
            $table->foreign('dia_eucaristia_id')->references('id')->on('dias_eucaristias')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('semana_santa');
    }
}
