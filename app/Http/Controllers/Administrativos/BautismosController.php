<?php

namespace App\Http\Controllers\Administrativos;

use App\Anotacione;
use App\Bautisado;
use App\CelebParroquia;
use App\Celebrante;
use App\Http\Controllers\Controller;
use App\Municipio;
use Illuminate\Http\Request;
use Validator;

class BautismosController extends Controller {
	public function index(Request $request) {
		$batuismos = Bautisado::buscar($request->name)->orderBy('id', 'DESC')->paginate(50);
		return view('administracion.bautismos.index')->with('bautizados', $batuismos);
	}
	public function create() {
		$municipios = Municipio::with(['Departamento'])->get();
		$celebrante = Celebrante::all();
		return view('administracion.bautismos.create')->with('municipios', $municipios)->with('celebrantes', $celebrante);
	}
	public function edit(Request $request) {

	}
	public function ejemplo() {
		$municipios = Municipio::with(['Departamento'])->get();
		return response()->json($municipios);
	}
	public function celebrantesParroquia() {
		$celeb = CelebParroquia::with(['Celebrante'])->where('estado', 'Activo')->get();
		return response()->json($celeb);
	}
	public function guardar(Request $request) {
		try {
			$validador = Validator::make($request->all(), [
				'nombre' => 'required',
				'fechaNacimiento' => 'required',
				'ciudadNacimiento' => 'required',
			]);
			if ($validador->fails()) {
				return response()->json([
					'estado' => 'validador',
					'errors' => $validador->errors(),
				]);
			}
			$parroco = CelebParroquia::where('cargo', 'Parroco')->where('estado', 'Activo')->first();
			$bautismo = new Bautisado();
			$bautismo->nombre = $request->nombre;
			$bautismo->libro = $request->libro;
			$bautismo->folio = $request->folio;
			$bautismo->partida = $request->partida;
			$bautismo->nom_padre = $request->padre;
			$bautismo->nom_madre = $request->madre;
			$bautismo->abuelo_paterno = $request->abueloPaterno;
			$bautismo->abuela_paterna = $request->abuelaPaterna;
			$bautismo->abuelo_materno = $request->abueloMaterno;
			$bautismo->abuela_materna = $request->abuelaMaterna;
			$bautismo->nom_padrino = $request->padrino;
			$bautismo->nom_madrina = $request->madrina;
			$bautismo->fecha_nacimiento = $request->fechaNacimiento;
			$bautismo->cod_ciudad_nac_baut = $request->ciudadNacimiento;
			$bautismo->fecha_bautismo = $request->fechaBautismo;
			$bautismo->cod_celebrante = $request->celebrante;
			$bautismo->parroco_firma = $parroco->celebrantes_id;
			$bautismo->save();
			return response()->json([
				'estado' => 'ok',
				'tipo' => 'save',
				'bautisado' => $bautismo->whereId($bautismo->id)->first(),
			]);
		} catch (Exception $e) {
			return response()->json('Error');
		}
	}
	public function reportePartida($id, $firma) {
		try {
			$datos = Bautisado::where('id', $id)->with(['Municipio.Departamento', 'Celebrante', 'CelebranteParroquia'])->first();
			$anotaciones = Anotacione::where('cod_bautisado', $id)->get();
			$quienFirma = CelebParroquia::with(['Celebrante'])->where('celebrantes_id', $firma)->first();
			if ($this->validarPartidaPDF($datos) == '') {
				$pdf = \PDF::loadView('administracion.reportes.partida', ['datos' => $datos, 'anotacion' => $anotaciones, 'firma' => $quienFirma]);
			} else {
				$pdf = \PDF::loadView('administracion.reportes.error', ['mensaje' => $this->validarPartidaPDF($datos)]);
			}
			return $pdf->setPaper('legal', 'portrait')->stream('bautizo.pdf');
		} catch (Exception $e) {
			dd('Algo ha salido mal al generar el reporte pdf');
		}
	}
	public function reporteBorrador($id, $valor) {
		try {
			$datos = Bautisado::where('id', $id)->with(['Municipio.Departamento', 'Celebrante'])->first();
			$anotaciones = Anotacione::where('cod_bautisado', $id)->get();
			$pdf = \PDF::loadView('administracion.reportes.borrador', ['datos' => $datos, 'anotacion' => $anotaciones, 'valor' => $valor]);
			return $pdf->setPaper('letter', 'portrait')->stream('borrador.pdf');
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
	protected function validarPartidaPDF($bautizado) {
		$mensaje = '';
		if ($bautizado->libro == null) {
			$mensaje = 'Libro';
			return $mensaje;
		}
		if ($bautizado->folio == null) {
			$mensaje = 'Folio';
			return $mensaje;
		}
		if ($bautizado->partida == null) {
			$mensaje = 'Partida';
			return $mensaje;
		}
		if ($bautizado->fecha_nacimiento == null) {
			$mensaje = 'Fecha de nacimiento';
			return $mensaje;
		}
		if ($bautizado->cod_ciudad_nac_baut == null) {
			$mensaje = 'Ciudad de nacimiento';
			return $mensaje;
		}
		if ($bautizado->fecha_bautismo == null) {
			$mensaje = 'Fecha de bautismo';
			return $mensaje;
		}
		if ($bautizado->cod_celebrante == null) {
			$mensaje = 'Celebrante';
			return $mensaje;
		}
		if ($bautizado->parroco_firma == null) {
			$mensaje = 'Parroco';
			return $mensaje;
		}
		return $mensaje;
	}
}