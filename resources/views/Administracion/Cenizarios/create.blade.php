@extends('layouts.app')

@section('title','Bautismos')

@section('contenido')
<div class="container" id="app">
	<div class="block-header">
		<h2>Crear cenizario</h2>
	</div>
	<div class="card">
		<div class="card-header">
			<h2>Crear cenizario
				<small>Se registrara una nueva persona fallecida que ocupara un cenizario</small>
			</h2>
		</div>
		<div class="card-body card-padding">
			<div class="row">
				<div class="col-sm-12 col-md-2 col-lg-2">
					<div class="form-group fg-float">
						<div class="fg-line">
							<input type="number" class="form-control fg-input" id="nombreBautisado" v-model="cenizario.numero">
							<label class="fg-label">Numero del cenizario</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-10 col-lg-10">
					<div class="form-group fg-float">
						<div class="fg-line">
							<input type="text" class="form-control fg-input" id="nombrePadre" v-model="cenizario.fallecido">
							<label class="fg-label">Nombre del Fallecido</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-12 col-lg-12">
					<div class="form-group fg-float">
						<div class="fg-line">
							<input type="text" class="form-control fg-input" id="nombreMadre" v-model="cenizario.comprador">
							<label class="fg-label">Nombre del comprador</label>
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
@section('scripts')
<script type="text/javascript" src="{{ asset('views/administracion/cenizario.js') }}"></script>
@endsection