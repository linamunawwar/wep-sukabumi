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
						<h2>Kebutuhan Pelatihan </h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a href="{{url('pelatihan/create_gap')}}"><button class="btn btn-success"> Tambah Data Gap Analysis</button></a></li>
							<li><a href="{{url('pelatihan/create_usulan')}}"><button class="btn btn-success"> Tambah Data Usulan</button></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Tanggal</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>2011/04/25</td>
									<td style="text-align: left;">
										<button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Gap Analysis</button > 
										<a href="{{url('pelatihan/edit_usulan')}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>  Edit Form Pelatihan</a>
										<button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Form Pelatihan</button>
									</td>
								</tr>
								<tr>
									<td>2011/04/25</td>
									<td style="text-align: left;">
										<button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Gap Analysis</button > 
										<a href="{{url('pelatihan/edit_usulan')}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>  Edit Form Pelatihan</a>
										<button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Form Pelatihan</button>
									</td>
								</tr>
								<tr>
									<td>2011/04/25</td>
									<td style="text-align: left;">
										<button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Gap Analysis</button > 
										<a href="{{url('pelatihan/edit_usulan')}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>  Edit Form Pelatihan</a>
										<button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Form Pelatihan</button>
									</td>
								</tr>
								<tr>
									<td>2011/04/25</td>
									<td style="text-align: left;">
										<button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Gap Analysis</button > 
										<a href="{{url('pelatihan/edit_usulan')}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>  Edit Form Pelatihan</a>
										<button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Form Pelatihan</button>
									</td>
								</tr>
								<tr>
									<td>2011/04/25</td>
									<td style="text-align: left;">
										<button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Gap Analysis</button > 
										<a href="{{url('pelatihan/edit_usulan')}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>  Edit Form Pelatihan</a>
										<button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Form Pelatihan</button>
									</td>
								</tr>
								<tr>
									<td>2011/04/25</td>
									<td style="text-align: left;">
										<button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Gap Analysis</button > 
										<a href="{{url('pelatihan/edit_usulan')}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>  Edit Form Pelatihan</a>
										<button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Form Pelatihan</button>
									</td>
								</tr>
								<tr>
									<td>2011/04/25</td>
									<td style="text-align: left;">
										<button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Gap Analysis</button > 
										<a href="{{url('pelatihan/edit_usulan')}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>  Edit Form Pelatihan</a>
										<button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Form Pelatihan</button>
									</td>
								</tr>
								<tr>
									<td>2011/04/25</td>
									<td style="text-align: left;">
										<button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Gap Analysis</button > 
										<a href="{{url('pelatihan/edit_usulan')}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>  Edit Form Pelatihan</a>
										<button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Form Pelatihan</button>
									</td>
								</tr>
								<tr>
									<td>2011/04/25</td>
									<td style="text-align: left;">
										<button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Gap Analysis</button > 
										<a href="{{url('pelatihan/edit_usulan')}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>  Edit Form Pelatihan</a>
										<button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Form Pelatihan</button>
									</td>
								</tr>
								<tr>
									<td>2011/04/25</td>
									<td style="text-align: left;">
										<button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Gap Analysis</button > 
										<a href="{{url('pelatihan/edit_usulan')}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>  Edit Form Pelatihan</a>
										<button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Form Pelatihan</button>
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