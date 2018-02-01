<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GruposConfirmacione extends Model {
	public function scopeBuscar($query, $data) {
		return $query->where('nombre', 'like', '%' . $data . '%')
			->orWhere('fecha', 'like', '%' . $data . '%');
	}
	public function Celebrante() {
		return $this->belongsTo('App\Celebrante','celebrante_id');
	}
}
