@extends('layouts.app')

@section('title','Bautismos')

@section('contenido')
<div class="container" id="app">
	<div class="block-header">
		<h2>Bautismos</h2>
	</div>
	<div class="card">
		<div class="card-header">
			<h2>Registros de bautismos
			</h2>
			<div class="row justify-content-between">
				<div class="col-md-4">
					<h3><a href="/administracion/bautismos/crear-bautismo" class="btn btn-success">Crear una bautismo</a></h3>
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
									<td>
										<a class="btn bgm-green" v-on:click="partida({{ $bautizo->id }})" data-toggle="tooltip" data-placement="top" title="Partida"><i class="zmdi zmdi-assignment-account"></i>
										</a>

										<a class="btn bgm-lightblue" v-on:click="borrador({{ $bautizo->id }})" data-toggle="tooltip" data-placement="top" title="Borrador"><i class="zmdi zmdi-assignment-alert"></i>
										</a>
									</td>
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
	<div class="modal fade" id="seleccionarFirma" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Seleccion de la persona que firma</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12 col-md-6 col-lg-6">
							<label>Quien firma</label>
							<select class="chosen" data-placeholder="Seleccione un celebrante..."  id="celebrantes" >
								<option disabled selected value="">Seleccione</option>
								<option v-for="(celeb,index) in celebrantes" v-bind:value="celeb.id">@{{ celeb.celebrante.nom_celebrante }} - @{{ celeb.cargo }}</option>
							</select>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-link" v-on:click="generarPartida">Generar</button>
					<button type="button" class="btn btn-link" data-dismiss="modal">Cerrar
					</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="seleccionarValor" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Seleccione ofrenda del bautismo</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12 col-md-6 col-lg-6">
							<input type="text" class="form-control fg-input" v-model="ofrenda">
							<label class="fg-label">Ofrenda</label>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-link" v-on:click="generarBorrador">Generar</button>
					<button type="button" class="btn btn-link" data-dismiss="modal">Cerrar
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
	var app = new Vue({
		el: '#app',
		data: {
			message: 'Hello Vue!',
			celebrantes:{},
			firma:'',
			bautizado:'',
			ofrenda:'30000'
		},
		methods: {
			partida: function(id) {
				$("#celebrantes").trigger("chosen:updated");
				this.bautizado=id;
				$('#seleccionarFirma').modal('show');
			},
			borrador: function(id) {
				this.bautizado=id;
				$('#seleccionarValor').modal('show');
			},
			complementos:function(){
				this.$http.get('/administracion/bautismos/celebrantes-parroquia').then((response) => {
					this.celebrantes=response.body;
					$("#celebrantes").trigger("chosen:updated");
				}, (error) => {
					toastr.error(error.status + ' ' + error.statusText + ' (' + error.url + ')');
				});
			},
			generarPartida:function(){
				if (this.bautizado.length==0) {
					toastr.warning('Seleccione una persona para generar la partida');
					return;
				}
				if (this.firma.length==0) {
					toastr.warning('Seleccione una persona para la firma de la partida');
					return
				}
				window.open("/administracion/bautismos/partida/"+this.bautizado+"/"+this.firma);
			},
			generarBorrador:function(){
				if (this.bautizado.length==0) {
					toastr.warning('Seleccione una persona para generar la partida');
					return;
				}
				if (this.ofrenda.length==0) {
					toastr.warning('Seleccione la ofrenda del bautizo');
					return
				}
				window.open("/administracion/bautismos/borrador/"+this.bautizado+"/"+this.ofrenda);
			},
			formReset:function(){
				this.firma='';
				this.bautizado='';
				this.ofrenda='30000';
				$('#celebrantes').val('').prop('selected',true);
			}
		},
		mounted() {
			entorno = this;
			entorno.complementos();
			$("#celebrantes").chosen({
				width: "100%"
			}).change(function() {
				entorno.firma = $('#celebrantes').val();
			});
			$('#seleccionarFirma').on('hide.bs.modal', function (e){
				entorno.formReset();
			});
		}
	});
</script>
@endsection