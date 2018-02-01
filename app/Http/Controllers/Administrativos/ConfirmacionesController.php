<?php

namespace App\Http\Controllers\Administrativos;

use App\Confirmacione;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Parroquia;
use App\GruposConfirmacione;

class ConfirmacionesController extends Controller {
	public function index(Request $request) {
		$confirmaciones = Confirmacione::buscar($request->name)->orderBy('id', 'ASC')->paginate(50);
		return view('administracion.confirmaciones.index')->with('confirmaciones', $confirmaciones);
	}
	public function create() {
		return view('administracion.confirmaciones.create');
	}
	public function complementosCreate()
	{
		try {
			return response()->json(['parroquias'=>Parroquia::with(['Municipio'])->get()]); 
		} catch (Exception $e) {
			return response()->json($e->getMessage());
		}
	}
	public function buscarGrupoConfirmacion(Request $request)
	{
		try {
			return response()->json(['grupos'=>GruposConfirmacione::buscar($request->descripcion)->with(['Celebrante'])->get()]); 
		} catch (Exception $e) {
			return response()->json($e->getMessage());
		}
	}
	public function edit(Request $request) {
		$municipios = Municipio::with(['Departamento'])->get();
		$celebrante = Celebrante::all();
		return view('administracion.bautismos.editar')->with('tipo', $request->tipoAnotacion)->with('bautismo', $request->bautizado)->with('municipios', $municipios)->with('celebrantes', $celebrante);
	}
	public function reportePartida($id, $firma) {
		try {
			$datos = Confirmacione::where('id', $id)->with(['Municipio.Departamento', 'Celebrante', 'CelebranteParroquia'])->first();
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
}