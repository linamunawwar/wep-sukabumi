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
						<h2>Daftar Gaji Pegawai </h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a href="{{url('gaji/create')}}"><button class="btn btn-primary"> <i class="fa fa-download"></i>  List Transfer</button></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>NIP</th>
									<th>Nama</th>
									<th>Gaji</th>
									<th>Uang Makan</th>
									<th>Uang Cuti</th>
									<th>Uang Telekomunikasi</th>
									<th>Bank</th>
									<th>No.Rekening</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>SA150795</td>
									<td>Tiger Nixon</td>
									<td>$320,800</td>
									<td>$320,800</td>
									<td>$320,800</td>
									<td>$320,800</td>
									<td>BNI</td>
									<td>1360005xxxxxx</td>
									<td style="text-align: center;"><button class="btn btn-default btn-xs"><i class="fa fa-edit"></i>  Edit</button> <button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Slip Gaji</button></td>
								</tr>
								<tr>
									<td>SL170793</td>
									<td>Garrett Winters</td>
									<td>$170,750</td>
									<td>$170,750</td>
									<td>$170,750</td>
									<td>$170,750</td>
									<td>Mandiri</td>
									<td>1360005xxxxxx</td>
									<td style="text-align: center;"><button class="btn btn-default btn-xs"><i class="fa fa-edit"></i>  Edit</button> <button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Slip Gaji</button></td>
								</tr>
								<tr>
									<td>HS1506795</td>
									<td>Ashton Cox</td>
									<td>$86,000</td>
									<td>$86,000</td>
									<td>$86,000</td>
									<td>$86,000</td>
									<td>BNI</td>
									<td>1360005xxxxxx</td>
									<td style="text-align: center;"><button class="btn btn-default btn-xs"><i class="fa fa-edit"></i>  Edit</button> <button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Slip Gaji</button></td>
								</tr>
								<tr>
									<td>QC150694</td>
									<td>Cedric Kelly</td>
									<td>$433,060</td>
									<td>$433,060</td>
									<td>$433,060</td>
									<td>$433,060</td>
									<td>BRI</td>
									<td>1360005xxxxxx</td>
									<td style="text-align: center;"><button class="btn btn-default btn-xs"><i class="fa fa-edit"></i>  Edit</button> <button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Slip Gaji</button></td>
								</tr>
								<tr>
									<td>SL080695</td>
									<td>Airi Satou</td>
									<td>$162,700</td>
									<td>$162,700</td>
									<td>$162,700</td>
									<td>$162,700</td>
									<td>BRI</td>
									<td>1360005xxxxxx</td>
									<td style="text-align: center;"><button class="btn btn-default btn-xs"><i class="fa fa-edit"></i>  Edit</button> <button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Slip Gaji</button></td>
								</tr>
								<tr>
									<td>SO110695</td>
									<td>Brielle Williamson</td>
									<td>$372,000</td>
									<td>$372,000</td>
									<td>$372,000</td>
									<td>$372,000</td>
									<td>Mandiri</td>
									<td>1360005xxxxxx</td>
									<td style="text-align: center;"><button class="btn btn-default btn-xs"><i class="fa fa-edit"></i>  Edit</button> <button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Slip Gaji</button></td>
								</tr>
								<tr>
									<td>SO190292</td>
									<td>Herrod Chandler</td>
									<td>$137,500</td>
									<td>$137,500</td>
									<td>$137,500</td>
									<td>$137,500</td>
									<td>BNI</td>
									<td>1360005xxxxxx</td>
									<td style="text-align: center;"><button class="btn btn-default btn-xs"><i class="fa fa-edit"></i>  Edit</button> <button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Slip Gaji</button></td>
								</tr>
								<tr>
									<td>SA110695</td>
									<td>Rhona Davidson</td>
									<td>$327,900</td>
									<td>$327,900</td>
									<td>$327,900</td>
									<td>$327,900</td>
									<td>Mandiri</td>
									<td>1360005xxxxxx</td>
									<td style="text-align: center;"><button class="btn btn-default btn-xs"><i class="fa fa-edit"></i>  Edit</button> <button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Slip Gaji</button></td>
								</tr>
								<tr>
									<td>PM110695</td>
									<td>Colleen Hurst</td>
									<td>$205,500</td>
									<td>$205,500</td>
									<td>$205,500</td>
									<td>$205,500</td>
									<td>Mandiri</td>
									<td>1360005xxxxxx</td>
									<td style="text-align: center;"><button class="btn btn-default btn-xs"><i class="fa fa-edit"></i>  Edit</button> <button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Slip Gaji</button></td>
								</tr>
								<tr>
									<td>SO110695</td>
									<td>Sonya Frost</td>
									<td>$103,600</td>
									<td>$103,600</td>
									<td>$103,600</td>
									<td>$103,600</td>
									<td>BNI</td>
									<td>1360005xxxxxx</td>
									<td style="text-align: center;"><button class="btn btn-default btn-xs"><i class="fa fa-edit"></i>  Edit</button> <button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Slip Gaji</button></td>
								</tr>
								<tr>
									<td>SL030695</td>
									<td>Jena Gaines</td>
									<td>$90,560</td>
									<td>$90,560</td>
									<td>$90,560</td>
									<td>$90,560</td>
									<td>BRI</td>
									<td>1360005xxxxxx</td>
									<td style="text-align: center;"><button class="btn btn-default btn-xs"><i class="fa fa-edit"></i>  Edit</button> <button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Slip Gaji</button></td>
								</tr>
								<tr>
									<td>SC310591</td>
									<td>Quinn Flynn</td>
									<td>$342,000</td>
									<td>$342,000</td>
									<td>$342,000</td>
									<td>$342,000</td>
									<td>BRI</td>
									<td>1360005xxxxxx</td>
									<td style="text-align: center;"><button class="btn btn-default btn-xs"><i class="fa fa-edit"></i>  Edit</button> <button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Slip Gaji</button></td>
								</tr>
								<tr>
									<td>HS180693</td>
									<td>Angelica Ramos</td>
									<td>$1,200,000</td>
									<td>$1,200,000</td>
									<td>$1,200,000</td>
									<td>$1,200,000</td>
									<td>Mandiri</td>
									<td>1360005xxxxxx</td>
									<td style="text-align: center;"><button class="btn btn-default btn-xs"><i class="fa fa-edit"></i>  Edit</button> <button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Slip Gaji</button></td>
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