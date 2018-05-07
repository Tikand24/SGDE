@extends('layouts.app')

@section('title','Osarios')

@section('contenido')
<div class="container">
	<div class="block-header">
		<h2>Osarios</h2>
	</div>
	<div class="card" id="app">
		<div class="card-header">
			<h2>Registros de Osarios
			</h2>
			<div class="row justify-content-between">
				<div class="col-md-4">
					<h3><a  href="{{ url('administracion/osarios/crear-osario') }}" class="btn btn-success">Crear un osario</a></h3>
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
									<td>
										<a class="btn bgm-green" v-on:click="partida({{ $osario->id }})" data-toggle="tooltip" data-placement="top" title="Titulo de arrendamiento"><i class="zmdi zmdi-assignment-account"></i>
										</a>
										<a class="btn bgm-orange" v-on:click="editar({{ $osario->id }})" data-toggle="tooltip" data-placement="top" title="Editar"><i class="zmdi zmdi-edit"></i>
										</a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						{!! $osarios->render() !!}
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
		<form action="" method="post" id="formSelect">
			{{ csrf_field() }}
			<input type="text" name="osario" id="osario" hidden="true">
		</form>
	</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
	var app = new Vue({
		el: '#app',
		data: {
			mostrarMensaje:false,
			message:'',
			celebrantes:{},
			firma:'',
			osario:'',
			ofrenda:'30000'
		},
		methods: {
			partida: function(id) {
				$("#celebrantes").trigger("chosen:updated");
				this.osario=id;
				$('#seleccionarFirma').modal('show');
			},
			borrador: function(id) {
				this.osario=id;
				$('#seleccionarValor').modal('show');
			},
			editar:function (id) {
				this.osario=id;
				console.log(this.osario);
				$('#osario').val(id);
				$('#formSelect').attr('action','/administracion/osarios/editar').submit();
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
				if (this.osario.length==0) {
					toastr.warning('Seleccione un osario para generar el titulo');
					return;
				}
				if (this.firma.length==0) {
					toastr.warning('Seleccione una persona para la firma el titulo');
					return
				}
				window.open("/administracion/osarios/titulo/"+this.osario+"/"+this.firma);
			},
			formReset:function(){
				this.firma='';
				this.osario='';
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