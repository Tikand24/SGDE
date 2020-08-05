<?php

namespace App\Models\Sistema;

use Illuminate\Database\Eloquent\Model;

class CambiosSistema extends Model
{
    protected $table = 'cambios_sistemas';
    public function scopeBuscar($query, $data)
    {
        return $query->where('nombre', 'like', '%' . $data . '%');
    }
}
