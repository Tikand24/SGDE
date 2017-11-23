<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CelebParroquia extends Model {
	public function scopeBuscar($query, $data) {
		return $query->where('nombre', 'like', '%' . $data . '%');
	}
	public function Celebrante() {
		return $this->belongsTo('App\Celebrante', 'celebrantes_id');
	}
}