<?php

namespace App\Models\Ministerio;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sistema\User;
use App\Models\Sistema\Estado;
use App\Models\Sistema\CargosCelebrante;

class Celebrantes extends Model
{
    protected $table = 'celebrantes';
    protected $fillable = [
        'nom_celebrante',
        'estados_id',
        'users_id',
        'cargos_celebrante_id',
    ];
    public function scopeBuscar($query, $data)
    {
        return $query->where('nom_celebrante', 'like', '%' . $data . '%');
    }
    public function cargoCelebrante()
    {
        return $this->belongsTo(CargosCelebrante::class, 'cargos_celebrante_id');
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
