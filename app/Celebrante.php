<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Celebrante extends Model {
	public function scopeBuscar($query, $data) {
		return $query->where('nom_celebrante', 'like', '%' . $data . '%');
	}
}