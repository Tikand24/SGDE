<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('agenda')) {
            Schema::create('agenda', function (Blueprint $table) {
                $table->increments('id');
                $table->dateTime('fecha');
                $table->mediumText('intencion');
                $table->integer('lugar');
                $table->integer('celebrante');
                $table->integer('usuario');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agenda');
    }
}
