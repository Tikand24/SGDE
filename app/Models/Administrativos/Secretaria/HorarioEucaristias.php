<?php

namespace App\Models\Administrativos\Secretaria;

use App\Models\Sistema\LugarEucaristias;
use Illuminate\Database\Eloquent\Model;

class HorarioEucaristias extends Model
{
    protected $table = 'horario_eucaristias';
    public function diasEucaristia()
    {
        return $this->belongsTo(DiasEucaristias::class, 'dia_eucaristia_id');
    }
    public function lugarEucaristia()
    {
        return $this->belongsTo(LugarEucaristias::class, 'lugar_eucaristia');
    }
}
