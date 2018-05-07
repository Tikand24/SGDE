 @php
use Carbon\Carbon;
Carbon::setUtf8(true);
Carbon::setLocale('es');
$now = Carbon::now();
$fechaFallecidoDb=explode('-', $datos->fecha_fallecimiento);
$fechaNacimientoDb=explode('-', $datos->fecha_nacimiento);
$fechaTrasladoDb=explode('-', $datos->fecha_traslado);
$fechaFallecido=Carbon::createFromDate($fechaFallecidoDb[0], $fechaFallecidoDb[1], $fechaFallecidoDb[2]);
$fechaNacimiento=Carbon::createFromDate($fechaNacimientoDb[0], $fechaNacimientoDb[1], $fechaNacimientoDb[2]);
$fechaTraslado=Carbon::createFromDate($fechaTrasladoDb[0], $fechaTrasladoDb[1], $fechaTrasladoDb[2]);
setlocale(LC_TIME, 'Spanish');
@endphp
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Titulo de osario</title>
	</head>
	<style>
	*{
		font-family: "Times New Roman", Times, serif;
		font-size: 12;
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
	#page1{
		padding: 0.5em
	}
	#contenido p{
		text-align: justify;
		padding: 0.8;
		line-height: 150%;
	}
	.underline{
	text-decoration: underline;
	
	}
	.negrita{
		font-weight: bold;
	}
	#fechas{
		margin: 50px 0 50px 0
	}
	#firma{
		margin-top: 10%;
	}
	</style>
	<body>
		<div id="page1">
			<table id="encabezado">
				<tr><th>DIÓCESIS DE GIRARDOT</th></tr>
				<tr><th>PARROQUIA DE LA SAGRADA FAMILIA</th></tr>
				<tr><th>FUSAGASUGÁ, CUNDINAMARCA</th></tr>
				<tr>
					<th>NIT: 808000495-3</th>
				</tr>
			</table>
			<div id="imgDiocesis">
				<img src="./administracion/img/LogoDiosecis.png" alt="">
			</div>
			<div id="imgSagradaFamilia">
				<img src="./administracion/img/sagradafamilia.jpg" alt="">
			</div>
		</div>
		<div id="contenido">
			<p>LA PARROQUIA DE LA “SAGRADA FAMILIA” HACE CONSTAR POR EL PRESENTE DOCUMENTO.</p>
			<p>Que el Señor: <span class="underline negrita">{{ strtoupper($datos->COMPRADOR_CENIZARIO) }}</span>, identificado con cedula de ciudadanía N° {{ $datos->cedula_comprador }} de {{ $datos->Municipio->nom_municipio }}-{{ $datos->Municipio->Departamento->nom_departamento }}, se responsabiliza del arriendo a perpetuidad el Cenizario No. <span class="underline negrita">{{ $datos->NUMERO_CENIZARIO }}</span> en la Cripta del Templo, para depositar los restos mortales de: <span class="underline negrita">{{ strtoupper($datos->FALLECIDO_CENIZARIO) }}.</span></p>
			<p id="fechas">
				Fecha de Nacimiento: <span class="underline">{{ $fechaNacimiento->format('j') }} de {{$fechaNacimiento->formatLocalized('%B')  }} de {{ $fechaNacimiento->format('Y') }}</span><br>
				Fecha de Fallecimiento: <span class="underline">{{ $fechaFallecido->format('j') }} de {{$fechaFallecido->formatLocalized('%B')  }} de {{ $fechaFallecido->format('Y') }}</span><br>
				Fecha de Traslado: <span class="underline">{{ $fechaTraslado->format('j') }} de {{$fechaTraslado->formatLocalized('%B')  }} de {{ $fechaTraslado->format('Y') }}</span><br>
			</p>
			<p>
				TENIENDO EN CUENTA EL LUGAR “SANTO”, EL COMPRADOR SE COMPROMETE A GUARDAR EL DEBIDO RESPETO EN LA CRIPTA Y A MANTENER EN PERFECTO ESTADO EL CENIZARIO Y A CANCELAR LA CUOTA ANUAL DE ADMINISTRACION DE $ 30.000 PESOS.
			</p>
			<p>
			EL NO PAGO DE LA ADMINISTRACIÓN Y MANTENIMIENTO  POR UN PERIODO SUPERIOR DE 36 MESES AUTORIZA A LA PARROQUIA A DISPONER DE LAS CENIZAS O LOS RESTOS GUARDÁNDOLOS EN UN SITIO DIGNO COMÚN.  UNA VEZ SE PONGA AL DIA SE LE ASIGNA UN NUEVO CENIZARIO O CENIZARIO. </p>
			<p>
				EL USO DEL CENIZARIO ES UNIPERSONAL,  NO SE PUEDE COLOCAR FLORES, FOTOS, VELADORAS, IMÁGENES Y NINGÚN OTRO ACCESORIO PARA MANTENER LA UNIFORMIDAD.
			</p>
			<p>
				SE EXPIDE EL PRESENTE TITULO A LOS {{ $now->format('j') }} DIAS DEL MES DE {{ strtoupper($now->formatLocalized('%B')) }} DE {{ $now->format('Y') }}. 
			</p>
		</div>
		<div id="firma">
		<p><strong>{{$firma->celebrante->nom_celebrante}}<br>
		{{$firma->cargo}}</strong></p>
	</div>
	</body>
</html>