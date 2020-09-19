<?php

namespace App\Models\Ministerio;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sistema\User;
use App\Models\Sistema\Estado;
use App\Models\Ministerio\CargoParroquial;

class CelebrantesParroquias extends Model
{
    protected $table = 'celebrantes_parroquias';
    protected $fillable = [
        'celebrantes_id',
        'cargo_parroquial_id',
        'estados_id',
        'users_id',
    ];
    public function scopeBuscar($query, $data)
    {
        return $query->where('nombre', 'like', '%' . $data . '%');
    }
    public function celebrante()
    {
        return $this->belongsTo(Celebrantes::class, 'celebrantes_id');
    }
    public function cargoParroquial()
    {
        return $this->belongsTo(CargoParroquial::class, 'cargo_parroquial_id');
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
