<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anotacione extends Model {
    protected $fillable = [
		'cod_bautisado',
		'parroco_firma',
		'anotacion'
	];
	public function scopeBuscar($query, $data) {
		return $query->where('Anotacion', 'like', '%' . $data . '%');
	}
	public function Bautisado() {
		return $this->belongsTo('App\Bautisado', 'cod_bautisado');
	}
	public function Parroco() {
		return $this->belongsTo('App\CelebParroquia', 'parroco_firma');
	}
}
