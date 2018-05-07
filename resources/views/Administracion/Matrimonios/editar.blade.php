@extends('layouts.app')

@section('title','Matrimonio')

@section('contenido')
<div class="container" id="app">
	<div class="block-header">
		<h2>Matrimonio</h2>
	</div>
	<div class="card">
		<div class="card-header">
			<h2>Datos del esposo 
			</h2>
		</div>
		<div class="card-body  card-padding">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<div class="form-group fg-float">
						<div class="fg-line fg-toggled">
							<input type="text" class="form-control fg-input" id="nombreEsposo" v-model="matrimonio.esposo">
							<label class="fg-label">Nombre del esposo</label>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-6 col-lg-6">
					<div class="form-group fg-float">
						<div class="fg-line fg-toggled">
							<input type="text" class="form-control fg-input" id="nombrePadreEsposo" v-model="matrimonio.padre_esposo">
							<label class="fg-label">Nombre del padre</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-6 col-lg-6">
					<div class="form-group fg-float">
						<div class="fg-line fg-toggled">
							<input type="text" class="form-control fg-input" id="nombreMadreEsposo" v-model="matrimonio.madre_esposo">
							<label class="fg-label">Nombre de la madre</label>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group fg-float">
						<div class="fg-line fg-toggled">
							<input type="text" class="form-control fg-input" id="libroBautisoEsposo" v-model="matrimonio.libro_bautizado_esposo">
							<label class="fg-label">Libro Bautismo</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group fg-float">
						<div class="fg-line fg-toggled">
							<input type="text" class="form-control fg-input" id="folioBautisoEsposo" v-model="matrimonio.folio_bautizado_esposo">
							<label class="fg-label">Folio Bautismo</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group fg-float">
						<div class="fg-line fg-toggled">
							<input type="text" class="form-control fg-input" id="partidaBautisoEsposo" v-model="matrimonio.partida_bautizado_esposo">
							<label class="fg-label">Partida Bautismo</label>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-6 m-b-25">
					<label>Parroquia de bautizo</label>
					<select class="chosen" data-placeholder="Seleccione una parroquia" id="selectParroquiaBautizadoEsposo">
						<option disabled selected value="">Seleccione una parroquia</option>
						<option v-for="parroquia in complementos.parroquias" v-bind:value="parroquia.id">@{{ parroquia.nombre }}</option>
					</select>
				</div>
				<div class="col-sm-12 col-md-12 col-lg-6 m-b-25">
					<label>Fecha de bautizo</label>
					<div class="input-group form-group">
						<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
						<div class="dtp-container">
							<input type='text' class="form-control date-picker"
							placeholder="Click here..."  id="fechaBautizoEsposo" v-model="matrimonio.fechaBautizoEsposo">
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group fg-float">
						<div class="fg-line fg-toggled">
							<input type="text" class="form-control fg-input" id="libroConfirmacionEsposo" v-model="matrimonio.libro_confirmado_esposo">
							<label class="fg-label">Libro Confirmacion</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group fg-float">
						<div class="fg-line fg-toggled">
							<input type="text" class="form-control fg-input" id="folioConfirmacionEsposo" v-model="matrimonio.folio_confirmado_esposo">
							<label class="fg-label">Folio Confirmacion</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group fg-float">
						<div class="fg-line fg-toggled">
							<input type="text" class="form-control fg-input" id="partidaConfirmacionEsposo" v-model="matrimonio.partida_confirmado_esposo">
							<label class="fg-label">Partida Confirmacion</label>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-6 m-b-25">
					<label>Parroquia de confirmacion</label>
					<select class="chosen" data-placeholder="Seleccione una parroquia" id="selectParroquiaConfirmacionEsposo">
						<option disabled selected value="">Seleccione una parroquia</option>
						<option v-for="parroquia in complementos.parroquias" v-bind:value="parroquia.id">@{{ parroquia.nombre }}</option>
					</select>
				</div>
				<div class="col-sm-12 col-md-12 col-lg-6 m-b-25">
					<label>Fecha de confirmacion</label>
					<div class="input-group form-group">
						<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
						<div class="dtp-container">
							<input type='text' class="form-control date-picker"
							placeholder="Click here..."  id="fechaConfirmacionEsposo" v-model="matrimonio.fechaConfirmacionEsposo">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card">
		<div class="card-header">
			<h2>Datos de la esposa
			</h2>
		</div>
		<div class="card-body  card-padding">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<div class="form-group fg-float">
						<div class="fg-line fg-toggled">
							<input type="text" class="form-control fg-input" id="nombreEsposa" v-model="matrimonio.esposa">
							<label class="fg-label">Nombre de la esposa</label>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-6 col-lg-6">
					<div class="form-group fg-float">
						<div class="fg-line fg-toggled">
							<input type="text" class="form-control fg-input" id="nombrePadreEsposa" v-model="matrimonio.padre_esposa">
							<label class="fg-label">Nombre del padre</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-6 col-lg-6">
					<div class="form-group fg-float">
						<div class="fg-line fg-toggled">
							<input type="text" class="form-control fg-input" id="nombreMadreEsposa" v-model="matrimonio.madre_esposa">
							<label class="fg-label">Nombre de la madre</label>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group fg-float">
						<div class="fg-line fg-toggled">
							<input type="text" class="form-control fg-input" id="libroBautisadoEsposa" v-model="matrimonio.libro_bautizado_esposa">
							<label class="fg-label">Libro Bautismo</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group fg-float">
						<div class="fg-line fg-toggled">
							<input type="text" class="form-control fg-input" id="folioBautisadoEsposa" v-model="matrimonio.folio_bautizado_esposa">
							<label class="fg-label">Folio Bautismo</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group fg-float">
						<div class="fg-line fg-toggled">
							<input type="text" class="form-control fg-input" id="partidaBautisadoEsposa" v-model="matrimonio.partida_bautizado_esposa">
							<label class="fg-label">Partida Bautismo</label>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-6 m-b-25">
					<label>Parroquia de bautizo</label>
					<select class="chosen" data-placeholder="Seleccione una parroquia" id="selectParroquiaBautizadoEsposa">
						<option disabled selected value="">Seleccione una parroquia</option>
						<option v-for="parroquia in complementos.parroquias" v-bind:value="parroquia.id">@{{ parroquia.nombre }}</option>
					</select>
				</div>
				<div class="col-sm-12 col-md-12 col-lg-6 m-b-25">
					<label>Fecha de bautizo</label>
					<div class="input-group form-group">
						<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
						<div class="dtp-container">
							<input type='text' class="form-control date-picker"
							placeholder="Click here..."  id="fechaBautizoEsposa" v-model="matrimonio.fechaBautizoEsposa">
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group fg-float">
						<div class="fg-line fg-toggled">
							<input type="text" class="form-control fg-input" id="libroConfirmacionEsposa" v-model="matrimonio.libro_confirmado_esposa">
							<label class="fg-label">Libro Confirmacion</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group fg-float">
						<div class="fg-line fg-toggled">
							<input type="text" class="form-control fg-input" id="folioConfirmacionEsposa" v-model="matrimonio.folio_confirmado_esposa">
							<label class="fg-label">Folio Confirmacion</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group fg-float">
						<div class="fg-line fg-toggled">
							<input type="text" class="form-control fg-input" id="partidaConfirmacionEsposa" v-model="matrimonio.partida_confirmado_esposa">
							<label class="fg-label">Partida Confirmacion</label>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-6 m-b-25">
					<label>Parroquia de confirmacion</label>
					<select class="chosen" data-placeholder="Seleccione una parroquia" id="selectParroquiaConfirmacionEsposa">
						<option disabled selected value="">Seleccione una parroquia</option>
						<option v-for="parroquia in complementos.parroquias" v-bind:value="parroquia.id">@{{ parroquia.nombre }}</option>
					</select>
				</div>
				<div class="col-sm-12 col-md-12 col-lg-6 m-b-25">
					<label>Fecha de confirmacion</label>
					<div class="input-group form-group">
						<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
						<div class="dtp-container">
							<input type='text' class="form-control date-picker"
							placeholder="Click here..."  id="fechaConfirmacionEsposa" v-model="matrimonio.fechaConfirmacionEsposa">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-header">
			<h2>Datos del matrimonio
			</h2>
		</div>
		<div class="card-body  card-padding">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<div class="form-group fg-float">
						<div class="fg-line fg-toggled">
							<input type="text" class="form-control fg-input" id="padrino" v-model="matrimonio.padrino">
							<label class="fg-label">Padrino</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-12 col-lg-12">
					<div class="form-group fg-float">
						<div class="fg-line fg-toggled">
							<input type="text" class="form-control fg-input" id="madrina" v-model="matrimonio.madrina">
							<label class="fg-label">Madrina</label>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<label>Fecha de matrimonio</label>
					<div class="input-group form-group">
						<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
						<div class="dtp-container">
							<input type='text' class="form-control date-picker"
							placeholder="Click here..."  id="fechaMatrimonio" v-model="matrimonio.fechaMatrimonio">
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12 m-b-25">
					<label>Celebrante</label>
					<select class="chosen" data-placeholder="Seleccione una parroquia" id="selectCelebranteMatrimonio">
						<option disabled selected value="">Seleccione un celebrante</option>
						<option v-for="celebrante in complementos.celebrantes" v-bind:value="celebrante.id">@{{ celebrante.nom_celebrante }}</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12 m-b-25">
					<label>Parroco</label>
					<select class="chosen" data-placeholder="Seleccione una parroquia" id="selectParrocoMatrimonio">
						<option disabled selected value="">Seleccione un celebrante</option>
						<option v-for="celebrante in complementos.celebrantes" v-bind:value="celebrante.id">@{{ celebrante.nom_celebrante }}</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group fg-float">
						<div class="fg-line fg-toggled">
							<input type="text" class="form-control fg-input" id="libroMatrimonio" v-model="matrimonio.libro">
							<label class="fg-label">Libro</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group fg-float">
						<div class="fg-line fg-toggled">
							<input type="text" class="form-control fg-input" id="folioMatrimonio" v-model="matrimonio.folio">
							<label class="fg-label">Folio</label>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group fg-float">
						<div class="fg-line fg-toggled">
							<input type="text" class="form-control fg-input" id="partidaMatrimonio" v-model="matrimonio.partida">
							<label class="fg-label">Partida</label>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card">
		<div class="card-header">
			<h2>Anotaciones
			</h2>
		</div>
		<div class="card-body  card-padding">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12" v-for="(anotacion,index) in matrimonio.anotaciones ">
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
			<div class="row" v-show="matrimonio.tipoEdicion=='true'">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<p class="c-black f-500 m-t-20 m-b-20">Nueva anotacion</p>
					<div class="form-group">
						<div class="fg-line">
							<textarea class="form-control"
							placeholder="Decreto ó anotacion" v-model="matrimonio.anotacion"></textarea>
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
	<input type="text" id="idMatrimonio" value="{{ $matrimonio }}" hidden="true">
	<input type="text" id="tipoEdicion" value="{{ $tipoEdicion }}" hidden="true">
