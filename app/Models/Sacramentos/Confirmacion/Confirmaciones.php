<?php

namespace App\Models\Sacramentos\Confirmacion;

use App\Models\Base\Genero;
use App\Models\Base\User;
use App\Models\Sistema\Estado;
use App\Models\Sistema\Parroquias;
use Illuminate\Database\Eloquent\Model;

class Confirmaciones extends Model
{
    protected $table = 'confirmaciones';
    protected $fillable = [
        'id',
        'nombre',
        'libro',
        'folio',
        'partida',
        'madre',
        'padre',
        'madrina',
        'padrino',
        'lib_baut',
        'fol_baut',
        'part_baut',
        'created_at',
        'updated_at',
        'estados_id',
        'grupos_confirmaciones_id',
        'users_id',
        'parroquias_id',
        'genero_id',
    ];
    public function scopeBuscar($query, $data)
    {
        return $query->where('nombre', 'like', '%' . $data . '%');
    }
    public function parroquia()
    {
        return $this->belongsTo(Parroquias::class, 'parroquias_id');
    }
    public function grupoConfirmacion()
    {
        return $this->belongsTo(GruposConfirmaciones::class, 'grupos_confirmaciones_id');
    }
    public function genero()
    {
        return $this->belongsTo(Genero::class, 'genero_id');
    }
    public function anotacionConfirmacion()
    {
        return $this->hasMany(AnotacionesConfirmaciones::class);
    }
    public function usuario()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estados_id');
    }
}
