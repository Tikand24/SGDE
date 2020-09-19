<?php

namespace App\Models\Sacramentos\Confirmacion;

use App\Models\Sistema\CelebrantesParroquias;
use App\Models\Sistema\User;
use App\Models\Sistema\Estado;
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
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estados_id');
    }
    public function usuario()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
