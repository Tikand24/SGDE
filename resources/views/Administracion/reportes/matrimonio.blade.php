@php
function mes($mes) {
	$nom = 'nombre mes';
	if ($mes == "January") {
		$nom = "Enero";
	} elseif ($mes == "February") {
		$nom = "Febrero";
	} elseif ($mes == "March") {
		$nom = "Marzo";
	} elseif ($mes == "April") {
		$nom = "Abril";
	} elseif ($mes == "May") {
		$nom = "Mayo";
	} elseif ($mes == "June") {
		$nom = "Junio";
	} elseif ($mes == "July") {
		$nom = "Julio";
	} elseif ($mes == "August") {
		$nom = "Agosto";
	} elseif ($mes == "September") {
		# code...
		$nom = "Septiembre";
	} elseif ($mes == "October") {
		# code...
		$nom = "Octubre";
	} elseif ($mes == "November") {
		# code...
		$nom = "Noviembre";
	} elseif ($mes == "December") {
		# code...
		$nom = "Diciembre";
	}
	return $nom;
}
$date = date_create($datos->fecha_matrimonio);
$diaMatrimonio = date_format($date, "d");
$fecm = date_format($date, "F");
$mesMatrimonio = mes($fecm);
$yearMatrimonio = date_format($date, "Y");

$dhoy = date('d');
$mhoy = mes(strftime('%B'));
$yhoy = date('Y');

$fechaBautizoEsposo = date_create($datos->fecha_bautizo_esposo);
$diaBautizoEsposo = date_format($fechaBautizoEsposo, "d");
$mesBautizoEsposo = date_format($fechaBautizoEsposo, "F");
$mesPartidaBautizoEsposo = mes($mesBautizoEsposo);
$yearBautizoEsposo = date_format($fechaBautizoEsposo, "Y");

$fechaBautizoEsposa = date_create($datos->fecha_bautizo_esposa);
$diaBautizoEsposa = date_format($fechaBautizoEsposa, "d");
$mesBautizoEsposa = date_format($fechaBautizoEsposa, "F");
$mesPartidaBautizoEsposa = mes($mesBautizoEsposa);
$yearBautizoEsposa = date_format($fechaBautizoEsposa, "Y");

$padresEsposo="";
if ($datos->padre_esposo != "" && $datos->padre_esposo != null) {
	$padresEsposo=$datos->padre_esposo;
	if ($datos->madre_esposo != "" && $datos->madre_esposo != null) {
		$padresEsposo.=" y ".$datos->madre_esposo;
	}
}else{
	$padresEsposo=$datos->madre_esposo;
}
$padresEsposa="";
if ($datos->padre_esposa != "" && $datos->padre_esposa != null) {
	$padresEsposa=$datos->padre_esposa;
	if ($datos->madre_esposa != "" && $datos->madre_esposa != null) {
		$padresEsposa.=" y ".$datos->madre_esposa;
	}
}else{
	$padresEsposa=$datos->madre_esposa;
}
$testigos="";
if ($datos->padrino != "" && $datos->padrino != null) {
	$testigos=$datos->padrino;
	if ($datos->madrina != "" && $datos->madrina != null) {
		$testigos.=" y ".$datos->madrina;
	}
}else{
	$testigos=$datos->madrina;
}

@endphp
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Partida de bautismo {{ $datos->nombre }}</title>
		<style>
		*{
			font-family: Helvetica;
			font-size: 14;
		}
		.center-align{
			text-align: center;
		}
		.table{
			width: 100%;
			margin:auto;
		}
		#folio{
			text-align: center;
			margin-top: 5%;
			width: 100%;
		}
		#nombre{
			margin-top: 5%;
		}
		#textoPrinc{
			margin-top: 3%;
			margin-left: 6%;
			text-align: justify;
		}
		.justify-text{
			text-align: justify;
			margin-left: 6%;
		}
		p {
			margin-left: 6%;
		}
		#firma{
			margin-top: 10%;
		}
		</style>
	</head>
	<body>
		<table class="center-align table">
			<tr><th>VICARIA DEL SUMAPAZ</th></tr>
			<tr><th>PARROQUIA DE LA SAGRADA FAMILIA</th></tr>
			<tr><th>FUSAGASUGA, CUNDINAMARCA</th></tr>
			<tr>
				<th>CARRERA 3,17-09 BARRIO BALMORAL</th>
			</tr>
			<tr>
				<th>TELEFONO 8716273 - CEL 3207947407</th>
			</tr>
		</table>
		<pre id="folio">
			<strong>Libro: {{ $datos->libro }}</strong>     <strong>Folio: {{ $datos->folio }}</strong>     <strong>Partida: {{ $datos->partida }}</strong>
		</pre>
		<p id="nombre"><strong>{{ $datos->esposo }}</strong><br><strong>{{ $datos->esposa }}</strong></p>
		<div id="textoPrinc">
			En la Parroquia de la Sagrada Familia de Fusagasugá, a 
			{{ $diaMatrimonio }} de 
			{{ $mesMatrimonio }} de 
			{{ $yearMatrimonio }}, El padre: 
			{{ $datos->Celebrante->Celebrante->nom_celebrante }}, presenció el matrimonio que contrajo: 
			{{ $datos->esposo }}, hijo de 
			{{ $padresEsposo }}, bautizado en la 
			{{ $datos->ParroquiaBautizado->nombre }} de 
			{{ $datos->ParroquiaBautizado->Municipio->nom_municipio }} - 
			{{ $datos->ParroquiaBautizado->Municipio->Departamento->nom_departamento }} el 
			{{ $diaBautizoEsposo }} de 
			{{ $mesPartidaBautizoEsposo }} de 
			{{ $yearBautizoEsposo }}. Lib: 
			{{ $datos->esposo_lib_baut }} Fol: 
			{{ $datos->esposo_fol_baut }} Partida N°: 
			{{ $datos->esposo_par_baut }}. Con: 
			{{ $datos->esposa }}, hija de 
			{{ $padresEsposa }}, bautizada en la 
			{{ $datos->ParroquiaBautizada->nombre }} de 
			{{ $datos->ParroquiaBautizada->Municipio->nom_municipio }} - 
			{{ $datos->ParroquiaBautizada->Municipio->Departamento->nom_departamento }} el 
			{{ $diaBautizoEsposa }} de 
			{{ $mesPartidaBautizoEsposa }} de 
			{{ $yearBautizoEsposa }}. Lib: {{ $datos->esposa_lib_baut }} Fol: {{ $datos->esposa_fol_baut }} Partida N°: {{ $datos->esposa_par_baut }}. Testigos: {{ $testigos }}.
		</div>
		<div class="justify-text">
			<div>
				<strong>Doy fe:</strong> {{ $datos->Parroco->Celebrante->nom_celebrante }} - {{ $datos->Parroco->Celebrante->cod_cargo_cel }}
			</div>
		</div>
		@if (count($anotacion)>0)
		<p>
			@foreach ($anotacion as $anot)
			<strong>Anotación:</strong> {{ $anot->anotacion }}<br>
			@endforeach
		</p>
		@endif
		<p>Es fiel copia expedida en Fusagasugá, Cundinamarca a los {{$dhoy}} dias del mes de {{$mhoy}} de {{$yhoy}}</p>
		<div id="firma">
			<p><strong>{{$firma->celebrante->nom_celebrante}}<br>
			{{$firma->cargo}}</strong></p>
		</div>
	</body>
</html>