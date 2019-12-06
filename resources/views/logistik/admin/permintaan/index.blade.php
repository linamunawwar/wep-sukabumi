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
							<li><a href="{{url('Logistik/admin/permintaan/create')}}"><button class="btn btn-success"> Tambah Data</button></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th scope="col"> No </th>
									<th scope="col"> Kode Permintaan </th>
									<th scope="col"> Tanggal </th>
									<th scope="col"> Status </th>
									<th scope="col"> Action </th>
								</tr>
							</thead>
							<tbody>	
                                    {{ $no = 0 }}
                                    @foreach ($permintaans as $permintaan)
                                    {{ $no++ }}
									<tr>
									<td>{{ $no }}</td>
									<td>{{ $permintaan->kode_permintaan }}</td>
									<td>{{ $permintaan->tanggal }}</td>
									<td></td>
									<td style="text-align:center;">
										<a class="btn btn-default btn-xs" href="{{url('logistik/admin/permintaan/detail/'.$permintaan->id.'')}}"><i class="fa fa-edit"></i>  Detail</a>
										<a class="btn btn-danger btn-xs" href="{{url('logistik/admin/permintaan/edit/'.$permintaan->id.'')}}"><i class="fa fa-trash"></i>  Edit</a><br>
										<a class="btn btn-default btn-xs" href="{{url('logistik/admin/permintaan/download/'.$permintaan->id.'')}}"><i class="fa fa-edit"></i>  Download</a>
										<a class="btn btn-default btn-xs" href="{{url('logistik/admin/permintaan/delete/'.$permintaan->id.'')}}"><i class="fa fa-edit"></i>  Delete</a>
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