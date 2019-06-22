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
					<span class="count_top"><i class="fa fa-user"></i> Pegawai Baru (CV)</span><br/>
					<div class="count green">{{$pegawai}}</div>
					<span class="count_bottom"><i class="green">Need To be Approved</i></span>
				</div>
				<div class="col-md-3 col-sm-5 col-xs-7 tile_stats_count">
					<span class="count_top"><i class="fa fa-paper-plane"></i> Pesan Internal</span>
					<div class="count green">{{$memo}}</div>
				</div>
				<div class="col-md-3 col-sm-5 col-xs-7 tile_stats_count">
					<span class="count_top"><i class="fa fa-sign-out"></i> Cuti</span>
					<div class="count green">{{$cuti}}</div>
				</div>
				<div class="col-md-3 col-sm-5 col-xs-7 tile_stats_count">
					<span class="count_top"><i class="fa fa-sign-out"></i> SPJ</span>
					<div class="count green">{{$spj}}</div>
					<span class="count_bottom"><i class="green">Need To be Approved</i></span>
				</div>
				<div cla
				<div class="col-md-3 col-sm-5 col-xs-7 tile_stats_count">
					<span class="count_top"><i class="fa fa-sign-out"></i> Pemberhentian Kerja</span>
					<div class="count green">{{$pecat}}</div>
				</div>
				<div class="col-md-3 col-sm-5 col-xs-7 tile_stats_count">
					<span class="count_top"><i class="fa fa-sign-out"></i> Resign</span>
					<div class="count green">{{$resign}}</div>
				</div>
				<div class="col-md-3 col-sm-5 col-xs-7 tile_stats_count">
					<span class="count_top"><i class="fa fa-sign-out"></i> Rencana Kebutuhan Pegawai</span>
					<div class="count green">6</div>
				</div>
			</div>

	    	<br>
	    	<br>
	    </div>
    <!-- /page content -->
@endsection