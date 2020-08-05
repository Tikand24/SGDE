<?php

namespace App\Models\Sistema;

use App\Models\Base\Municipios;
use App\Models\Sacramentos\Confirmacion\Confirmaciones;
use Illuminate\Database\Eloquent\Model;

class Parroquias extends Model
{
    protected $table = 'parroquias';
    public function municipio()
    {
        return $this->belongsTo(Municipios::class, 'municipio_id');
    }
    public function confirmaciones()
    {
        return $this->hasMany(Confirmaciones::class);
    }
}
