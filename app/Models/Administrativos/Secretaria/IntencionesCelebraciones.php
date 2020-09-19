<?php

namespace App\Models\Ministerio;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sistema\User;
use App\Models\Sistema\Estado;
use App\Models\Administrativos\Pastoral\TipoIntenciones;
use App\Models\Ministerio\Celebraciones;

class IntencionesCelebraciones extends Model
{
    protected $table = 'intenciones_celebraciones';

    protected $fillable = [
        'intencion',
        'tipo_intenciones_id',
        'celebraciones_id',
        'estados_id',
        'users_id',
    ];
    public function tipoIntencion()
    {
        return $this->belongsTo(TipoIntenciones::class, 'tipo_intenciones_id');
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
