<?php

namespace App\Models\Administrativos\Secretaria;

use Illuminate\Database\Eloquent\Model;
use App\Models\Administrativos\Secretaria\LugarEucaristias;
use App\Models\Administrativos\Secretaria\DiasEucaristias;
use App\Models\Sistema\User;
use App\Models\Sistema\Estado;

class HorarioEucaristias extends Model
{
    protected $table = 'horario_eucaristias';
    protected $fillable = [
        'dia_eucaristia_id',
        'hora_eucaristia',
        'lugar_eucaristia_id',
        'users_id',
        'estados_id',
    ];
    public function diasEucaristia()
    {
        return $this->belongsTo(DiasEucaristias::class, 'dia_eucaristia_id');
    }
    public function lugarEucaristia()
    {
        return $this->belongsTo(LugarEucaristias::class, 'lugar_eucaristia_id');
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
