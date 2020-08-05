<?php

namespace App\Models\Sistema;

use Illuminate\Database\Eloquent\Model;

class CelebrantesParroquias extends Model
{
    protected $table = 'celeb_parroquias';
    public function scopeBuscar($query, $data)
    {
        return $query->where('nombre', 'like', '%' . $data . '%');
    }
    public function celebrante()
    {
        return $this->belongsTo(Celebrantes::class, 'celebrantes_id');
    }
}
