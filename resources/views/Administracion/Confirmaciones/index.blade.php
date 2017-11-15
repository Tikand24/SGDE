@extends('layouts.app')

@section('title','Confirmaciones')

@section('contenido')
<div class="container">
	<div class="block-header">
		<h2>Confirmaciones</h2>
	</div>
	<div class="card">
		<div class="card-header">
			<h2>Registros de Confirmaciones
			</h2>
			<div class="row justify-content-between">
				<div class="col-md-4">
					<h3><a href="" class="btn btn-success">Crear una confirmacion</a></h3>
				</div>
				<div class="col-md-4 col-md-offset-4">
					<form action="">
						<div class="form-group fg-float">
							<div class="fg-line">
								<input type="text" id="buscarBautisado" class="input-sm form-control fg-input" name="name">
								<label class="fg-label" for="buscarBautisado">Buscar confirmacion</label>
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
									<th>Nombre</th>
									<th>Libro</th>
									<th>Folio</th>
									<th>Partida</th>
									<th>Opciones</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($confirmaciones as $confirmacion)
								<tr>
									<td>{{ $confirmacion->nombre }}</td>
									<td>{{ $confirmacion->libro }}</td>
									<td>{{ $confirmacion->folio }}</td>
									<td>{{ $confirmacion->partida }}</td>
									<td><button class="btn"></button></td>
								</tr>
								@endforeach
							</tbody>
						</table>
						{!! $confirmaciones->render() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection