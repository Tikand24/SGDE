<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Material Admin</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>GIH - @yield('title') </title>
        <!-- Vendor CSS -->
        <link href="{{ asset('administracion/vendors/bower_components/fullcalendar/dist/fullcalendar.min.css') }}" rel="stylesheet">
        <link href="{{ asset('administracion/vendors/bower_components/animate.css/animate.min.css') }}" rel="stylesheet">
        <link href="{{ asset('administracion/vendors/bower_components/sweetalert/dist/sweetalert.css') }}" rel="stylesheet">
        <link href="{{ asset('administracion/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css') }}" rel="stylesheet">
        <link href="{{ asset('administracion/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css') }}" rel="stylesheet">

        <!-- CSS -->
        <link href="{{ asset('administracion/css/app_1.min.css') }}" rel="stylesheet">
        <link href="{{ asset('administracion/css/app_2.min.css') }}" rel="stylesheet">
@yield('estilos')
    </head>
    <body>
        <header id="header" class="clearfix" data-ma-theme="blue">
            @include('layouts.navbar')
        </header>
        <section id="main">
            @include('layouts.leftbar')
            <section id="content">
                @yield('contenido')
            </section>
        </section>

        <footer id="footer">
            Copyright &copy; 2015 Material Admin

            <ul class="f-menu">
                <li><a href="">Home</a></li>
                <li><a href="">Dashboard</a></li>
                <li><a href="">Reports</a></li>
                <li><a href="">Support</a></li>
                <li><a href="">Contact</a></li>
            </ul>
        </footer>

        <!-- Page Loader -->
        <div class="page-loader">
            <div class="preloader pls-blue">
                <svg class="pl-circular" viewBox="25 25 50 50">
                    <circle class="plc-path" cx="50" cy="50" r="20" />
                </svg>

                <p>Please wait...</p>
            </div>
        </div>

        <!-- Older IE warning message -->
        <!--[if lt IE 9]>
            <div class="ie-warning">
                <h1 class="c-white">Warning!!</h1>
                <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
                <div class="iew-container">
                    <ul class="iew-download">
                        <li>
                            <a href="http://www.google.com/chrome/">
                                <img src="img/browsers/chrome.png" alt="">
                                <div>Chrome</div>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.mozilla.org/en-US/firefox/new/">
                                <img src="img/browsers/firefox.png" alt="">
                                <div>Firefox</div>
                            </a>
                        </li>
                        <li>
                            <a href="http://www.opera.com">
                                <img src="img/browsers/opera.png" alt="">
                                <div>Opera</div>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.apple.com/safari/">
                                <img src="img/browsers/safari.png" alt="">
                                <div>Safari</div>
                            </a>
                        </li>
                        <li>
                            <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                                <img src="img/browsers/ie.png" alt="">
                                <div>IE (New)</div>
                            </a>
                        </li>
                    </ul>
                </div>
                <p>Sorry for the inconvenience!</p>
            </div>
        <![endif]-->

        <!-- Javascript Libraries -->
        <script src="{{ asset('administracion/vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('administracion/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

        <script src="{{ asset('administracion/vendors/bower_components/flot/jquery.flot.js') }}"></script>
        <script src="{{ asset('administracion/vendors/bower_components/flot/jquery.flot.resize.js') }}"></script>
        <script src="{{ asset('administracion/vendors/bower_components/flot.curvedlines/curvedLines.js') }}"></script>
        <script src="{{ asset('administracion/vendors/sparklines/jquery.sparkline.min.js') }}"></script>
        <script src="{{ asset('administracion/vendors/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js') }}"></script>

        <script src="{{ asset('administracion/vendors/bower_components/moment/min/moment.min.js') }}"></script>
        <script src="{{ asset('administracion/vendors/bower_components/fullcalendar/dist/fullcalendar.min.js ') }}"></script>
        <script src="{{ asset('administracion/vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js') }}"></script>
        <script src="{{ asset('administracion/vendors/bower_components/Waves/dist/waves.min.js') }}"></script>
        <script src="{{ asset('administracion/vendors/bootstrap-growl/bootstrap-growl.min.js') }}"></script>
        <script src="{{ asset('administracion/vendors/bower_components/sweetalert/dist/sweetalert.min.js') }}"></script>
        <script src="{{ asset('administracion/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>

        <!-- Placeholder for IE9 -->
        <!--[if IE 9 ]>
            <script src="vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>
        <![endif]-->

        <script src="{{ asset('administracion/js/app.min.js') }}"></script>
        @yield('scripts')
    </body>
  </html>