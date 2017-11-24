<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CambiosSistema extends Model {
	public function scopeBuscar($query, $data) {
		return $query->where('nombre', 'like', '%' . $data . '%');
	}
}