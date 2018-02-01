<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Celebrante extends Model {
	public function scopeBuscar($query, $data) {
		return $query->where('nom_celebrante', 'like', '%' . $data . '%');
	}
	public function Bautisado() {
		return $this->hasMany('App\Bautisado');
	}
	public function CelebParroquia() {
		return $this->hasMany('App\CelebParroquia');
	}
	public function BautisadoParroco() {
		return $this->hasMany('App\Bautisado');
	}
	public function GruposConfirmaciones() {
		return $this->hasMany('App\GruposConfirmacione');
	}
}