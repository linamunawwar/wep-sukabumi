@extends('layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

@section('main_container')

    <!-- page content -->
    <div class="right_col" role="main">
    	<div class="row">
			<div class="col-md-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Inbox Design<small>User Mail</small></h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="#">Settings 1</a>
									</li>
									<li><a href="#">Settings 2</a>
									</li>
								</ul>
							</li>
							<li><a class="close-link"><i class="fa fa-close"></i></a>
							</li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="row">
							<div class="col-sm-3 mail_list_column">
								<button id="compose" class="btn btn-sm btn-success btn-block" type="button">COMPOSE</button>
								<a href="#">
									<div class="mail_list">
										<div class="left">
											<i class="fa fa-circle"></i> <i class="fa fa-edit"></i>
										</div>
										<div class="right">
											<h3>Dennis Mugo <small>3.00 PM</small></h3>
											<p>Ut enim ad minim veniam, quis nostrud exercitation enim ad minim veniam, quis nostrud exercitation...</p>
										</div>
									</div>
								</a>
								<a href="#">
									<div class="mail_list">
										<div class="left">
											<i class="fa fa-star"></i>
										</div>
										<div class="right">
											<h3>Jane Nobert <small>4.09 PM</small></h3>
											<p><span class="badge">To</span> Ut enim ad minim veniam, quis nostrud exercitation enim ad minim veniam, quis nostrud exercitation...</p>
										</div>
									</div>
								</a>
			 					<a href="#">
									<div class="mail_list">
										<div class="left">
											<i class="fa fa-circle-o"></i><i class="fa fa-paperclip"></i>
										</div>
										<div class="right">
											<h3>Musimbi Anne <small>4.09 PM</small></h3>
											<p><span class="badge">CC</span> Ut enim ad minim veniam, quis nostrud exercitation enim ad minim veniam, quis nostrud exercitation...</p>
										</div>
									</div>
								</a>
								<a href="#">
									<div class="mail_list">
										<div class="left">
											<i class="fa fa-paperclip"></i>
										</div>
										<div class="right">
											<h3>Jon Dibbs <small>4.09 PM</small></h3>
											<p>Ut enim ad minim veniam, quis nostrud exercitation enim ad minim veniam, quis nostrud exercitation...</p>
										</div>
									</div>
								</a>
								<a href="#">
									<div class="mail_list">
										<div class="left">
											.
										</div>
										<div class="right">
											<h3>Debbis & Raymond <small>4.09 PM</small></h3>
											<p>Ut enim ad minim veniam, quis nostrud exercitation enim ad minim veniam, quis nostrud exercitation...</p>
										</div>
									</div>
								</a>
								<a href="#">
									<div class="mail_list">
										<div class="left">
										.
										</div>
										<div class="right">
											<h3>Debbis & Raymond <small>4.09 PM</small></h3>
											<p>Ut enim ad minim veniam, quis nostrud exercitation enim ad minim veniam, quis nostrud exercitation...</p>
										</div>
									</div>
								</a>
								<a href="#">
									<div class="mail_list">
										<div class="left">
											<i class="fa fa-circle"></i> <i class="fa fa-edit"></i>
										</div>
										<div class="right">
											<h3>Dennis Mugo <small>3.00 PM</small></h3>
											<p>Ut enim ad minim veniam, quis nostrud exercitation enim ad minim veniam, quis nostrud exercitation...</p>
										</div>
									</div>
								</a>
								<a href="#">
									<div class="mail_list">
										<div class="left">
											<i class="fa fa-star"></i>
										</div>
										<div class="right">
											<h3>Jane Nobert <small>4.09 PM</small></h3>
											<p>Ut enim ad minim veniam, quis nostrud exercitation enim ad minim veniam, quis nostrud exercitation...</p>
										</div>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    <!-- /page content -->
@endsection