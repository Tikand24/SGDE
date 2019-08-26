@extends('layouts.app')
@section('title','Confirmaciones')
@section('contenido')
<div class="container" id="app">
	<div class="block-header">
		<h2>Horarios</h2>
	</div>
	<div class="card">
		<div class="card-header">
			<h2>
				Horario
			</h2>
		</div>
		<div class="card-body  card-padding">
			<div role="tabpanel">
				<ul class="tab-nav" role="tablist">
					<li v-bind:class="ordenEditSemanal ? '' : 'active'">
						<a href="#tamSemanalEstatico" aria-controls="tamSemanalEstatico" role="tab" data-toggle="tab">Horario semanal constante</a>
					</li>
					<li v-bind:class="ordenEditSemanal ? '' : ''">
						<a href="#listadoHorario" aria-controls="listadoHorario" role="tab" data-toggle="tab">Listado de horario</a> 
					</li>
					<li v-bind:class="ordenEditSemanal ? '' : ''">
						<a href="#crearHorario" aria-controls="crearHorario" role="tab" data-toggle="tab">Crear horario</a>
					</li>
					<li v-bind:class="ordenEditSemanal ? 'active' : ''">
						<a href="#editarHorarioSemanal" aria-controls="editarHorarioSemanal" role="tab" data-toggle="tab" v-show="ordenEditSemanal">Editar horario semanal</a>
					</li>
				</ul>
			</div>
			<div class="tab-content">
				<div role="tabpanel" v-bind:class="ordenEditSemanal ? 'tab-pane' : 'tab-pane active'" id="tamSemanalEstatico">
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12 text-right p-r-25">
							<button class="btn btn-success btn-icon-text" data-toggle="tooltip" data-placement="top" title="Nuevo horario semanal" v-on:click="nuevoHorarioSemanal"><i class="zmdi zmdi-plus-square"></i> Nuevo
							</button>
						</div>
						<div class="col-sm-12 col-md-12 col-lg-12">
							<table class="table">
								<thead>
									<tr>
										<th>Dia</th>
										<th>Hora</th>
										<th>Lugar</th>
										<th>Estado</th>
										<th>Opciones</th>
									</tr>
								</thead>
								<tbody>
									<tr  v-for="horario in horarios">
										<td>@{{ horario.dias_eucaristia.dia_semana }}</td>
										<td>@{{ parseHorario(horario.hora_eucaristia) }}</td>
										<td>@{{ horario.lugar_eucaristia.descripcion }}</td>
										<td>@{{ horario.estado }}</td>
										<td>@{{ horario.fecha_eucaristia }}</td>
										<td>
											<button type="button" class="btn btn-danger btn-icon waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="top" title="Inactivar" v-if="horario.estado == 'Activo'" v-on:click="inactivarHorarioSemanal(horario)"><span class="zmdi zmdi-lock-outline"></span></button>
											<button type="button" class="btn btn-success btn-icon waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="top" title="Activar" v-if="horario.estado == 'Inactivo'" v-on:click="activarHorarioSemanal(horario)"><span class="zmdi zmdi-lock-open"></span></button>
											<button type="button" class="btn btn-icon waves-effect waves-circle waves-float" v-on:click="editarHorarioSemanal(horario)"><span class="zmdi zmdi-edit"></span></button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div role="tabpanel" v-bind:class="ordenEditSemanal ? 'tab-pane' : 'tab-pane'" id="listadoHorario"><div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12">
							<table id="data-table-command" class="table table-striped table-vmiddle">
								<thead>
									<tr>
										<th data-column-id="dia">Fecha de eucaristia</th>
										<th data-column-id="hora">Hora</th>
										<th data-column-id="lugar">Lugar</th>
										<th data-column-id="estado">Estado</th>
										<th data-column-id="commands" data-formatter="commands" data-sortable="false">Opciones</th>
									</tr>
								</thead>
								<tbody>
									<tr  v-for="horario in horarios" v-if="horario.semanal != 1">
										<td>@{{ parseFechaEucaristia(horario.fecha_eucaristia) }}</td>
										<td>@{{ parseHorario(horario.hora_eucaristia) }}</td>
										<td>@{{ horario.lugar_eucaristia.descripcion }}</td>
										<td>@{{ horario.estado }}</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div role="tabpanel" v-bind:class="ordenEditSemanal ? 'tab-pane' : 'tab-pane'" id="crearHorario">
					<p>Morbi mattis ullamcorper velit. Etiam rhoncus. Phasellus leo dolor, tempus
						non, auctor et, hendrerit quis, nisi. Cras id dui. Curabitur turpis.
						Etiam ut purus mattis mauris sodales aliquam. Aenean viverra rhoncus pede.
						Nulla sit amet est. Donec mi odio, faucibus at, scelerisque quis, convallis
						in, nisi. Praesent ac sem eget est egestas volutpat.
						Cras varius. Morbi mollis tellus ac sapien. In enim justo, rhoncus ut,
						imperdiet a, venenatis vitae, justo. Nam ipsum risus, rutrum vitae,
						vestibulum eu, molestie vel, lacus. Fusce vel dui.</p>
				</div>
				<div role="tabpanel" v-bind:class="ordenEditSemanal ? 'tab-pane active' : 'tab-pane'" id="editarHorarioSemanal" v-show="ordenEditSemanal" >
					<div class="row">
						<div class="col-sm-12 col-md-4 col-lg-4">
							<label>Dia</label>
							<select class="chosen" data-placeholder="Seleccione un dia"  id="selectDiaEucaristia" v-model="horario.dia_eucaristia">
								@foreach ($diasEucaristia as $dia)
									<option value="{{ $dia->id }}">{{ $dia->dia_semana }}</option>	
								@endforeach
							</select>
						</div>
						<div class="col-sm-12 col-md-4 col-lg-4">
							<label>Hora</label>
							<div class="input-group form-group">
								<span class="input-group-addon"><i class="zmdi zmdi-time"></i></span>
								<div class="dtp-container">
									<input type='text' class="form-control time-picker"
										   placeholder="Click here..." id="horaEucaristia" v-model="horario.hora_eucaristia">
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-md-4 col-lg-4">
							<label>Lugar eucaristia</label>
							<select class="chosen" data-placeholder="Seleccione un dia"  id="selectLugarEucaristia" v-model="horario.lugar_eucaristia">
								@foreach ($lugarEucaristia as $lugar)
									<option value="{{ $lugar->id }}">{{ $lugar->descripcion }}</option>	
								@endforeach
							</select>
						</div>
						<div class="col-sm-12 col-md-12 col-lg-12 text-right">
							<button class="btn btn-success" v-on:click="guardarHorarioSemanal">Guardar</button>
							<button class="btn btn-danger" v-on:click="cerrarEdicion">Cancelar</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
	moment.locale('es', {
	  months: 'Enero_Febrero_Marzo_Abril_Mayo_Junio_Julio_Agosto_Septiembre_Octubre_Noviembre_Diciembre'.split('_'),
	  monthsShort: 'Enero._Feb._Mar_Abr._May_Jun_Jul._Ago_Sept._Oct._Nov._Dec.'.split('_'),
	  weekdays: 'Domingo_Lunes_Martes_Miercoles_Jueves_Viernes_Sabado'.split('_'),
	  weekdaysShort: 'Dom._Lun._Mar._Mier._Jue._Vier._Sab.'.split('_'),
	  weekdaysMin: 'Do_Lu_Ma_Mi_Ju_Vi_Sa'.split('_')
	});
	var datosHorarios = @json($horarios);
	var app = new Vue({
		el: '#app',
		data: {
			ordenEditSemanal: false,
			horarios: datosHorarios,
			horario: {
				id:'',
				dia_eucaristia:'',
				hora_eucaristia:'',
				lugar_eucaristia:'',
				semanal:'',
				fecha_eucaristia:'',
				estado:''
			}
		},
		methods: {
			parseHorario (val) {
				return moment(val, 'HH:mm:ss').format('LT');
			},
			parseFechaEucaristia (val) {
				return moment(val, 'YYYY-MM-DD').format('LL');
			},
			inactivarHorarioSemanal (val) {
				this.$http.post('/administracion/horarios/inactivar-horario-semanal',val).then((response) => {
					if (response.body.state == 'validador') {
						  jQuery.each(response.body.errors, function(i, value) {
							  toastr.warning(value)
						  })
					  } else {
						  if (response.body.state == 'ok') {
							this.horarios=response.body.data;
							this.cerrarEdicion();
							  if (response.body.tipo == 'Inactivo') {
								  toastr.success('Horario Semanal Inactivo correctamente');
							  }
						  }
					  }
				}, (error) => {
					console.log(error);
					toastr.error(error.status + ' ' + error.statusText + ' (' + error.url + ')');
				});
			},
			activarHorarioSemanal (val) {
				this.$http.post('/administracion/horarios/activar-horario-semanal',val).then((response) => {
					if (response.body.state == 'validador') {
						  jQuery.each(response.body.errors, function(i, value) {
							  toastr.warning(value)
						  })
					  } else {
						  if (response.body.state == 'ok') {
							this.horarios=response.body.data;
							this.cerrarEdicion();
							  if (response.body.tipo == 'Activo') {
								  toastr.success('Horario Semanal Activo correctamente');
							  }
						  }
					  }
				}, (error) => {
					console.log(error);
					toastr.error(error.status + ' ' + error.statusText + ' (' + error.url + ')');
				});
			},
			editarHorarioSemanal (val) {
				this.ordenEditSemanal=false;
				this.horario= {
					id:val.id,
					dia_eucaristia:val.dias_eucaristia.id,
					hora_eucaristia:this.parseHorario(val.hora_eucaristia),
					lugar_eucaristia:val.lugar_eucaristia.id,
					semanal:val.semanal,
					fecha_eucaristia:val.fecha_eucaristia,
					estado:val.estado
				};
				$("#selectDiaEucaristia").trigger("chosen:updated");
				$("#selectLugarEucaristia").trigger("chosen:updated");
				setTimeout(() => this.ordenEditSemanal = true, 300);
			},
			nuevoHorarioSemanal () {
				this.ordenEditSemanal=false;
				this.horario= {
					id:'',
					dia_eucaristia:'',
					hora_eucaristia:'',
					lugar_eucaristia:'',
					semanal:'',
					fecha_eucaristia:'',
					estado:''
				};
				$("#selectDiaEucaristia").trigger("chosen:updated");
				$("#selectLugarEucaristia").trigger("chosen:updated");
				setTimeout(() => this.ordenEditSemanal = true, 300);
			},
			cerrarEdicion () {
				this.formReset();
				this.ordenEditSemanal = false;
			},
			formReset () {
				this.horario= {
					id:'',
					dia_eucaristia:'',
					hora_eucaristia:'',
					lugar_eucaristia:'',
					semanal:'',
					fecha_eucaristia:'',
					estado:''
				};
			},
			guardarHorarioSemanal:function(){
				if (this.horario.dia_eucaristia.length==0) {
					toastr.warning('El dia de la eucaristia es requerido');
					return
				}
				if (this.horario.lugar_eucaristia.length==0) {
					toastr.warning('El lugar de la eucaristia es requerido');
					return
				}
				if (this.horario.hora_eucaristia.length==0) {
					toastr.warning('La hora de la eucaristia es requerido');
					return
				}
				this.horario.hora_eucaristia = moment(this.horario.hora_eucaristia, 'LT').format('HH:mm:ss');
				if (this.horario.id !='') {
					this.$http.post('/administracion/horarios/update-horario-semanal',this.horario).then((response) => {
						if (response.body.state == 'validador') {
						jQuery.each(response.body.errors, function(i, value) {
							toastr.warning(value)
						})
					} else {
						if (response.body.state == 'ok') {
							this.horarios=response.body.data;
							this.cerrarEdicion();
							if (response.body.tipo == 'update') {
								toastr.success('Horario actualizado correctamente');
							}
							if (response.body.tipo == 'save') {
								toastr.success('Horario guardado correctamente');
							}
						}
					}
					}, (error) => {
						console.log(error);
						toastr.error(error.status + ' ' + error.statusText + ' (' + error.url + ')');
					});
				}else{
					this.$http.post('/administracion/horarios/save-horario-semanal',this.horario).then((response) => {
						if (response.body.state == 'validador') {
						jQuery.each(response.body.errors, function(i, value) {
							toastr.warning(value)
						})
					} else {
						if (response.body.state == 'ok') {
						this.horarios=response.body.data;
						this.cerrarEdicion();
							if (response.body.tipo == 'update') {
								toastr.success('Horario actualizado correctamente');
							}
							if (response.body.tipo == 'save') {
								toastr.success('Horario guardado correctamente');
							}
						}
					}
					}, (error) => {
						console.log(error);
						toastr.error(error.status + ' ' + error.statusText + ' (' + error.url + ')');
					});
				}
			}
		},
		mounted:function(){
			var entorno=this;
			$("#selectDiaEucaristia").chosen({
				width: "100%"
			}).change(function() {
				entorno.horario.dia_eucaristia = $('#selectDiaEucaristia').val();
			});
			$("#selectLugarEucaristia").chosen({
				width: "100%"
			}).change(function() {
				entorno.horario.lugar_eucaristia = $('#selectLugarEucaristia').val();
			});
			$('#horaEucaristia').datetimepicker({
				format: 'LT'
			}).on('dp.change', function(e) {
				entorno.horario.hora_eucaristia = $('#horaEucaristia').val();
			});
			$("#data-table-command").bootgrid({
				css: {
					icon: 'zmdi icon',
					iconColumns: 'zmdi-view-module',
					iconDown: 'zmdi-sort-amount-desc',
					iconRefresh: 'zmdi-refresh',
					iconUp: 'zmdi-sort-amount-asc'
				},
				formatters: {
					"commands": function(column, row) {
						return "<button type=\"button\" class=\"btn btn-icon command-edit waves-effect waves-circle\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-edit\"></span></button> " +
								  "<button type=\"button\" class=\"btn btn-icon command-delete waves-effect waves-circle\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-delete\"></span></button>";
					}
				}
			});
		},
		updated: function(){
			$("#selectDiaEucaristia").trigger("chosen:updated");
			$("#selectLugarEucaristia").trigger("chosen:updated");
		}
	});
</script>
@endsection