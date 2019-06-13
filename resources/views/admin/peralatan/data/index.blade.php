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
						<h2>Data Inventaris Proyek </h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a href="{{url('admin/peralatan/data/create')}}"><button class="btn btn-success"> Tambah Data</button></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Kode Barang</th>
									<th>Nama Barang</th>
									<th>Tipe Barang</th>
									<th style="width: 200px;">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($inventoris as $inventori)
									<tr>
										<td>{{$inventori->kode_barang}}</td>
										<td>{{$inventori->nama_barang}}</td>
										<td>{{$inventori->tipe_barang}}</td>
										<td style="text-align: left;">
											<a href="{{'data/edit/'.$inventori->id.''}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>  Edit</a>
											<a href="{{'data/delete/'.$inventori->id.''}}" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>  Delete</a>
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