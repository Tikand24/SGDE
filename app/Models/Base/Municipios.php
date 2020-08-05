<?php

namespace App\Models\Base;

use App\Models\Sacramentos\Bautismo\Bautisados;
use App\Models\Sistema\Parroquias;
use Illuminate\Database\Eloquent\Model;

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
    public function bautisado()
    {
        return $this->hasMany(Bautisados::class);
    }
    public function parroquias()
    {
        return $this->hasMany(Parroquias::class);
    }
}
