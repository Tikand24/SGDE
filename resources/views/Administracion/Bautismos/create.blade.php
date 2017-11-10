@extends('layouts.app')

@section('title','Bautismos')

@section('contenido')
<div class="container">
	<div class="block-header">
		<h2>Crear Bautismo</h2>
	</div>
	<div class="card">
		<div class="card-header">
			<h2>Crear bautismo
				<small>Se registrara una nueva persona bautizada y se asignara automaticamente sin libro, folio o partida</small>
			</h2>
		</div>
		<div class="card-body card-padding">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<div class="form-group fg-float">
						<div class="fg-line">
							<input type="text" class="form-control fg-input" id="nombreBautisado">
							<label class="fg-label">Nombre del batuizado</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-6 col-lg-6">
					<div class="form-group fg-float">
						<div class="fg-line">
							<input type="text" class="form-control fg-input" id="nombrePadre">
							<label class="fg-label">Nombre del padre</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-6 col-lg-6">
					<div class="form-group fg-float">
						<div class="fg-line">
							<input type="text" class="form-control fg-input" id="nombreMadre">
							<label class="fg-label">Nombre de la madre</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-6 col-lg-6">
					<div class="form-group fg-float">
						<div class="fg-line">
							<input type="text" class="form-control fg-input" id="nombreAbueloPaterno">
							<label class="fg-label">Nombre del abuelo paterno</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-6 col-lg-6">
					<div class="form-group fg-float">
						<div class="fg-line">
							<input type="text" class="form-control fg-input" id="nombreAbuelaPaterna">
							<label class="fg-label">Nombre de la abuela paterna</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-6 col-lg-6">
					<div class="form-group fg-float">
						<div class="fg-line">
							<input type="text" class="form-control fg-input" id="nombreAbueloMaterno">
							<label class="fg-label">Nombre del abuelo materno</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-6 col-lg-6">
					<div class="form-group fg-float">
						<div class="fg-line">
							<input type="text" class="form-control fg-input" id="nombreAbuelaMaterna">
							<label class="fg-label">Nombre de la abuela materna</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-6 col-lg-6">
					<div class="form-group fg-float">
						<div class="fg-line">
							<input type="text" class="form-control fg-input" id="nombrePadrino">
							<label class="fg-label">Nombre del padrino</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-6 col-lg-6">
					<div class="form-group fg-float">
						<div class="fg-line">
							<input type="text" class="form-control fg-input" id="nombreMadrina">
							<label class="fg-label">Nombre de la madrina</label>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-6 col-lg-6">
					<label>Fecha de nacimiento</label>
					<div class="input-group form-group">
						<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
						<div class="dtp-container">
							<input type='text' class="form-control date-picker"
							placeholder="Click here..."  id="fechaNacimiento">
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-6 col-lg-6">
					<label>Ciudad de nacimiento</label>
					<select class="chosen" data-placeholder="Seleccione una ciudad..."  id="ciudadNacimiento">
						<option>Seleccione</option>
						@foreach ($municipios as $municipio)
							<option value="{{ $municipio->id }}">{{ $municipio->nom_municipio }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-6 col-lg-6">
					<label>Fecha de bautismo</label>
					<div class="input-group form-group">
						<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
						<div class="dtp-container">
							<input type='text' class="form-control date-picker"
							placeholder="Click here..."  id="fechaBautismo">
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-6 col-lg-6">
					<label>Celebrante</label>
					<select class="chosen" data-placeholder="Seleccione un celebrante..."  id="celebrante">
						<option>Seleccione</option>
						@foreach ($celebrantes as $celebrante)
							<option value="{{ $celebrante->id }}">{{ $celebrante->nom_celebrante }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group fg-float">
						<div class="fg-line">
							<input type="text" class="form-control fg-input" id="libro">
							<label class="fg-label">Libro</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group fg-float">
						<div class="fg-line">
							<input type="text" class="form-control fg-input" id="folio">
							<label class="fg-label">Folio</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group fg-float">
						<div class="fg-line">
							<input type="text" class="form-control fg-input" id="partida">
							<label class="fg-label">Partida</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-12 col-lg-12">
					<button type="submit" id="btnEnviar" class="btn btn-primary">Guardar</button>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{ asset('views/administracion/bautismo.js') }}"></script>
@endsection