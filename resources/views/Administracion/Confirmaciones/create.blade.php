@extends('layouts.app')
@section('title','Confirmaciones')
@section('contenido')
<div class="container" id="app">
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
							<input type="text" class="form-control fg-input" id="nombreBautisado" v-model="confirmado.nombre">
							<label class="fg-label">Nombre del confirmado</label>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-6 col-lg-6">
					<div class="form-group fg-float">
						<div class="fg-line">
							<input type="text" class="form-control fg-input" v-model="confirmado.madre">
							<label class="fg-label">Nombre de la Madre</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-6 col-lg-6">
					<div class="form-group fg-float">
						<div class="fg-line">
							<input type="text" class="form-control fg-input" v-model="confirmado.padre">
							<label class="fg-label">Nombre del padre</label>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-6 col-lg-6">
					<div class="form-group fg-float">
						<div class="fg-line">
							<input type="text" class="form-control fg-input" v-model="confirmado.padrino">
							<label class="fg-label">Nombre del padrino</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-6 col-lg-6">
					<div class="form-group fg-float">
						<div class="fg-line">
							<input type="text" class="form-control fg-input" v-model="confirmado.madrina">
							<label class="fg-label">Nombre de la madrina</label>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<label>Genero</label>
					<select class="chosen" data-placeholder="Seleccione un genero..."  id="generoSelect" v-model="confirmado.genero">
						<option v-for="genero in complementos.generos" v-bind:value="genero">@{{ genero }}</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12 m-b-25">
					<label>Parroquia bautizado</label>
					<select class="chosen" data-placeholder="Seleccione una parroquia" id="selectParroquiaBautizado">
						<option disabled selected value="">Seleccione una parroquia</option>
						<option v-for="parroquia in complementos.parroquias" v-bind:value="parroquia.id">@{{ parroquia.nombre }} - @{{ parroquia.dio_arq_diocesis }}</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group fg-float">
						<div class="fg-line">
							<input type="text" class="form-control fg-input"  v-model="confirmado.libroBautismo" >
							<label class="fg-label">Libro bautizo</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group fg-float">
						<div class="fg-line">
							<input type="text" class="form-control fg-input"  v-model="confirmado.folioBautismo">
							<label class="fg-label">Folio bautizo</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group fg-float">
						<div class="fg-line">
							<input type="text" class="form-control fg-input" v-model="confirmado.partidaBautismo" >
							<label class="fg-label">Partida bautizo</label>
						</div>
					</div>
				</div>
			</div>
			<div class="row m-b-25">
					<div class="col-sm-12 col-md-12 col-lg-12">
						<label>Grupo de confirmacion</label>
						<button class="btn btn-info btn-block" v-on:click="buscarGrupoConfirmacion">Busqueda de grupo</button>
					</div>
					<div class="col-sm-6 col-md-2 col-lg-2">
						<h5>@{{ confirmado.grupoConfirmado.nombre }}</h5>
					</div>
					<div class="col-sm-6 col-md-2 col-lg-2">
						<h5>@{{ confirmado.grupoConfirmado.fecha }}</h5>
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4">
						<h5>@{{ confirmado.grupoConfirmado.descripcion_partida }}</h5>
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4">
						<h5>@{{ confirmado.grupoConfirmado.celebrante }}</h5>
					</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group fg-float">
						<div class="fg-line">
							<input type="text" class="form-control fg-input" id="libro" v-model="confirmado.libro" >
							<label class="fg-label">Libro</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group fg-float">
						<div class="fg-line">
							<input type="text" class="form-control fg-input" id="folio" v-model="confirmado.folio" >
							<label class="fg-label">Folio</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group fg-float">
						<div class="fg-line">
							<input type="text" class="form-control fg-input" id="partida" v-model="confirmado.partida" >
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

	<div class="modal fade" id="modalBuscarGrupoConfirmacion" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Buscar grupo de confirmacion</h4>
				</div>
				<div class="modal-body">
					<div class="row">	
						<div class="col-sm-10 col-md-10 col-lg-10">
							<div class="form-group">
								<div class="fg-line">
									<input type="text" class="form-control fg-input" v-model="busqueda.descripcion" placeholder="Busque por año o nombre del grupo. Ej: 2015; ó Confirmacion 2015-1">
								</div>
							</div>
						</div>
						<div class="col-sm-2 col-md-22 col-lg-22">
							<button class="btn btn-default btn-icon-text" v-on:click="buscadorGruposConfirmacion"><i class="zmdi zmdi-search"></i> Buscar
							</button>
						</div>
					</div>
					<div class="row">
						<div class="table-responsive">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Nombre</th>
										<th>Fecha</th>
										<th>Descripcion</th>
										<th>Descripcion partida</th>
										<th>Celebrante</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="grupo in complementos.gruposConfirmacion" v-on:dblclick="seleccionarGrupo(grupo)">
										<td>@{{ grupo.nombre }}</td>
										<td>@{{ grupo.fecha }}</td>
										<td>@{{ grupo.descripcion }}</td>
										<td>@{{ grupo.descripcion_partida }}</td>
										<td>@{{ grupo.celebrante_parroquia.celebrante.nom_celebrante }}</td>
										<td><a class="btn btn-success btn-icon" v-on:click="seleccionarGrupo(grupo)"><i class="zmdi zmdi-check-circle"></i></a></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="modal-footer">
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
			busqueda:{
				descripcion:''
			},
			complementos:{
				parroquias:[],
				gruposConfirmacion:[],
				generos:[]
			},
			confirmado:{
				nombre:'',
				libro:'',
				folio:'',
				partida:'',
				madre:'',
				padre:'',
				padrino:'',
				madrina:'',
				genero:'',
				parroquiaBautizado:'',
				libroBautismo:'',
				folioBautismo:'',
				partidaBautismo:'',
				grupoConfirmado:{
					id:'',
					nombre:'',
					fecha:'',
					descripcion_partida:'',
					celebrante:''
				}
			}
		},
		methods: {
			guardar:function(){
				if (this.confirmado.nombre.length==0) {
					toastr.warning('El nombre del confirmado es requerido');
					return
				}
				if (this.confirmado.padre.length==0) {
					if (this.confirmado.madre.length==0) {
						toastr.warning('El nombre del padre o madre es requerido');
						return
					}
				}
				if (this.confirmado.padrino.length==0) {
					if (this.confirmado.madrina.length==0) {
						toastr.warning('El nombre del padrino o madrina es requerido');
						return
					}
				}
				if (this.confirmado.genero.length==0) {
						toastr.warning('El genero del confirmado es requerido');
						return
				}
				this.$http.post('/administracion/confirmaciones/guardar-confirmacion',this.confirmado).then((response) => {
					if (response.body.estado == 'validador') {
                    jQuery.each(response.body.errors, function(i, value) {
                        toastr.warning(value)
                    })
                } else {
                    if (response.body.estado == 'ok') {
                        if (response.body.tipo == 'update') {
                            toastr.success('Confirmado a ctualizado correctamente');
                        }
                        if (response.body.tipo == 'save') {
                            toastr.success('Confirmado creado correctamente');
                        }
                    }
                }
				}, (error) => {
					console.log(error);
					toastr.error(error.status + ' ' + error.statusText + ' (' + error.url + ')');
				});
			},
			getComplementos:function(){
				this.$http.get('/administracion/confirmaciones/complementos').then((response) => {
					this.complementos.parroquias=response.body.parroquias;
					this.complementos.generos=response.body.generos;
				}, (error) => {
					console.log(error);
					toastr.error(error.status + ' ' + error.statusText + ' (' + error.url + ')');
				});
			},
			buscarGrupoConfirmacion:function () {
				$('#modalBuscarGrupoConfirmacion').modal('show');
			},
			buscadorGruposConfirmacion:function(){
				this.$http.post('/administracion/confirmaciones/buscar-grupo-confirmacion',this.busqueda).then((response) => {
					this.complementos.gruposConfirmacion=response.body.grupos;
				}, (error) => {
					console.log(error);
					toastr.error(error.status + ' ' + error.statusText + ' (' + error.url + ')');
				});
			},
			seleccionarGrupo:function (data) {
				this.confirmado.grupoConfirmado={
					id:data.id,
					nombre:data.nombre,
					fecha:data.fecha,
					descripcion_partida:data.descripcion_partida,
					celebrante:data.celebrante_parroquia.celebrante.nom_celebrante
				}
				this.complementos.gruposConfirmacion=[];
				$('#modalBuscarGrupoConfirmacion').modal('hide');
			}
		},
		mounted:function(){
			var entorno=this;
			entorno.getComplementos();
			$("#selectParroquiaBautizado").chosen({
				width: "100%"
			}).change(function() {
				entorno.confirmado.parroquiaBautizado = $('#selectParroquiaBautizado').val();
			});
			$("#generoSelect").chosen({
				width: "100%"
			}).change(function() {
				entorno.confirmado.genero = $('#generoSelect').val();
			});
		},
		updated: function(){
			$("#selectParroquiaBautizado").trigger("chosen:updated");
			$("#generoSelect").trigger("chosen:updated");
		}
	});
</script>
@endsection