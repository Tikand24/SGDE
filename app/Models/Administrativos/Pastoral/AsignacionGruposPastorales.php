<?php

namespace App\Models\Administrativos\Pastoral;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sistema\User;
use App\Models\Sistema\Estado;
use App\Models\Base\TiposIntegrantesGrupoPastoral;

class AsignacionGruposPastorales extends Model
{
    protected $table = 'asignacion_grupos_pastorales';
    protected $fillable = [
        'users_id',
        'tipos_integrantes_grupo_pastora_id',
        'nombre',
        'estados_id',
        'fecha_inicio_vigencia',
        'fecha_fin_vigencia',
    ];
    public function scopeBuscar($query, $data)
    {
        return $query->where('nombre', 'like', '%' . $data . '%');
    }
    public function tipoIntegrantes()
    {
        return $this->belongsTo(TiposIntegrantesGrupoPastoral::class, 'tipos_integrantes_grupo_pastora_id');
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
