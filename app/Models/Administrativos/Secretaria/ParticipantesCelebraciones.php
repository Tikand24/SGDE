<?php

namespace App\Models\Administrativos\Pastoral;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sistema\User;
use App\Models\Sistema\Estado;
use App\Models\Ministerio\Celebraciones;
use App\Models\Administrativos\Pastoral\Feligres;

class ParticipantesCelebraciones extends Model
{
    protected $table = 'participantes_celebraciones';
    protected $fillable = [
        'feligres_id',
        'celebraciones_id',
        'estados_id',
        'users_id',
    ];
    public function feligres()
    {
        return $this->belongsTo(Feligres::class, 'feligres_id');
    }
    public function celebracion()
    {
        return $this->belongsTo(Celebraciones::class, 'celebraciones_id');
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
