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
						<h2>List Transfer Gaji </h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a href="{{url('gaji/list_transfer/unduh')}}"><button class="btn btn-success"><i class="fa fa-download"></i> Download</button></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>NIP</th>
									<th>Nama</th>
									<th>Bank</th>
									<th>Nomor Rekening</th>
									<th>Nominal</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>SA150795</td>
									<td>Tiger Nixon</td>
									<td>BNI</td>
									<td>1360005xxxxxx</td>
									<td>$320,800</td>
								</tr>
								<tr>
									<td>SL170793</td>
									<td>Garrett Winters</td>
									<td>BRI</td>
									<td>1360005xxxxxx</td>
									<td>$320,800</td>
								</tr>
								<tr>
									<td>HS1506795</td>
									<td>Ashton Cox</td>
									<td>Mandiri</td>
									<td>1360005xxxxxx</td>
									<td>$320,800</td>
								</tr>
								<tr>
									<td>QC150694</td>
									<td>Cedric Kelly</td>
									<td>BNI</td>
									<td>1360005xxxxxx</td>
									<td>$320,800</td>
								</tr>
								<tr>
									<td>SL080695</td>
									<td>Airi Satou</td>
									<td>BRI</td>
									<td>1360005xxxxxx</td>
									<td>$320,800</td>
								</tr>
								<tr>
									<td>SO110695</td>
									<td>Brielle Williamson</td>
									<td>Mandiri</td>
									<td>1360005xxxxxx</td>
									<td>$320,800</td>
								</tr>
								<tr>
									<td>SO190292</td>
									<td>Herrod Chandler</td>
									<td>BNI</td>
									<td>1360005xxxxxx</td>
									<td>$320,800</td>
								</tr>
								<tr>
									<td>SA110695</td>
									<td>Rhona Davidson</td>
									<td>BRI</td>
									<td>1360005xxxxxx</td>
									<td>$320,800</td>
								</tr>
								<tr>
									<td>PM110695</td>
									<td>Colleen Hurst</td>
									<td>BRI</td>
									<td>1360005xxxxxx</td>
									<td>$320,800</td>
								</tr>
								<tr>
									<td>SO110695</td>
									<td>Sonya Frost</td>
									<td>BCA</td>
									<td>1360005xxxxxx</td>
									<td>$320,800</td>
								</tr>
								<tr>
									<td>SL030695</td>
									<td>Jena Gaines</td>
									<td>BNI</td>
									<td>1360005xxxxxx</td>
									<td>$320,800</td>
								</tr>
								<tr>
									<td>SC310591</td>
									<td>Quinn Flynn</td>
									<td>Mandiri</td>
									<td>1360005xxxxxx</td>
									<td>$320,800</td>
								</tr>
								<tr>
									<td>HS180693</td>
									<td>Angelica Ramos</td>
									<td>BNI</td>
									<td>1360005xxxxxx</td>
									<td>$320,800</td>
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