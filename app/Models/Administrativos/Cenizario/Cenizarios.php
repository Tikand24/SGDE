<?php

namespace App\Models\Administrativos\Cenizario;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sistema\Municipios;
use App\Models\Sistema\User;
use App\Models\Sistema\Estado;
use App\Models\Sistema\TiposDocumento;

class Cenizarios extends Model
{
    protected $table = 'cenizarios';
    protected $fillable = [
        'numero',
        'comprador',
        'fallecido',
        'identificacion_titular',
        'fecha_nacimiento',
        'fecha_fallecimiento',
        'fecha_traslado',
        'municipios_id',
        'tipos_documento_id',
        'estados_id',
        'users_id',
    ];
    public function scopeBuscar($query, $data)
    {
        return $query->where('NUMERO_CENIZARIO', 'like', '%' . $data . '%')
            ->orWhere('COMPRADOR_CENIZARIO', 'like', '%' . $data . '%')
            ->orWhere('FALLECIDO_CENIZARIO', 'like', '%' . $data . '%');
    }
    public function tipoDocumento()
    {
        return $this->belongsTo(TiposDocumento::class, 'tipos_documento_id');
    }
    public function municipio()
    {
        return $this->belongsTo(Municipios::class, 'municipios_id');
    }
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estados_id');
    }
    public function usuario()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
