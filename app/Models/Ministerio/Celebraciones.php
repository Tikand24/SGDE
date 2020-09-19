<?php

namespace App\Models\Ministerio;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sistema\User;
use App\Models\Sistema\Estado;
use App\Models\Ministerio\ConfiguracionCelebraciones;
use App\Models\Administrativos\Secretaria\LugarEucaristias;

class Celebraciones extends Model
{
    protected $table = 'celebraciones';

    protected $fillable = [
        'fecha',
        'hora',
        'participantes',
        'configuracion_celebraciones_id',
        'estados_id',
        'users_id',
        'lugar_eucaristias_id',
    ];
    public function scopeBuscar($query, $data)
    {
        return $query->where('nombre', 'like', '%' . $data . '%');
    }
    public function configuracionCelebraciones()
    {
        return $this->belongsTo(ConfiguracionCelebraciones::class, 'configuracion_celebraciones_id');
    }
    public function lugarEucaristia()
    {
        return $this->belongsTo(LugarEucaristias::class, 'lugar_eucaristias_id');
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
