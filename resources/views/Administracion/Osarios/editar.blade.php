@extends('layouts.app')

@section('title','Bautismos')

@section('contenido')
<div class="container" id="app">
	<div class="block-header">
		<h2>Editar osario</h2>
	</div>
	<div class="card">
		<div class="card-header">
			<h2>Datos del osario</h2>
		</div>
		<div class="card-body card-padding">
			<div class="row">
				<div class="col-sm-12 col-md-2 col-lg-2">
					<div class="form-group fg-float">
						<div class="fg-line fg-toggled">
							<input type="number" class="form-control fg-input" v-model="osario.numero" v-on:blur="validarNumeroOsario">
							<label class="fg-label">Numero del osario</label>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<div class="form-group fg-float">
						<div class="fg-line fg-toggled">
							<input type="text" class="form-control fg-input" v-model="osario.fallecido">
							<label class="fg-label">Nombres del fallecido</label>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-4 m-b-25">
					<label>Fecha de nacimiento</label>
					<div class="input-group form-group">
						<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
						<div class="dtp-container">
							<input type='text' class="form-control date-picker"
							placeholder="Click here..."  id="fechaNacimiento" v-model="osario.fecha_nacimiento">
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-12 col-lg-4 m-b-25">
					<label>Fecha de fallecimiento</label>
					<div class="input-group form-group">
						<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
						<div class="dtp-container">
							<input type='text' class="form-control date-picker"
							placeholder="Click here..."  id="fechaFallecimiento" v-model="osario.fecha_fallecimiento">
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-12 col-lg-4 m-b-25">
					<label>Fecha de traslado</label>
					<div class="input-group form-group">
						<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
						<div class="dtp-container">
							<input type='text' class="form-control date-picker"
							placeholder="Click here..."  id="fechaTraslado" v-model="osario.fecha_traslado">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card">
		<div class="card-header">
			<h2>Datos del comprador</h2>
		</div>
		<div class="card-body card-padding">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-4 m-t-20">
					<div class="form-group fg-float">
						<div class="fg-line fg-toggled">
							<input type="number" class="form-control fg-input" v-model="osario.cedula_comprador">
							<label class="fg-label">Numero de identificacion</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-6 col-lg-8 m-b-25">
					<label>Municipio de expedicion</label>
					<select class="chosen" data-placeholder="Seleccione una parroquia" id="selectMunicipio">
						<option disabled selected value="">Seleccione un municipio</option>
						<option v-for="municipio in comple.ciudades" v-bind:value="municipio.id">@{{ municipio.nom_municipio }} - @{{ municipio.departamento.nom_departamento }}</option>	
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<div class="form-group fg-float">
						<div class="fg-line fg-toggled">
							<input type="text" class="form-control fg-input" v-model="osario.comprador">
							<label class="fg-label">Nombres del comprador</label>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<button type="submit" id="btnEnviar" class="btn btn-primary" v-on:click="guardar">Guardar</button>
				</div>
			</div>
		</div>
	</div>
	<input type="text" id="osarioId" value="{{ $osario }}" hidden="true" disabled="true" readonly="true">
