<?php

namespace App\Http\Controllers\Administrativos;

use App\Celebrante;
use App\Http\Controllers\Controller;
use App\Http\Helpers\EnumsTrait;
use App\Municipio;
use Illuminate\Http\Request;
use App\HorarioEucaristia;
use App\DiasEucaristia;
use App\LugarEucaristia;
use Carbon\Carbon;
use Validator;
use App\AvisosParroquiale;

class AvisosParroquialesController extends Controller {
	use EnumsTrait;
	public function index() {
		$avisos = AvisosParroquiale::orderBy('id', 'DESC')->get();
		return view('administracion.avisos.index')->with('avisos', $avisos);
	}
	public function store(Request $request)
	{
		try {
			$validador = Validator::make($request->all(), [
				'descripcion' => 'required',
			]);
			if ($validador->fails()) {
				return response()->json([
					'state' => 'validador',
					'errors' => $validador->errors(),
				]);
			}
			$aviso = new AvisosParroquiale();
			$aviso->descripcion = $request->descripcion;
			$aviso->save();
			return response()->json([
				'state' => 'ok',
				'tipo' => 'save',
				'data' => $aviso
			]);
		} catch (\Exception $e) {
			return response()->json($e->getMessage());
		}
	}
	public function update(Request $request)
	{
		try {
			$validador = Validator::make($request->all(), [
				'id' => 'required',
				'descripcion' => 'required',
			]);
			if ($validador->fails()) {
				return response()->json([
					'state' => 'validador',
					'errors' => $validador->errors(),
				]);
			}
			$aviso = AvisosParroquiale::find($request->id);
			$aviso->descripcion = $request->descripcion;
			$aviso->save();
			return response()->json([
				'state' => 'ok',
				'tipo' => 'update',
				'data' => $aviso
			]);
		} catch (\Exception $e) {
			return response()->json($e->getMessage());
		}
	}
	public function delete(Request $request)
	{
		try {
			$validador = Validator::make($request->all(), [
				'id' => 'required'
			]);
			if ($validador->fails()) {
				return response()->json([
					'state' => 'validador',
					'errors' => $validador->errors(),
				]);
			}
			$aviso = AvisosParroquiale::find($request->id);
			$aviso->delete();
			return response()->json([
				'state' => 'ok',
				'tipo' => 'delete'
			]);
		} catch (\Exception $e) {
			return response()->json($e->getMessage());
		}
	}
}