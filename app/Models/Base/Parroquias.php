<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sistema\Municipios;
use App\Models\Sistema\User;
use App\Models\Sistema\Estado;

class Parroquias extends Model
{
    protected $table = 'parroquias';
    protected $fillable = [
        'nombre',
        'dio_arq_diocesis',
        'municipios_id',
        'estados_id',
        'users_id',
    ];
    public function municipio()
    {
        return $this->belongsTo(Municipios::class, 'municipios_id');
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