</div>
@endsection
@section('scripts')
<script type="text/javascript">
	
	var app = new Vue({
		el: '#app',
		data: {
			complementos:{
				parroquias:[],
				celebrantes:[]
			},
			matrimonio:{
				id:'',
				nombres:'',
				libro:'',
				folio:'',
				partida:'',
				fechaMatrimonio:'',
				esposo:'',
				esposa:'',
				padre_esposo:'',
				madre_esposo:'',
				padre_esposa:'',
				madre_esposa:'',
				parroquia_bautizado:'',
				fechaBautizoEsposo:'',
				libro_bautizado_esposo:'',
				folio_bautizado_esposo:'',
				partida_bautizado_esposo:'',
				parroquia_bautizada:'',
				fechaBautizoEsposa:'',
				libro_bautizado_esposa:'',
				folio_bautizado_esposa:'',
				partida_bautizado_esposa:'',
				parroquia_confirmado:'',
				fechaConfirmacionEsposo:'',
				libro_confirmado_esposo:'',
				folio_confirmado_esposo:'',
				partida_confirmado_esposo:'',
				parroquia_confirmada:'',
				fechaConfirmacionEsposa:'',
				libro_confirmado_esposa:'',
				folio_confirmado_esposa:'',
				partida_confirmado_esposa:'',
				celebrante:'',
				parroco:'',
				padrino:'',
				madrina:'',
				tipoEdicion:'',
				anotaciones:[],
				anotacion:''
			}
		},
		methods: {
			getComplementos:function(){
				this.$http.get('/administracion/matrimonios/complementos-create').then((response) => {
					this.complementos.parroquias=response.body.parroquias;
					this.complementos.celebrantes=response.body.celebrantes;
				}, (error) => {
					console.log(error);
					toastr.error(error.status + ' ' + error.statusText + ' (' + error.url + ')');
				});
			},
			guardar:function(){
				if (this.matrimonio.esposo.length==0) {
					toastr.warning('En nombre del esposo es obligatorio');
					return
				}
				if (this.matrimonio.padre_esposo.length==0 && this.matrimonio.madre_esposo.length==0) {
					toastr.warning('El nombre del padre o madre del esposo es obligatorio');
					return
				}
				if (this.matrimonio.parroquia_bautizado.length==0) {
					toastr.warning('El parroquia de bautizo del esposo es obligatoria');
					return
				}
				if (this.matrimonio.parroquia_confirmado.length==0) {
					toastr.warning('El parroquia de confirmacion del esposo es obligatoria');
					return
				}
				if (this.matrimonio.esposa.length==0) {
					toastr.warning('En nombre de la esposa es obligatorio');
					return
				}
				if (this.matrimonio.padre_esposa.length==0 && this.matrimonio.madre_esposa.length==0) {
					toastr.warning('El nombre del padre o madre de la esposa es obligatorio');
					return
				}
				if (this.matrimonio.parroquia_bautizada.length==0) {
					toastr.warning('El parroquia de bautizo de la esposa es obligatoria');
					return
				}
				if (this.matrimonio.parroquia_confirmada.length==0) {
					toastr.warning('El parroquia de confirmacion de la esposa es obligatoria');
					return
				}
				if (this.matrimonio.parroco.length==0) {
					toastr.warning('Seleccione el parroco de la iglesia que presencia el matrimonio');
					return
				}
				if (this.matrimonio.celebrante.length==0) {
					toastr.warning('Seleccione el sacerdote que celebra el matrimonio');
					return
				}
				if (this.matrimonio.tipoEdicion=='true') {
					if (this.matrimonio.anotacion.length==0) {					
						toastr.warning('Digite la anotacion de la modificacion por decreto');
						return	
					}
				}
				this.$http.post('/administracion/matrimonios/actualizar-matrimonio',this.matrimonio).then((response) => {
					console.log(response);
					if (response.body.estado == 'validador') {
	                    jQuery.each(response.body.errors, function(i, value) {
	                        toastr.warning(value)
	                    })
	                } else {
	                    if (response.body.estado == 'ok') {
	                        if (response.body.tipo == 'update') {
	                            toastr.success('Matrimonio a ctualizado correctamente');
	                        }
	                        if (response.body.tipo == 'save') {
	                            toastr.success('Matrimonio creado correctamente');
	                        }
	                    }
	                }
				}, (error) => {
					console.log(error);
					toastr.error(error.status + ' ' + error.statusText + ' (' + error.url + ')');
				});

			},
			datosMatrimonio:function(){
				var entorno=this;
				this.$http.post('/administracion/matrimonios/matrimonio-editar',this.matrimonio).then((response) => {
					console.log(response);
					entorno.matrimonio.nombres=response.body.matrimonio.nombres;
					entorno.matrimonio.libro=response.body.matrimonio.libro;
					entorno.matrimonio.folio=response.body.matrimonio.folio;
					entorno.matrimonio.partida=response.body.matrimonio.partida;
					entorno.matrimonio.fechaMatrimonio=response.body.matrimonio.fecha_matrimonio;
					entorno.matrimonio.esposo=response.body.matrimonio.esposo;
					entorno.matrimonio.esposa=response.body.matrimonio.esposa;
					entorno.matrimonio.padre_esposo=response.body.matrimonio.padre_esposo;
					entorno.matrimonio.madre_esposo=response.body.matrimonio.madre_esposo;
					entorno.matrimonio.padre_esposa=response.body.matrimonio.padre_esposa;
					entorno.matrimonio.madre_esposa=response.body.matrimonio.madre_esposa;
					entorno.matrimonio.parroquia_bautizado=response.body.matrimonio.parroquia_bautizado_id;
					entorno.matrimonio.libro_bautizado_esposo=response.body.matrimonio.esposo_lib_baut;
					entorno.matrimonio.folio_bautizado_esposo=response.body.matrimonio.esposo_fol_baut;
					entorno.matrimonio.partida_bautizado_esposo=response.body.matrimonio.esposo_par_baut;
					entorno.matrimonio.parroquia_bautizada=response.body.matrimonio.parroquia_bautizada_id;
					entorno.matrimonio.libro_bautizado_esposa=response.body.matrimonio.esposa_lib_baut;
					entorno.matrimonio.folio_bautizado_esposa=response.body.matrimonio.esposa_fol_baut;
					entorno.matrimonio.partida_bautizado_esposa=response.body.matrimonio.esposa_par_baut;
					entorno.matrimonio.parroquia_confirmado=response.body.matrimonio.parroquia_confirmado_id;
					entorno.matrimonio.libro_confirmado_esposo=response.body.matrimonio.esposo_lib_conf;
					entorno.matrimonio.folio_confirmado_esposo=response.body.matrimonio.esposo_fol_conf;
					entorno.matrimonio.partida_confirmado_esposo=response.body.matrimonio.esposo_par_conf;
					entorno.matrimonio.parroquia_confirmada=response.body.matrimonio.parroquia_confirmada_id;
					entorno.matrimonio.libro_confirmado_esposa=response.body.matrimonio.esposa_lib_conf;
					entorno.matrimonio.folio_confirmado_esposa=response.body.matrimonio.esposa_fol_conf;
					entorno.matrimonio.partida_confirmado_esposa=response.body.matrimonio.esposa_par_conf;
					entorno.matrimonio.celebrante=response.body.matrimonio.celebrante_id;
					entorno.matrimonio.parroco=response.body.matrimonio.parroco_id;
					entorno.matrimonio.padrino=response.body.matrimonio.padrino;
					entorno.matrimonio.madrina=response.body.matrimonio.madrina;
					entorno.matrimonio.anotaciones=response.body.anotaciones;
					entorno.matrimonio.fechaBautizoEsposo=response.body.matrimonio.fecha_bautizo_esposo;
					entorno.matrimonio.fechaBautizoEsposa=response.body.matrimonio.fecha_bautizo_esposa;
					entorno.matrimonio.fechaConfirmacionEsposo=response.body.matrimonio.fecha_confirmado_esposo;
					entorno.matrimonio.fechaConfirmacionEsposa=response.body.matrimonio.fecha_confirmado_esposa;
	        		$('#fechaMatrimonio').val(response.body.matrimonio.fecha_matrimonio);
	        		$('#fechaBautizoEsposo').val(response.body.matrimonio.fecha_bautizo_esposo);
	        		$('#fechaConfirmacionEsposo').val(response.body.matrimonio.fecha_confirmado_esposo);
	        		$('#fechaBautizoEsposa').val(response.body.matrimonio.fecha_bautizo_esposa);
	        		$('#fechaConfirmacionEsposa').val(response.body.matrimonio.fecha_confirmado_esposa);
					$('#selectParroquiaBautizadoEsposo option[value="'+entorno.matrimonio.parroquia_bautizado+'"]').prop('selected',true);
					$('#selectParroquiaBautizadoEsposa option[value="'+entorno.matrimonio.parroquia_bautizada+'"]').prop('selected',true);
					$('#selectParroquiaConfirmacionEsposo option[value="'+entorno.matrimonio.parroquia_confirmado+'"]').prop('selected',true);
					$('#selectParroquiaConfirmacionEsposa option[value="'+entorno.matrimonio.parroquia_confirmada+'"]').prop('selected',true);
					$('#selectCelebranteMatrimonio option[value="'+entorno.matrimonio.celebrante+'"]').prop('selected',true);
					$('#selectParrocoMatrimonio option[value="'+entorno.matrimonio.parroco+'"]').prop('selected',true);
				}, (error) => {
					console.log(error);
					toastr.error(error.status + ' ' + error.statusText + ' (' + error.url + ')');
				});
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
	                closeOnCancel: true
	            }, function(isConfirm) {
	                if (isConfirm) {
	                    entorno.$http.post('/administracion/matrimonios/eliminar-anotacion', data).then((response) => {
	                        if (response.body.estado=='ok') {
	                        	if (response.body.tipo=='delete') {
									entorno.matrimonio.anotaciones.splice(index,1);
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
			var entorno = this;
			entorno.matrimonio.id=$('#idMatrimonio').val();
			entorno.matrimonio.tipoEdicion=$('#tipoEdicion').val();
			entorno.getComplementos();
			entorno.datosMatrimonio();
			$("#selectParroquiaBautizadoEsposo").chosen({
				width: "100%"
			}).change(function() {
				entorno.matrimonio.parroquia_bautizado = $('#selectParroquiaBautizadoEsposo').val();
			});
			$("#selectParroquiaBautizadoEsposa").chosen({
				width: "100%"
			}).change(function() {
				entorno.matrimonio.parroquia_bautizada = $('#selectParroquiaBautizadoEsposa').val();
			});
			$("#selectParroquiaConfirmacionEsposo").chosen({
				width: "100%"
			}).change(function() {
				entorno.matrimonio.parroquia_confirmado = $('#selectParroquiaConfirmacionEsposo').val();
			});
			$("#selectParroquiaConfirmacionEsposa").chosen({
				width: "100%"
			}).change(function() {
				entorno.matrimonio.parroquia_confirmada = $('#selectParroquiaConfirmacionEsposa').val();
			});
			$("#selectCelebranteMatrimonio").chosen({
				width: "100%"
			}).change(function() {
				entorno.matrimonio.celebrante = $('#selectCelebranteMatrimonio').val();
			});
			$("#selectParrocoMatrimonio").chosen({
				width: "100%"
			}).change(function() {
				entorno.matrimonio.parroco = $('#selectParrocoMatrimonio').val();
			});
	        $('#fechaMatrimonio').datetimepicker({
	            format: 'YYYY-MM-DD',
	            maxDate: moment().format("YYYY-MM-DD")
	        }).on('dp.change', function(e) {
	            entorno.matrimonio.fechaMatrimonio = $('#fechaMatrimonio').val();
	        });
	        $('#fechaBautizoEsposo').datetimepicker({
	            format: 'YYYY-MM-DD',
	            maxDate: moment().format("YYYY-MM-DD")
	        }).on('dp.change', function(e) {
	            entorno.matrimonio.fechaBautizoEsposo = $('#fechaBautizoEsposo').val();
	        });
	        $('#fechaBautizoEsposa').datetimepicker({
	            format: 'YYYY-MM-DD',
	            maxDate: moment().format("YYYY-MM-DD")
	        }).on('dp.change', function(e) {
	            entorno.matrimonio.fechaBautizoEsposa = $('#fechaBautizoEsposa').val();
	        });
	        $('#fechaConfirmacionEsposo').datetimepicker({
	            format: 'YYYY-MM-DD',
	            maxDate: moment().format("YYYY-MM-DD")
	        }).on('dp.change', function(e) {
	            entorno.matrimonio.fechaConfirmacionEsposo = $('#fechaConfirmacionEsposo').val();
	        });
	        $('#fechaConfirmacionEsposa').datetimepicker({
	            format: 'YYYY-MM-DD',
	            maxDate: moment().format("YYYY-MM-DD")
	        }).on('dp.change', function(e) {
	            entorno.matrimonio.fechaConfirmacionEsposa = $('#fechaConfirmacionEsposa').val();
	        });
		},
		updated: function(){
			$('#selectParroquiaBautizadoEsposo').trigger('chosen:updated');
			$('#selectParroquiaBautizadoEsposa').trigger('chosen:updated');
			$('#selectParroquiaConfirmacionEsposo').trigger('chosen:updated');
			$('#selectParroquiaConfirmacionEsposa').trigger('chosen:updated');
			$('#selectCelebranteMatrimonio').trigger('chosen:updated');
			$('#selectParrocoMatrimonio').trigger('chosen:updated');
		}
	});
</script>
@endsection