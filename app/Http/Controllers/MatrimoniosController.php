<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Sacramentos\Matrimonio\Matrimonios;
use App\Models\Sistema\CambiosSistema;
use App\Models\Sacramentos\Matrimonio\AnotacionesMatrimonios;
use Illuminate\Http\Request;
use App\Models\Base\Parroquias;
use App\Models\Ministerio\Celebrantes;
use App\Models\Ministerio\CelebrantesParroquias;
use Illuminate\Support\Facades\Validator;
use Exception;

class MatrimoniosController extends Controller
{
    public function index(Request $request)
    {
        $matrimonios = Matrimonios::buscar($request->name)->orderBy('id', 'DESC')->paginate(50);
        return view('administracion.matrimonios.index')->with('matrimonios', $matrimonios);
    }
    public function create()
    {
        return view('administracion.matrimonios.create');
    }
    public function complementosCreate()
    {
        try {
            return response()->json([
                'parroquias' => Parroquias::with(['Municipio'])->get(),
                'celebrantes' => Celebrantes::all()
            ]);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function edit(Request $request)
    {
        return view('administracion.matrimonios.editar')->with('matrimonio', $request->matrimonio)->with('tipoEdicion', $request->tipoEdicion);
    }
    public function datosEditar(Request $request)
    {
        return response()->json([
            'matrimonio' => Matrimonios::find($request->id),
            'anotaciones' => AnotacionesMatrimonios::where('matrimonio_id', $request->id)->get()
        ]);
    }
    public function guardar(Request $request)
    {
        try {
            $validador = Validator::make($request->all(), [
                'esposo' => 'required',
                'esposa' => 'required',
            ]);
            if ($validador->fails()) {
                return response()->json([
                    'estado' => 'validador',
                    'errors' => $validador->errors(),
                ]);
            }
            $matrimonio = new Matrimonios();
            $matrimonio->nombres = $request->esposo . " y " . $request->esposa;
            $matrimonio->libro = $request->libro;
            $matrimonio->folio = $request->folio;
            $matrimonio->partida = $request->partida;
            $matrimonio->fecha_matrimonio = $request->fechaMatrimonio;
            $matrimonio->esposo = $request->esposo;
            $matrimonio->esposa = $request->esposa;
            $matrimonio->padre_esposo = $request->padre_esposo;
            $matrimonio->madre_esposo = $request->madre_esposo;
            $matrimonio->padre_esposa = $request->padre_esposa;
            $matrimonio->madre_esposa = $request->madre_esposa;
            $matrimonio->parroquia_bautizado_id = $request->parroquia_bautizado;
            $matrimonio->fecha_bautizo_esposo = $request->fechaBautizoEsposo;
            $matrimonio->esposo_lib_baut = $request->libro_bautizado_esposo;
            $matrimonio->esposo_fol_baut = $request->folio_bautizado_esposo;
            $matrimonio->esposo_par_baut = $request->partida_bautizado_esposo;
            $matrimonio->parroquia_bautizada_id = $request->parroquia_bautizada;
            $matrimonio->fecha_bautizo_esposa = $request->fechaBautizoEsposa;
            $matrimonio->esposa_lib_baut = $request->libro_bautizado_esposa;
            $matrimonio->esposa_fol_baut = $request->folio_bautizado_esposa;
            $matrimonio->esposa_par_baut = $request->partida_bautizado_esposa;
            $matrimonio->parroquia_confirmado_id = $request->parroquia_confirmado;
            $matrimonio->fecha_confirmado_esposo = $request->fechaConfirmacionEsposo;
            $matrimonio->esposo_lib_conf = $request->libro_confirmado_esposo;
            $matrimonio->esposo_fol_conf = $request->folio_confirmado_esposo;
            $matrimonio->esposo_par_conf = $request->partida_confirmado_esposo;
            $matrimonio->parroquia_confirmada_id = $request->parroquia_confirmada;
            $matrimonio->fecha_confirmado_esposa = $request->fechaConfirmacionEsposa;
            $matrimonio->esposa_lib_conf = $request->libro_confirmado_esposa;
            $matrimonio->esposa_fol_conf = $request->folio_confirmado_esposa;
            $matrimonio->esposa_par_conf = $request->partida_confirmado_esposa;
            $matrimonio->parroco_id = $request->parroco;
            $matrimonio->celebrante_id = $request->celebrante;
            $matrimonio->padrino = $request->padrino;
            $matrimonio->madrina = $request->madrina;
            $matrimonio->usuario_id = \Auth::id();
            $matrimonio->save();
            return response()->json([
                'estado' => 'ok',
                'tipo' => 'save'
            ]);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function actualizarMatrimonio(Request $request)
    {
        try {
            $validador = Validator::make($request->all(), [
                'id' => 'required',
                'tipoEdicion' => 'required',
                'esposo' => 'required',
                'esposa' => 'required',
                'anotacion' => 'required_if:tipoEdicion,true',
            ]);
            if ($validador->fails()) {
                return response()->json([
                    'estado' => 'validador',
                    'errors' => $validador->errors(),
                ]);
            }
            $matrimonio = Matrimonios::find($request->id);
            $matrimonio->nombres = $request->esposo . " y " . $request->esposa;
            $matrimonio->libro = $request->libro;
            $matrimonio->folio = $request->folio;
            $matrimonio->partida = $request->partida;
            $matrimonio->fecha_matrimonio = $request->fechaMatrimonio;
            $matrimonio->esposo = $request->esposo;
            $matrimonio->esposa = $request->esposa;
            $matrimonio->padre_esposo = $request->padre_esposo;
            $matrimonio->madre_esposo = $request->madre_esposo;
            $matrimonio->padre_esposa = $request->padre_esposa;
            $matrimonio->madre_esposa = $request->madre_esposa;
            $matrimonio->parroquia_bautizado_id = $request->parroquia_bautizado;
            $matrimonio->fecha_bautizo_esposo = $request->fechaBautizoEsposo;
            $matrimonio->esposo_lib_baut = $request->libro_bautizado_esposo;
            $matrimonio->esposo_fol_baut = $request->folio_bautizado_esposo;
            $matrimonio->esposo_par_baut = $request->partida_bautizado_esposo;
            $matrimonio->parroquia_bautizada_id = $request->parroquia_bautizada;
            $matrimonio->fecha_bautizo_esposa = $request->fechaBautizoEsposa;
            $matrimonio->esposa_lib_baut = $request->libro_bautizado_esposa;
            $matrimonio->esposa_fol_baut = $request->folio_bautizado_esposa;
            $matrimonio->esposa_par_baut = $request->partida_bautizado_esposa;
            $matrimonio->parroquia_confirmado_id = $request->parroquia_confirmado;
            $matrimonio->fecha_confirmado_esposo = $request->fechaConfirmacionEsposo;
            $matrimonio->esposo_lib_conf = $request->libro_confirmado_esposo;
            $matrimonio->esposo_fol_conf = $request->folio_confirmado_esposo;
            $matrimonio->esposo_par_conf = $request->partida_confirmado_esposo;
            $matrimonio->parroquia_confirmada_id = $request->parroquia_confirmada;
            $matrimonio->fecha_confirmado_esposa = $request->fechaConfirmacionEsposa;
            $matrimonio->esposa_lib_conf = $request->libro_confirmado_esposa;
            $matrimonio->esposa_fol_conf = $request->folio_confirmado_esposa;
            $matrimonio->esposa_par_conf = $request->partida_confirmado_esposa;
            $matrimonio->parroco_id = $request->parroco;
            $matrimonio->celebrante_id = $request->celebrante;
            $matrimonio->padrino = $request->padrino;
            $matrimonio->madrina = $request->madrina;
            $matrimonio->save();
            if ($request->tipoEdicion == "true") {
                $cambioSistema = new CambiosSistema();
                $cambioSistema->cambio_id = $matrimonio->id;
                $cambioSistema->tipo_cambio = 'Matrimonio';
                $cambioSistema->usuario_id = \Auth::user()->id;
                $cambioSistema->descipcion_cambio = 'Actualizacion de registro de Matrimonios por decreto';
                $cambioSistema->save();
                $anotacion = new AnotacionesMatrimonios();
                $anotacion->matrimonio_id = $matrimonio->id;
                $anotacion->anotacion = $request->anotacion;
                $anotacion->save();
            } else {
                $cambioSistema = new CambiosSistema();
                $cambioSistema->cambio_id = $matrimonio->id;
                $cambioSistema->tipo_cambio = 'Matrimonio';
                $cambioSistema->usuario_id = \Auth::user()->id;
                $cambioSistema->descipcion_cambio = 'Actualizacion de registro de Matrimonios por decreto';
                $cambioSistema->save();
            }
            return response()->json([
                'estado' => 'ok',
                'tipo' => 'update'
            ]);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function eliminarAnotacion(Request $request)
    {
        try {
            $anotacion = AnotacionesMatrimonios::find($request->id);
            $cambioSistema = new CambiosSistema();
            $cambioSistema->cambio_id = $anotacion->matrimonio_id;
            $cambioSistema->tipo_cambio = 'Matrimonio';
            $cambioSistema->usuario_id = \Auth::user()->id;
            $cambioSistema->descipcion_cambio = 'Eliminacion de anotacion de Matrimonios. Anotacion eliminada:' . $anotacion->anotacion;
            $cambioSistema->save();
            $anotacion->delete();
            return response()->json([
                'estado' => 'ok',
                'tipo' => 'delete'
            ]);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function reportePartida($id, $firma)
    {
        try {
            $datos = Matrimonios::where('id', $id)->with(['ParroquiaBautizado.Municipio', 'ParroquiaBautizada.Municipio', 'ParroquiaConfirmado.Municipio', 'ParroquiaConfirmada.Municipio', 'Parroco.Celebrante', 'Celebrante.Celebrante'])->first();
            $anotaciones = AnotacionesMatrimonios::where('matrimonio_id', $id)->get();
            $quienFirma = CelebrantesParroquias::with(['Celebrante'])->where('celebrantes_id', $firma)->first();
            if ($this->validarPartidaPDF($datos) == '') {
                $pdf = \PDF::loadView('administracion.reportes.matrimonio', ['datos' => $datos, 'anotacion' => $anotaciones, 'firma' => $quienFirma]);
            } else {
                $pdf = \PDF::loadView('administracion.reportes.error', ['mensaje' => $this->validarPartidaPDF($datos)]);
            }
            return $pdf->setPaper('legal', 'portrait')->stream('matrimonio.pdf');
        } catch (Exception $e) {
            dd('Algo ha salido mal al generar el reporte pdf');
        }
    }
    protected function validarPartidaPDF($matrimonio)
    {
        $mensaje = '';
        if ($matrimonio->libro == null) {
            $mensaje = 'Libro';
            return $mensaje;
        }
        if ($matrimonio->folio == null) {
            $mensaje = 'Folio';
            return $mensaje;
        }
        if ($matrimonio->partida == null) {
            $mensaje = 'Partida';
            return $mensaje;
        }
        if ($matrimonio->esposo == null) {
            $mensaje = 'Esposo';
            return $mensaje;
        }
        if ($matrimonio->esposa == null) {
            $mensaje = 'Esposa';
            return $mensaje;
        }
        if ($matrimonio->parroquia_bautizado_id == null) {
            $mensaje = 'Parroquia bautizado esposo';
            return $mensaje;
        }
        if ($matrimonio->fecha_bautizo_esposo == null) {
            $mensaje = 'Fecha de bautizo del esposo';
            return $mensaje;
        }
        if ($matrimonio->parroquia_bautizada_id == null) {
            $mensaje = 'Parroquia bautizada esposa';
            return $mensaje;
        }
        if ($matrimonio->fecha_bautizo_esposa == null) {
            $mensaje = 'Fecha de bautizo de la esposa';
            return $mensaje;
        }
        if ($matrimonio->parroco_id == null) {
            $mensaje = 'Parroco del Matrimonios';
            return $mensaje;
        }
        if ($matrimonio->celebrante_id == null) {
            $mensaje = 'Celebrante del Matrimonios';
            return $mensaje;
        }
        if ($matrimonio->padrino == null && $matrimonio->madrina == null) {
            $mensaje = 'Padrino o madrina';
            return $mensaje;
        }
        return $mensaje;
    }
}
