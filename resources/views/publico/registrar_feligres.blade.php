<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>SGDE</title>
		<meta name="csrf-token" id="token" content="{{ csrf_token() }}"  value="{{ csrf_token() }}">
		<meta name="description" content="Cardio is a free one page template made exclusively for Codrops by Luka Cvetinovic" />
		<meta name="keywords" content="html template, css, free, one page, gym, fitness, web design" />
		<meta name="author" content="Luka Cvetinovic for Codrops" />
		<!-- Favicons (created with http://realfavicongenerator.net/)-->
		<link rel="apple-touch-icon" sizes="57x57" href="{{ asset('front-end/img/favicons/apple-touch-icon-57x57.png') }}">
		<link rel="apple-touch-icon" sizes="60x60" href="{{ asset('front-end/img/favicons/apple-touch-icon-60x60.png') }}">
		<link rel="icon" type="image/png" href="{{ asset('front-end/img/favicons/favicon-32x32.png') }}" sizes="32x32">
		<link rel="icon" type="image/png" href="{{ asset('front-end/img/favicons/favicon-16x16.png') }}" sizes="16x16">
		<link rel="manifest" href="{{ asset('front-end/img/favicons/manifest.json') }}">
		<link rel="shortcut icon" href="{{ asset('front-end/img/favicons/favicon.ico') }}">
		<meta name="msapplication-TileColor" content="#00a8ff">
		<meta name="msapplication-config" content="{{ asset('front-end/img/favicons/browserconfig.xml') }}">
		<meta name="theme-color" content="#ffffff">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
		<!-- Normalize -->
		<link rel="stylesheet" type="text/css" href="{{ asset('front-end/css/normalize.css') }}">
		<!-- Bootstrap -->
		<link rel="stylesheet" type="text/css" href="{{ asset('front-end/css/bootstrap.css') }}">
		<!-- Owl -->
		<link rel="stylesheet" type="text/css" href="{{ asset('front-end/css/owl.css') }}">
		
		<!-- Animate.css -->

		<link rel="stylesheet" type="text/css" href="{{ asset('front-end/css/animate.css') }}">
		<!-- Font Awesome -->
		<link rel="stylesheet" type="text/css" href="{{ asset('front-end/fonts/font-awesome-4.1.0/css/font-awesome.min.css') }}">
		<!-- Elegant Icons -->
		<link rel="stylesheet" type="text/css" href="{{ asset('front-end/fonts/eleganticons/et-icons.css') }}">
		<!-- Main style -->
		<link rel="stylesheet" type="text/css" href="{{ asset('front-end/css/cardio.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('front-end/css/bootstrap-material-datetimepicker.css') }}">		
		
	</head>
	<body>
		<div class="preloader">
			<img src="{{ asset('front-end/img/loader.gif') }}" alt="Preloader image">
		</div>
		<nav class="navbar">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#"><img src="{{ asset('front-end/img/logo.png') }}" data-active-url="{{ asset('front-end/img/logo-active.png') }}" alt=""></a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right main-nav">
						<li><a href="#intro">Inicio</a></li>
						<li><a href="#services">Servicios</a></li>
						<li><a href="#team">Equipo</a></li>
						<li><a href="#pricing">Aranceles</a></li>
						@if (Auth::check())
						<li><a href="{{ route('home') }}" class="btn btn-blue">Administracion</a></li>
						@else
						<li><a href="#" data-toggle="modal" data-target="#modal1" class="btn btn-blue">Ingresar</a></li>
						@endif
					</ul>
				</div>
				<!-- /.navbar-collapse -->
			</div>
			<!-- /.container-fluid -->
		</nav>
		<header id="intro">
			<div class="container" id="seccionInicial">
				<div class="table">
					<div class="header-text">
						<form class="reg-fel-form" method="POST" action="{{ route('login') }}" >
							{{ csrf_field() }}
							<div class="row">
								<div class="col-md-6 col-lg-6">
									<input type="text" class="form-control form-white" placeholder="Nombres" required autofocus>
								</div>
								<div class="col-md-6 col-lg-6">
									<input type="text" class="form-control form-white" required placeholder="Apellidos">
								</div>
								<div class="col-md-6 col-lg-6">
									<input type="email" class="form-control form-white" required placeholder="E-mail">
								</div>
								<div class="col-md-6 col-lg-6">
									<input type="number" class="form-control form-white" required placeholder="telefono">
								</div>
								<div class="col-md-6 col-lg-6">
									<input type="date" class="form-control form-white" id="fechaNacimiento" required placeholder="Fecha de nacimiento">
								</div>
								<div class="col-md-6 col-lg-6">
									<div class="checkbox-holder text-left">
										<div class="checkbox">
											<input type="checkbox" value="None" id="squaredOne" name="remember" {{ old('remember') ? 'checked' : '' }} />
											<label for="squaredOne"><span>Recibir notificacion</span></label>
										</div>
									</div>
									<small>Recibir notificacion referentes a la parroquia, avisos parroquiales, eventos ecleciasticos, mensajes de "saludo del parroco", el tren, horarios de eventos importantes.</small>
								</div>
							</div>
							<button type="submit" class="btn btn-submit">Iniciar sesión</button>
						</form>
					</div>
				</div>
			</div>
		</header>
		<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content modal-popup">
					<a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
					<h3 class="white">Iniciar sesión</h3>
					<form class="popup-form" method="POST" action="{{ route('login') }}" >
						{{ csrf_field() }}
						<input id="email" type="email" class="form-control form-white" name="email" placeholder="Usuario" value="{{ old('email') }}" required autofocus>
						<input id="password" type="password" class="form-control form-white" name="password" required placeholder="Contraseña">
						<div class="checkbox-holder text-left">
							<div class="checkbox">
								<input type="checkbox" value="None" id="wdawd" name="remember" {{ old('remember') ? 'checked' : '' }} />
								<label for="wdawd"><span>Recordarme</span></label>
							</div>
						</div>
						<button type="submit" class="btn btn-submit">Iniciar sesión</button>
					</form>
				</div>
			</div>
		</div>
		<footer>
			<div class="container">
				<div class="row">
					<div class="col-sm-6 text-center-mobile">
						<h3 class="white">Sistema gestor de documentos ecleciasticos</h3>
						<h5 class="light regular light-white">Sistematizacion de procesos con documentos ecleciasticos</h5>
						<a href="#" class="btn btn-blue ripple trial-button">Solicitar presentacion</a>
					</div>
					<div class="col-sm-6 text-center-mobile">
						<h3 class="white">Horario de atencion <span class="open-blink"></span></h3>
						<div class="row opening-hours">
							<div class="col-sm-6 text-center-mobile">
								<h5 class="light-white light">Lun - Vier</h5>
								<h3 class="regular white">8:00 - 18:00</h3>
							</div>
							<div class="col-sm-6 text-center-mobile">
								<h5 class="light-white light">Sabados</h5>
								<h3 class="regular white">8:00 - 12:00</h3>
							</div>
						</div>
					</div>
				</div>
				<div class="row bottom-footer text-center-mobile">
					<div class="col-sm-8">
						<p>&copy; 2018 All Rights Reserved.Theme by <a href="http://tympanus.net/codrops/">Codrops.</a> Developed by Jonatan Villalobos</p>
					</div>
					<div class="col-sm-4 text-right text-center-mobile">
						<ul class="social-footer">
							<li><a href="http://www.facebook.com/pages/Codrops/159107397912"><i class="fa fa-facebook"></i></a></li>
							<li><a href="http://www.twitter.com/codrops"><i class="fa fa-twitter"></i></a></li>
							<li><a href="https://plus.google.com/101095823814290637419"><i class="fa fa-google-plus"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</footer>
		<!-- Holder for mobile navigation -->
		<div class="mobile-nav">
			<ul>
			</ul>
			<a href="#" class="close-link"><i class="arrow_up"></i></a>
		</div>
		<!-- Scripts -->
		<script src="{{ asset('front-end/js/jquery-1.11.1.min.js') }}"></script>
		<script src="{{ asset('front-end/js/owl.carousel1.min.js') }}"></script>
		<script src="{{ asset('front-end/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('front-end/js/wow.min.js') }}"></script>
		<script src="{{ asset('front-end/js/typewriter.js') }}"></script>
		<script src="{{ asset('front-end/js/jquery.onepagenav.js') }}"></script>
		<script src="{{ asset('front-end/js/main.js') }}"></script>
		<script src="{{ asset('front-end/js/moment.min.js') }}"></script>
		<script src="{{ asset('front-end/js/moment-with-locales.min.js') }}"></script>
		<script src="{{ asset('front-end/js/bootstrap-material-datetimepicker.js') }}"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.3/vue.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/vue-resource@1.3.4"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
		<script src="{{ asset('administracion/js/vueConfig.js') }}"></script>
		<script>
			var vueInicial = new Vue({
		    el: '#seccionInicial',
		    data: {
		        numDia: moment().format("E"),
		        horariosEucaristias: []
		    },
		    methods: {
		    },
		    mounted: function() {
		    	
		        moment.locale("es");
		    },
		    updated: function() {
		    }
		});
		</script>
	</body>
</html>