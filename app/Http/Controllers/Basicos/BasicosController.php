<?php

namespace App\Http\Controllers\Basicos;

use App\Http\Controllers\Controller;
use App\Models\Sistema\Municipios;
use App\Models\Ministerio\CelebrantesParroquias;
use App\Models\Base\Genero;

class BasicosController extends Controller
{
    public function ciudades()
    {
        return response()->json(['cities' => Municipios::orderBy('nom_municipio')->with(['departamento'])->get()]);
    }
    public function celebrantes()
    {
        return response()->json(['celebrant' => CelebrantesParroquias::where('estado', 'Activo')
            ->with('celebrante')->get()]);
    }
    public function obtenerTodos()
    {
        $complementos = collect();
        $complementos->put('parishes', CelebrantesParroquias::where('cargo', 'Parroco')->with('celebrante')->get());
        $complementos->put('parish_priest', CelebrantesParroquias::where('cargo', 'Parroco')->where('estado', 'Activo')
            ->with('celebrante')->first());
        $complementos->put('cities', Municipios::orderBy('nom_municipio')->with(['departamento'])->get());
        $complementos->put('celebrant', CelebrantesParroquias::where('estado', 'Activo')->with('celebrante')->get());
        $complementos->put('all_celebrant', CelebrantesParroquias::where('estado', 'Activo')
            ->orWhere('estado', 'Inactivo')
            ->with('celebrante')
            ->get());
        $complementos->put('gender', Genero::all());
        return response()->json(['data' => $complementos]);
    }
}
