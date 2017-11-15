@extends('layouts.app')

@section('title','Osarios')

@section('contenido')
<div class="container">
	<div class="block-header">
		<h2>Osarios</h2>
	</div>
	<div class="card">
		<div class="card-header">
			<h2>Registros de Osarios
			</h2>
			<div class="row justify-content-between">
				<div class="col-md-4">
					<h3><a href="" class="btn btn-success">Crear un osario</a></h3>
				</div>
				<div class="col-md-4 col-md-offset-4">
					<form action="">
						<div class="form-group fg-float">
							<div class="fg-line">
								<input type="text" id="buscarCenizario" class="input-sm form-control fg-input" name="name">
								<label class="fg-label" for="buscarCenizario">Buscar osario</label>
							</div>
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit">Buscar</button>
							</span>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Numero Del Osario</th>
									<th>Fallecido</th>
									<th>Comprador Osario</th>
									<th>Opciones</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($osarios as $osario)
								<tr>
									<td>{{ $osario->NUMERO_OSARIO }}</td>
									<td>{{ $osario->FALLECIDO_OSARIO }}</td>
									<td>{{ $osario->COMPRADOR_OSARIO }}</td>
									<td><button class="btn"></button></td>
								</tr>
								@endforeach
							</tbody>
						</table>
						{!! $osarios->render() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection