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
						<h2>Arsip </h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a href="{{url('logistik/admin/lokasi/create')}}"><button class="btn btn-success"> Tambah Data</button></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th scope="col"> Nama Lokasi </th>
									<th scope="col"> Keterangan Lokasi </th>
									<th scope="col"> Action </th>
								</tr>
							</thead>
							<tbody>								
								@foreach ($locations as $location)
									<tr>
									<td>{{ $location->nama }}</td>
									<td>{{ $location->keterangan }}</td>
									<td style="text-align:center;">
										<a class="btn btn-default btn-xs" href="{{url('logistik/admin/lokasi/edit/'.$location->id.'')}}"><i class="fa fa-edit"></i>  Edit</a>
										<a class="btn btn-danger btn-xs" href="{{url('logistik/admin/lokasi/delete/'.$location->id.'')}}"><i class="fa fa-trash"></i>  Delete</a><br>
									</td>
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