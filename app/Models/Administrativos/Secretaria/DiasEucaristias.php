<?php

namespace App\Models\Administrativos\Secretaria;

use Illuminate\Database\Eloquent\Model;

class DiasEucaristias extends Model
{
    protected $table = 'dias_eucaristias';
    public function horarioEucaristia()
    {
        return $this->hasMany(HorarioEucaristias::class);
    }
}
