@extends('layouts.app')

@section('title','Confirmaciones')

@section('contenido')
<div class="container">
	<div class="block-header">
		<h2>Confirmaciones</h2>
	</div>
	<div class="card" id="app">
		<div class="card-header">
			<h2>Registros de Confirmaciones
			</h2>
			<div class="row justify-content-between">
				<div class="col-md-4">
					<h3><a href="{{ url('administracion/confirmaciones/crear-confirmacion') }}" class="btn btn-success">Crear una confirmacion</a></h3>
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
									<td>
										<a class="btn bgm-green" v-on:click="partida({{ $confirmacion->id }})" data-toggle="tooltip" data-placement="top" title="Partida"><i class="zmdi zmdi-assignment-account"></i>
										</a>
										<a class="btn bgm-orange" v-on:click="editar({{ $confirmacion->id }})" data-toggle="tooltip" data-placement="top" title="Editar"><i class="zmdi zmdi-edit"></i>
										</a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						{!! $confirmaciones->render() !!}
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
	<div class="modal fade" id="seleccionarEdicion" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Seleccione tipo de edicion</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="text-center">
							<label class="radio radio-inline m-r-20">
                                <input type="radio" name="inlineRadioOptions" v-on:click="message=false;mostrarMensaje=true;" >
                                <i class="input-helper"></i>
                                Edicion por sistema
                            </label>
                            <label class="radio radio-inline m-r-20">
                                <input type="radio" name="inlineRadioOptions" v-on:click="message=true;mostrarMensaje=true;" >
                                <i class="input-helper"></i>
                                Edicion por decreto
                            </label>
						</div>
					</div>
					<div class="row" v-show="mostrarMensaje">
						<form action="" method="post" id="formSelect">
							{{ csrf_field() }}
							<input type="text" name="confirmado" v-model="confirmado" hidden="true">
							<input type="text" name="tipoEdicion" v-model="message"  hidden="true">
						</form>
						<p v-if="message==false">
							La edicion por sistema se podra usar cuando hay un error de digitacion por parte del usuario que creo el documento, esta correccion no generara una "Anotacion" por lo cual la correccion se vera reflejada en la partida pero no tendra una anotacion. Se almacenara que usuario realizo el cambio por sistema
						</p>
						<p v-if="message==true">
							La edicion por decreto se usuara cuando el error encontrado es corregido siguiendo el proceso eclesiastico de la diosecis, esta correccion generara una "Anotacion" por lo cual tanto la correcion como el decreto se veran reflejados en la partida.
						</p>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-link" v-on:click="ordenEdit">Editar</button>
					<button type="button" class="btn btn-link" data-dismiss="modal">Cerrar
					</button>
				</div>
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
			mostrarMensaje:false,
			message:'',
			celebrantes:{},
			firma:'',
			confirmado:'',
			ofrenda:'30000'
		},
		methods: {
			partida: function(id) {
				$("#celebrantes").trigger("chosen:updated");
				this.confirmado=id;
				$('#seleccionarFirma').modal('show');
			},
			borrador: function(id) {
				this.confirmado=id;
				$('#seleccionarValor').modal('show');
			},
			editar:function (id) {
				this.confirmado=id;
				console.log(this.confirmado);
				$('#seleccionarEdicion').modal('show');
			},
			ordenEdit:function(){
				$('#formSelect').attr('action','/administracion/confirmaciones/editar').submit();
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
				if (this.confirmado.length==0) {
					toastr.warning('Seleccione una persona para generar la partida');
					return;
				}
				if (this.firma.length==0) {
					toastr.warning('Seleccione una persona para la firma de la partida');
					return
				}
				window.open("/administracion/confirmaciones/partida/"+this.confirmado+"/"+this.firma);
			},
			generarBorrador:function(){
				if (this.confirmado.length==0) {
					toastr.warning('Seleccione una persona para generar la partida');
					return;
				}
				if (this.ofrenda.length==0) {
					toastr.warning('Seleccione la ofrenda del bautizo');
					return
				}
				window.open("/administracion/confirmaciones/borrador/"+this.confirmado+"/"+this.ofrenda);
			},
			formReset:function(){
				this.firma='';
				this.confirmado='';
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