<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bautisado extends Model {
	
    protected $fillable = [
		'nombre',
		'libro',
		'folio',
		'partida',
		'nom_padre',
		'nom_madre',
		'abuelo_paterno',
		'abuela_paterna',
		'abuelo_materno',
		'abuela_materna',
		'nom_padrino',
		'nom_madrina',
		'genero',
		'fecha_nacimiento',
		'cod_ciudad_nac_baut',
		'fecha_bautismo',
		'cod_celebrante',
		'parroco_firma',
	];
	
	public function scopeBuscar($query, $data) {
		return $query->where('nombre', 'like', '%' . $data . '%');
	}
	public function Municipio() {
		return $this->belongsTo('App\Municipio', 'cod_ciudad_nac_baut');
	}
	public function Celebrante() {
		return $this->belongsTo('App\CelebParroquia', 'cod_celebrante');
	}
	public function CelebranteParroquia() {
		return $this->belongsTo('App\CelebParroquia', 'parroco_firma');
	}
	public function Anotaciones() {
		return $this->hasMany('App\Anotacione');
	}
}
