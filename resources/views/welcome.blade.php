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
        <div class="container">
            <div class="table">
                <div class="header-text">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h3 class="light white">Parroquia Sagrada Familia de Fusagasuga</h3>
                            <!--<h1 class="white typed">{{ config('app.name') }}</h1>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section id="seccionInicial">
        <div class="cut cut-top"></div>
        <div class="container">
            <div class="row intro-tables">
                <div class="col-md-4">
                    <div class="intro-table intro-table-first">
                        <h5 class="white heading">Horario de eucaristia</h5>
                        <div id="horarioCarousel" class="owl-schedule owl-carousel owl-height ">
                            <div v-for="(dias,index) in horariosEucaristias" class="item">
                                <div class="schedule-row row">
                                    <div class="col-xs-12">
                                        <h5 class="regular white">@{{ fechaHorario(index) }}</h5>
                                    </div>
                                </div>
                                <div v-for="horas in dias" class="schedule-row row">
                                    <div class="col-xs-6">
                                        <h5 class="regular white">@{{ horas.lugar_eucaristia.descripcion }}</h5>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <h5 class="white">@{{ transformarHora(horas.hora_eucaristia) }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="intro-table intro-table-hover">
                        <h5 class="white heading hide-hover">Comunidad</h5>
                        <div class="">
                            <h4 class="white heading small-heading no-margin regular">Registrate</h4>
                            <h4 class="white heading small-pt">Pertenesco a esta comunidad parroquial</h4>
                            <a href="#" data-toggle="modal" data-target="#modalRegistro" class="btn btn-white-fill expand">Registrar</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="intro-table intro-table-third">
                        <h5 class="white heading">Comentarios feligres</h5>
                        <div id="owlTestimonial" class="owl-testimonials">
                            <div class="item">
                                <h4 class="white heading content">Mi parroquia donde espiritualmente me alimento gracias Dios mio por los sacerdotes por la organizacion etc.</h4>
                                <h5 class="white heading light author">Amparo Saavedra</h5>
                            </div>
                            <div class="item">
                                <h4 class="white heading content">El mejor viacrucis se vivio en esta parroquia ...las misas y el sonido son excelentes</h4>
                                <h5 class="white heading light author">Martha Amaya</h5>
                            </div>
                            <div class="item">
                                <h4 class="white heading content">Son muy bonitas las misas y la iglesia</h4>
                                <h5 class="white heading light author">Laura Sarmiento</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="services" class="section section-padded">
        <div class="container">
            <div class="row text-center title">
                <h2>Servicios</h2>
                <h4 class="light muted">Despacho parroquial, direccion espirutual, atencion sacerdotal</h4>
            </div>
            <div class="row services">
                <div class="col-md-4">
                    <div class="service">
                        <div class="icon-holder">
                            <img src="{{ asset('front-end/img/icons/heart-blue.png') }}" alt="" class="icon">
                        </div>
                        <h4 class="heading">Despacho Parroquial</h4>
                        <p class="description">Partidas, Certificaciones, Libros liturgicos, Cirios, Camandulas/Denarios, Imagenes, Medalleria Liturgica</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service">
                        <div class="icon-holder">
                            <img src="{{ asset('front-end/img/icons/guru-blue.png') }}" alt="" class="icon">
                        </div>
                        <h4 class="heading">Criptas</h4>
                        <p class="description">Osarios: cajon, placa, timbre de placa, instalacion de placa.<br>Cenizarios: placa, timbre de placa, instalacion de placa</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service">
                        <div class="icon-holder">
                            <img src="{{ asset('front-end/img/icons/weight-blue.png') }}" alt="" class="icon">
                        </div>
                        <h4 class="heading">Atencion Sacerdotal</h4>
                        <p class="description">Confesiones, Visitas a enfermos, Atencion espiritual</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="cut cut-bottom"></div>
    </section>
    <section id="team" class="section gray-bg">
        <div class="container">
            <div class="row title text-center">
                <h2 class="margin-top">Equipo</h2>
                <h4 class="light muted">Equipo parroquial</h4>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="team text-center">
                        <div class="cover" style="background:url('{{ asset('front-end/img/team/team-cover1.jpg') }}'); background-size:cover;">
                            <div class="overlay text-center">
                                <h3 class="white">13 años</h3>
                                <h5 class="light light-white">de ordenacion sacerdotal</h5>
                            </div>
                        </div>
                        <img src="{{ asset('front-end/img/team/team3.jpg') }}" alt="Team Image" class="avatar">
                        <div class="title">
                            <h4>Fray lucas </h4>
                            <h5 class="muted regular">Parroco</h5>
                        </div>
                        <button data-toggle="modal" data-target="#modalMensaje" id="mensajePadreLucas" class="btn btn-blue-fill">Enviar mensaje</button>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="team text-center">
                        <div class="cover" style="background:url('{{ asset('front-end/img/team/team-cover2.jpg') }}'); background-size:cover;">
                            <div class="overlay text-center">
                                <h3 class="white">1 años</h3>
                                <h5 class="light light-white">Ordenacion sacerdotal</h5>
                            </div>
                        </div>
                        <img src="{{ asset('front-end/img/team/team1.jpg') }}" alt="Team Image" class="avatar">
                        <div class="title">
                            <h4>Sebastian</h4>
                            <h5 class="muted regular">Vicario parroquial</h5>
                        </div>
                        <a href="#" data-toggle="modal" data-target="#modalMensaje"  id="mensajePadreSebastian" class="btn btn-blue-fill ripple">Enviar mensaje</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="team text-center">
                        <div class="cover" style="background:url('{{ asset('front-end/img/team/team-cover3.jpg') }}'); background-size:cover;">
                            <div class="overlay text-center">
                                <h3 class="white">3 años</h3>
                                <h5 class="light light-white">Ordenacion sacerdotal</h5>
                            </div>
                        </div>
                        <img src="{{ asset('front-end/img/team/team2.jpg') }}" alt="Team Image" class="avatar">
                        <div class="title">
                            <h4>Francisco</h4>
                            <h5 class="muted regular">Vicario parroquial</h5>
                        </div>
                        <a href="#" data-toggle="modal" data-target="#modalMensaje" id="mensajePadreFrancisco" class="btn btn-blue-fill ripple">Enviar mensaje</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="team text-center">
                        <div class="cover" style="background:url('{{ asset('front-end/img/team/team-cover1.jpg') }}'); background-size:cover;">
                            <div class="overlay text-center">
                                <h3 class="white">13 años</h3>
                                <h5 class="light light-white">de ordenacion sacerdotal</h5>
                            </div>
                        </div>
                        <img src="{{ asset('front-end/img/team/team3.jpg') }}" alt="Team Image" class="avatar">
                        <div class="title">
                            <h4>Farid </h4>
                            <h5 class="muted regular">Vicario parroquial</h5>
                        </div>
                        <button data-toggle="modal" data-target="#modalMensaje"  id="mensajePadreFarid" class="btn btn-blue-fill">Enviar mensaje</button>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="team text-center">
                        <div class="cover" style="background:url('{{ asset('front-end/img/team/team-cover1.jpg') }}'); background-size:cover;">
                            <div class="overlay text-center">
                                <h3 class="white">13 años</h3>
                                <h5 class="light light-white">de diacono</h5>
                            </div>
                        </div>
                        <img src="{{ asset('front-end/img/team/team3.jpg') }}" alt="Team Image" class="avatar">
                        <div class="title">
                            <h4>Rodolfo guacaneme</h4>
                            <h5 class="muted regular">Diacono permanente</h5>
                        </div>
                        <button data-toggle="modal" data-target="#modalMensaje" id="mensajeDiacono"  class="btn btn-blue-fill">Enviar mensaje</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="pricing" class="section">
        <div class="container">
            <div class="row title text-center">
                <h2 class="margin-top white">Arancel eclesiastico</h2>
                <h4 class="light white">Decreto xxx de 2016 de la diocesis de girardota</h4>
            </div>
            <div class="row no-margin">
                <div class="col-md-7 no-padding col-md-offset-5 pricings text-center">
                    <div class="pricing">
                        <div class="box-main active" data-img="{{ asset('front-end/img/pricing1.jpg') }}">
                            <h4 class="white">Eucaristias</h4>
                            <h4 class="white regular light">$30.000 <span class="small-font"> -  en Hora habitual</span></h4>
                            <a href="#" data-toggle="modal" data-target="#modalMasInfoEucaristias" class="btn btn-white-fill">Mas informacion</a>
                            <i class="info-icon icon_question"></i>
                        </div>
                        <div class="box-second active">
                            <ul class="white-list text-left">
                                <li>Eucaristias comunitarias</li>
                                <li>Sacramento del bautismo <a href="#" data-toggle="modal" data-target="#modalMasInfoBautismos" class="white close-link"><i class="icon_info_alt"></i></a></li>
                                <li>Matrimonios <a href="#" data-toggle="modal" data-target="#modalMasInfoMatrimonios" class="white close-link"><i class="icon_info_alt"></i></a></li>
                                <li>Exequias</li>
                                <li>Osarios <a href="#" data-toggle="modal" data-target="#modalMasInfoOsarios" class="white close-link"><i class="icon_info_alt"></i></a></li>
                                <li>Cenizarios <a href="#" data-toggle="modal" data-target="#modalMasInfoCenizarios" class="white close-link"><i class="icon_info_alt"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="pricing">
                        <div class="box-main" data-img="{{ asset('front-end/img/pricing2.jpg') }}">
                            <h4 class="white">Despacho parroquial</h4>
                            <h4 class="white regular light">$10.000 <span class="small-font">/ documento ecleciastico</span></h4>
                            <a href="#" data-toggle="modal" data-target="#masInfoDespacho" class="btn btn-white-fill">Mas informacion</a>
                            <i class="info-icon icon_question"></i>
                        </div>
                        <div class="box-second">
                            <ul class="white-list text-left">
                                <li>Partidas de bautismo</li>
                                <li>Partidas de confirmacion</li>
                                <li>Partidas de matrimonio</li>
                                <li>Certificados negativos</li>
                                <li>Cirios</li>
                                <li>Libros liturgicos</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-padded blue-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="owl-twitter owl-carousel">
                        <div class="item text-center">
                            <i class="icon fa fa-twitter"></i>
                            <h4 class="white light">Dios nos pide poco y nos da mucho. Nos pide un corazón abierto para acogerle a Él y a los hermanos más débiles..</h4>
                            <h4 class="light-white light">@Pontifex_es</h4>
                        </div>
                        <div class="item text-center">
                            <i class="icon fa fa-twitter"></i>
                            <h4 class="white light">Mientras rezo incesantemente por la paz, e invito a todas las personas de buena voluntad a continuar haciendo lo mismo, hago un llamamiento de nuevo a todos los responsables políticos para que prevalezcan la justicia y la paz.</h4>
                            <h4 class="light-white light">@Pontifex_es</h4>
                        </div>
                        <div class="item text-center">
                            <i class="icon fa fa-twitter"></i>
                            <h4 class="white light">El cristiano, por vocación, es hermano de todos los hombres, especialmente si son pobres, y también de los enemigos.</h4>
                            <h4 class="light-white light">@Pontifex_es</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="seccionDatos">
    <div class="modal fade" id="modalRegistro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-popup">
                <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
                <h3 class="white">Registrar</h3>
                <form class="popup-form">
                    {{ csrf_field() }}
                    <input type="text" v-model="feligres.nombre" class="form-control form-white" placeholder="Nombres" required autofocus>
                    <input type="text" v-model="feligres.apellido" class="form-control form-white" required placeholder="Apellidos">
                    <input type="email" v-model="feligres.email" class="form-control form-white" required placeholder="E-mail">
                    <input type="number" v-model="feligres.telefono" class="form-control form-white" required placeholder="telefono">
                    <input type="date" v-model="feligres.fecha_nacimiento" class="form-control form-white" id="fechaNacimiento" required placeholder="Fecha de nacimiento">
                    <div class="checkbox-holder text-left">
                        <div class="checkbox">
                            <input type="checkbox" value="None"  v-model="feligres.recibir_notificacion" id="recibirNotificacion" name="remember" />
                            <label for="recibirNotificacion"><span>Recibir notificacion</span></label>
                        </div>
                    </div>
                    <small>Recibir notificacion referentes a la parroquia, avisos parroquiales, eventos ecleciasticos, mensajes de "saludo del parroco", el tren, horarios de eventos importantes.</small>
                    <button v-on:click.prevent="registrarFeligres" class="btn btn-submit">Registrar</button>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalMensaje" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-popup">
                <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
                <h3 class="white">Enviar mensaje a @{{ mensaje.sacerdote }}</h3>
                <form class="popup-form" method="POST" action="{{ route('login') }}" >
                    {{ csrf_field() }}
                <input type="text" v-model="mensaje.nombre" class="form-control form-white" required placeholder="Nombre">
                    <textarea v-model="mensaje.mensaje" class="form-control form-white" placeholder="Mensaje"></textarea>
                    <button v-on:click.prevent="guardarMensaje" class="btn btn-submit">Enviar</button>
                </form>
            </div>
        </div>
    </div>
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
                            <input type="checkbox" value="None" id="squaredOne" name="remember" {{ old('remember') ? 'checked' : '' }} />
                            <label for="squaredOne"><span>Recordarme</span></label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-submit">Iniciar sesión</button>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalMasInfoEucaristias" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-popup">
                <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
                <div class="align-left">
                <h3 class="white">Eucaristias comunitarias</h3>
                <p class="white">Las eucaristias comunitarias se celebran todos los <strong>Sabados 6:00 P.M.</strong> y <strong>Domingos 12:00 M.</strong> $6.000 cada alma o cada intencion</p>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalMasInfoBautismos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-popup">
                <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
                <h3 class="white">Sacramento del bautismo</h3>
                <p class="white align-left">Requisitos para el sacramento del bautismo menores de 7 años.<br>
                    <strong>Documentos:</strong><br>
                    <ul class="white-list text-left">
                        <li>Registro civil de nacimiento del niño.</li>
                        <li>Fotocopia de la cédula de los padres y padrinos.</li>
                        <li>Nombre de los abuelos paternos y maternos (por escrito como están en la cédula).</li>
                        <li>una ofrenda de $20.000, se debe llevar al despacho parroquial, de lunes a viernes antes del cursillo para sentar la partida.</li>
                        <li>Pertenecer al territorio de la Parroquia Sagrada Familia de Fusagasuga </li>
                        <li>Celebración de bautismos segundo y cuarto sábado de cada mes en la Eucaristía de las 2:00 de la tarde.en el templo Parroquial </li>
                        <li>Curso pre-bautismal para padres y padrinos, primer o tercer sábado de 9:00 a.m. a 1:00 p.m. en la capilla Fusacatan.</li>
                        <li>Los padrinos deben ser casados por lo católico o solteros.</li>
                    </ul>
                </p>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalMasInfoMatrimonios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-popup">
                <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
                <h3 class="white">Sacramento del matrimonio</h3>
                <p class="white align-left">Requisitos para el sacramento del matrimonio<br>
                    <strong>Documentos:</strong><br>
                    <ul class="white-list text-left">
                        <li>Partida de Bautismo.</li>
                        <li>Partida de confirmación. </li>
                        <li>Registro Civil.</li>
                        <li>Fotocopia de la cédula. </li>
                        <li>Dos fotos a color  3 x 4 cm.</li>
                        <li>Constancia del curso prematrimonial.</li>
                        <li>Si tienen hijos y son bautizados anexar las partidas de bautismo de lo contrario el registro cvil de nacimiento.</li>
                        <li>Fotocopia de la Cédula de los padrinos.</li>
                        <li>Todos los documentos deben de estar como mínimo 30 días antes de la fecha del matrimonio.</li>
                    </ul>
                    <br>
                    <div class="white">NOTA: todos los documentos deben ser recientes y originales, si las partidas no pertenecen a esta Diócesis deben venir autenticadas por la Diócesis a donde pertenecen.</div>
                </p>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalMasInfoOsarios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-popup">
                <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
                <h3 class="white">Osarios</h3>
                <p class="white align-left">Servicios incluidos.<br>
                    <ul class="white-list text-left">
                        <li>Cajón</li>
                        <li>Placa</li>
                        <li>Timbre de placa</li>
                        <li>Instalación de placa</li>
                    </ul>
                    <br>
                    <div class="white">
                        NOTA: Los osarios se venden Diez (10) días antes de la fecha de exhumación, se debe traer:<br>
                        Nombre completo del fallecido, fecha de nacimiento, fecha de fallecimiento y el numero de Cédula de la persona que queda como arrendatario del osario.<br>
                        Anualmente deben cancelar una cuota de $30.000 por mantenimiento y administración 
                    </div>
                </p>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalMasInfoCenizarios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-popup">
                <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
                <h3 class="white">Cenizarios</h3>
                <p class="white align-left">Servicios incluidos.<br>
                    <ul class="white-list text-left">
                        <li>Placa</li>
                        <li>Timbre de placa</li>
                        <li>Instalación de placa</li>
                    </ul>
                    <br>
                    <div class="white">
                        NOTA: Traer el nombre completo del fallecido, fecha de nacimiento y de fallecimiento y el numero de Cédula de la persona que queda como arrendatario del cenizario.<br>
                        Anualmente deben cancelar una cuota de $30.000 por mantenimiento y administración
                    </div>
                </p>
            </div>
        </div>
    </div>
    <div class="modal fade" id="masInfoDespacho" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-popup">
                <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
                <h3 class="white">Despacho parroquial</h3>
                <p class="white align-left">
                    Las partidas de bautismo, comunion y confirmacion se entregan 1 dia habil despues de la radicacion, para poder reclamar el documento es necesario el recibo entregado en el despacho parroquial.
                    <p class="white">
                        Horario de atencion:<br>
                        <ul class="white-list text-left">
                            <li>Lunes a Viernes: 8:00 A.M. - 12:00 M y 2:00 P.M. - 5:00 P.M.</li>
                            <li>Sabados: 8:00 A.M. - 1:00 P.M.</li>
                            <li>Domingos y festivos no hay atencion</li>
                        </ul>                        
                    </p>
                    <br>
                    <div class="white">Telefono: 871 62 73 - 320 894 6407</div>
                </p>
            </div>
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
                            <h3 class="regular white">8:00 - 1:00</h3>
                        </div>
                    </div>
                    <div class="row opening-hours">
                        <div class="col-sm-12 text-center-mobile">
                            <h5 class="light-white light">Telefonos de contacto</h5>
                            <h3 class="regular white">871 62 73 - 320 894 6407</h3>
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
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.3/vue.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.3.4"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="{{ asset('administracion/js/vueConfig.js') }}"></script> 
    <script>
    var vueInicial = new Vue({
        el: '#seccionInicial',
        data: {
            numDia:moment().format("E"),
            horariosEucaristias:[],
        },
        methods: {
            getHorariosEucaristias:function(){
                this.$http.get('/horario-eucaristias/'+this.numDia).then((response) => {
                    console.log(response.body);
                    this.horariosEucaristias=response.body;
                }, (error) => { 
                    console.log(error);
                    toastr.error(error.status + ' ' + error.statusText + ' (' + error.url + ')');
                });
            },
            transformarHora:function(hora){
                console.log(moment(hora,"HH:mm:ss").format("hh:mm:ss A"));
                return moment(hora,"HH:mm:ss").format("hh:mm A");
            },
            fechaHorario:function(index){
                dia="";
                console.log(index);

                console.log(moment().format("E"));
                if (index=="dia1") {
                    dia=moment().format("E");
                }
                if (index=="dia2") {
                    if ((parseInt(moment().format("E"))+1)>7) {
                        dia="1";   
                    }else{
                        dia=parseInt(moment().format("E"))+1;
                    }
                }
                if (index=="dia3") {
                    if ((parseInt(moment().format("E"))+2)>7) {
                        if ((parseInt(moment().format("E"))+2)==8) {
                            dia="1";  
                        }else{
                            dia="2";
                        }  
                    }else{
                        dia=parseInt(moment().format("E"))+2;
                    }
                }
                console.log(dia);
                if (dia=="1") {
                    return "Lunes";
                }
                if (dia=="2") {
                    return "Martes";
                }
                if (dia=="3") {
                    return "Miercoles";
                }
                if (dia=="4") {
                    return "Jueves";
                }
                if (dia=="5") {
                    return "Viernes";
                }
                if (dia=="6") {
                    return "Sabado";
                }
                if (dia=="7") {
                    return "Domingo";
                }
                return "";
            }   
        },
        mounted:function(){
            moment.locale("es");
            this.getHorariosEucaristias();
        },
        updated: function(){   
            console.log('updated');         
            $('#horarioCarousel').owlCarousel({
                singleItem: true,
                pagination: false,
                autoPlay:5000,
                stopOnHover:true,
                autoHeight:true
            });
        }
    });

    </script>
    <script type="text/javascript">
    var vueInicial = new Vue({
        el: '#seccionDatos',
        data: {
            feligres:{
                id:'',
                nombre:'',
                apellido:'',
                fecha_nacimiento:'',
                email:'',
                telefono:'',
                recibir_notificacion:false
            },
            mensaje:{
                nombre:'',
                mensaje:'',
                sacerdote:''
            }
        },
        methods: {
            registrarFeligres:function(){
                if (this.feligres.nombre.length==0) {
                    toastr.warning('Por favor digite su nombre');
                    return
                }
                if (this.feligres.apellido.length==0) {
                    toastr.warning('Por favor digite su apellido');
                    return
                }
                if (this.feligres.fecha_nacimiento.length==0) {
                    toastr.warning('Por favor seleccione una fecha de nacimiento');
                    return
                }
                this.$http.post('/registrar-feligres',this.feligres).then((response) => {
                    console.log(response.body);
                    if (response.body.estado == 'validador') {
                        jQuery.each(response.body.errors, function(i, value) {
                            toastr.warning(value)
                        })
                    } else {
                        if (response.body.estado == 'ok') {
                            if (response.body.tipo == 'update') {
                                toastr.success('Feligres actualizado con exito');
                                this.formReset();
                            }
                            if (response.body.tipo == 'save') {
                                this.formReset();
                                toastr.success('Feligres registrado con exito');
                            }
                        }else{
                            toastr.error('Error interno');
                        }
                    }
                }, (error) => {
                    console.log(error);
                    toastr.error(error.status + ' ' + error.statusText + ' (' + error.url + ')');
                });
            },
            formReset:function(){
                this.feligres={
                    id:'',
                    nombre:'',
                    apellido:'',
                    fecha_nacimiento:'',
                    email:'',
                    telefono:'',
                    recibir_notificacion:false
                };
                this.mensaje={
                    nombre:'',
                    mensaje:'',
                    sacerdote:''
                };
            },
            guardarMensaje:function(){
                if (this.mensaje.nombre.length==0) {
                    toastr.warning('Por favor digite su nombre');
                    return
                }
                if (this.mensaje.mensaje.length==0) {
                    toastr.warning('Por favor digite el mensaje que desea enviar');
                    return
                }
                this.$http.post('/registrar-mensaje-feligres',this.mensaje).then((response) => {
                    console.log(response.body);
                    if (response.body.estado == 'validador') {
                        jQuery.each(response.body.errors, function(i, value) {
                            toastr.warning(value)
                        })
                    } else {
                        if (response.body.estado == 'ok') {
                            if (response.body.tipo == 'update') {
                                toastr.success('Mensaje actualizado correctamente');
                                this.formReset();
                            }
                            if (response.body.tipo == 'save') {
                                this.formReset();
                                toastr.success('Mensaje registrado con exito');
                            }
                        }else{
                            toastr.error('Error interno');
                        }
                    }
                }, (error) => {
                    console.log(error);
                    toastr.error(error.status + ' ' + error.statusText + ' (' + error.url + ')');
                });
            }
        },
        mounted:function(){
            entorno=this;
            $('#mensajePadreLucas').click(function(){
                entorno.mensaje.sacerdote='Fray Lucas';
            });
            $('#mensajePadreSebastian').click(function(){
                entorno.mensaje.sacerdote='Sebastian';
            });
            $('#mensajePadreFrancisco').click(function(){
                entorno.mensaje.sacerdote='Francisco';
            });
            $('#mensajePadreFarid').click(function(){
                entorno.mensaje.sacerdote='Farid';
            });
            $('#mensajeDiacono').click(function(){
                entorno.mensaje.sacerdote='Diacono';
            });
        },
        updated: function(){ 
        }
    });

    </script>
</body>

</html>
