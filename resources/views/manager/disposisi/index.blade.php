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
						<h2>List Disposisi </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Nomor Agenda</th>
									<th>Pengirim</th>
									<th>Kepada</th>
									<th>Tanggal Terima</th>
									<th>Sifat</th>
									<th>Perihal</th>
									<th>Tugas</th>
									<th style="width: 235px;">Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>SM/WK/II/12/2019</td>
									<td>System Architect</td>
									<td>System Architect</td>
									<td>2019/02/18</td>
									<td>Penting</td>
									<td>System Architect</td>
									<td>Mengetahui</td>
									<td style="text-align: center;">
										<a class="btn btn-primary btn-xs" href="{{url('manager/disposisi/proses')}}"><i class="fa fa-refresh"></i>  Proses</a>
									</td>
								</tr>
								<tr>
									<td>SM/WK/II/12/2019</td>
									<td>System Architect</td>
									<td>System Architect</td>
									<td>2019/02/18</td>
									<td>Segera</td>
									<td>System Architect</td>
									<td>Menyelesaikan</td>
									<td style="text-align: center;">
										<a class="btn btn-dark btn-xs" href="{{url('manager/disposisi/proses')}}"><i class="fa fa-refresh"></i>  Proses</a>
									</td>
								</tr>
								<tr>
									<td>SM/WK/II/12/2019</td>
									<td>System Architect</td>
									<td>Junior Technical Author</td>
									<td>2019/02/18</td>
									<td>Penting</td>
									<td>Junior Technical Author</td>
									<td>Mengetahui</td>
									<td style="text-align: center;">
										<a class="btn btn-dark btn-xs" href="{{url('manager/disposisi/proses')}}"><i class="fa fa-refresh"></i>  Proses</a>
									</td>
								</tr>
								<tr>
									<td>SM/WK/II/12/2019</td>
									<td>System Architect</td>
									<td>Junior Technical Author</td>
									<td>2019/02/18</td>
									<td>Biasa</td>
									<td>Senior Javascript Developer</td>
									<td>Memproses</td>
									<td style="text-align: center;">
										<a class="btn btn-primary btn-xs" href="{{url('manager/disposisi/proses')}}"><i class="fa fa-refresh"></i>  Proses</a>
									</td>
								</tr>
								<tr>
									<td>SM/WK/II/12/2019</td>
									<td>System Architect</td>
									<td>Junior Technical Author</td>
									<td>2019/02/18</td>
									<td>Segera</td>
									<td>Integration Specialist</td>
									<td>Memproses</td>
									<td style="text-align: center;">
										<a class="btn btn-primary btn-xs" href="{{url('manager/disposisi/proses')}}"><i class="fa fa-refresh"></i>  Proses</a>
									</td>
								</tr>
								<tr>
									<td>SM/WK/II/12/2019</td>
									<td>System Architect</td>
									<td>Junior Technical Author</td>
									<td>2019/02/18</td>
									<td>Penting</td>
									<td>Office Manager</td>
									<td>Memeriksa</td>
									<td style="text-align: center;">
										<a class="btn btn-primary btn-xs" href="{{url('manager/disposisi/proses')}}"><i class="fa fa-refresh"></i>  Proses</a>
									</td>
								</tr>
								<tr>
									<td>SM/WK/II/12/2019</td>
									<td>System Architect</td>
									<td>Junior Technical Author</td>
									<td>2019/02/18</td>
									<td>Biasa</td>
									<td>Support Lead</td>
									<td>Memproses</td>
									<td style="text-align: center;">
										<a class="btn btn-dark btn-xs" href="{{url('manager/disposisi/proses')}}"><i class="fa fa-refresh"></i>  Proses</a>
									</td>
								</tr>
								<tr>
									<td>SM/WK/II/12/2019</td>
									<td>System Architect</td>
									<td>Junior Technical Author</td>
									<td>2019/02/18</td>
									<td>Penting</td>
									<td>Chief Executive Officer (CEO)</td>
									<td>Memeriksa</td>
									<td style="text-align: center;">
										<a class="btn btn-primary btn-xs" href="{{url('manager/disposisi/proses')}}"><i class="fa fa-refresh"></i>  Proses</a>
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