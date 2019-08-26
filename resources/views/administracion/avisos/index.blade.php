@extends('layouts.app')
@section('title','Confirmaciones')
@section('contenido')
<div class="container" id="app">
	<div class="block-header">
		<h2>Avisos parroquiales</h2>
	</div>
	<div class="card">
		<div class="card-body  card-padding">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<p class="f-700 m-t-20 m-b-20">Aviso parroquial</p>
					<div class="form-group">
						<div class="fg-line">
							<textarea class="form-control auto-size" placeholder="Start pressing Enter to see growing..." v-model="aviso.descripcion"></textarea>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-12 col-lg-12">
					<button class="btn btn-success" v-on:click="guardarAviso">@{{ ordenEditAviso ? 'Editar' : 'Guardar' }}</button>
					<button class="btn btn-danger" v-show="ordenEditAviso" v-on:click="formReset">Cancelar</button>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<div class="card-header">
						<h2>
							Previsualizacion
						</h2>
					</div>
				</div>
				<div class="col-sm-12 col-md-12 col-lg-12">
					<div class="card">
						<div class="card-body  card-padding">
							<div class="row" v-for="(avisoFor, index) in avisos">
								<div class="col-sm-10 col-md-10 col-lg-10">
									<p>@{{ avisoFor.descripcion }}</p>
								</div>
								<div class="col-sm-2 col-md-2 col-lg-2">
									<button type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Editar Aviso" v-on:click="editarAviso(avisoFor,index)"><span class="zmdi zmdi-edit"></span></button>
									<button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Editar aviso" v-on:click="eliminarAviso(avisoFor,index)"><span class="zmdi zmdi-lock-outline"></span></button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-12 col-lg-12">
					<div>
						<p>@{{ aviso.descripcion }}</p>
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
	var datosAvisos = @json($avisos);
	var app = new Vue({
		el: '#app',
		data: {
			aviso: {
				id:'',
				descripcion: ''
			},
			avisos: datosAvisos,
			ordenEditAviso: false,
			indexFor:'',
			horarios: datosAvisos,
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
			editarAviso (val, index) {
				console.log(index);
				this.ordenEditAviso = true;
				this.indexFor=index;
				var data = val;
				this.aviso = data;
			},
			eliminarAviso (val, index) {
				this.indexFor = index;
				this.$http.post('/administracion/avisos-parroquiales/eliminar-aviso',val).then((response) => {
					if (response.body.state == 'validador') {
						  jQuery.each(response.body.errors, function(i, value) {
							  toastr.warning(value)
						  })
					  } else {
						if (response.body.state == 'ok') {
							this.avisos.splice(this.indexFor,1);
						 	if (response.body.tipo == 'delete') {
								toastr.success('Aviso eliminado');
							}
							this.formReset();
						}
					  }
				}, (error) => {
					console.log(error);
					toastr.error(error.status + ' ' + error.statusText + ' (' + error.url + ')');
				});
			},
			formReset () {
				this.indexFor='';
				this.ordenEditAviso=false;
				this.aviso= {
					id: '',
					descripcion: ''
				};
			},
			guardarAviso:function(){
				if (this.aviso.descripcion.length==0) {
					toastr.warning('El aviso es requerido');
					return
				}
				if (this.aviso.id !='') {
					this.$http.post('/administracion/avisos-parroquiales/actualizar-aviso',this.aviso).then((response) => {
						if (response.body.state == 'validador') {
						jQuery.each(response.body.errors, function(i, value) {
							toastr.warning(value)
						})
					} else {
						if (response.body.state == 'ok') {
							this.avisos.splice(this.indexFor,1,response.body.data);
							if (response.body.tipo == 'update') {
								toastr.success('Aviso actualizado correctamente');
							}
							if (response.body.tipo == 'save') {
								toastr.success('Aviso guardado correctamente');
							}
							this.formReset();
						}
					}
					}, (error) => {
						console.log(error);
						toastr.error(error.status + ' ' + error.statusText + ' (' + error.url + ')');
					});
				}else{
					this.$http.post('/administracion/avisos-parroquiales/crear-aviso',this.aviso).then((response) => {
						if (response.body.state == 'validador') {
						jQuery.each(response.body.errors, function(i, value) {
							toastr.warning(value)
						})
					} else {
						if (response.body.state == 'ok') {
							this.avisos.push(response.body.data);
							if (response.body.tipo == 'update') {
								toastr.success('Aviso actualizado correctamente');
							}
							if (response.body.tipo == 'save') {
								toastr.success('Aviso guardado correctamente');
							}
							this.formReset();
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