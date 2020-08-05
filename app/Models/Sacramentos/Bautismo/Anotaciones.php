<?php

namespace App\Models\Sacramentos\Bautismo;

use App\CelebParroquia;
use App\Models\Sistema\CelebrantesParroquias;
use Illuminate\Database\Eloquent\Model;

class Anotaciones extends Model
{
    protected $table = 'anotaciones';
    protected $fillable = [
        'cod_bautisado',
        'parroco_firma',
        'anotacion'
    ];
    public function scopeBuscar($query, $data)
    {
        return $query->where('anotacion', 'like', '%' . $data . '%');
    }
    public function bautisado()
    {
        return $this->belongsTo(Bautisados::class, 'cod_bautisado');
    }
    public function parroco()
    {
        return $this->belongsTo(CelebrantesParroquias::class, 'parroco_firma');
    }
}
