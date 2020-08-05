<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

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
