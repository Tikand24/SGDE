<?php

namespace App\Http\Controllers\Administrativos;

use App\Confirmacione;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfirmacionesController extends Controller {
	public function index(Request $request) {
		$confirmaciones = Confirmacione::buscar($request->name)->orderBy('id', 'ASC')->paginate(50);
		return view('administracion.confirmaciones.index')->with('confirmaciones', $confirmaciones);
	}
}