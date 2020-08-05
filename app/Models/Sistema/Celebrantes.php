<?php

namespace App\Models\Sistema;

use App\Models\Sacramentos\Bautismo\Bautisados;
use App\Models\Sacramentos\Confirmacion\GruposConfirmaciones;
use Illuminate\Database\Eloquent\Model;

class Celebrantes extends Model
{
    protected $table = 'celebrantes';
    public function scopeBuscar($query, $data)
    {
        return $query->where('nom_celebrante', 'like', '%' . $data . '%');
    }
    public function bautisado()
    {
        return $this->hasMany(Bautisados::class);
    }
    public function celebParroquia()
    {
        return $this->hasMany(CelebrantesParroquias::class);
    }
    public function bautisadoParroco()
    {
        return $this->hasMany(Bautisados::class);
    }
    public function gruposConfirmaciones()
    {
        return $this->hasMany(GruposConfirmaciones::class);
    }
}
