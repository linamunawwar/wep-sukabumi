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
						<h2>Daftar Pengajuan SPJ </h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a href="{{url('spj/create')}}"><button class="btn btn-success"> Tambah Data</button></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>NIP</th>
									<th>Nama</th>
									<th>Tanggal</th>
									<th>Nominal</th>
									<th>Keperluan</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>SA150795</td>
									<td>Tiger Nixon</td>
									<td>2011/04/25</td>
									<td>800.000</td>
									<td>Pengagantian Biaya perjalanan dinas</td>
									<td style="text-align: center;"><span class="label label-success">Approved By PM</span></td>
									<td style="text-align: left;"><button class="btn btn-dark btn-xs"><i class="fa fa-check"></i>  Approve</button > <button class="btn btn-dark btn-xs"><i class="fa fa-download"></i>  Unduh</button></td>
								</tr>
								<tr>
									<td>SL170793</td>
									<td>Garrett Winters</td>
									<td>2011/04/25</td>
									<td>250.000</td>
									<td>Pengagantian Biaya perjalanan dinas</td>
									<td style="text-align: center;"><span class="label label-primary">Approved By Admin</span></td>
									<td style="text-align: left;"><button class="btn btn-dark btn-xs"><i class="fa fa-check"></i>  Approve</button></td>
								</tr>
								<tr>
									<td>HS1506795</td>
									<td>Ashton Cox</td>
									<td>2011/04/25</td>
									<td>870.000</td>
									<td>Pengagantian Biaya perjalanan dinas</td>
									<td style="text-align: center;"><span class="label label-primary">Approved By Admin</span></td>
									<td style="text-align: left;"><button class="btn btn-dark btn-xs"><i class="fa fa-check"></i>  Approve</button></td>
								</tr>
								<tr>
									<td>QC150694</td>
									<td>Cedric Kelly</td>
									<td>2011/04/25</td>
									<td>800.000</td>
									<td>Pengagantian Biaya perjalanan dinas</td>
									<td style="text-align: center;"><span class="label label-default">Not Approved</span></td>
									<td style="text-align: left;"><button class="btn btn-success btn-xs"><i class="fa fa-check"></i>  Approve</button></td>
								</tr>
								<tr>
									<td>SL080695</td>
									<td>Airi Satou</td>
									<td>2011/04/25</td>
									<td>500.000</td>
									<td>Pengagantian Biaya perjalanan dinas</td>
									<td style="text-align: center;"><span class="label label-default">Not Approved</span></td>
									<td style="text-align: left;"><button class="btn btn-success btn-xs"><i class="fa fa-check"></i>  Approve</button></td>
								</tr>
								<tr>
									<td>SO110695</td>
									<td>Brielle Williamson</td>
									<td>2011/04/25</td>
									<td>800.000</td>
									<td>Pengagantian Biaya perjalanan dinas</td>
									<td style="text-align: center;"><span class="label label-default">Not Approved</span></td>
									<td style="text-align: left;"><button class="btn btn-success btn-xs"><i class="fa fa-check"></i>  Approve</button></td>
								</tr>
								<tr>
									<td>SO190292</td>
									<td>Herrod Chandler</td>
									<td>2011/04/25</td>
									<td>800.000</td>
									<td>Pengagantian Biaya perjalanan dinas</td>
									<td style="text-align: center;"><span class="label label-primary">Approved By Admin</span></td>
									<td style="text-align: left;"><button class="btn btn-dark btn-xs"><i class="fa fa-check"></i>  Approve</button></td>
								</tr>
								<tr>
									<td>SA110695</td>
									<td>Rhona Davidson</td>
									<td>2011/04/25</td>
									<td>1.000.000</td>
									<td>Pengagantian Biaya perjalanan dinas</td>
									<td style="text-align: center;"><span class="label label-primary">Approved By Admin</span></td>
									<td style="text-align: left;"><button class="btn btn-dark btn-xs"><i class="fa fa-check"></i>  Approve</button></td>
								</tr>
								<tr>
									<td>PM110695</td>
									<td>Colleen Hurst</td>
									<td>2011/04/25</td>
									<td>900.000</td>
									<td>Pengagantian Biaya perjalanan dinas</td>
									<td style="text-align: center;"><span class="label label-success">Approved By PM</span></td>
									<td style="text-align: left;"><button class="btn btn-dark btn-xs"><i class="fa fa-check"></i>  Approve</button> <button class="btn btn-dark btn-xs"><i class="fa fa-download"></i>  Unduh</button></td>
								</tr>
								<tr>
									<td>SO110695</td>
									<td>Sonya Frost</td>
									<td>2011/04/25</td>
									<td>800.000</td>
									<td>Pengagantian Biaya perjalanan dinas</td>
									<td style="text-align: center;"><span class="label label-success">Approved By PM</span></td>
									<td style="text-align: left;"><button class="btn btn-dark btn-xs"><i class="fa fa-check"></i>  Approve</button> <button class="btn btn-dark btn-xs"><i class="fa fa-download"></i>  Unduh</button></td>
								</tr>
								<tr>
									<td>SL030695</td>
									<td>Jena Gaines</td>
									<td>2011/04/25</td>
									<td>200.000</td>
									<td>Pengagantian Biaya perjalanan dinas</td>
									<td style="text-align: center;"><span class="label label-primary">Approved By Admin</span></td>
									<td style="text-align: left;"><button class="btn btn-dark btn-xs"><i class="fa fa-check"></i>  Approve</button></td>
								</tr>
								<tr>
									<td>SC310591</td>
									<td>Quinn Flynn</td>
									<td>2011/04/25</td>
									<td>300.000</td>
									<td>Pengagantian Biaya perjalanan dinas</td>
									<td style="text-align: center;"><span class="label label-success">Approved By PM</span></td>
									<td style="text-align: left;"><button class="btn btn-dark btn-xs"><i class="fa fa-check"></i>  Approve</button> <button class="btn btn-dark btn-xs"><i class="fa fa-download"></i>  Unduh</button></td>
								</tr>
								<tr>
									<td>HS180693</td>
									<td>Angelica Ramos</td>
									<td>2011/04/25</td>
									<td>500.000</td>
									<td>Pengagantian Biaya perjalanan dinas</td>
									<td style="text-align: center;"><span class="label label-default">Not Approved</span></td>
									<td style="text-align: left;"><button class="btn btn-success btn-xs"><i class="fa fa-check"></i>  Approve</button></td>
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