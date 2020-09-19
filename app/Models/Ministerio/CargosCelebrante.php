<?php

namespace App\Models\Sistema;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sistema\User;
use App\Models\Sistema\Estado;

class CargosCelebrante extends Model
{
    protected $table = 'cargos_celebrante';
    protected $fillable = [
        'nombre',
        'users_id',
        'estados_id',
    ];
    public function scopeBuscar($query, $data)
    {
        return $query->where('nombre', 'like', '%' . $data . '%');
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
