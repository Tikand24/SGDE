<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bautisado extends Model {
	public function scopeBuscar($query, $data) {
		return $query->where('nombre', 'like', '%' . $data . '%');
	}
}
