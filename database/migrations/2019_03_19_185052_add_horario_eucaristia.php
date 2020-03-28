<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHorarioEucaristia extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (Schema::hasTable('horario_eucaristias')) {
			if (!Schema::hasColumn('horario_eucaristias', 'semanal')) {
				Schema::table('horario_eucaristias', function (Blueprint $table) {
					$table->boolean('semanal')->nulleable();
				});
			}
			if (!Schema::hasColumn('horario_eucaristias', 'fecha_eucaristia')) {
				Schema::table('horario_eucaristias', function (Blueprint $table) {
					$table->date('fecha_eucaristia')->nullable();
				});
			}
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		if (Schema::hasTable('table')) {
			Schema::table('horario_eucaristias', function (Blueprint $table) {
				$table->dropColumn('semanal');
				$table->dropColumn('fecha_eucaristia');
			});
		}
	}
}
