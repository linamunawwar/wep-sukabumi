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
						<h2>Rencana Kebutuhan Pegawai </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Bagian</th>
									<th>Tanggal</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Health & Saftey</td>
									<td>2011/04/25</td>
									<td style="text-align: center;"><span class="label label-default">Not Approved </span></td>
									<td style="text-align: left;"><button class="btn btn-dark btn-xs"><i class="fa fa-download"></i>  Unduh</button></td>
								</tr>
								<tr>
									<td>Quality Control</td>
									<td>2011/04/25</td>
									<td style="text-align: center;"><span class="label label-success">Approved By PM</span></td>
									<td style="text-align: left;"> <button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Unduh</button></td>
								</tr>
								<tr>
									<td>Quality Control</td>
									<td>2011/04/25</td>
									<td style="text-align: center;"><span class="label label-success">Approved By PM</span></td>
									<td style="text-align: left;"> <button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Unduh</button></td>
								</tr>
								<tr>
									<td>Site Operational</td>
									<td>2011/04/25</td>
									<td style="text-align: center;"><span class="label label-success">Approved By PM</span></td>
									<td style="text-align: left;"> <button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Unduh</button></td>
								</tr>
								<tr>
									<td>Health & Safety</td>
									<td>2011/04/25</td>
									<td style="text-align: center;"><span class="label label-default">Not Approved</span></td>
									<td style="text-align: left;"><button class="btn btn-dark btn-xs"><i class="fa fa-download"></i>  Unduh</button></td>
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