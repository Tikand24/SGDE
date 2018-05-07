<?php

namespace App\Http\Controllers\Administrativos;

use App\Http\Controllers\Controller;
use App\Osario;
use Illuminate\Http\Request;
use Validator;
use App\Municipio;
use App\CelebParroquia;
use App\CambiosSistema;

class OsariosController extends Controller {
	public function index(Request $request) {
		$osarios = Osario::buscar($request->name)->orderBy('id', 'DESC')->paginate(50);
		return view('administracion.osarios.index')->with('osarios', $osarios);
	}
	public function create() {
		return view('administracion.osarios.create');
	}
	public function edit(Request $request) {
		return view('administracion.osarios.editar')->with('osario',$request->osario);
	}
	public function complementos()
	{
		try {
			 return response()->json([
			 	'ciudades'=>Municipio::with(['Departamento'])->get()
			 ]);
		} catch (Exception $e) {
			return response()->json($e->getMessage());
		}
	}
	public function guardar(Request $request) {
		try {
			$validador = Validator::make($request->all(), [
				'numero' => 'required',
				'fallecido' => 'required',
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
			$osario = new Osario();
			$osario->NUMERO_OSARIO=$request->numero;
			$osario->COMPRADOR_OSARIO=$request->comprador;
			$osario->FALLECIDO_OSARIO=$request->fallecido;
			$osario->cedula_comprador=$request->cedula_comprador;
			$osario->ciudad_expedicion_id=$request->ciudad_expedicion;
			$osario->fecha_nacimiento=$request->fecha_nacimiento;
			$osario->fecha_fallecimiento=$request->fecha_fallecimiento;
			$osario->fecha_traslado=$request->fecha_traslado;
			$osario->save();
			return response()->json([
				'estado' => 'ok',
				'tipo' => 'save',
				'osario' => $osario,
			]);
		} catch (Exception $e) {
			return response()->json($e->getMessage());
		}
	}
	public function actualizarOsario(Request $request)
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
			$osario = Osario::find($request->id);
			$osario->NUMERO_OSARIO=$request->numero;
			$osario->COMPRADOR_OSARIO=$request->comprador;
			$osario->FALLECIDO_OSARIO=$request->fallecido;
			$osario->cedula_comprador=$request->cedula_comprador;
			$osario->ciudad_expedicion_id=$request->ciudad_expedicion;
			$osario->fecha_nacimiento=$request->fecha_nacimiento;
			$osario->fecha_fallecimiento=$request->fecha_fallecimiento;
			$osario->fecha_traslado=$request->fecha_traslado;
			$osario->save();
				$cambioSistema = new CambiosSistema();
				$cambioSistema->cambio_id = $osario->id;
				$cambioSistema->tipo_cambio = 'Osario';
				$cambioSistema->usuario_id = \Auth::user()->id;
				$cambioSistema->descipcion_cambio = 'Actualizacion de registro de osario';
				$cambioSistema->save();
			return response()->json([
				'estado' => 'ok',
				'tipo' => 'update',
				'osario' => $osario,
			]);
		} catch (Exception $e) {
			return response()->json($e->getMessage());
		}
	}
	public function validarNumeroOsario(Request $request)
	{
		try {
			return response()->json([
				'osario'=>Osario::where('NUMERO_OSARIO',$request->numero)->count()
			]);
		} catch (Exception $e) {
			return response()->json($e->getMessage());
		}
	}
	public function datosOsario(Request $request)
	{
		try {
			return response()->json([
				'osario' => Osario::where('id',$request->id)->first()
			]);
		} catch (Exception $e) {
			return response()->json($e->getMessage());
		}
	}
	public function generarTitulo($id,$firma)
	{
		try {
			$datos = Osario::where('id', $id)->with(['Municipio'])->first();
			$quienFirma = CelebParroquia::with(['Celebrante'])->where('celebrantes_id', $firma)->first();
			if ($this->validarPartidaPDF($datos) == '') {
				$pdf = \PDF::loadView('administracion.reportes.titulo_osario', ['datos' => $datos, 'firma' => $quienFirma]);
			} else {
				$pdf = \PDF::loadView('administracion.reportes.error', ['mensaje' => $this->validarPartidaPDF($datos)]);
			}
			return $pdf->setPaper('letter', 'portrait')->stream('osario.pdf');
		} catch (Exception $e) {
			dd('Algo ha salido mal al generar el reporte pdf');
		}
	}
	protected function validarPartidaPDF($osario) {
		$mensaje = '';
		if ($osario->NUMERO_OSARIO == null) {
			$mensaje = 'Numero de osario';
			return $mensaje;
		}
		if ($osario->FALLECIDO_OSARIO == null) {
			$mensaje = 'Nombre del fallecido que ocupa el osario';
			return $mensaje;
		}
		if ($osario->COMPRADOR_OSARIO == null) {
			$mensaje = 'Nombre del comprador del osario';
			return $mensaje;
		}
		if ($osario->cedula_comprador==null) {
			$mensaje = 'Cedula del comprador';
			return $mensaje;
		}
		if ($osario->ciudad_expedicion_id==null) {
			$mensaje = 'Ciudad de expedicion de la cedula';
			return $mensaje;
		}
		if ($osario->fecha_nacimiento==null) {
			$mensaje = 'Fecha de nacimiento';
			return $mensaje;
		}
		if ($osario->fecha_fallecimiento==null) {
			$mensaje = 'Fecha de fallecimiento';
			return $mensaje;
		}
		if ($osario->fecha_traslado==null) {
			$mensaje = 'Fecha de traslado';
			return $mensaje;
		}
		return $mensaje;
	}
}