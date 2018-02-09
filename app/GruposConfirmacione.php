<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GruposConfirmacione extends Model {
	public function scopeBuscar($query, $data) {
		return $query->where('nombre', 'like', '%' . $data . '%')
			->orWhere('fecha', 'like', '%' . $data . '%');
	}
	public function CelebranteParroquia() {
		return $this->belongsTo('App\CelebParroquia','celebrante_parroquia_id');
	}
	public function Confirmaciones()
	{
		return $this->hasMany('App\Confirmacione');
	}
}
