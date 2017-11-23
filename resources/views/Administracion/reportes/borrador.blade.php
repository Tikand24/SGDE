<?php
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
$date = date_create($datos->fecha_bautismo);
$diaBautizo = date_format($date, "d");
$fecm = date_format($date, "F");
$mesBautizo = mes($fecm);
$yearBautizo = date_format($date, "Y");
$date = date_create($datos->fecha_nacimiento);
$diaNacimiento = date_format($date, "d");
$fecmn = date_format($date, "F");
$mesNacimiento = mes($fecmn);
$yearNacimiento = date_format($date, "Y");
$dhoy = date('d');
$mhoy = mes(strftime('%B'));
$yhoy = date('Y');
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Borrador de bautizo {{ $datos->nombre }}</title>
</head>
<style>
*{
	font-family: Helvetica;
	font-size: 13;
}
#encabezado{
	width: 100%;
	text-align: center;
}
#imgDiocesis{
	position: absolute;
	top: 5px;
	left: 5px;
}
#imgSagradaFamilia{
	position: absolute;
	top: 5px;
	right: 5px;
}
#imgDiocesis img{
	width: 55px; height: 105px;
}
#imgSagradaFamilia img{
	width: 70px; height: 85px;
}
#ofrenda{
	position: absolute;
	top: 90px;
	right: 19px;
}
#contenido{
	margin-top: 80px;
}
#contenido2{
	margin-top: 80px;
}
#encabezado2{
	width: 100%;
	margin-top:0px;
	text-align: center;
}
#imgDiocesis2{
	position: absolute;
	top: 430px;
	left: 5px;
}
#imgSagradaFamilia2{
	position: absolute;
	top: 430px;
	right: 5px;
}
#imgDiocesis2 img{
	width: 55px; height: 105px;
}
#imgSagradaFamilia2 img{
	width: 70px; height: 85px;
}
#ofrenda2{
	position: absolute;
	top: 510px;
	right: 19px;
}
#page1{
	border-style: solid;
	border-width: 2px;
	padding: 0.5em
}
#page2{
	margin-top: 57px;
	border-style: solid;
	border-width: 2px;
	padding: 0.5em
}
</style>
<body>
	<div id="page1">
		<table id="encabezado">
			<tr><th>DIOCESIS DE GIRARDOT</th></tr>
			<tr><th>PARROQUIA DE LA SAGRADA FAMILIA-FUSAGASUGA</th></tr>
			<tr><th>BORRADOR DE BAUTISMO</th></tr>
		</table>
		<div id="imgDiocesis">

			<img src="./administracion/img/LogoDiosecis.png" alt="">
		</div>
		<div id="imgSagradaFamilia">

			<img src="./administracion/img/sagradafamilia.jpg" alt="">
		</div>
		<p id="ofrenda"><strong>ofrenda: ${{ $valor }}</strong></p>
		<div id="contenido">
			<strong>Nombre del Bautizado:</strong> {{ $datos->nombre }}<br>
			<strong>Fecha y lugar de nacimiento:</strong> {{$diaNacimiento}} de  {{$mesNacimiento}} de  {{$yearNacimiento}}. {{ $datos->municipio->nom_municipio }}-{{ $datos->municipio->departamento->nom_departamento }}.<br>
			<strong>Fecha de bautismo:</strong>{{ $diaBautizo }} de  {{ $mesBautizo }} de  {{ $yearBautizo }}.<br>
			<strong>Nombre de los padres:</strong>
			@if ($datos->nom_padre==null)
			{{ $datos->nom_madre }}.
			@else
			@if ($datos->nom_madre==null)
			{{ $datos->nom_padre }}.
			@else
			{{ $datos->nom_padre }} - {{ $datos->nom_madre }}.
			@endif
			@endif<br>
			<strong>Abuelos paternos:</strong>
			@if ($datos->abuelo_paterno==null)
			{{ $datos->abuela_paterna }}.
			@else
			@if ($datos->abuela_paterna==null)
			{{ $datos->abuelo_paterno }}.
			@else
			{{ $datos->abuelo_paterno }} - {{ $datos->abuela_paterna }}.
			@endif
			@endif<br>
			<strong>Abuelos maternos:</strong>
			@if ($datos->abuelo_materno==null)
			{{ $datos->abuela_materna }}.
			@else
			@if ($datos->abuela_materna==null)
			{{ $datos->abuelo_materno }}.
			@else
			{{ $datos->abuelo_materno }} - {{ $datos->abuela_materna }}.
			@endif
			@endif<br>
			<strong>Padrinos:</strong>
			@if ($datos->nom_padrino==null)
			{{ $datos->nom_madrina }}.
			@else
			@if ($datos->nom_madrina==null)
			{{ $datos->nom_padrino }}.
			@else
			{{ $datos->nom_padrino }} - {{ $datos->nom_madrina }}.
			@endif
			@endif<br>
			<strong>Ministro:</strong> {{$datos->celebrante->nom_celebrante}}. {{$datos->celebrante->cod_cargo_cel}}.
		</div>
	</div>
	<div id="page2">
		<table id="encabezado2">
			<tr><th>DIOCESIS DE GIRARDOT</th></tr>
			<tr><th>PARROQUIA DE LA SAGRADA FAMILIA-FUSAGASUGA</th></tr>
			<tr><th>BORRADOR DE BAUTISMO</th></tr>
		</table>
		<div id="imgDiocesis2">
			<img src="./administracion/img/LogoDiosecis.png" alt="no img">
		</div>
		<div id="imgSagradaFamilia2">
			<img src="./administracion/img/sagradafamilia.jpg" alt="no img">
		</div>
		<p id="ofrenda2"><strong>ofrenda: ${{ $valor }}</strong></p>
		<div id="contenido2">
			<strong>Nombre del Bautizado:</strong> {{ $datos->nombre }}.<br>
			<strong>Fecha y lugar de nacimiento:</strong> {{$diaNacimiento}} de  {{$mesNacimiento}} de  {{$yearNacimiento}}. {{ $datos->municipio->nom_municipio }}-{{ $datos->municipio->departamento->nom_departamento }}.<br>
			<strong>Fecha de bautismo:</strong>{{ $diaBautizo }} de  {{ $mesBautizo }} de  {{ $yearBautizo }}.<br>
			<strong>Nombre de los padres:</strong>
			@if ($datos->nom_padre==null)
			{{ $datos->nom_madre }}.
			@else
			@if ($datos->nom_madre==null)
			{{ $datos->nom_padre }}.
			@else
			{{ $datos->nom_padre }} - {{ $datos->nom_madre }}.
			@endif
			@endif<br>
			<strong>Abuelos paternos:</strong>
			@if ($datos->abuelo_paterno==null)
			{{ $datos->abuela_paterna }}.
			@else
			@if ($datos->abuela_paterna==null)
			{{ $datos->abuelo_paterno }}.
			@else
			{{ $datos->abuelo_paterno }} - {{ $datos->abuela_paterna }}.
			@endif
			@endif<br>
			<strong>Abuelos maternos:</strong>
			@if ($datos->abuelo_materno==null)
			{{ $datos->abuela_materna }}.
			@else
			@if ($datos->abuela_materna==null)
			{{ $datos->abuelo_materno }}.
			@else
			{{ $datos->abuelo_materno }} - {{ $datos->abuela_materna }}.
			@endif
			@endif<br>
			<strong>Padrinos:</strong>
			@if ($datos->nom_padrino==null)
			{{ $datos->nom_madrina }}.
			@else
			@if ($datos->nom_madrina==null)
			{{ $datos->nom_padrino }}.
			@else
			{{ $datos->nom_padrino }} - {{ $datos->nom_madrina }}.
			@endif
			@endif<br>
			<strong>Ministro:</strong> {{$datos->celebrante->nom_celebrante}}. {{$datos->celebrante->cod_cargo_cel}}.
		</div>
	</div>
</body>
</html>