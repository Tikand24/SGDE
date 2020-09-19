<?php

namespace App\Http\Controllers;

use App\Models\Ministerio\Celebrantes;
use App\Http\Controllers\Controller;
use App\Http\Helpers\EnumsTrait;
use App\Models\Sistema\Municipios;
use Illuminate\Http\Request;
use App\Models\Administrativos\Secretaria\HorarioEucaristias;
use App\Models\Administrativos\Secretaria\DiasEucaristias;
use App\Models\Administrativos\Secretaria\LugarEucaristias;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Exception;

class HorariosController extends Controller
{
    use EnumsTrait;
    public function index()
    {
        $horario = HorarioEucaristias::with(['DiasEucaristia', 'LugarEucaristia'])->orderBy('id', 'DESC')->get();
        $lugarEucaristia = LugarEucaristias::all();
        $diasEucaristia = DiasEucaristias::all();
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
            $horario = HorarioEucaristias::where('dia_eucaristia_id', $request->dia_eucaristia)->where('lugar_eucaristia', $request->lugar_eucaristia)->where('hora_eucaristia', $request->hora_eucaristia)->first();
            if (!is_null($horario)) {
                if ($horario->id != $request->id) {
                    return response()->json([
                        'state' => 'validador',
                        'errors' => ['El Horario ya esta registrado. No  se puede actualizar'],
                    ]);
                }
            }
            $horarioEucaristia = HorarioEucaristias::find($request->id);
            $horarioEucaristia->dia_eucaristia_id = $request->dia_eucaristia;
            $horarioEucaristia->lugar_eucaristia = $request->lugar_eucaristia;
            $horarioEucaristia->hora_eucaristia = $request->hora_eucaristia;
            $horarioEucaristia->save();
            return response()->json([
                'state' => 'ok',
                'tipo' => 'update',
                'data' => HorarioEucaristias::with(['DiasEucaristia', 'LugarEucaristia'])->orderBy('id', 'DESC')->get()
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
            $horario = HorarioEucaristias::where('dia_eucaristia_id', $request->dia_eucaristia)->where('lugar_eucaristia', $request->lugar_eucaristia)->where('hora_eucaristia', $request->hora_eucaristia)->first();
            if (!is_null($horario)) {
                return response()->json([
                    'state' => 'validador',
                    'errors' => ['El Horario ya esta registrado. No se pueden duplicar los horarios'],
                ]);
            }
            $horarioEucaristia = new HorarioEucaristias();
            $horarioEucaristia->dia_eucaristia_id = $request->dia_eucaristia;
            $horarioEucaristia->lugar_eucaristia = $request->lugar_eucaristia;
            $horarioEucaristia->hora_eucaristia = $request->hora_eucaristia;
            $horarioEucaristia->semanal = 1;
            $horarioEucaristia->estado = 'Activo';
            $horarioEucaristia->save();
            return response()->json([
                'state' => 'ok',
                'tipo' => 'update',
                'data' => HorarioEucaristias::with(['DiasEucaristia', 'LugarEucaristia'])->orderBy('id', 'DESC')->get()
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
            $horarioEucaristia = HorarioEucaristias::find($request->id);
            $horarioEucaristia->estado = 'Activo';
            $horarioEucaristia->save();
            return response()->json([
                'state' => 'ok',
                'tipo' => 'Activo',
                'data' => HorarioEucaristias::with(['DiasEucaristia', 'LugarEucaristia'])->orderBy('id', 'DESC')->get()
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
            $horarioEucaristia = HorarioEucaristias::find($request->id);
            $horarioEucaristia->estado = 'Inactivo';
            $horarioEucaristia->save();
            return response()->json([
                'state' => 'ok',
                'tipo' => 'Inactivo',
                'data' => HorarioEucaristias::with(['DiasEucaristia', 'LugarEucaristia'])->orderBy('id', 'DESC')->get()
            ]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
