<?php

namespace App\Http\Controllers\Administrativos;

use App\Http\Controllers\Controller;
use App\Osario;
use Illuminate\Http\Request;
use Validator;

class OsariosController extends Controller {
	public function index(Request $request) {
		$osarios = Osario::buscar($request->name)->orderBy('id', 'ASC')->paginate(50);
		return view('administracion.osarios.index')->with('osarios', $osarios);
	}
	public function create() {
		return view('administracion.osarios.create');
	}
	public function guardar(Request $request) {
		try {
			$validador = Validator::make($request->all(), [
				'fallecido' => 'required',
				'comprador' => 'required',
				'numero' => 'required',
			]);
			if ($validador->fails()) {
				return response()->json([
					'estado' => 'validador',
					'errors' => $validador->errors(),
				]);
			}
			$osario = new Osario();
			$osario->NUMERO_OSARIO = $request->numero;
			$osario->COMPRADOR_OSARIO = $request->comprador;
			$osario->FALLECIDO_OSARIO = $request->fallecido;
			$osario->save();
			return response()->json([
				'estado' => 'ok',
				'tipo' => 'save',
				'osario' => $osario->whereId($osario->id)->first(),
			]);
		} catch (Exception $e) {
			return response()->json('Error');
		}
	}

}