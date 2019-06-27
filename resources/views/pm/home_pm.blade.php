@extends('layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

@section('main_container')

    <!-- page content -->
	    <div class="right_col" role="main">
	    	<div class="row tile_count">
				<div class="col-md-3 col-sm-5 col-xs-7 tile_stats_count">
					<a href="{{url('pm/memo')}}">
						<span class="count_top"><i class="fa fa-paper-plane"></i> Pesan Internal</span>
						<div class="count">3</div>
					</a>
				</div>
				<div class="col-md-3 col-sm-5 col-xs-7 tile_stats_count">
					<a href="{{url('pm/cuti')}}">
						<span class="count_top"><i class="fa fa-sign-out"></i> Cuti</span>
						<div class="count green">6</div>
						<span class="count_bottom"><i class="green">Need To be Approved</i></span>
					</a>
				</div>
				<div class="col-md-3 col-sm-5 col-xs-7 tile_stats_count">
					<a href="{{url('pm/izin')}}">
						<span class="count_top"><i class="fa fa-sign-out"></i> Izin</span>
						<div class="count green">6</div>
						<span class="count_bottom"><i class="green">Need To be Approved</i></span>
					</a>
				</div>
				<div class="col-md-3 col-sm-5 col-xs-7 tile_stats_count">
					<a href="{{url('pm/slip_gaji')}}">
						<span class="count_top"><i class="fa fa-money"></i> Slip Gaji</span>
						<div class="count green">6</div>
						<span class="count_bottom"><i class="green">Need To be Approved</i></span>
					</a>
				</div>
				<div class="col-md-3 col-sm-5 col-xs-7 tile_stats_count">
					<a href="{{url('pm/pecat')}}">
						<span class="count_top"><i class="fa fa-sign-out"></i> Pemberhentian Kerja</span>
						<div class="count green">6</div>
						<span class="count_bottom"><i class="green">Need To be Approved</i></span>
					</a>
				</div>
				<div class="col-md-3 col-sm-5 col-xs-7 tile_stats_count">
					<a href="{{url('pm/resign')}}">
						<span class="count_top"><i class="fa fa-sign-out"></i> Resign</span>
						<div class="count green">6</div>
						<span class="count_bottom"><i class="green">Need To be Approved</i></span>
					</a>
				</div>
				<div class="col-md-3 col-sm-5 col-xs-7 tile_stats_count">
					<a href="{{url('pm/disposisi')}}">
						<span class="count_top"><i class="fa fa-envelope"></i> Disposisi</span>
						<div class="count">10</div>
						<span class="count_bottom"><i class="green">Need To be processed</i></span>
					</a>
				</div>
			</div>

	    	<br>
	    	<br>
	    </div>
    <!-- /page content -->
@endsection