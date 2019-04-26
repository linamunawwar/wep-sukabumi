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
					<span class="count_top"><i class="fa fa-paper-plane"></i> Pesan Internal</span>
					<div class="count">3</div>
				</div>
				<div class="col-md-3 col-sm-5 col-xs-7 tile_stats_count">
					<span class="count_top"><i class="fa fa-sign-out"></i> Cuti</span>
					<div class="count green">6</div>
					<span class="count_bottom"><i class="green">Need To be Approved</i></span>
				</div>
				<div class="col-md-3 col-sm-5 col-xs-7 tile_stats_count">
					<span class="count_top"><i class="fa fa-sign-out"></i> Izin</span>
					<div class="count green">6</div>
					<span class="count_bottom"><i class="green">Need To be Approved</i></span>
				</div>
				<div class="col-md-3 col-sm-5 col-xs-7 tile_stats_count">
					<span class="count_top"><i class="fa fa-money"></i> Slip Gaji</span>
					<div class="count green">6</div>
					<span class="count_bottom"><i class="green">Need To be Approved</i></span>
				</div>
				<div class="col-md-3 col-sm-5 col-xs-7 tile_stats_count">
					<span class="count_top"><i class="fa fa-sign-out"></i> Pemecatan</span>
					<div class="count green">6</div>
					<span class="count_bottom"><i class="green">Need To be Approved</i></span>
				</div>
				<div class="col-md-3 col-sm-5 col-xs-7 tile_stats_count">
					<span class="count_top"><i class="fa fa-sign-out"></i> Resign</span>
					<div class="count green">6</div>
					<span class="count_bottom"><i class="green">Need To be Approved</i></span>
				</div>
				<div class="col-md-3 col-sm-5 col-xs-7 tile_stats_count">
					<span class="count_top"><i class="fa fa-envelope"></i> Disposisi</span>
					<div class="count">10</div>
					<span class="count_bottom"><i class="green">Need To be processed</i></span>
				</div>
			</div>

	    	<br>
	    	<br>
	    </div>
    <!-- /page content -->
@endsection