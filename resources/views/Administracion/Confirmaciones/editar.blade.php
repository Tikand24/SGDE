@extends('layouts.app')
@section('title','Confirmaciones')
@section('contenido')
<div class="container" id="app">
	<div class="block-header">
		<h2>Confirmaciones</h2>
	</div>
	<div class="card">
		<div class="card-header">
			<h2>Editar confirmacion
			</h2>
		</div>
		<div class="card-body  card-padding">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<div class="form-group fg-float">
						<div class="fg-line fg-toggled">
							<input type="text" class="form-control fg-input" id="nombreBautisado" placeholder="" v-model="confirmado.nombre">
							<label class="fg-label">Nombre del confirmado</label>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-6 col-lg-6">
					<div class="form-group fg-float">
						<div class="fg-line fg-toggled">
							<input type="text" class="form-control fg-input" v-model="confirmado.madre">
							<label class="fg-label">Nombre de la Madre</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-6 col-lg-6">
					<div class="form-group fg-float">
						<div class="fg-line fg-toggled">
							<input type="text" class="form-control fg-input" v-model="confirmado.padre">
							<label class="fg-label">Nombre del padre</label>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-6 col-lg-6">
					<div class="form-group fg-float">
						<div class="fg-line fg-toggled">
							<input type="text" class="form-control fg-input" v-model="confirmado.padrino">
							<label class="fg-label">Nombre del padrino</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-6 col-lg-6">
					<div class="form-group fg-float">
						<div class="fg-line fg-toggled">
							<input type="text" class="form-control fg-input" v-model="confirmado.madrina">
							<label class="fg-label">Nombre de la madrina</label>
						</div>
					</div>
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
						<div class="fg-line fg-toggled">
							<input type="text" class="form-control fg-input"  v-model="confirmado.libroBautismo" >
							<label class="fg-label">Libro bautizo</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group fg-float">
						<div class="fg-line fg-toggled">
							<input type="text" class="form-control fg-input"  v-model="confirmado.folioBautismo">
							<label class="fg-label">Folio bautizo</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group fg-float">
						<div class="fg-line fg-toggled">
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
						<div class="fg-line fg-toggled">
							<input type="text" class="form-control fg-input" id="libro" v-model="confirmado.libro" >
							<label class="fg-label">Libro</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group fg-float">
						<div class="fg-line fg-toggled">
							<input type="text" class="form-control fg-input" id="folio" v-model="confirmado.folio" >
							<label class="fg-label">Folio</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group fg-float">
						<div class="fg-line fg-toggled">
							<input type="text" class="form-control fg-input" id="partida" v-model="confirmado.partida" >
							<label class="fg-label">Partida</label>
						</div>
					</div>
				</div>
			</div>

		<div class="card-header">
			<h2>Anotaciones
			</h2>
		</div>
		<div class="card-body card-padding">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12" v-for="(anotacion,index) in confirmado.anotaciones ">
					<div class="card-header">
						<h2><small>Anotacion #@{{index+1}}</small></h2>
						<ul class="actions">
							<li>
								<a v-on:click="eliminarAnotacion(anotacion,index)">
									<i class="zmdi zmdi-tag-close"></i>
								</a>
							</li>
						</ul>
					</div>
					<div class="card-body card-padding">
						@{{ anotacion.anotacion }}
					</div>
				</div>
			</div>
			<div class="row" v-show="confirmado.tipoEdicion=='true'">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<p class="c-black f-500 m-t-20 m-b-20">Nueva anotacion</p>
					<div class="form-group">
						<div class="fg-line">
							<textarea class="form-control"
							placeholder="Decreto ó anotacion" v-model="confirmado.anotacion"></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<button type="submit" id="btnEnviar" class="btn btn-primary" v-on:click="guardar">Editar</button>
				</div>
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
								<div class="fg-line fg-toggled">
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
	<input type="text" id="idConfirmado" value="{{ $confirmado }}" hidden="true">
	<input type="text" id="tipoEdicion" value="{{ $tipoEdicion }}" hidden="true">
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
				gruposConfirmacion:[]
			},
			confirmado:{
				id:'',
				nombre:'',
				libro:'',
				folio:'',
				partida:'',
				madre:'',
				padre:'',
				padrino:'',
				madrina:'',
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
				},
				anotacion:'',
				anotaciones:[],
				tipoEdicion:''
			}
		},
		methods: {
			guardar:function(){
				if (this.confirmado.nombre.length==0) {
					toastr.warning('El nombre del confirmado es requerido');
					return
				}
				if (this.confirmado.padre==null) {
					if (this.confirmado.madre==null) {
						toastr.warning('El nombre del padre o madre es requerido');
						return
					}
				}
				if (this.confirmado.padrino==null) {
					if (this.confirmado.madrina==null) {
						toastr.warning('El nombre del padrino o madrina es requerido');
						return
					}
				}

				if (this.confirmado.tipoEdicion=='true') {
					console.log(this.confirmado.tipoEdicion);
					if (this.confirmado.anotacion.length==0) {
						toastr.warning('La anotacion es requerida');
						return
					}
				}
				this.$http.post('/administracion/confirmaciones/actualizar-confirmacion',this.confirmado).then((response) => {
					if (response.body.estado == 'validador') {
                    jQuery.each(response.body.errors, function(i, value) {
                        toastr.warning(value)
                    })
                } else {
                    if (response.body.estado == 'ok') {
                        if (response.body.tipo == 'update') {
                            toastr.success('Confirmado a ctualizado correctamente');
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
				}, (error) => {
					console.log(error);
					toastr.error(error.status + ' ' + error.statusText + ' (' + error.url + ')');
				});
			},
			datosConfirmado:function(){
				this.$http.post('/administracion/confirmaciones/confirmado-editar',this.confirmado).then((response) => {
					console.log(response.body);
					if (response.body.confirmacion.length==0) {
						toastr.error('No se encontraron datos del confirmado. Por favor vuelva a la lista de confirmados y escoga uno de la lista');
						return
					}
					this.confirmado={
						id:response.body.confirmacion.id,
						nombre:response.body.confirmacion.nombre,
						libro:response.body.confirmacion.libro,
						folio:response.body.confirmacion.folio,
						partida:response.body.confirmacion.partida,
						madre:response.body.confirmacion.madre,
						padre:response.body.confirmacion.padre,
						padrino:response.body.confirmacion.padrino,
						madrina:response.body.confirmacion.madrino,
						parroquiaBautizado:response.body.confirmacion.parroquia_baut_id,
						libroBautismo:response.body.confirmacion.lib_baut,
						folioBautismo:response.body.confirmacion.fol_baut,
						partidaBautismo:response.body.confirmacion.part_baut,
						grupoConfirmado:{
							id:response.body.confirmacion.grupo_confirmacion.id,
							nombre:response.body.confirmacion.grupo_confirmacion.nombre,
							fecha:response.body.confirmacion.grupo_confirmacion.fecha,
							descripcion_partida:response.body.confirmacion.grupo_confirmacion.descripcion_partida,
							celebrante:response.body.confirmacion.grupo_confirmacion.celebrante_parroquia.celebrante.nom_celebrante
						},
						anotacion:'',
						anotaciones:response.body.anotaciones,
						tipoEdicion:this.confirmado.tipoEdicion
					};
					$('#selectParroquiaBautizado option[value="'+this.confirmado.parroquiaBautizado+'"]').prop('selected',true);
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
				console.log(data.celebrante_parroquia);
				this.confirmado.grupoConfirmado={
					id:data.id,
					nombre:data.nombre,
					fecha:data.fecha,
					descripcion_partida:data.descripcion_partida,
					celebrante:data.celebrante_parroquia.celebrante.nom_celebrante
				}
				this.complementos.gruposConfirmacion=[];
				$('#modalBuscarGrupoConfirmacion').modal('hide');
			},
			eliminarAnotacion:function(data,index){
				entorno=this;
	            swal({
	                title: "¿Desea eliminar la anotacion?",
	                text: "La anotacion se eliminara y no se podra recuperar",
	                type: "warning",
	                showCancelButton: true,
	                confirmButtonColor: "#DD6B55",
	                confirmButtonText: "Eliminar",
	                cancelButtonText: "Cancelar",
	                closeOnConfirm: false,
	                closeOnCancel: false
	            }, function(isConfirm) {
	                if (isConfirm) {
	                    entorno.$http.post('/administracion/confirmaciones/eliminar-anotacion', data).then((response) => {
	                        if (response.body.estado=='ok') {
	                        	if (response.body.tipo=='delete') {
									entorno.confirmado.anotaciones.splice(index,1);
	                        		swal("Eliminado", "La anotacion se elimino correctamente", "success");
	                        		return
	                        	}	                    			
	                        }
	                    }, (error) => {
	                    	console.log(error);
	                        toastr.error(error.status + ' ' + error.statusText + ' (' + error.url + ')');
	                    });
	                }
	            });
			}
		},
		mounted:function(){
			var entorno=this;
			this.confirmado.id=$('#idConfirmado').val();
			this.confirmado.tipoEdicion=$('#tipoEdicion').val();
			entorno.getComplementos();
			entorno.datosConfirmado();
			$("#selectParroquiaBautizado").chosen({
				width: "100%"
			}).change(function() {
				entorno.confirmado.parroquiaBautizado = $('#selectParroquiaBautizado').val();
			});
		},
		updated: function(){
			$("#selectParroquiaBautizado").trigger("chosen:updated");
		}
	});
</script>
@endsection