<?php

namespace App\Models\Sacramentos\Bautismo;

use App\Models\Sistema\User;
use App\Models\Sistema\CelebrantesParroquias;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sistema\Estado;
use App\Models\Sacramentos\Bautismo\Bautisados;

class AnotacionesBautismos extends Model
{
    protected $table = 'anotacion_bautismos';
    protected $fillable = [
        'anotacion',
        'estados_id',
        'users_id',
        'bautisados_id',
        'celebrantes_parroquias_id',
    ];
    public function scopeBuscar($query, $data)
    {
        return $query->where('anotacion', 'like', '%' . $data . '%');
    }
    public function bautisado()
    {
        return $this->belongsTo(Bautisados::class, 'bautisados_id');
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
