<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HorarioEucaristia extends Model {
	public function DiasEucaristia() {
		return $this->belongsTo('App\DiasEucaristia','dia_eucaristia_id');
	}
	public function LugarEucaristia() {
		return $this->belongsTo('App\LugarEucaristia','lugar_eucaristia');
	}
}
