<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;
use App\Models\Base\Municipios;

class Departamentos extends Model
{
    protected $table = 'departamentos';
    public function scopeBuscar($query, $data)
    {
        return $query->where('nombre', 'like', '%' . $data . '%');
    }
    public function municipio()
    {
        return $this->hasMany(Municipios::class);
    }
}
