<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Osario extends Model {
	public function scopeBuscar($query, $data) {
		return $query->where('NUMERO_OSARIO', 'like', '%' . $data . '%')
			->orWhere('COMPRADOR_OSARIO', 'like', '%' . $data . '%')
			->orWhere('FALLECIDO_OSARIO', 'like', '%' . $data . '%');
	}
	public function Municipio()
	{
		return $this->belongsTo('App\Municipio','ciudad_expedicion_id');
	}
}
