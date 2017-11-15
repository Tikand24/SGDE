<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matrimonio extends Model {
	public function scopeBuscar($query, $data) {
		return $query->where('nombres', 'like', '%' . $data . '%');
	}
}
