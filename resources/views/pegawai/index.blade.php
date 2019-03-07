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
						<h2>Daftar Pegawai </h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a href="{{url('pegawai/create')}}"><button class="btn btn-success"> Tambah Data</button></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>NIP</th>
									<th>Nama</th>
									<th style="width: 15%;">Jabatan</th>
									<th style="width: 15%;">Mulai Tugas Di Proyek</th>
									<th>Gaji</th>
									<th>Password</th>
									<th>Download</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>SA150795</td>
									<td>Tiger Nixon</td>
									<td>System Architect</td>
									<td>2011/04/25</td>
									<td>$320,800</td>
									<td>hesnd7w</td>
									<td>
										<a class="btn btn-success btn-xs"><i class="fa fa-download"></i> CV </a>
										<a class="btn btn-success btn-xs"><i class="fa fa-download"></i> MCU </a> 
										<a class="btn btn-success btn-xs"><i class="fa fa-download"></i> PKWT </a>
									</td>
									<td style="text-align: center;"><span class="label label-success">Approved By PM</span></td>
									<td style="text-align: center;"><button class="btn btn-dark btn-xs"><i class="fa fa-check"></i>  Approve</button></td>
								</tr>
								<tr>
									<td>SL170793</td>
									<td>Garrett Winters</td>
									<td>Accountant</td>
									<td>2011/07/25</td>
									<td>$170,750</td>
									<td>hske848</td>
									<td>
										<a class="btn btn-success btn-xs"><i class="fa fa-download"></i> CV </a>
										 <a class="btn btn-success btn-xs"><i class="fa fa-download"></i> MCU </a>
										 <a class="btn btn-success btn-xs"><i class="fa fa-download"></i> PKWT </a>
									</td>
									<td style="text-align: center;"><span class="label label-success">Approved By PM</span></td>
									<td style="text-align: center;"><button class="btn btn-dark btn-xs"><i class="fa fa-check"></i>  Approve</button></td>
								</tr>
								<tr>
									<td>HS1506795</td>
									<td>Ashton Cox</td>
									<td>Junior Technical Author</td>
									<td>2009/01/12</td>
									<td>$86,000</td>
									<td>dk08ehy</td>
									<td>
										<a class="btn btn-dark btn-xs"><i class="fa fa-download"></i> CV </a> 
										<a class="btn btn-dark btn-xs"><i class="fa fa-download"></i> MCU </a>
									</td>
									<td style="text-align: center;"><span class="label label-default">Not Approved</span></td>
									<td style="text-align: center;"><button class="btn btn-success btn-xs"><i class="fa fa-check"></i>  Approve</button></td>
								</tr>
								<tr>
									<td>QC150694</td>
									<td>Cedric Kelly</td>
									<td>Senior Javascript Developer</td>
									<td>2012/03/29</td>
									<td>$433,060</td>
									<td>sleur480</td>
									<td>
										<a class="btn btn-dark btn-xs"><i class="fa fa-download"></i> CV </a> 
										<a class="btn btn-dark btn-xs"><i class="fa fa-download"></i> MCU </a>
									</td>
									<td style="text-align: center;"><span class="label label-default">Not Approved</span></td>
									<td style="text-align: center;"><button class="btn btn-success btn-xs"><i class="fa fa-check"></i>  Approve</button></td>
								</tr>
								<tr>
									<td>SL080695</td>
									<td>Airi Satou</td>
									<td>Accountant</td>
									<td>2008/11/28</td>
									<td>$162,700</td>
									<td>ksleo08</td>
									<td>
										<a class="btn btn-dark btn-xs"><i class="fa fa-download"></i> CV </a> 
										<a class="btn btn-dark btn-xs"><i class="fa fa-download"></i> MCU </a>
										<a class="btn btn-dark btn-xs"><i class="fa fa-download"></i> PKWT </a>
									</td>
									<td style="text-align: center;"><span class="label label-default">Not Approved</span></td>
									<td style="text-align: center;"><button class="btn btn-success btn-xs"><i class="fa fa-check"></i>  Approve</button></td>
								</tr>
								<tr>
									<td>SO110695</td>
									<td>Brielle Williamson</td>
									<td>Integration Specialist</td>
									<td>2012/12/02</td>
									<td>$372,000</td>
									<td>po97htr</td>
									<td>
										<a class="btn btn-dark btn-xs"><i class="fa fa-download"></i> CV </a> 
										<a class="btn btn-dark btn-xs"><i class="fa fa-download"></i> MCU </a>
									</td>
									<td style="text-align: center;"><span class="label label-default">Not Approved</span></td>
									<td style="text-align: center;"><button class="btn btn-success btn-xs"><i class="fa fa-check"></i>  Approve</button></td>
								</tr>
								<tr>
									<td>SO190292</td>
									<td>Herrod Chandler</td>
									<td>Sales Assistant</td>
									<td>2012/08/06</td>
									<td>$137,500</td>
									<td>op09h76</td>
									<td>
										<a class="btn btn-dark btn-xs"><i class="fa fa-download"></i> CV </a> 
										<a class="btn btn-dark btn-xs"><i class="fa fa-download"></i> MCU </a>
									</td>
									<td style="text-align: center;"><span class="label label-default">Not Approved</span></td>
									<td style="text-align: center;"><button class="btn btn-success btn-xs"><i class="fa fa-check"></i>  Approve</button></td>
								</tr>
								<tr>
									<td>SA110695</td>
									<td>Rhona Davidson</td>
									<td>Integration Specialist</td>
									<td>2010/10/14</td>
									<td>$327,900</td>
									<td>sft56ju</td>
									<td>
										<a class="btn btn-dark btn-xs"><i class="fa fa-download"></i> CV </a> 
										<a class="btn btn-dark btn-xs"><i class="fa fa-download"></i> MCU </a>
									</td>
									<td style="text-align: center;"><span class="label label-default">Not Approved</span></td>
									<td style="text-align: center;"><button class="btn btn-success btn-xs"><i class="fa fa-check"></i>  Approve</button></td>
								</tr>
								<tr>
									<td>PM110695</td>
									<td>Colleen Hurst</td>
									<td>Javascript Developer</td>
									<td>2009/09/15</td>
									<td>$205,500</td>
									<td>jskop09</td>
									<td>
										<a class="btn btn-success btn-xs"><i class="fa fa-download"></i> CV </a> 
										<a class="btn btn-success btn-xs"><i class="fa fa-download"></i> MCU </a>
										<a class="btn btn-success btn-xs"><i class="fa fa-download"></i> PKWT </a>
									</td>
									<td style="text-align: center;"><span class="label label-success">Approved By PM</span></td>
									<td style="text-align: center;"><button class="btn btn-dark btn-xs"><i class="fa fa-check"></i>  Approve</button></td>
								</tr>
								<tr>
									<td>SO110695</td>
									<td>Sonya Frost</td>
									<td>Software Engineer</td>
									<td>2008/12/13</td>
									<td>$103,600</td>
									<td>op09ju7</td>
									<td>
										<a class="btn btn-success btn-xs"><i class="fa fa-download"></i> CV </a> 
										<a class="btn btn-success btn-xs"><i class="fa fa-download"></i> MCU </a>
										<a class="btn btn-success btn-xs"><i class="fa fa-download"></i> PKWT </a>
									</td>
									<td style="text-align: center;"><span class="label label-success">Approved By PM</span></td>
									<td style="text-align: center;"><button class="btn btn-dark btn-xs"><i class="fa fa-check"></i>  Approve</button></td>
								</tr>
								<tr>
									<td>SL030695</td>
									<td>Jena Gaines</td>
									<td>Office Manager</td>
									<td>2008/12/19</td>
									<td>$90,560</td>
									<td>io09uy6</td>
									<td>
										<a class="btn btn-success btn-xs"><i class="fa fa-download"></i> CV </a> 
										<a class="btn btn-success btn-xs"><i class="fa fa-download"></i> MCU </a>
									</td>
									<td style="text-align: center;"><span class="label label-success">Approved By PM</span></td>
									<td style="text-align: center;"><button class="btn btn-dark btn-xs"><i class="fa fa-check"></i>  Approve</button></td>
								</tr>
								<tr>
									<td>SC310591</td>
									<td>Quinn Flynn</td>
									<td>Support Lead</td>
									<td>2013/03/03</td>
									<td>$342,000</td>
									<td>op09hy6</td>
									<td>
										<a class="btn btn-success btn-xs"><i class="fa fa-download"></i> CV </a> 
										<a class="btn btn-success btn-xs"><i class="fa fa-download"></i> MCU </a>
									</td>
									<td style="text-align: center;"><span class="label label-success">Approved By PM</span></td>
									<td style="text-align: center;"><button class="btn btn-dark btn-xs"><i class="fa fa-check"></i>  Approve</button></td>
								</tr>
								<tr>
									<td>HS180693</td>
									<td>Angelica Ramos</td>
									<td>Chief Executive Officer (CEO)</td>
									<td>2009/10/09</td>
									<td>$1,200,000</td>
									<td>hjuyt78</td>
									<td>
										<a class="btn btn-dark btn-xs"><i class="fa fa-download"></i> CV </a> 
										<a class="btn btn-dark btn-xs"><i class="fa fa-download"></i> MCU </a>
									</td>
									<td style="text-align: center;"><span class="label label-default">Not Approved</span></td>
									<td style="text-align: center;"><button class="btn btn-success btn-xs"><i class="fa fa-check"></i>  Approve</button></td>
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