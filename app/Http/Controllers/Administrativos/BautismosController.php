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
	public function ejemplo() {
		$municipios = Municipio::with(['Departamento'])->get();
		return response()->json($municipios);
	}
	public function guardar(Request $request) {
		try {
			$validador = Validator::make($request->all(), [
				'nombre' => 'required',
				'fechaNacimiento' => 'required',
				'ciudadNacimiento' => 'required',
			]);
			if ($validador->fails()) {
				return response()->json([
					'estado' => 'validador',
					'errors' => $validador->errors(),
				]);
			}
			$bautismo = new Bautisado();
			$bautismo->nombre = $request->nombre;
			$bautismo->libro = $request->libro;
			$bautismo->folio = $request->folio;
			$bautismo->partida = $request->partida;
			$bautismo->nom_padre = $request->padre;
			$bautismo->nom_madre = $request->madre;
			$bautismo->abuelo_paterno = $request->abueloPaterno;
			$bautismo->abuela_paterna = $request->abuelaPaterna;
			$bautismo->abuelo_materno = $request->abueloMaterno;
			$bautismo->abuela_materna = $request->abuelaMaterna;
			$bautismo->nom_padrino = $request->padrino;
			$bautismo->nom_madrina = $request->madrina;
			$bautismo->fecha_nacimiento = $request->fechaNacimiento;
			$bautismo->cod_ciudad_nac_baut = $request->ciudadNacimiento;
			$bautismo->fecha_bautismo = $request->fechaBautismo;
			$bautismo->cod_celebrante = $request->celebrante;
			$bautismo->save();
			return response()->json([
				'estado' => 'ok',
				'tipo' => 'save',
				'bautisado' => $bautismo->whereId($bautismo->id)->first(),
			]);
		} catch (Exception $e) {
			return response()->json('Error');
		}
	}
}