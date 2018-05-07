<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LugarEucaristia extends Model {
	public function HorarioEucaristia() {
		return $this->hasMany('App\HorarioEucaristia');
	}
}
