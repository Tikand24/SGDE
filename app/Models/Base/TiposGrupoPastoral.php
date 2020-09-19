<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sistema\User;
use App\Models\Sistema\Estado;

class TiposGrupoPastoral extends Model
{
    protected $table = 'tipos_grupo_pastoral';
    protected $fillable = [
        'nombre',
        'estados_id',
        'users_id',
    ];
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estados_id');
    }
    public function usuario()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
