<?php

namespace App\Models\Administrativos\Pastoral;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sistema\User;
use App\Models\Sistema\Estado;
use App\Models\Administrativos\Pastoral\Feligres;
use App\Models\Administrativos\Pastoral\Grupos;

class IntegrantesGrupo extends Model
{
    protected $table = 'integrante_grupo_pastoral';
    protected $fillable = [
        'feligres_id',
        'grupos_id',
        'users_id',
        'estados_id',
    ];
    public function feligres()
    {
        return $this->belongsTo(Feligres::class, 'feligres_id');
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
