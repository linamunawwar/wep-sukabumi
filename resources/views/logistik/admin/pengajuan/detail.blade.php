@extends('logistik.layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush
<style>
	#datatable thead tr th {
		text-align: center;
		vertical-align: middle;
		font-family: "Helvetica Neue",Roboto,Arial,"Droid Sans",sans-serif;
		font-size: 15px;
		font-weight: 400;
	}

	#datatable tbody tr td {
		text-align: center;
		vertical-align: middle;
		font-family: "Helvetica Neue",Roboto,Arial,"Droid Sans",sans-serif;
		font-size: 13px;
		font-weight: 400;
	}
</style>

@section('main_container')

    <!-- page content -->
    <div class="right_col" role="main">
    	<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Detail Pengajuan Material </h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a href="{{url('Logistik/admin/pengajuan/')}}"><button class="btn btn-success"> Kembali </button></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th scope="col" rowspan="2"><b> No</b> </th>
									<th scope="col" rowspan="2"><b> Element Activity</b> </th>
									<th scope="col" rowspan="2"><b> Material</b> </th>
									<th scope="col" colspan="2"><b> Permintaan</b> </th>
									<th scope="col" colspan="2"><b> Penyerahan</b> </th>
								</tr>
								<tr>
									<th scope="col"><b> Satuan </b></th>
									<th scope="col"><b> Jumlah </b></th>
									<th scope="col"><b> Satuan </b></th>
									<th scope="col"><b> Jumlah </b></th>
								</tr>
							</thead>
							<tbody>	
								<?php $no = 1; ?>
								@foreach ($details as $detail)
									<tr>
										<td scope="col"> {{ $no++ }} </td>
										<td scope="col"> {{ $detail->element_activity }} </td>
										<td scope="col"> {{ $detail->detailPengajuanMaterial->nama }} </td>
										<td scope="col"> {{ $detail->permintaan_satuan }} </td>
										<td scope="col"> {{ $detail->permintaan_jumlah }} </td>
										<td scope="col"> {{ $detail->penyerahan_satuan }} </td>
										<td scope="col"> {{ $detail->pemyerahan_jumlah }} </td>
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