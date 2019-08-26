<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEstadoHorariosEucaristia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('horario_eucaristias', function (Blueprint $table) {
            $table->enum('estado',['Activo','Inactivo'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('horario_eucaristias', function (Blueprint $table) {
            $table->dropColumn('estado');
        });
    }
}
