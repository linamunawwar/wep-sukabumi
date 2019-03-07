@extends('layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

@section('main_container')

    <!-- page content -->
	    <div class="right_col" role="main">
	    	<div class="row tile_count">
				<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
					<span class="count_top"><i class="fa fa-user"></i> Memo Baru</span>
					<div class="count">2500</div>
					<span class="count_bottom"><i class="green">4% </i> Pegawai Baru</span>
				</div>
				<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
					<span class="count_top"><i class="fa fa-clock-o"></i> Cuti</span>
					<div class="count">123.50</div>
					<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
				</div>
				<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
					<span class="count_top"><i class="fa fa-user"></i> Izin</span>
					<div class="count green">2,500</div>
					<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
				</div>
				<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
					<span class="count_top"><i class="fa fa-user"></i> Slip Gaji</span>
					<div class="count">4,567</div>
					<span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
				</div>
				<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
					<span class="count_top"><i class="fa fa-user"></i> Pemecatan</span>
					<div class="count">2,315</div>
					<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
				</div>
				<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
					<span class="count_top"><i class="fa fa-user"></i> Resign</span>
					<div class="count">7,325</div>
					<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
				</div>
				<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
					<span class="count_top"><i class="fa fa-user"></i> SPJ</span>
					<div class="count">7,325</div>
					<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
				</div>
				<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
					<span class="count_top"><i class="fa fa-user"></i> Disposisi</span>
					<div class="count">7,325</div>
					<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
				</div>
				<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
					<span class="count_top"><i class="fa fa-user"></i> Rencana Kebutuhan Pegawai</span>
					<div class="count">7,325</div>
					<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
				</div>
				<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
					<span class="count_top"><i class="fa fa-user"></i> Penyerahan Tugas Cuti</span>
					<div class="count">7,325</div>
					<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="dashboard_graph">
						<div class="row x_title">
							<div class="col-md-6">
								<h3>Network Activities <small>Graph title sub-title</small></h3>
							</div>
							<div class="col-md-6">
								<div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
									<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
									<span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
								</div>
							</div>
						</div>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<div id="chart_plot_01" class="demo-placeholder"></div>
						 </div>
						<div class="col-md-3 col-sm-3 col-xs-12 bg-white">
							<div class="x_title">
								<h2>Top Campaign Performance</h2>
								<div class="clearfix"></div>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-6">
								<div>
									<p>Facebook Campaign</p>
									<div class="">
										<div class="progress progress_sm" style="width: 76%;">
											<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="80"></div>
										</div>
									</div>
								</div>
								<div>
									<p>Twitter Campaign</p>
									<div class="">
										<div class="progress progress_sm" style="width: 76%;">
											<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60"></div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-6">
								<div>
									<p>Conventional Media</p>
									<div class="">
										<div class="progress progress_sm" style="width: 76%;">
											<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="40"></div>
										</div>
									</div>
								</div>
								<div>
									<p>Bill boards</p>
									<div class="">
										<div class="progress progress_sm" style="width: 76%;">
											<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
	    			</div>
	    		</div>
	    	</div>
	    	<br>
	    	<br>
	    </div>
    <!-- /page content -->
@endsection