@extends('layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

@section('main_container')

    <!-- page content -->
    <div class="right_col" role="main">
    	<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Rencana Kebutuhan Pegawai </h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a href="{{url('manager/rkp/create')}}"><button class="btn btn-success"> Tambah Data</button></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Bagian</th>
									<th>Tanggal</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($rkps as $rkp)
									<tr>
										<td>{{$rkp->kodeBagian->description}}</td>
										<?php
											$tanggal = explode(' ', $rkp->created_at);
										?>
										<td>{{konversi_tanggal($tanggal[0])}}</td>
										@if($rkp->is_verif_pm == 0)
											<td><span class="label label-default">Not Approved</span></td>
											<td style="text-align: left;"><button class="btn btn-dark btn-xs"><i class="fa fa-download"></i>  Unduh</button></td>
										@elseif($rkp->is_verif_pm == 1)
											<td><span class="label label-primary">Approved by Admin</span></td>
											<td style="text-align: left;"><button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Unduh</button></td>
										@endif
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
    </div>
    <!-- /page content -->
@endsection