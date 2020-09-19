<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sistema\User;
use App\Models\Sistema\Estado;
use App\Models\Base\TiposGrupoPastoral;
use App\Models\Administrativos\Pastoral\IntegranteGrupoPastoral;

class TiposIntegrantesGrupoPastoral extends Model
{
    protected $table = 'tipos_integrantes_grupo_pastoral';
    protected $fillable = [
        'integrante_grupo_pastoral_id',
        'tipos_grupo_pastoral_id',
        'estados_id',
        'users_id',
    ];
    public function integranteGrupoPastoral()
    {
        return $this->belongsTo(IntegranteGrupoPastoral::class, 'integrante_grupo_pastoral_id');
    }
    public function tipoGrupoPastoral()
    {
        return $this->belongsTo(TiposGrupoPastoral::class, 'tipos_grupo_pastoral_id');
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
