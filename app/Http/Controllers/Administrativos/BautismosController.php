<?php

namespace App\Http\Controllers\Administrativos;

use App\Bautisado;
use App\Celebrante;
use App\Http\Controllers\Controller;
use App\Municipio;
use Illuminate\Http\Request;
use Validator;

class BautismosController extends Controller {
	public function index(Request $request) {
		$batuismos = Bautisado::buscar($request->name)->orderBy('id', 'ASC')->paginate(50);
		return view('administracion.bautismos.index')->with('bautizados', $batuismos);
	}
	public function create() {
		$municipios = Municipio::with(['Departamento'])->get();
		$celebrante = Celebrante::all();
		return view('administracion.bautismos.create')->with('municipios', $municipios)->with('celebrantes', $celebrante);
	}
	public function guardar(Request $request) {
		try {
			$validador = Validator::make($request->all(), [
				'codigo' => 'required | max:5 |unique:ad_catenciones,codigo',
				'nombre' => 'required | max:500|unique:ad_catenciones,nombre',
				'direccion' => 'required | max:200',
				'tipo' => 'required',
			]);
			if ($validador->fails()) {
				return response()->json([
					'estado' => 'validador',
					'errors' => $validador->errors(),
				]);
			}
			$bautismo = new Bautisado();
			$batuismo->nombre = $request->nombre;
			$batuismo->libro = $request->libro;
			$batuismo->folio = $request->folio;
			$batuismo->partida = $request->partida;
			$batuismo->nom_padre = $request->nom_padre;
			$batuismo->nom_madre = $request->nom_madre;
			$batuismo->abuelo_paterno = $request->abuelo_paterno;
			$batuismo->abuela_paterna = $request->abuela_paterna;
			$batuismo->abuelo_materno = $request->abuelo_materno;
			$batuismo->abuela_materna = $request->abuela_materna;
			$batuismo->nom_padrino = $request->nom_padrino;
			$batuismo->nom_madrina = $request->nom_madrina;
			$batuismo->fecha_nacimiento = $request->fecha_nacimiento;
			$batuismo->cod_ciudad_nac_baut = $request->cod_ciudad_nac_baut;
			$batuismo->fecha_bautismo = $request->fecha_bautismo;
			$batuismo->cod_celebrante = $request->cod_celebrante;
			$batuismo->save();
			return response()->json([
				'estado' => 'ok',
				'tipo' => 'save',
				'bautisado' => $bautismo->whereId($bautismo->id)->first(),
			]);
		} catch (Exception $e) {
			return response()->json($e->getMessage());
		}
	}
}