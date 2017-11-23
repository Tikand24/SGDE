
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
		En la parroquia de la Sagrada Familia de Fusagasugá a los {{ $diaBautizo }} días del mes de  {{ $mesBautizo }} de  {{ $yearBautizo }} Fue bautizado: <strong>{{ $datos->nombre }}</strong> nacido en {{ $datos->municipio->nom_municipio }}-{{ $datos->municipio->departamento->nom_departamento }} el  {{$diaNacimiento}} de  {{$mesNacimiento}} de  {{$yearNacimiento}}.
	</div>
	<div class="justify-text">
	<div>
		<strong>Padres:</strong>
		@if ($datos->nom_padre==null)
		{{ $datos->nom_madre }}
		@else
		@if ($datos->nom_madre==null)
		{{ $datos->nom_padre }}
		@else
		{{ $datos->nom_padre }} - {{ $datos->nom_madre }}
		@endif
		@endif
	</div>
	<div>
		<strong>Abuelos Paternos:</strong>
		@if ($datos->abuelo_paterno==null)
		{{ $datos->abuela_paterna }}
		@else
		@if ($datos->abuela_paterna==null)
		{{ $datos->abuelo_paterno }}
		@else
		{{ $datos->abuelo_paterno }} - {{ $datos->abuela_paterna }}
		@endif
		@endif
	</div>
	<div>
		<strong>Abuelos Maternos:</strong>
		@if ($datos->abuelo_materno==null)
		{{ $datos->abuela_materna }}
		@else
		@if ($datos->abuela_materna==null)
		{{ $datos->abuelo_materno }}
		@else
		{{ $datos->abuelo_materno }} - {{ $datos->abuela_materna }}
		@endif
		@endif
	</div>
	<div>
		<strong>Padrinos:</strong>
		@if ($datos->nom_padrino==null)
		{{ $datos->nom_madrina }}
		@else
		@if ($datos->nom_madrina==null)
		{{ $datos->nom_padrino }}
		@else
		{{ $datos->nom_padrino }} - {{ $datos->nom_madrina }}
		@endif
		@endif
	</div>
	<div>
		<strong>Doy fe:</strong> {{ $datos->CelebranteParroquia->nom_celebrante }} - {{ $datos->CelebranteParroquia->cod_cargo_cel }}
	</div>
	</div>
	@if (count($anotacion)>0)
	<p>
	@foreach ($anotacion as $anot)
			<strong>Anotación:</strong> {{ $anot->Anotacion }}<br>
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