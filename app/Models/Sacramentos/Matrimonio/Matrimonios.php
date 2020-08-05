<?php

namespace App\Models\Sacramentos\Matrimonio;

use App\Models\Sistema\CelebrantesParroquias;
use App\Models\Sistema\Parroquias;
use Illuminate\Database\Eloquent\Model;

class Matrimonios extends Model
{
    protected $table = 'matrimonios';
    public function scopeBuscar($query, $data)
    {
        return $query->where('nombres', 'like', '%' . $data . '%');
    }
    public function parroquiaBautizado()
    {
        return $this->belongsTo(Parroquias::class, 'parroquia_bautizado_id');
    }
    public function parroquiaBautizada()
    {
        return $this->belongsTo(Parroquias::class, 'parroquia_bautizada_id');
    }
    public function parroquiaConfirmado()
    {
        return $this->belongsTo(Parroquias::class, 'parroquia_confirmado_id');
    }
    public function parroquiaConfirmada()
    {
        return $this->belongsTo(Parroquias::class, 'parroquia_confirmada_id');
    }
    public function parroco()
    {
        return $this->belongsTo(CelebrantesParroquias::class, 'parroco_id');
    }
    public function celebrante()
    {
        return $this->belongsTo(CelebrantesParroquias::class, 'celebrante_id');
    }
}
