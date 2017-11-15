<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cenizario extends Model {
	public function scopeBuscar($query, $data) {
		return $query->where('NUMERO_CENIZARIO', 'like', '%' . $data . '%')
			->orWhere('COMPRADOR_CENIZARIO', 'like', '%' . $data . '%')
			->orWhere('FALLECIDO_CENIZARIO', 'like', '%' . $data . '%');
	}
}
