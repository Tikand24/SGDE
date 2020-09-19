<?php

namespace App\Models\Sacramentos\Confirmacion;

use App\Models\Sistema\User;
use App\Models\Sistema\CelebrantesParroquias;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sistema\Estado;

class AnotacionesConfirmaciones extends Model
{
    protected $table = 'anotacion_confirmaciones';
    protected $fillable = [
        'anotacion',
        'estados_id',
        'users_id',
        'confirmaciones_id',
        'celebrantes_parroquias_id',
    ];
    public function scopeBuscar($query, $data)
    {
        return $query->where('anotacion', 'like', '%' . $data . '%');
    }
    public function confirmado()
    {
        return $this->belongsTo(Confirmaciones::class, 'confirmaciones_id');
    }
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
