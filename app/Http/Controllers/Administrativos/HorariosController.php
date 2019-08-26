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

class HorariosController extends Controller {
	use EnumsTrait;
	public function index() {
		$horario = HorarioEucaristia::with(['DiasEucaristia','LugarEucaristia'])->orderBy('id', 'DESC')->get();
		$lugarEucaristia = LugarEucaristia::all();
		$diasEucaristia = DiasEucaristia::all();
		return view('administracion.horarios.index')->with('horarios', $horario)->with('lugarEucaristia', $lugarEucaristia)->with('diasEucaristia', $diasEucaristia);
	}
	public function update(Request $request)
	{
		try {
			$validador = Validator::make($request->all(), [
				'id' => 'required',
				'dia_eucaristia' => 'required',
				'lugar_eucaristia' => 'required',
				'hora_eucaristia' => 'required',
			]);
			if ($validador->fails()) {
				return response()->json([
					'state' => 'validador',
					'errors' => $validador->errors(),
				]);
			}
			$horario=HorarioEucaristia::where('dia_eucaristia_id', $request->dia_eucaristia)->where('lugar_eucaristia', $request->lugar_eucaristia)->where('hora_eucaristia', $request->hora_eucaristia)->first();
			if (!is_null($horario)) {
				if ($horario->id != $request->id) {
					return response()->json([
						'state' => 'validador',
						'errors' => ['El Horario ya esta registrado. No  se puede actualizar'],
					]);
				}
			}
			$horarioEucaristia = HorarioEucaristia::find($request->id);
			$horarioEucaristia->dia_eucaristia_id = $request->dia_eucaristia;
			$horarioEucaristia->lugar_eucaristia = $request->lugar_eucaristia;
			$horarioEucaristia->hora_eucaristia = $request->hora_eucaristia;
			$horarioEucaristia->save();
			return response()->json([
				'state' => 'ok',
				'tipo' => 'update',
				'data' => HorarioEucaristia::with(['DiasEucaristia','LugarEucaristia'])->orderBy('id', 'DESC')->get()
			]);
		} catch (\Exception $e) {
			return response()->json($e->getMessage());
		}
	}
	public function createSemanal(Request $request)
	{
		try {
			$validador = Validator::make($request->all(), [
				'dia_eucaristia' => 'required',
				'lugar_eucaristia' => 'required',
				'hora_eucaristia' => 'required',
			]);
			if ($validador->fails()) {
				return response()->json([
					'state' => 'validador',
					'errors' => $validador->errors(),
				]);
			}
			$horario=HorarioEucaristia::where('dia_eucaristia_id', $request->dia_eucaristia)->where('lugar_eucaristia', $request->lugar_eucaristia)->where('hora_eucaristia', $request->hora_eucaristia)->first();
			if (!is_null($horario)) {
					return response()->json([
						'state' => 'validador',
						'errors' => ['El Horario ya esta registrado. No se pueden duplicar los horarios'],
					]);
			}
			$horarioEucaristia = new HorarioEucaristia();
			$horarioEucaristia->dia_eucaristia_id = $request->dia_eucaristia;
			$horarioEucaristia->lugar_eucaristia = $request->lugar_eucaristia;
			$horarioEucaristia->hora_eucaristia = $request->hora_eucaristia;
			$horarioEucaristia->semanal = 1;
			$horarioEucaristia->estado = 'Activo';
			$horarioEucaristia->save();
			return response()->json([
				'state' => 'ok',
				'tipo' => 'update',
				'data' => HorarioEucaristia::with(['DiasEucaristia','LugarEucaristia'])->orderBy('id', 'DESC')->get()
			]);
		} catch (Exception $e) {
			return response()->json($e->getMessage());
		}
	}
	public function estadoActivo(Request $request)
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
			$horarioEucaristia = HorarioEucaristia::find($request->id);
			$horarioEucaristia->estado = 'Activo';
			$horarioEucaristia->save();
			return response()->json([
				'state' => 'ok',
				'tipo' => 'Activo',
				'data' => HorarioEucaristia::with(['DiasEucaristia','LugarEucaristia'])->orderBy('id', 'DESC')->get()
			]);
		} catch (\Exception $e) {
			return response()->json($e->getMessage());
		}
	}
	public function estadoInactivo(Request $request)
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
			$horarioEucaristia = HorarioEucaristia::find($request->id);
			$horarioEucaristia->estado = 'Inactivo';
			$horarioEucaristia->save();
			return response()->json([
				'state' => 'ok',
				'tipo' => 'Inactivo',
				'data' => HorarioEucaristia::with(['DiasEucaristia','LugarEucaristia'])->orderBy('id', 'DESC')->get()
			]);
		} catch (\Exception $e) {
			return response()->json($e->getMessage());
		}
	}
}