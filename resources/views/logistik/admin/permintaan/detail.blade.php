@extends('logistik.layouts.blank')

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
						<h2>Permintaan Material </h2>
						<ul class="nav navbar-right panel_toolbox">
							<li>
								@if ($notifPermintaan->is_pm == 1)
									<a class="btn btn-default" title="Download" style="background-color:#0984E3; color:#FFFFFF; padding:0.5em 0.7em 0.5em 0.7em; margin-top:0.3em; width:8em;" href="{{url('Logistik/admin/permintaan/unduh/'.$notifPermintaan->id.'')}}"> <b>Download</b> <i class="fa fa-download" style="font-size:15px;"> </i>  </a>
								@else
								<div class="btn btn-dark" title="Download" style="color:#FFFFFF;  padding:0.5em 0.7em 0.5em 0.7em; margin-top:0.3em; width:8em; opacity: 0.5;"> <b>Download</b> <i class="fa fa-download" style="font-size:15px;opacity: 0.5;"></i>  </div>
								@endif
							</li>
							<li><a href="{{url('Logistik/admin/permintaan/')}}"><button class="btn btn-success"> Kembali </button></a></li>
						</ul><br><br>
						<p>Kode Permintaan : {{$details[0]->detailPermintaan->kode_permintaan}}</p>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th scope="col"> No </th>
									<th scope="col"> Nama Material </th>
									<th scope="col"> No Part </th>
									<th scope="col"> Volume </th>
									<th scope="col"> Satuan </th>
									<th scope="col"> Keperluan </th>
								</tr>
							</thead>
							<tbody>	
                                    <?php $no = 1; ?> 
                                    @foreach ($details as $detail)
									<tr>
									<td>{{ $no++ }}</td>
									<td>{{ $detail->detailPermintaanMaterial->nama }}</td>
									<td>{{ $detail->no_part }}</td>
									<td>{{ $detail->volume }}</td>
									<td>{{ $detail->satuan }}</td>
									<td>{{ $detail->keperluan }}</td>
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