@extends('logistik.layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

@section('main_container')

    <!-- page content -->
	    <div class="right_col" role="main">
	    	<div class="row tile_count">
				<div class="col-md-3 col-sm-5 col-xs-7 tile_stats_count">
					<a href="{{url('Logistik/manager/material')}}">
						<span class="count_top"><i class="fa fa-user"></i> Material</span><br/>
						<div class="count green">{{$materials}}</div>
					</a>
				</div>
				<div class="col-md-3 col-sm-5 col-xs-7 tile_stats_count">
					<a href="{{url('manager/spj/pengajuan')}}">
						<span class="count_top"><i class="fa fa-exchange"></i> Permintaan Material</span>
						<div class="count">{{count(notifApprovePermintaanManager())}}</div>
						<span class="count_bottom"><i class="green">Need To be Approved</i></span>
					</a>
				</div>
				<div class="col-md-3 col-sm-5 col-xs-7 tile_stats_count">
					<a href="{{url('manager/spj/pengajuan')}}">
						<span class="count_top"><i class="fa fa-exchange"></i> Penerimaan Material</span>
						<div class="count">{{count(notifApprovePenerimaanManager())}}</div>
						<span class="count_bottom"><i class="green">Need To be Approved</i></span>
					</a>
				</div>
				<div class="col-md-3 col-sm-5 col-xs-7 tile_stats_count">
					<a href="{{url('manager/spj/pengajuan')}}">
						<span class="count_top"><i class="fa fa-exchange"></i> Pengajuan Material</span>
						<div class="count">{{count(notifApprovePengajuanManager())}}</div>
						<span class="count_bottom"><i class="green">Need To be Approved</i></span>
					</a>
				</div>
			</div>

	    	<br>
	    	<br>
	    </div>
    <!-- /page content -->
@endsection