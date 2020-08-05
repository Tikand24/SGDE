<?php

namespace App\Models\Administrativos\Osario;

use App\Models\Base\Municipios;
use Illuminate\Database\Eloquent\Model;

class Osarios extends Model
{
    protected $table = 'osarios';
    public function scopeBuscar($query, $data)
    {
        return $query->where('NUMERO_OSARIO', 'like', '%' . $data . '%')
            ->orWhere('COMPRADOR_OSARIO', 'like', '%' . $data . '%')
            ->orWhere('FALLECIDO_OSARIO', 'like', '%' . $data . '%');
    }
    public function municipio()
    {
        return $this->belongsTo(Municipios::class, 'ciudad_expedicion_id');
    }
}
