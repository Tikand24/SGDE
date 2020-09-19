<?php

namespace App\Models\Administrativos\Secretaria;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sistema\User;
use App\Models\Sistema\Estado;

class LugarEucaristias extends Model
{
    protected $table = 'lugar_eucaristias';
    protected $fillable = [
        'descripcion',
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
