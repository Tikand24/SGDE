<?php

namespace App\Models\Sacramentos\Confirmacion;

use Illuminate\Database\Eloquent\Model;

class AnotacionesConfirmaciones extends Model
{
    protected $table = 'anotacion_confirmaciones';
    public function confirmacion()
    {
        return $this->belongsTo(Confirmaciones::class, 'parroquia_baut_id');
    }
}