</div>
@endsection
@section('scripts')
<script type="text/javascript">
	var app = new Vue({
	    el: '#app',
	    data: {
	        osario: {
	            id: '',
	            cedula_comprador:'',
	            ciudad_expedicion:'',
	            fecha_nacimiento:'',
	            fecha_fallecimiento:'',
	            fecha_traslado:'',
	            fallecido: '',
	            comprador: '',
	            numero: '',
	            numeroOriginal:''
	        },
	        comple:{
	        	ciudades:[]
	        }
	    },
	    methods: {
	        complementos:function(){
	            this.$http.get('/administracion/osarios/complementos').then((response) => {
	                this.comple.ciudades=response.body.ciudades;
	                this.datosOsario();
	            }, (error) => {
	                toastr.error(error.status + ' ' + error.statusText + ' (' + error.url + ')');
	            });
	        },
	        datosOsario:function(){
	            this.$http.post('/administracion/osarios/osario-editar',this.osario).then((response) => {
	                console.log(response.body);
	            this.osario.id=response.body.osario.id;
	            this.osario.cedula_comprador= response.body.osario.cedula_comprador;
	            this.osario.ciudad_expedicion= response.body.osario.ciudad_expedicion_id;
	            this.osario.fecha_nacimiento= response.body.osario.fecha_nacimiento;
	            this.osario.fecha_fallecimiento= response.body.osario.fecha_fallecimiento;
	            this.osario.fecha_traslado= response.body.osario.fecha_traslado;
	            this.osario.fallecido=  response.body.osario.FALLECIDO_OSARIO;
	            this.osario.comprador=  response.body.osario.COMPRADOR_OSARIO;
	            this.osario.numero=  response.body.osario.NUMERO_OSARIO;
	            this.osario.numeroOriginal=response.body.osario.NUMERO_OSARIO;
				$('#selectMunicipio option[value="'+this.osario.ciudad_expedicion+'"]').prop('selected',true);
	            }, (error) => {
	                toastr.error(error.status + ' ' + error.statusText + ' (' + error.url + ')');
	            });
	        },
	        concatenarComprador:function(){
	        	this.osario.comprador=this.osario.comprador_nombres.nombres+' '+this.osario.comprador_nombres.apellidos;
	        },
	        concatenarFallecido:function(){
	        	this.osario.fallecido=this.osario.fallecido_nombres.nombres+' '+this.osario.fallecido_nombres.apellidos;
	        },
	        validarNumeroOsario:function(){
	        	if (this.osario.numero.length==0) {
	        		return
	        	}
	        	if (this.osario.numero==this.osario.numeroOriginal) {
	        		return
	        	}
	            this.$http.post('/administracion/osarios/validar-numero-osario',this.osario).then((response) => {
	                console.log(response.body);
	                if (response.body.osario > 0) {
	                	toastr.warning('El numero de osario ya esta en uso. Digite otro numero');
	                	this.osario.numero='';
	                	return
	                }
	            }, (error) => {
	                toastr.error(error.status + ' ' + error.statusText + ' (' + error.url + ')');
	            });
	        },
	        guardar:function(){
	        	if (this.osario.numero.length==0) {
					toastr.warning('El numero del osario es requerido');
					return
	        	}
	        	if (this.osario.fallecido.length==0) {
					toastr.warning('El nombre del fallecido es requerido');
					return
	        	}
	        	if (this.osario.fecha_nacimiento.length==0) {
					toastr.warning('La fecha de nacimiento es requerida');
					return
	        	}
	        	if (this.osario.fecha_fallecimiento.length==0) {
					toastr.warning('La fecha de fallecimiento es requerida');
					return
	        	}
	        	if (this.osario.comprador.length==0) {
					toastr.warning('El nombre del comprador es requerido');
					return
	        	}
	        	if (this.osario.cedula_comprador.length==0) {
					toastr.warning('El numero de identificacion es requerido');
					return
	        	}
	        	if (this.osario.ciudad_expedicion.length==0) {
					toastr.warning('El municipio de expedicion es requerido');
					return
	        	}
	        	if (this.osario.comprador.length==0) {
					toastr.warning('El nombre del comprador es requerido');
					return
	        	}
				this.$http.post('/administracion/osarios/actualizar-osario',this.osario).then((response) => {
					console.log(response);
					if (response.body.estado == 'validador') {
	                    jQuery.each(response.body.errors, function(i, value) {
	                        toastr.warning(value)
	                    })
	                } else {
	                    if (response.body.estado == 'ok') {
	                        if (response.body.tipo == 'update') {
	                            toastr.success('Osario actualizado correctamente');
	                        }
	                        if (response.body.tipo == 'save') {
	                            toastr.success('Osario creado correctamente');
	                        }
	                    }
	                }
				}, (error) => {
					console.log(error);
					toastr.error(error.status + ' ' + error.statusText + ' (' + error.url + ')');
				});
	        }
	    },
	    mounted() {
	    	entorno=this;
	    	entorno.complementos();
	    	entorno.osario.id=$('#osarioId').val();
			$("#selectMunicipio").chosen({
				width: "100%"
			}).change(function() {
				entorno.osario.ciudad_expedicion = $('#selectMunicipio').val();
			});
	        $('#fechaNacimiento').datetimepicker({
	            format: 'YYYY-MM-DD',
	            maxDate: moment().format("YYYY-MM-DD")
	        }).on('dp.change', function(e) {
	            entorno.osario.fecha_nacimiento = $('#fechaNacimiento').val();
	        });
	        $('#fechaFallecimiento').datetimepicker({
	            format: 'YYYY-MM-DD',
	            maxDate: moment().format("YYYY-MM-DD")
	        }).on('dp.change', function(e) {
	            entorno.osario.fecha_fallecimiento = $('#fechaFallecimiento').val();
	        });
	        $('#fechaTraslado').datetimepicker({
	            format: 'YYYY-MM-DD'
	        }).on('dp.change', function(e) {
	            entorno.osario.fecha_traslado = $('#fechaTraslado').val();
	        });
	    },
		updated: function(){
			$('#selectMunicipio').trigger('chosen:updated');
		}
	});
</script>
@endsection