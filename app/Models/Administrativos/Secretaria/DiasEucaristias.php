<?php

namespace App\Models\Administrativos\Secretaria;

use Illuminate\Database\Eloquent\Model;

class DiasEucaristias extends Model
{
    protected $table = 'dias_eucaristias';

    protected $fillable = [
        'dia_semana',
        'estados_id',
        'users_id',
    ];
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estados_id');
    }
    public function usuario()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
