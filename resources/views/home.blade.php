@extends('layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

@section('main_container')

    <!-- page content -->
	    <div class="right_col" role="main">
	    	<div class="row tile_count" style="display: none;">
				<div class="col-md-3 col-sm-5 col-xs-7 tile_stats_count">
					<span class="count_top"><i class="fa fa-user"></i> Pegawai Baru (CV)</span><br/>
					<div class="count">5</div>
					<span class="count_bottom"><i class="green">Need To be Approved</i></span>
				</div>
				<div class="col-md-3 col-sm-5 col-xs-7 tile_stats_count">
					<span class="count_top"><i class="fa fa-sitemap"></i> Struktur Pegawai</span><br/>
					<div class="count">5</div>
					<span class="count_bottom"><i class="green">Need To be Approved</i></span>
				</div>
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
					<span class="count_top"><i class="fa fa-sign-out"></i> Resign</span>
					<div class="count green">6</div>
					<span class="count_bottom"><i class="green">Need To be Approved</i></span>
				</div>
				<div class="col-md-3 col-sm-5 col-xs-7 tile_stats_count">
					<span class="count_top"><i class="fa fa-sign-out"></i> Rencana Kebutuhan Pegawai</span>
					<div class="count green">6</div>
					<span class="count_bottom"><i class="green">Need To be Approved</i></span>
				</div>
			</div>
			<div class="row tile_count">
				<div class="col-md-10">
				<div class="alert alert-danger alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
					</button>
					Anda telah melakukan Pengajuan cetak Struktur Pegawai sebelumnya, Silahkan Tunggu verifikasi dari Kepala Proyek untuk dapat mencetak.
				</div>
			</div>
			</div>
	    	<br>
	    	<br>
	    </div>
    <!-- /page content -->
@endsection