<?php

namespace App\Models\Administrativos\Cenizario;

use App\Models\Base\Municipios;
use Illuminate\Database\Eloquent\Model;

class Cenizarios extends Model
{
    protected $table = 'cenizarios';
    public function scopeBuscar($query, $data)
    {
        return $query->where('NUMERO_CENIZARIO', 'like', '%' . $data . '%')
            ->orWhere('COMPRADOR_CENIZARIO', 'like', '%' . $data . '%')
            ->orWhere('FALLECIDO_CENIZARIO', 'like', '%' . $data . '%');
    }
    public function municipio()
    {
        return $this->belongsTo(Municipios::class, 'ciudad_expedicion_id');
    }
}
