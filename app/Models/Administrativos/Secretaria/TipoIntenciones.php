<?php

namespace App\Models\Administrativos\Pastoral;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sistema\User;
use App\Models\Sistema\Estado;

class TipoIntenciones extends Model
{
    protected $table = 'tipo_intenciones';
    protected $fillable = [
        'nombre',
        'icono',
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
