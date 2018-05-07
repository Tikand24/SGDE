<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnotacionMatrimonio extends Model {
	public function Matrimonio() {
		return $this->belongsTo('App\Matrimonio','matrimonio_id');
	}
}
