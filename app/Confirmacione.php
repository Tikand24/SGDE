<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Confirmacione extends Model {
	public function scopeBuscar($query, $data) {
		return $query->where('nombre', 'like', '%' . $data . '%');
	}
	public function Parroquia() {
		return $this->belongsTo('App\Parroquia','parroquia_baut_id');
	}
	public function GrupoConfirmacion()
	{
		return $this->belongsTo('App\GruposConfirmacione','grupo_confirmado_id');
	}
	public function AnotacionConfirmacion()
	{
		return $this->hasMany('App\AnotacionConfirmacione');
	}
}
