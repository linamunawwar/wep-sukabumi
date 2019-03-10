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
					<div class="count">5</div>
					<span class="count_bottom"><i class="green">Need To be Approved</i></span>
				</div>
				<div class="col-md-3 col-sm-5 col-xs-7 tile_stats_count">
					<span class="count_top"><i class="fa fa-sitemap"></i> Penggantian Tugas</span><br/>
					<div class="count">5</div>
					<span class="count_bottom"><i class="green">Need To be Approved</i></span>
				</div>
			</div>

	    	<br>
	    	<br>
	    </div>
    <!-- /page content -->
@endsection