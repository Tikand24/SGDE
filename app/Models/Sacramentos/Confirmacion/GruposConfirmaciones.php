<?php

namespace App\Models\Sacramentos\Confirmacion;

use App\Models\Sistema\CelebrantesParroquias;
use Illuminate\Database\Eloquent\Model;

class GruposConfirmaciones extends Model
{
    protected $table = 'grupos_confirmaciones';
    public function scopeBuscar($query, $data)
    {
        return $query->where('nombre', 'like', '%' . $data . '%')
            ->orWhere('fecha', 'like', '%' . $data . '%');
    }
    public function celebranteParroquia()
    {
        return $this->belongsTo(CelebrantesParroquias::class, 'celebrante_parroquia_id');
    }
    public function confirmaciones()
    {
        return $this->hasMany(Confirmaciones::class);
    }
}
