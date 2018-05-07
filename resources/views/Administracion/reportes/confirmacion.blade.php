
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
$tipHijo="hijo";
$tipBautizado="Batizado";
if ($datos->genero=="Femenino") {
	$tipHijo="hija";
	$tipBautizado="Batizada";
}
?>
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
	<p id="nombre"><strong>{{ $datos->nombre }}</strong></p>
	<div id="textoPrinc">
		{{ $datos->GrupoConfirmacion->descripcion_partida }} <strong>{{ $datos->nombre }}</strong>  {{ $tipHijo }} de 
		@if ($datos->madre!="" && $datos->padre!="")
			{{ $datos->padre }} y {{ $datos->madre }}.
		@else
			@if ($datos->padre!="")
				{{ $datos->padre }}.
			@endif
			@if ($datos->madre!="")
				{{ $datos->madre }}.
			@endif
		@endif
		{{ $tipBautizado }} en la {{ $datos->parroquia->nombre }} de {{ $datos->parroquia->municipio->nom_municipio }}-{{ $datos->parroquia->municipio->departamento->nom_departamento }} libro: {{ $datos->lib_baut }} folio: {{ $datos->fol_baut }} partida: {{ $datos->part_baut }}. 
		@if ($datos->padrino!="")
			Padrino: {{ $datos->padrino }}. 
		@endif
		@if ($datos->madrina!="")
			Madrina: {{ $datos->madrina }}. 
		@endif
	</div>
	<div class="justify-text">
	<div>
		<strong>Doy fe:</strong> {{ $datos->GrupoConfirmacion->CelebranteParroquia->Celebrante->nom_celebrante }} - {{ $datos->GrupoConfirmacion->CelebranteParroquia->Celebrante->cod_cargo_cel }}
	</div>
	</div>
	@if (count($anotacion)>0)
	<p>
	@foreach ($anotacion as $anot)
			<strong>Anotación:</strong> {{ $anot->anotacion }}<br>
		@endforeach
		</p>
	@else
		<P>Sin nota marginal de matrimonio hasta la fecha</P>
	@endif

	<p>Es fiel copia expedida en Fusagasugá, Cundinamarca a los {{$dhoy}} dias del mes de {{$mhoy}} de {{$yhoy}}</p>
	<div id="firma">
		<p><strong>{{$firma->celebrante->nom_celebrante}}<br>
		{{$firma->cargo}}</strong></p>
	</div>
</body>
</html>