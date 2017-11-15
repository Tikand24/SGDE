@extends('layouts.app')

@section('title','Inicio')

@section('contenido')
<div class="container">
	<div class="block-header">
		<h2>Panel de administracion</h2>
	</div>
	<div class="card">
		<div class="card-header">
			<h2>Estadistica de ventas <small>Ventas de almacen y sacristia</small></h2>
		</div>
		<div class="card-body">
			<div class="chart-edge">
				<div id="curved-line-chart" class="flot-chart "></div>
			</div>
		</div>
	</div>

	<div class="mini-charts">
		<div class="row">
			<div class="col-sm-6 col-md-3">
				<div class="mini-charts-item bgm-lightgreen">
					<div class="clearfix">
						<div class="chart stats-bar"></div>
						<div class="count">
							<small>Bautisados</small>
							<h2>987,459</h2>
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-6 col-md-3">
				<div class="mini-charts-item bgm-purple">
					<div class="clearfix">
						<div class="chart stats-bar-2"></div>
						<div class="count">
							<small>Comuniones</small>
							<h2>356,785K</h2>
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-6 col-md-3">
				<div class="mini-charts-item bgm-orange">
					<div class="clearfix">
						<div class="chart stats-line"></div>
						<div class="count">
							<small>Confirmados</small>
							<h2>$ 458,778</h2>
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-6 col-md-3">
				<div class="mini-charts-item bgm-bluegray">
					<div class="clearfix">
						<div class="chart stats-line-2"></div>
						<div class="count">
							<small>Matrimonios</small>
							<h2>23,856</h2>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="dash-widgets">
		<div class="row">
			<div class="col-md-4 col-sm-6">
				<div id="site-visits" class="dw-item bgm-teal">
					<div class="dwi-header">
						<div class="p-30">
							<div class="dash-widget-visits"></div>
						</div>

						<div class="dwih-title">En los pasados 30 dias</div>
					</div>

					<div class="list-group lg-even-white">
						<div class="list-group-item media sv-item">
							<div class="pull-right">
								<div class="stats-bar"></div>
							</div>
							<div class="media-body">
								<small>Visitas a la pagina</small>
								<h3>47,896,536</h3>
							</div>
						</div>

						<div class="list-group-item media sv-item">
							<div class="pull-right">
								<div class="stats-bar-2"></div>
							</div>
							<div class="media-body">
								<small>Consultas de horarios</small>
								<h3>24,456,799</h3>
							</div>
						</div>

						<div class="list-group-item media sv-item">
							<div class="pull-right">
								<div class="stats-line"></div>
							</div>
							<div class="media-body">
								<small>Consultas generales</small>
								<h3>13,965</h3>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4 col-sm-6">
				<div id="pie-charts" class="dw-item bgm-cyan c-white">

					<div class="dw-item">
						<div class="dwi-header">
							<div class="dwih-title">Estadisticas de emails</div>
						</div>

						<div class="clearfix"></div>

						<div class="text-center p-20 m-t-25">
							<div class="easy-pie main-pie" data-percent="75">
								<div class="percent">45</div>
								<div class="pie-title">Emails totales enviados</div>
							</div>
						</div>

						<div class="p-t-25 p-b-20 text-center">
							<div class="easy-pie sub-pie-1" data-percent="56">
								<div class="percent">56</div>
								<div class="pie-title">Enviados</div>
							</div>
							<div class="easy-pie sub-pie-2" data-percent="84">
								<div class="percent">84</div>
								<div class="pie-title">Abiertos</div>
							</div>
							<div class="easy-pie sub-pie-2" data-percent="21">
								<div class="percent">21</div>
								<div class="pie-title">Ignorados</div>
							</div>
						</div>
					</div>

				</div>
			</div>

			<div class="col-md-4 col-sm-6">
				<div class="dw-item bgm-lime">
					<div id="weather-widget"></div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-6">
			<!-- Recent Items -->
			<div class="card">
				<div class="card-header">
					<h2>Recent Items <small>Phasellus condimentum ipsum id auctor imperdie</small></h2>
					<ul class="actions">
						<li class="dropdown">
							<a href="" data-toggle="dropdown">
								<i class="zmdi zmdi-more-vert"></i>
							</a>

							<ul class="dropdown-menu dropdown-menu-right">
								<li>
									<a href="">Refresh</a>
								</li>
								<li>
									<a href="">Settings</a>
								</li>
								<li>
									<a href="">Other Settings</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>

				<div class="card-body m-t-0">
					<table class="table table-inner table-vmiddle">
						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th style="width: 60px">Price</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="f-500 c-cyan">2569</td>
								<td>Samsung Galaxy Mega</td>
								<td class="f-500 c-cyan">$521</td>
							</tr>
							<tr>
								<td class="f-500 c-cyan">9658</td>
								<td>Huawei Ascend P6</td>
								<td class="f-500 c-cyan">$440</td>
							</tr>
							<tr>
								<td class="f-500 c-cyan">1101</td>
								<td>HTC One M8</td>
								<td class="f-500 c-cyan">$680</td>
							</tr>
							<tr>
								<td class="f-500 c-cyan">6598</td>
								<td>Samsung Galaxy Alpha</td>
								<td class="f-500 c-cyan">$870</td>
							</tr>
							<tr>
								<td class="f-500 c-cyan">4562</td>
								<td>LG G3</td>
								<td class="f-500 c-cyan">$690</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div id="recent-items-chart" class="flot-chart"></div>
			</div>

			<!-- Todo -->
			<div id="todo" class="card card-light">
				<div class="card-header ch-alt">
					<h2>Todo Lists <small>Add, edit and manage your Todo Lists</small></h2>
				</div>

				<div class="card-body card-padding">
					<div class="t-add">
						<i class="ta-btn zmdi zmdi-plus" data-ma-action="todo-form-open"></i>

						<div class="ta-block">
							<textarea placeholder="What you want to do..."></textarea>

							<div class="tab-actions">
								<a data-ma-action="todo-form-close" href="" class="c-red"><i class="zmdi zmdi-close"></i></a>
								<a data-ma-action="todo-form-close" href="" class="c-green"><i class="zmdi zmdi-check"></i></a>
							</div>
						</div>
					</div>

					<div class="list-group">
						<div class="list-group-item media">
							<div class="pull-right">
								<ul class="actions actions-alt">
									<li class="dropdown">
										<a href="" data-toggle="dropdown">
											<i class="zmdi zmdi-more-vert"></i>
										</a>

										<ul class="dropdown-menu dropdown-menu-right">
											<li><a href="">Delete</a></li>
											<li><a href="">Archive</a></li>
										</ul>
									</li>
								</ul>
							</div>
							<div class="media-body">
								<div class="checkbox checkbox-light">
									<label>
										<input type="checkbox">
										<i class="input-helper"></i>
										<span>
											Duis vitae nibh molestie pharetra augue vitae
										</span>
									</label>
								</div>
							</div>
						</div>

						<div class="list-group-item media">
							<div class="pull-right">
								<ul class="actions actions-alt">
									<li class="dropdown">
										<a href="" data-toggle="dropdown">
											<i class="zmdi zmdi-more-vert"></i>
										</a>

										<ul class="dropdown-menu dropdown-menu-right">
											<li><a href="">Delete</a></li>
											<li><a href="">Archive</a></li>
										</ul>
									</li>
								</ul>
							</div>
							<div class="media-body">
								<div class="checkbox checkbox-light">
									<label>
										<input type="checkbox">
										<i class="input-helper"></i>
										<span>
											Duis vitae nibh molestie pharetra augue vitae
										</span>
									</label>
								</div>
							</div>
						</div>

						<div class="list-group-item media">
							<div class="pull-right">
								<ul class="actions actions-alt">
									<li class="dropdown">
										<a href="" data-toggle="dropdown">
											<i class="zmdi zmdi-more-vert"></i>
										</a>

										<ul class="dropdown-menu dropdown-menu-right">
											<li><a href="">Delete</a></li>
											<li><a href="">Archive</a></li>
										</ul>
									</li>
								</ul>
							</div>
							<div class="media-body">
								<div class="checkbox checkbox-light">
									<label>
										<input type="checkbox">
										<i class="input-helper"></i>
										<span>
											In vel imperdiet leoorbi mollis leo sit amet quam fringilla varius mauris orci turpis
										</span>
									</label>
								</div>
							</div>
						</div>

						<div class="list-group-item media">
							<div class="pull-right">
								<ul class="actions actions-alt">
									<li class="dropdown">
										<a href="" data-toggle="dropdown">
											<i class="zmdi zmdi-more-vert"></i>
										</a>

										<ul class="dropdown-menu dropdown-menu-right">
											<li><a href="">Delete</a></li>
											<li><a href="">Archive</a></li>
										</ul>
									</li>
								</ul>
							</div>
							<div class="media-body">
								<div class="checkbox checkbox-light">
									<label>
										<input type="checkbox">
										<i class="input-helper"></i>
										<span>
											Suspendisse quis sollicitudin erosvel dictum nunc
										</span>
									</label>
								</div>
							</div>
						</div>

						<div class="list-group-item media">
							<div class="pull-right">
								<ul class="actions actions-alt">
									<li class="dropdown">
										<a href="" data-toggle="dropdown">
											<i class="zmdi zmdi-more-vert"></i>
										</a>

										<ul class="dropdown-menu dropdown-menu-right">
											<li><a href="">Delete</a></li>
											<li><a href="">Archive</a></li>
										</ul>
									</li>
								</ul>
							</div>
							<div class="media-body">
								<div class="checkbox checkbox-light">
									<label>
										<input type="checkbox">
										<i class="input-helper"></i>
										<span>
											Curabitur egestas finibus sapien quis faucibusras bibendum ut justo at sagittis. In hac habitasse platea dictumst
										</span>
									</label>
								</div>
							</div>
						</div>

						<div class="list-group-item media">
							<div class="pull-right">
								<ul class="actions actions-alt">
									<li class="dropdown">
										<a href="" data-toggle="dropdown">
											<i class="zmdi zmdi-more-vert"></i>
										</a>

										<ul class="dropdown-menu dropdown-menu-right">
											<li><a href="">Delete</a></li>
											<li><a href="">Archive</a></li>
										</ul>
									</li>
								</ul>
							</div>
							<div class="media-body">
								<div class="checkbox checkbox-light">
									<label>
										<input type="checkbox">
										<i class="input-helper"></i>
										<span>
											Suspendisse potenti. Cras dolor augue, tincidunt sit amet lorem id, blandit rutrum libero
										</span>
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-sm-6">
			<!-- Calendar -->
			<div class="card" id="calendar-widget">
				<div class="card-header ch-alt bgm-teal">
					<div class="cwh-year"></div>
					<div class="cwh-day"></div>

					<button class="bgm-lightgreen btn btn-default bg btn-float"><i class="zmdi zmdi-plus"></i></button>
				</div>

				<div class="card-body card-padding-sm">
					<div id="cw-body"></div>
				</div>
			</div>

			<!-- Recent Posts -->
			<div class="card">
				<div class="card-header ch-alt m-b-20">
					<h2>Recent Posts <small>Phasellus condimentum ipsum id auctor imperdie</small></h2>
					<ul class="actions">
						<li>
							<a href="">
								<i class="zmdi zmdi-refresh-alt"></i>
							</a>
						</li>
						<li>
							<a href="">
								<i class="zmdi zmdi-download"></i>
							</a>
						</li>
						<li class="dropdown">
							<a href="" data-toggle="dropdown">
								<i class="zmdi zmdi-more-vert"></i>
							</a>

							<ul class="dropdown-menu dropdown-menu-right">
								<li>
									<a href="">Change Date Range</a>
								</li>
								<li>
									<a href="">Change Graph Type</a>
								</li>
								<li>
									<a href="">Other Settings</a>
								</li>
							</ul>
						</li>
					</ul>

					<button class="btn bgm-cyan btn-float"><i class="zmdi zmdi-plus"></i></button>
				</div>

				<div class="card-body">
					<div class="list-group">
						<a class="list-group-item media" href="">
							<div class="pull-left">
								<img class="lgi-img" src="{{ asset('administracion/img/profile-pics/1.jpg') }}" alt="">
							</div>
							<div class="media-body">
								<div class="lgi-heading">David Belle</div>
								<small class="lgi-text">Cum sociis natoque penatibus et magnis dis parturient montes</small>
							</div>
						</a>
						<a class="list-group-item media" href="">
							<div class="pull-left">
								<img class="lgi-img" src="{{ asset('administracion/img/profile-pics/2.jpg') }}" alt="">
							</div>
							<div class="media-body">
								<div class="lgi-heading">Jonathan Morris</div>
								<small class="lgi-text">Nunc quis diam diamurabitur at dolor elementum, dictum turpis vel</small>
							</div>
						</a>
						<a class="list-group-item media" href="">
							<div class="pull-left">
								<img class="lgi-img" src="{{ asset('administracion/img/profile-pics/3.jpg') }}" alt="">
							</div>
							<div class="media-body">
								<div class="lgi-heading">Fredric Mitchell Jr.</div>
								<small class="lgi-text">Phasellus a ante et est ornare accumsan at vel magnauis blandit turpis at augue ultricies</small>
							</div>
						</a>
						<a class="list-group-item media" href="">
							<div class="pull-left">
								<img class="lgi-img" src="{{ asset('administracion/img/profile-pics/4.jpg') }}" alt="">
							</div>
							<div class="media-body">
								<div class="lgi-heading">Glenn Jecobs</div>
								<small class="lgi-text">Ut vitae lacus sem ellentesque maximus, nunc sit amet varius dignissim, dui est consectetur neque</small>
							</div>
						</a>
						<a class="list-group-item media" href="">
							<div class="pull-left">
								<img class="lgi-img" src="{{ asset('administracion/img/profile-pics/4.jpg') }}" alt="">
							</div>
							<div class="media-body">
								<div class="lgi-heading">Bill Phillips</div>
								<small class="lgi-text">Proin laoreet commodo eros id faucibus. Donec ligula quam, imperdiet vel ante placerat</small>
							</div>
						</a>
						<a class="view-more" href="">View All</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection