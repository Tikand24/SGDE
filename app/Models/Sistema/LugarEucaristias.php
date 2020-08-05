<?php

namespace App\Models\Sistema;

use App\Models\Administrativos\Secretaria\HorarioEucaristias;
use Illuminate\Database\Eloquent\Model;

class LugarEucaristias extends Model
{
    protected $table = 'lugar_eucaristias';
    public function horarioEucaristia()
    {
        return $this->hasMany(HorarioEucaristias::class);
    }
}
