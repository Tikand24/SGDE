<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnotacionConfirmacione extends Model {
	public function Confirmacion() {
		return $this->belongsTo('App\Confirmacione','parroquia_baut_id');
	}
}
