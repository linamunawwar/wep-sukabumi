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
						<h2>List Surat Keluar </h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a href="{{url('surat_keluar/create')}}"><button class="btn btn-success"> Tambah Data</button></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Nomor Surat</th>
									<th>Tanggal Surat</th>
									<th>Perihal</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>SM/WK/II/12/2019</td>
									<td>2019/02/18</td>
									<td>System Architect</td>
									<td style="text-align: center;"><button class="btn btn-default btn-xs"><i class="fa fa-edit"></i>  Edit</button> <button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Surat</button></td>
								</tr>
								<tr>
									<td>SM/WK/II/12/2019</td>
									<td>2019/02/18</td>
									<td>Accountant</td>
									<td style="text-align: center;"><button class="btn btn-default btn-xs"><i class="fa fa-edit"></i>  Edit</button> <button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Surat</button></td>
								</tr>
								<tr>
									<td>SM/WK/II/12/2019</td>
									<td>2019/02/18</td>
									<td>Junior Technical Author</td>
									<td style="text-align: center;"><button class="btn btn-default btn-xs"><i class="fa fa-edit"></i>  Edit</button> <button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Surat</button></td>
								</tr>
								<tr>
									<td>SM/WK/II/12/2019</td>
									<td>2019/02/18</td>
									<td>Senior Javascript Developer</td>
									<td style="text-align: center;"><button class="btn btn-default btn-xs"><i class="fa fa-edit"></i>  Edit</button> <button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Surat</button></td>
								</tr>
								<tr>
									<td>SM/WK/II/12/2019</td>
									<td>2019/02/18</td>
									<td>Integration Specialist</td>
									<td style="text-align: center;"><button class="btn btn-default btn-xs"><i class="fa fa-edit"></i>  Edit</button> <button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Surat</button></td>
								</tr>
								<tr>
									<td>SM/WK/II/12/2019</td>
									<td>2019/02/18</td>
									<td>Office Manager</td>
									<td style="text-align: center;"><button class="btn btn-default btn-xs"><i class="fa fa-edit"></i>  Edit</button> <button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Surat</button></td>
								</tr>
								<tr>
									<td>SM/WK/II/12/2019</td>
									<td>2019/02/18</td>
									<td>Support Lead</td>
									<td style="text-align: center;"><button class="btn btn-default btn-xs"><i class="fa fa-edit"></i>  Edit</button> <button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Surat</button></td>
								</tr>
								<tr>
									<td>SM/WK/II/12/2019</td>
									<td>2019/02/18</td>
									<td>Chief Executive Officer (CEO)</td>
									<td style="text-align: center;"><button class="btn btn-default btn-xs"><i class="fa fa-edit"></i>  Edit</button> <button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Surat</button></td>
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