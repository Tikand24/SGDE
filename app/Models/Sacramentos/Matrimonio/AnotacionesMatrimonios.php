<?php

namespace App\Models\Sacramentos\Matrimonio;

use Illuminate\Database\Eloquent\Model;

class AnotacionesMatrimonios extends Model
{
    protected $table = 'anotaciones_matrimonios';
    public function matrimonio()
    {
        return $this->belongsTo(Matrimonios::class, 'matrimonio_id');
    }
}
