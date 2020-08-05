<?php

namespace App\Http\Helpers;

use App\Models\Sistema\Estado;
use Illuminate\Support\Facades\DB;

/**
 * Created by PhpStorm.
 * User: ojo
 * Date: 15/09/17
 * Time: 12:29 PM
 */
trait DefaultsTrait
{
    public static function getEstadoActivo(){
        $estado = Estado::where('nombre','activo')->first();
        if(is_null($estado)){
            return 0;
        }
        return $estado->id;
    }
}
