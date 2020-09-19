<?php

namespace App\Models\Administrativos\Secretaria;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sistema\User;
use App\Models\Sistema\Estado;
use App\Models\Administrativos\Pastoral\AsignacionGruposPastorales;

class ConfiguracionCelebraciones extends Model
{
    protected $table = 'configuracion_celebraciones';
    protected $fillable = [
        'asignacion_grupos_pastorales_id_acolitos',
        'asignacion_grupos_pastorales_id_ministros',
        'asignacion_grupos_pastorales_id_cantantes',
        'asignacion_grupos_pastorales_id_procalmadores',
        'asignacion_grupos_pastorales_id_colectores',
        'estados_id',
        'users_id',
    ];
    public function scopeBuscar($query, $data)
    {
        return $query->where('nombre', 'like', '%' . $data . '%');
    }
    public function acolitos()
    {
        return $this->belongsTo(AsignacionGruposPastorales::class, 'asignacion_grupos_pastorales_id_acolitos');
    }
    public function ministros()
    {
        return $this->belongsTo(AsignacionGruposPastorales::class, 'asignacion_grupos_pastorales_id_ministros');
    }
    public function cantantes()
    {
        return $this->belongsTo(AsignacionGruposPastorales::class, 'asignacion_grupos_pastorales_id_cantantes');
    }
    public function proclamadores()
    {
        return $this->belongsTo(AsignacionGruposPastorales::class, 'asignacion_grupos_pastorales_id_procalmadores');
    }
    public function colectores()
    {
        return $this->belongsTo(AsignacionGruposPastorales::class, 'asignacion_grupos_pastorales_id_colectores');
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
