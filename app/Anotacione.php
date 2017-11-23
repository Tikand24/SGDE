<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anotacione extends Model {
	public function scopeBuscar($query, $data) {
		return $query->where('Anotacion', 'like', '%' . $data . '%');
	}
	public function Bautisado() {
		return $this->belongsTo('App\Bautisado', 'cod_bautisado');
	}
}
