<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHorarioEucaristia extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('horario_eucaristias', function (Blueprint $table) {
			$table->boolean('semanal')->nulleable();
			$table->date('fecha_eucaristia')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('horario_eucaristias', function (Blueprint $table) {
			$table->dropColumn('semanal');
			$table->dropColumn('fecha_eucaristia');
		});
	}
}
