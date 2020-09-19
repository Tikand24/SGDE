<?php

namespace App\Models\Sacramentos\Bautismo;

use App\Models\Sistema\Genero;
use App\Models\Sistema\Municipios;
use App\Models\Sistema\User;
use App\Models\Sistema\CelebrantesParroquias;
use App\Models\Sistema\Estado;
use Illuminate\Database\Eloquent\Model;

class Bautisados extends Model
{
    protected $table = 'bautisados';
    protected $fillable = [
        'nombre',
        'libro',
        'folio',
        'partida',
        'nom_padre',
        'nom_madre',
        'abuelo_paterno',
        'abuela_paterna',
        'abuelo_materno',
        'abuela_materna',
        'nom_padrino',
        'nom_madrina',
        'fecha_nacimiento',
        'fecha_bautismo',
        'updated_at',
        'created_at',
        'users_id',
        'estados_id',
        'municipios_id',
        'celebrantes_parroquias_id_celebrante',
        'celebrantes_parroquias_id_parroco',
        'genero_id',
    ];

    public function scopeBuscar($query, $data)
    {
        return $query->where('nombre', 'like', '%' . $data . '%');
    }
    public function municipio()
    {
        return $this->belongsTo(Municipios::class, 'municipios_id');
    }
    public function celebrante()
    {
        return $this->belongsTo(CelebrantesParroquias::class, 'celebrantes_parroquias_id_celebrante');
    }
    public function parroco()
    {
        return $this->belongsTo(CelebrantesParroquias::class, 'celebrantes_parroquias_id_parroco');
    }
    public function genero()
    {
        return $this->belongsTo(Genero::class, 'genero_id');
    }
    public function anotaciones()
    {
        return $this->hasMany(Anotaciones::class);
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
