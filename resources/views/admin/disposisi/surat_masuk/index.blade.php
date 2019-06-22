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
						<h2>List Surat Masuk </h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a href="{{url('admin/surat_masuk/create')}}"><button class="btn btn-success"> Tambah Data</button></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Nomor Surat</th>
									<th>Tanggal Surat</th>
									<th>Pengirim</th>
									<th>Kepada</th>
									<th>Perihal</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($surats as $surat)
									<tr>
										<td>{{$surat->no_surat}}</td>
										<td>{{konversi_tanggal($surat->tanggal_surat)}}</td>
										<td>{{$surat->pengirim}}</td>
										<td>{{$surat->kepada}}</td>
										<td>{{$surat->perihal}}</td>
										<td style="text-align: center;">
											<a class="btn btn-default btn-xs" href="{{url('admin/surat_masuk/edit/'.$surat->id.'')}}"><i class="fa fa-edit"></i>  Edit</a> 
											<a class="btn btn-danger btn-xs" href="{{url('admin/surat_masuk/delete/'.$surat->id.'')}}"><i class="fa fa-trash"></i>  Delete</a> 
											<a class="btn btn-success btn-xs" href="{{url('admin/surat_masuk/unduh/'.$surat->id.'')}}"><i class="fa fa-download"></i>  Surat</a>
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