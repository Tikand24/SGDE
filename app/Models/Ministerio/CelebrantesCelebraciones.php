<?php

namespace App\Models\Ministerio;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sistema\User;
use App\Models\Sistema\Estado;
use App\Models\Ministerio\Celebraciones;
use App\Models\Ministerio\CelebrantesParroquias;

class CelebrantesCelebraciones extends Model
{
    protected $table = 'celebrantes_celebraciones';

    protected $fillable = [
        'celebraciones_id',
        'celebrantes_parroquias_id',
        'estados_id',
        'users_id',
    ];
    public function scopeBuscar($query, $data)
    {
        return $query->where('nombre', 'like', '%' . $data . '%');
    }
    public function celebracion()
    {
        return $this->belongsTo(Celebraciones::class, 'celebraciones_id');
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
