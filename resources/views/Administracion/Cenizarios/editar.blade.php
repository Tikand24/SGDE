@extends('layouts.app')

@section('title','Bautismos')

@section('contenido')
<div class="container" id="app">
	<div class="block-header">
		<h2>Editar cenizario</h2>
	</div>
	<div class="card">
		<div class="card-header">
			<h2>Datos del cenizario</h2>
		</div>
		<div class="card-body card-padding">
			<div class="row">
				<div class="col-sm-12 col-md-2 col-lg-2">
					<div class="form-group fg-float">
						<div class="fg-line fg-toggled">
							<input type="number" class="form-control fg-input" v-model="cenizario.numero" v-on:blur="validarNumeroOsario">
							<label class="fg-label">Numero del osario</label>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<div class="form-group fg-float">
						<div class="fg-line fg-toggled">
							<input type="text" class="form-control fg-input" v-model="cenizario.fallecido">
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
							placeholder="Click here..."  id="fechaNacimiento" v-model="cenizario.fecha_nacimiento">
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-12 col-lg-4 m-b-25">
					<label>Fecha de fallecimiento</label>
					<div class="input-group form-group">
						<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
						<div class="dtp-container">
							<input type='text' class="form-control date-picker"
							placeholder="Click here..."  id="fechaFallecimiento" v-model="cenizario.fecha_fallecimiento">
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-12 col-lg-4 m-b-25">
					<label>Fecha de traslado</label>
					<div class="input-group form-group">
						<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
						<div class="dtp-container">
							<input type='text' class="form-control date-picker"
							placeholder="Click here..."  id="fechaTraslado" v-model="cenizario.fecha_traslado">
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
							<input type="number" class="form-control fg-input" v-model="cenizario.cedula_comprador">
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
							<input type="text" class="form-control fg-input" v-model="cenizario.comprador">
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
	<input type="text" id="cenizarioId" value="{{ $cenizario }}" hidden="true" disabled="true" readonly="true">
</div>
@endsection
@section('scripts')
<script type="text/javascript">
	var app = new Vue({
	    el: '#app',
	    data: {
	        cenizario: {
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
	                this.datosCenizario();
	            }, (error) => {
	                toastr.error(error.status + ' ' + error.statusText + ' (' + error.url + ')');
	            });
	        },
	        datosCenizario:function(){
	            this.$http.post('/administracion/cenizarios/cenizario-editar',this.cenizario).then((response) => {
	                console.log(response.body);
	            this.cenizario.id=response.body.cenizario.id;
	            this.cenizario.cedula_comprador= response.body.cenizario.cedula_comprador;
	            this.cenizario.ciudad_expedicion= response.body.cenizario.ciudad_expedicion_id;
	            this.cenizario.fecha_nacimiento= response.body.cenizario.fecha_nacimiento;
	            this.cenizario.fecha_fallecimiento= response.body.cenizario.fecha_fallecimiento;
	            this.cenizario.fecha_traslado= response.body.cenizario.fecha_traslado;
	            this.cenizario.fallecido=  response.body.cenizario.FALLECIDO_CENIZARIO;
	            this.cenizario.comprador=  response.body.cenizario.COMPRADOR_CENIZARIO;
	            this.cenizario.numero=  response.body.cenizario.NUMERO_CENIZARIO;
	            this.cenizario.numeroOriginal=response.body.cenizario.NUMERO_CENIZARIO;
				$('#selectMunicipio option[value="'+this.cenizario.ciudad_expedicion+'"]').prop('selected',true);
	            }, (error) => {
	                toastr.error(error.status + ' ' + error.statusText + ' (' + error.url + ')');
	            });
	        },
	        concatenarComprador:function(){
	        	this.cenizario.comprador=this.cenizario.comprador_nombres.nombres+' '+this.cenizario.comprador_nombres.apellidos;
	        },
	        concatenarFallecido:function(){
	        	this.cenizario.fallecido=this.cenizario.fallecido_nombres.nombres+' '+this.cenizario.fallecido_nombres.apellidos;
	        },
	        validarNumeroOsario:function(){
	        	if (this.cenizario.numero.length==0) {
	        		return
	        	}
	        	if (this.cenizario.numero==this.cenizario.numeroOriginal) {
	        		return
	        	}
	            this.$http.post('/administracion/cenizarios/validar-numero-cenizario',this.cenizario).then((response) => {
	                console.log(response.body);
	                if (response.body.cenizario > 0) {
	                	toastr.warning('El numero de cenizario ya esta en uso. Digite otro numero');
	                	this.cenizario.numero='';
	                	return
	                }
	            }, (error) => {
	                toastr.error(error.status + ' ' + error.statusText + ' (' + error.url + ')');
	            });
	        },
	        guardar:function(){
	        	if (this.cenizario.numero.length==0) {
					toastr.warning('El numero del cenizario es requerido');
					return
	        	}
	        	if (this.cenizario.fallecido.length==0) {
					toastr.warning('El nombre del fallecido es requerido');
					return
	        	}
	        	if (this.cenizario.fecha_nacimiento.length==0) {
					toastr.warning('La fecha de nacimiento es requerida');
					return
	        	}
	        	if (this.cenizario.fecha_fallecimiento.length==0) {
					toastr.warning('La fecha de fallecimiento es requerida');
					return
	        	}
	        	if (this.cenizario.comprador.length==0) {
					toastr.warning('El nombre del comprador es requerido');
					return
	        	}
	        	if (this.cenizario.cedula_comprador.length==0) {
					toastr.warning('El numero de identificacion es requerido');
					return
	        	}
	        	if (this.cenizario.ciudad_expedicion.length==0) {
					toastr.warning('El municipio de expedicion es requerido');
					return
	        	}
	        	if (this.cenizario.comprador.length==0) {
					toastr.warning('El nombre del comprador es requerido');
					return
	        	}
				this.$http.post('/administracion/cenizarios/actualizar-cenizario',this.cenizario).then((response) => {
					console.log(response);
					if (response.body.estado == 'validador') {
	                    jQuery.each(response.body.errors, function(i, value) {
	                        toastr.warning(value)
	                    })
	                } else {
	                    if (response.body.estado == 'ok') {
	                        if (response.body.tipo == 'update') {
	                            toastr.success('Cenizario actualizado correctamente');
	                        }
	                        if (response.body.tipo == 'save') {
	                            toastr.success('Cenizario creado correctamente');
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
	    	entorno.cenizario.id=$('#cenizarioId').val();
			$("#selectMunicipio").chosen({
				width: "100%"
			}).change(function() {
				entorno.cenizario.ciudad_expedicion = $('#selectMunicipio').val();
			});
	        $('#fechaNacimiento').datetimepicker({
	            format: 'YYYY-MM-DD',
	            maxDate: moment().format("YYYY-MM-DD")
	        }).on('dp.change', function(e) {
	            entorno.cenizario.fecha_nacimiento = $('#fechaNacimiento').val();
	        });
	        $('#fechaFallecimiento').datetimepicker({
	            format: 'YYYY-MM-DD',
	            maxDate: moment().format("YYYY-MM-DD")
	        }).on('dp.change', function(e) {
	            entorno.cenizario.fecha_fallecimiento = $('#fechaFallecimiento').val();
	        });
	        $('#fechaTraslado').datetimepicker({
	            format: 'YYYY-MM-DD'
	        }).on('dp.change', function(e) {
	            entorno.cenizario.fecha_traslado = $('#fechaTraslado').val();
	        });
	    },
		updated: function(){
			$('#selectMunicipio').trigger('chosen:updated');
		}
	});
</script>
@endsection