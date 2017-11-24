@extends('layouts.app')

@section('title','Confirmaciones')

@section('contenido')
<div class="container">
	<div class="block-header">
		<h2>Confirmaciones</h2>
	</div>
	<div class="card">
		<div class="card-header">
			<h2>Crear confirmacion
			</h2>
		</div>
		<div class="card-body  card-padding">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<div class="form-group fg-float">
						<div class="fg-line">
							<input type="text" class="form-control fg-input" id="nombreBautisado" >
							<label class="fg-label">Nombre del confirmado</label>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group fg-float">
						<div class="fg-line">
							<input type="text" class="form-control fg-input" id="libro" >
							<label class="fg-label">Libro</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group fg-float">
						<div class="fg-line">
							<input type="text" class="form-control fg-input" id="folio" >
							<label class="fg-label">Folio</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group fg-float">
						<div class="fg-line">
							<input type="text" class="form-control fg-input" id="partida" >
							<label class="fg-label">Partida</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-12 col-lg-12">
					<button type="submit" id="btnEnviar" class="btn btn-primary" v-on:click="guardar">Guardar</button>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection