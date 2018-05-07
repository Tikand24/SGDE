<?php

namespace App\Http\Controllers\Administrativos;

use App\Confirmacione;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Parroquia;
use App\GruposConfirmacione;
use Validator;
use App\AnotacionConfirmacione;
use App\CelebParroquia;
use App\CambiosSistema;
use App\Http\Helpers\EnumsTrait;
class ConfirmacionesController extends Controller {
use EnumsTrait;
	public function index(Request $request) {
		$confirmaciones = Confirmacione::buscar($request->name)->orderBy('id', 'DESC')->paginate(50);
		return view('administracion.confirmaciones.index')->with('confirmaciones', $confirmaciones);
	}
	public function create() {
		return view('administracion.confirmaciones.create');
	}
	public function edit(Request $request)
	{
		try {
			return view('administracion.confirmaciones.editar')->with('confirmado',$request->confirmado)->with('tipoEdicion',$request->tipoEdicion);
		
		} catch (Exception $e) {
			return response()->json($e->getMessage());
		}
	}
	public function confirmadoEditar(Request $request)
	{
		try {
			$confirmacion = Confirmacione::where('id',$request->id)->with(['Parroquia','GrupoConfirmacion.CelebranteParroquia.Celebrante'])->first();
			$anotaciones= AnotacionConfirmacione::where('confirmacion_id',$request->id)->get();
			return response()->json([
				'confirmacion'=>$confirmacion,
				'anotaciones'=>$anotaciones
			]);
		} catch (Exception $e) {
			return response()->json($e->getMessage());
		}
	}
	public function complementosCreate()
	{
		try {
			return response()->json([
				'parroquias'=>Parroquia::with(['Municipio'])->get(),
				'generos'=>$this->getEnumValues('confirmaciones', 'genero')
			]); 
		} catch (Exception $e) {
			return response()->json($e->getMessage());
		}
	}
	public function guardar(Request $request)
	{
		try {
			$validador = Validator::make($request->all(), [
				'nombre' => 'required',
				'grupoConfirmado.id' => 'required',
			]);
			if ($validador->fails()) {
				return response()->json([
					'estado' => 'validador',
					'errors' => $validador->errors(),
				]);
			}
			$confirmacion=new Confirmacione();
			$confirmacion->nombre=$request->nombre;
			$confirmacion->libro=$request->libro;
			$confirmacion->folio=$request->folio;
			$confirmacion->partida=$request->partida;
			$confirmacion->madre=$request->madre;
			$confirmacion->padre=$request->padre;
			$confirmacion->madrina=$request->madrina;
			$confirmacion->padrino=$request->padrino;
			$confirmacion->genero=$request->genero;
			$confirmacion->grupo_confirmado_id=$request->grupoConfirmado['id'];
			$confirmacion->lib_baut=$request->libroBautismo;
			$confirmacion->fol_baut=$request->folioBautismo;
			$confirmacion->part_baut=$request->partidaBautismo;
			$confirmacion->parroquia_baut_id=$request->parroquiaBautizado;
			$confirmacion->usu_id=\Auth::id();
			$confirmacion->save();
			return response()->json([
				'estado' => 'ok',
				'tipo' => 'save'
			]);
		} catch (Exception $e) {
			return response()->json($e->getMessage());
		}
	}
	public function updated(Request $request)
	{
		
		try {
			$validador = Validator::make($request->all(), [
				'id'=> 'required',
				'nombre' => 'required',
				'grupoConfirmado.id' => 'required',
				'anotacion' => 'required_if:tipoEdicion,true',
			]);
			if ($validador->fails()) {
				return response()->json([
					'estado' => 'validador',
					'errors' => $validador->errors(),
				]);
			}
			$confirmacion= Confirmacione::where('id',$request->id)->first();
			$confirmacion->nombre=$request->nombre;
			$confirmacion->libro=$request->libro;
			$confirmacion->folio=$request->folio;
			$confirmacion->partida=$request->partida;
			$confirmacion->madre=$request->madre;
			$confirmacion->padre=$request->padre;
			$confirmacion->madrina=$request->madrina;
			$confirmacion->padrino=$request->padrino;
			$confirmacion->genero=$request->genero;
			$confirmacion->grupo_confirmado_id=$request->grupoConfirmado['id'];
			$confirmacion->lib_baut=$request->libroBautismo;
			$confirmacion->fol_baut=$request->folioBautismo;
			$confirmacion->part_baut=$request->partidaBautismo;
			$confirmacion->parroquia_baut_id=$request->parroquiaBautizado;
			$confirmacion->save();
			if ($request->tipoEdicion=="true") {
				$cambioSistema = new CambiosSistema();
				$cambioSistema->cambio_id = $confirmacion->id;
				$cambioSistema->tipo_cambio = 'Confirmacion';
				$cambioSistema->usuario_id = \Auth::user()->id;
				$cambioSistema->descipcion_cambio = 'Actualizacion de registro de confirmacion por decreto';
				$cambioSistema->save();
				$anotacion= new AnotacionConfirmacione();
				$anotacion->confirmacion_id=$confirmacion->id;
				$anotacion->anotacion=$request->anotacion;
				$anotacion->save();
			}else{
				$cambioSistema = new CambiosSistema();
				$cambioSistema->cambio_id = $confirmacion->id;
				$cambioSistema->tipo_cambio = 'Confirmacion';
				$cambioSistema->usuario_id = \Auth::user()->id;
				$cambioSistema->descipcion_cambio = 'Actualizacion de registro de confirmacion por sistema';
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
	public function buscarGrupoConfirmacion(Request $request)
	{
		try {
			return response()->json(['grupos'=>GruposConfirmacione::buscar($request->descripcion)->with(['CelebranteParroquia.Celebrante'])->get()]); 
		} catch (Exception $e) {
			return response()->json($e->getMessage());
		}
	}
	public function reportePartida($id, $firma) {
		try {
			$datos = Confirmacione::where('id', $id)->with(['GrupoConfirmacion.CelebranteParroquia.Celebrante','Parroquia.Municipio.Departamento'])->first();
			$anotaciones = AnotacionConfirmacione::where('confirmacion_id', $id)->get();
			$quienFirma = CelebParroquia::with(['Celebrante'])->where('celebrantes_id', $firma)->first();
			if ($this->validarPartidaPDF($datos) == '') {
				$pdf = \PDF::loadView('administracion.reportes.confirmacion', ['datos' => $datos, 'anotacion' => $anotaciones, 'firma' => $quienFirma]);
			} else {
				$pdf = \PDF::loadView('administracion.reportes.error', ['mensaje' => $this->validarPartidaPDF($datos)]);
			}
			return $pdf->setPaper('legal', 'portrait')->stream('bautizo.pdf');
		} catch (Exception $e) {
			dd('Algo ha salido mal al generar el reporte pdf');
		}
	}
	public function eliminarAnotacion(Request $request)
	{
		try {
			$anotacion = AnotacionConfirmacione::find($request->id);
			$cambioSistema = new CambiosSistema();
			$cambioSistema->cambio_id = $anotacion->confirmacion_id;
			$cambioSistema->tipo_cambio = 'Confrimacion';
			$cambioSistema->usuario_id = \Auth::user()->id;
			$cambioSistema->descipcion_cambio = 'Eliminacion de anotacion de confirmacion. Anotacion eliminada:'.$anotacion->anotacion;
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

	protected function validarPartidaPDF($confirmado) {
		$mensaje = '';
		if ($confirmado->libro == null) {
			$mensaje = 'Libro';
			return $mensaje;
		}
		if ($confirmado->folio == null) {
			$mensaje = 'Folio';
			return $mensaje;
		}
		if ($confirmado->partida == null) {
			$mensaje = 'Partida';
			return $mensaje;
		}
		if ($confirmado->GrupoConfirmacion==null) {
			$mensaje = 'Grupo de confirmacion';
			return $mensaje;
		}
		return $mensaje;
	}
}