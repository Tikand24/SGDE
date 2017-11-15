<?php

namespace App\Http\Controllers\Administrativos;

use App\Http\Controllers\Controller;
use App\Matrimonio;
use Illuminate\Http\Request;

class MatrimoniosController extends Controller {
	public function index(Request $request) {
		$matrimonios = Matrimonio::buscar($request->name)->orderBy('id', 'ASC')->paginate(50);
		return view('administracion.matrimonios.index')->with('matrimonios', $matrimonios);
	}
}