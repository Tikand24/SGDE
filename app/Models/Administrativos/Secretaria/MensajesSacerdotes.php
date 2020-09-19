<?php

namespace App\Models\Administrativos\Secretaria;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sistema\User;
use App\Models\Sistema\Estado;
use App\Models\Ministerio\CelebrantesParroquias;

class MensajesSacerdotes extends Model
{
    protected $table = 'mensajes_sacerdotes';

    protected $fillable = [
        'nombre_feligres',
        'mensaje',
        'celebrantes_parroquias_id',
        'estados_id',
        'users_id',
    ];
    public function celebranteParroquia()
    {
        return $this->belongsTo(CelebrantesParroquias::class, 'celebrantes_parroquias_id');
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
