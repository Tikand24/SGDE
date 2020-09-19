<?php

namespace App\Models\Administrativos\Secretaria;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sistema\User;
use App\Models\Sistema\Estado;
use App\Models\Administrativos\Pastoral\Grupos;

class Eventos extends Model
{
    protected $table = 'asignacion_grupos_pastorales';
    protected $fillable = [
        'nombre',
        'grupos_id',
        'users_id',
        'estados_id',
    ];
    public function scopeBuscar($query, $data)
    {
        return $query->where('nombre', 'like', '%' . $data . '%');
    }
    public function grupo()
    {
        return $this->belongsTo(Grupos::class, 'grupos_id');
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
