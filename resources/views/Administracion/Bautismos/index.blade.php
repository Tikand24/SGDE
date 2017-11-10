@extends('layouts.app')

@section('title','Bautismos')

@section('contenido')
<div class="container">
	<div class="block-header">
		<h2>Bautismos</h2>
	</div>
	<div class="card">
		<div class="card-header">
			<h2>Registros de bautismos
			</h2>
			<div class="row justify-content-between">
				<div class="col-md-4">
					<h3><a href="" class="btn btn-success">Crear una bautismo</a></h3>
				</div>
				<div class="col-md-4 col-md-offset-4">
					<form action="">
						<div class="form-group fg-float">
							<div class="fg-line">
								<input type="text" id="buscarBautisado" class="input-sm form-control fg-input" name="name">
								<label class="fg-label" for="buscarBautisado">Buscar bautisado</label>
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
									<th>#</th>
									<th>Nombre</th>
									<th>Libro</th>
									<th>Folio</th>
									<th>Partida</th>
									<th>Opciones</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($bautizados as $bautizo)
								<tr>
									<td>{{ $bautizo->id }}</td>
									<td>{{ $bautizo->nombre }}</td>
									<td>{{ $bautizo->libro }}</td>
									<td>{{ $bautizo->folio }}</td>
									<td>{{ $bautizo->partida }}</td>
									<td><button class="btn"></button></td>
								</tr>
								@endforeach
							</tbody>
						</table>
						{!! $bautizados->render() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection