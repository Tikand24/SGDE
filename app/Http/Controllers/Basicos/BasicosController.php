<?php

namespace App\Http\Controllers\Basicos;

use App\Http\Controllers\Controller;
use App\Municipio;
use App\CelebParroquia;

class BasicosController extends Controller {
	public function ciudades() {
        return response()->json(['cities'=>Municipio::orderBy('nom_municipio')->with(['Departamento'])->get()]);
    }
	public function celebrantes() {
        return response()->json(['celebrant'=>CelebParroquia::where('estado','Activo')->with('Celebrante')->get()]);
    }
    public function obtenerTodos()
    {
        $complementos = collect();
        $complementos->put('parishes',CelebParroquia::where('cargo', 'Parroco')->with('Celebrante')->get());
        $complementos->put('parish_priest',CelebParroquia::where('cargo', 'Parroco')->where('estado', 'Activo')->with('Celebrante')->first());
        $complementos->put('cities',Municipio::orderBy('nom_municipio')->with(['Departamento'])->get());
        $complementos->put('celebrant',CelebParroquia::where('estado','Activo')->with('Celebrante')->get());
        $complementos->put('gender',[['id'=>'Masculino','abreviatura'=>'Masculino'],['id'=>'Femenino','abreviatura'=>'Femenino']]);
        return response()->json(['data'=>$complementos]);
    }
}