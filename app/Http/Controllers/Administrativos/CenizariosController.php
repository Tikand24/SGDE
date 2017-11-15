<?php

namespace App\Http\Controllers\Administrativos;

use App\Cenizario;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CenizariosController extends Controller {
	public function index(Request $request) {
		$cenizarios = Cenizario::buscar($request->name)->orderBy('id', 'ASC')->paginate(50);
		return view('administracion.cenizarios.index')->with('cenizarios', $cenizarios);
	}
}