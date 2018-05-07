<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matrimonio extends Model {
	public function scopeBuscar($query, $data) {
		return $query->where('nombres', 'like', '%' . $data . '%');
	}
	public function ParroquiaBautizado()
	{
		return $this->belongsTo('App\Parroquia','parroquia_bautizado_id');
	}
	public function ParroquiaBautizada()
	{
		return $this->belongsTo('App\Parroquia','parroquia_bautizada_id');
	}
	public function ParroquiaConfirmado()
	{
		return $this->belongsTo('App\Parroquia','parroquia_confirmado_id');
	}
	public function ParroquiaConfirmada()
	{
		return $this->belongsTo('App\Parroquia','parroquia_confirmada_id');
	}
	public function Parroco()
	{
		return $this->belongsTo('App\CelebParroquia','parroco_id');
	}
	public function Celebrante()
	{
		return $this->belongsTo('App\CelebParroquia','celebrante_id');
	}
}
