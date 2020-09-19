<?php

namespace App\Models\Administrativos\Pastoral;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sistema\User;
use App\Models\Sistema\Estado;
use App\Models\Administrativos\Pastoral\IntegranteGrupoPastoral;

class GruposPastorales extends Model
{
    protected $table = 'grupos_pastorales';

    protected $fillable = [
        'nombre',
        'telefono',
        'descripcion_reunion',
        'integrante_grupo_pastoral_id',
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
    public function integrante()
    {
        return $this->belongsTo(IntegranteGrupoPastoral::class, 'integrante_grupo_pastoral_id');
    }
}
