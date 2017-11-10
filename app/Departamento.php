<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model {
	public function scopeBuscar($query, $data) {
		return $query->where('nombre', 'like', '%' . $data . '%');
	}
	public function Municipio() {
		return $this->hasMany('App\Municipio');
	}
}
