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
						<h2>Arsip </h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a href="{{url('arsip/create')}}"><button class="btn btn-success"> Tambah Data</button></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Nama Form</th>
									<th>Bagian</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>CV</td>
									<td>Semua Bagian</td>
									<td style="text-align: left;">
										<button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Form</button > 
										<a href="{{url('pelatihan/edit_usulan')}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>  Edit</a>
										<button class="btn btn-success btn-xs"><i class="fa fa-cancel"></i> Delete</button>
									</td>
								</tr>
								<tr>
									<td>Form Cuti</td>
									<td>Semua Bagian</td>
									<td style="text-align: left;">
										<button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Form</button > 
										<a href="{{url('pelatihan/edit_usulan')}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>  Edit</a>
										<button class="btn btn-success btn-xs"><i class="fa fa-cancel"></i> Delete</button>
									</td>
								</tr>
								<tr>
									<td>Form MCU</td>
									<td>Semua Bagian</td>
									<td style="text-align: left;">
										<button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Form</button > 
										<a href="{{url('pelatihan/edit_usulan')}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>  Edit</a>
										<button class="btn btn-success btn-xs"><i class="fa fa-cancel"></i> Delete</button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
    </div>
    <!-- /page content -->
@endsection