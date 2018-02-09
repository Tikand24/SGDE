<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parroquia extends Model {
	public function Municipio() {
		return $this->belongsTo('App\Municipio','municipio_id');
	}
	public function Confirmaciones() {
		return $this->hasMany('App\Confirmacione');
	}
}
