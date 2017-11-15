<?php

namespace App\Http\Controllers\Administrativos;

use App\Http\Controllers\Controller;
use App\Osario;
use Illuminate\Http\Request;

class OsariosController extends Controller {
	public function index(Request $request) {
		$osarios = Osario::buscar($request->name)->orderBy('id', 'ASC')->paginate(50);
		return view('administracion.osarios.index')->with('osarios', $osarios);
	}
}