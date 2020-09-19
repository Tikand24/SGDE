<?php

namespace App\Models\Sistema;

use App\Models\Base\Departamentos;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sistema\User;
use App\Models\Sistema\Estado;

class Municipios extends Model
{
    protected $table = 'municipios';
    public function scopeBuscar($query, $data)
    {
        return $query->where('nombre', 'like', '%' . $data . '%');
    }
    public function departamento()
    {
        return $this->belongsTo(Departamentos::class, 'cod_departamento');
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
