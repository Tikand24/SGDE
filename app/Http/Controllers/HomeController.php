<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\HorarioEucaristia;
use App\Feligre;
use Validator;
use App\Http\Controllers\Controller;
use App\MensajesSacerdote;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->middleware('auth');
        return view('home');
    }

    public function horarioSemanal($dia)
    {
        try {
            $hoy=$dia;
            if (($dia+1)>7) {
                $manhiana=1;
            }else{
                $manhiana=$dia+1;
            }
            if (($dia+2)>7) {
                $pasadomanhiana=2;
            }else{
                $pasadomanhiana=$dia+2;
            }
            return response()->json([
                'dia1'=>HorarioEucaristia::where('dia_eucaristia_id',$hoy)->with(['DiasEucaristia','LugarEucaristia'])->get(),
                'dia2'=>HorarioEucaristia::where('dia_eucaristia_id',$manhiana)->with(['DiasEucaristia','LugarEucaristia'])->get(),
                'dia3'=>HorarioEucaristia::where('dia_eucaristia_id',$pasadomanhiana)->with(['DiasEucaristia','LugarEucaristia'])->get()
            ]);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function guardarFeligres(Request $request)
    {
        try {
            $validador = Validator::make($request->all(), [
                'nombre' => 'required',
                'apellido' => 'required',
                'fecha_nacimiento' => 'required',
                'recibir_notificacion' => 'required',
            ]);
            if ($validador->fails()) {
                return response()->json([
                    'estado' => 'validador',
                    'errors' => $validador->errors(),
                ]);
            }
            $feligres = new Feligre();
            $feligres->nombre = $request->nombre;
            $feligres->apellido = $request->apellido;
            $feligres->fecha_nacimiento = $request->fecha_nacimiento;
            $feligres->email = $request->email;
            $feligres->telefono = $request->telefono;
            $feligres->recibir_notificacion = $request->recibir_notificacion;
            $feligres->save();
            return response()->json([
                'estado' => 'ok',
                'tipo' => 'save'
            ]);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function guardarMensajeFeligres(Request $request)
    {
        try {
            $validador = Validator::make($request->all(), [
                'nombre' => 'required',
                'mensaje' => 'required',
                'sacerdote' => 'required',
            ]);
            if ($validador->fails()) {
                return response()->json([
                    'estado' => 'validador',
                    'errors' => $validador->errors(),
                ]);
            }
            $mensajeSacerdote = new MensajesSacerdote();
            $mensajeSacerdote->nombre_feligres = $request->nombre;
            $mensajeSacerdote->sacerdote = $request->sacerdote;
            $mensajeSacerdote->mensaje = $request->mensaje;
            $mensajeSacerdote->save();
            return response()->json([
                'estado' => 'ok',
                'tipo' => 'save'
            ]);
        } catch (Exception $e) {
         return response()->json($e->getMessage());   
        }
    }
}
