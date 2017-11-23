<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bautisado extends Model {
	public function scopeBuscar($query, $data) {
		return $query->where('nombre', 'like', '%' . $data . '%');
	}
	public function Municipio() {
		return $this->belongsTo('App\Municipio', 'cod_ciudad_nac_baut');
	}
	public function Celebrante() {
		return $this->belongsTo('App\Celebrante', 'cod_celebrante');
	}
	public function CelebranteParroquia() {
		return $this->belongsTo('App\Celebrante', 'parroco_firma');
	}
	public function Anotaciones() {
		return $this->hasMany('App\Anotacione');
	}
}
