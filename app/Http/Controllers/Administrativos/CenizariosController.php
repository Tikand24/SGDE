<?php

namespace App\Http\Controllers\Administrativos;

use App\Cenizario;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class CenizariosController extends Controller {
	public function index(Request $request) {
		$cenizarios = Cenizario::buscar($request->name)->orderBy('id', 'ASC')->paginate(50);
		return view('administracion.cenizarios.index')->with('cenizarios', $cenizarios);
	}
	public function create() {
		return view('administracion.cenizarios.create');
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
			$cenizario = new Cenizario();
			$cenizario->NUMERO_CENIZARIO = $request->numero;
			$cenizario->COMPRADOR_CENIZARIO = $request->comprador;
			$cenizario->FALLECIDO_CENIZARIO = $request->fallecido;
			$cenizario->save();
			return response()->json([
				'estado' => 'ok',
				'tipo' => 'save',
				'cenizario' => $cenizario->whereId($cenizario->id)->first(),
			]);
		} catch (Exception $e) {
			return response()->json('Error');
		}
	}
}