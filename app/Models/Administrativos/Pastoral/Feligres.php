<?php

namespace App\Models\Administrativos\Pastoral;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sistema\User;
use App\Models\Sistema\Estado;
use App\Models\Sistema\TiposDocumento;

class Feligres extends Model
{
    protected $table = 'feligres';
    protected $fillable = [
        'tipos_documento_id',
        'identificacion',
        'nombre',
        'apellido',
        'fecha_nacimiento',
        'email',
        'telefono',
        'recibir_notificacion',
        'users_id',
        'estados_id',
    ];
    public function scopeBuscar($query, $data)
    {
        return $query->where('nombre', 'like', '%' . $data . '%');
    }
    public function tipoDocumento()
    {
        return $this->belongsTo(TiposDocumento::class, 'tipos_documento_id');
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
