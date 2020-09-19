<?php

namespace App\Models\Sistema;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sistema\User;
use App\Models\Sistema\Estado;

class CambiosSistema extends Model
{
    protected $table = 'cambios_sistemas';

    protected $fillable = [
        'cambio_id',
        'tipo_cambio',
        'descipcion_cambio',
        'estados_id',
        'users_id',
    ];
    public function scopeBuscar($query, $data)
    {
        return $query->where('nombre', 'like', '%' . $data . '%');
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
