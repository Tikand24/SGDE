<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model {
	public function scopeBuscar($query, $data) {
		return $query->where('nombre', 'like', '%' . $data . '%');
	}
	public function Departamento() {
		return $this->belongsTo('App\Departamento', 'cod_departamento');
	}
}
