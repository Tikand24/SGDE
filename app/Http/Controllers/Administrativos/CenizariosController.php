<?php

namespace App\Http\Controllers\Administrativos;

use App\Cenizario;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\CambiosSistema;
use App\CelebParroquia;

class CenizariosController extends Controller
{
    public function index(Request $request)
    {
        $cenizarios = Cenizario::buscar($request->name)->orderBy('id', 'DESC')->paginate(50);
        return view('administracion.cenizarios.index')->with('cenizarios', $cenizarios);
    }
    public function create()
    {
        return view('administracion.cenizarios.create');
    }
    public function edit(Request $request)
    {
        return view('administracion.cenizarios.editar')->with('cenizario', $request->cenizario);
    }
    public function guardar(Request $request)
    {
        try {
            $validador = Validator::make($request->all(), [
                'fallecido' => 'required',
                'numero' => 'required',
                'fecha_nacimiento' => 'required',
                'fecha_fallecimiento' => 'required',
                'comprador' => 'required',
                'cedula_comprador' => 'required',
                'ciudad_expedicion' => 'required',
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
            $cenizario->cedula_comprador=$request->cedula_comprador;
            $cenizario->ciudad_expedicion_id=$request->ciudad_expedicion;
            $cenizario->fecha_nacimiento=$request->fecha_nacimiento;
            $cenizario->fecha_fallecimiento=$request->fecha_fallecimiento;
            $cenizario->fecha_traslado=$request->fecha_traslado;
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
    public function actualizarCenizario(Request $request)
    {
        try {
            $validador = Validator::make($request->all(), [
                'id' => 'required',
                'numero' => 'required',
                'fallecido' => 'required',
                'fecha_nacimiento' => 'required',
                'fecha_fallecimiento' => 'required',
                'comprador' => 'required',
                'cedula_comprador' => 'required',
                'ciudad_expedicion' => 'required',
                'comprador' => 'required',
            ]);
            if ($validador->fails()) {
                return response()->json([
                    'estado' => 'validador',
                    'errors' => $validador->errors(),
                ]);
            }
            $cenizario = Cenizario::find($request->id);
            $cenizario->NUMERO_CENIZARIO=$request->numero;
            $cenizario->COMPRADOR_CENIZARIO=$request->comprador;
            $cenizario->FALLECIDO_CENIZARIO=$request->fallecido;
            $cenizario->cedula_comprador=$request->cedula_comprador;
            $cenizario->ciudad_expedicion_id=$request->ciudad_expedicion;
            $cenizario->fecha_nacimiento=$request->fecha_nacimiento;
            $cenizario->fecha_fallecimiento=$request->fecha_fallecimiento;
            $cenizario->fecha_traslado=$request->fecha_traslado;
            $cenizario->save();
            $cambioSistema = new CambiosSistema();
            $cambioSistema->cambio_id = $cenizario->id;
            $cambioSistema->tipo_cambio = 'Cenizario';
            $cambioSistema->usuario_id = \Auth::user()->id;
            $cambioSistema->descipcion_cambio = 'Actualizacion de registro de cenizario';
            $cambioSistema->save();
            return response()->json([
                'estado' => 'ok',
                'tipo' => 'update',
                'cenizario' => $cenizario,
            ]);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function validarNumeroCenizario(Request $request)
    {
        try {
            return response()->json([
                'cenizario'=>Cenizario::where('NUMERO_CENIZARIO',$request->numero)->count()
            ]);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function datosCenizario(Request $request)
    {
        try {
            return response()->json([
                'cenizario' => Cenizario::where('id',$request->id)->first()
            ]);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function generarTitulo($id,$firma)
    {
        try {
            $datos = Cenizario::where('id', $id)->with(['Municipio'])->first();
            $quienFirma = CelebParroquia::with(['Celebrante'])->where('celebrantes_id', $firma)->first();
            if ($this->validarPartidaPDF($datos) == '') {
                $pdf = \PDF::loadView('administracion.reportes.titulo_cenizario', ['datos' => $datos, 'firma' => $quienFirma]);
            } else {
                $pdf = \PDF::loadView('administracion.reportes.error', ['mensaje' => $this->validarPartidaPDF($datos)]);
            }
            return $pdf->setPaper('letter', 'portrait')->stream('cenizario.pdf');
        } catch (Exception $e) {
            dd('Algo ha salido mal al generar el reporte pdf');
        }
    }
    protected function validarPartidaPDF($cenizario) {
        $mensaje = '';
        if ($cenizario->NUMERO_CENIZARIO == null) {
            $mensaje = 'Numero de cenizario';
            return $mensaje;
        }
        if ($cenizario->FALLECIDO_CENIZARIO == null) {
            $mensaje = 'Nombre del fallecido que ocupa el cenizario';
            return $mensaje;
        }
        if ($cenizario->COMPRADOR_CENIZARIO == null) {
            $mensaje = 'Nombre del comprador del cenizario';
            return $mensaje;
        }
        if ($cenizario->cedula_comprador==null) {
            $mensaje = 'Cedula del comprador';
            return $mensaje;
        }
        if ($cenizario->ciudad_expedicion_id==null) {
            $mensaje = 'Ciudad de expedicion de la cedula';
            return $mensaje;
        }
        if ($cenizario->fecha_nacimiento==null) {
            $mensaje = 'Fecha de nacimiento';
            return $mensaje;
        }
        if ($cenizario->fecha_fallecimiento==null) {
            $mensaje = 'Fecha de fallecimiento';
            return $mensaje;
        }
        if ($cenizario->fecha_traslado==null) {
            $mensaje = 'Fecha de traslado';
            return $mensaje;
        }
        return $mensaje;
    }
}