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
					<a href="{{url('manager/memo')}}">
						<span class="count_top"><i class="fa fa-paper-plane"></i> Pesan Internal</span>
						<div class="count">{{$memo}}</div>
					</a>
				</div>
				<div class="col-md-3 col-sm-5 col-xs-7 tile_stats_count">
					<a href="{{url('manager/cuti')}}">
						<span class="count_top"><i class="fa fa-sign-out"></i> Cuti</span>
						<div class="count green">{{$cuti}}</div>
						<span class="count_bottom"><i class="green">Need To be Approved</i></span>
					</a>
				</div>
				<div class="col-md-3 col-sm-5 col-xs-7 tile_stats_count">
					<a href="{{url('manager/izin')}}">
						<span class="count_top"><i class="fa fa-sign-out"></i> Izin</span>
						<div class="count green">{{$izin}}</div>
						<span class="count_bottom"><i class="green">Need To be Approved</i></span>
					</a>
				</div>
				<div class="col-md-3 col-sm-5 col-xs-7 tile_stats_count">
					<a href="{{url('manager/pegawai/pecat')}}">
						<span class="count_top"><i class="fa fa-sign-out"></i> Pemberhentian Kerja</span>
						<div class="count green">{{$pecat}}</div>
						<span class="count_bottom"><i class="green">Need To be Approved</i></span>
					</a>
				</div>
				<div class="col-md-3 col-sm-5 col-xs-7 tile_stats_count">
					<a href="{{url('manager/pegawai/resign')}}">
						<span class="count_top"><i class="fa fa-sign-out"></i> Resign</span>
						<div class="count green">{{$resign}}</div>
						<span class="count_bottom"><i class="green">Need To be Approved</i></span>
					</a>
				</div>
				<div class="col-md-3 col-sm-5 col-xs-7 tile_stats_count">
					<a href="{{url('manager/disposisi')}}">
						<span class="count_top"><i class="fa fa-envelope"></i> Disposisi</span>
						<div class="count">{{$disposisi}}</div>
						<span class="count_bottom"><i class="green">Need To be processed</i></span>
					</a>
				</div>
			</div>

	    	<br>
	    	<br>
	    </div>
    <!-- /page content -->
@endsection