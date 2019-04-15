@extends('layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

@section('main_container')

    <!-- page content -->
	    <div class="right_col" role="main" style="overflow: hidden;">
	    	<div style="background: #1ABB9C; width: 100%; padding: 20px; margin: 20px; margin-top:70px; border-radius: 5px;" >
	    		<h4 style="color: white;">Selamat Datang di Aplikasi <b>Waskita E-Office Project</b>.</h4>
	    	</div>
	    	<div class="row tile_count">
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