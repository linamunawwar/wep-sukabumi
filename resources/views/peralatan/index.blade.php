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
						<h2>Peminjaman Peralatan </h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a href="{{url('peralatan/create')}}"><button class="btn btn-success"> Tambah Data</button></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>NIP</th>
									<th>Nama Pegawai</th>
									<th>Nama Barang</th>
									<th>Tipe Barang</th>
									<th>Tanggal Pinjam</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>SA150795</td>
									<td>Tiger Nixon</td>
									<td>Motor</td>
									<td>Kendaraan</td>
									<td>2011/04/25</td>
									<td style="text-align: center;">
										<span class="label label-success">Approved</span>
										<span class="label label-success">Dikembalikan</span>
									</td>
									<td style="text-align: left;"><button class="btn btn-dark btn-xs"><i class="fa fa-check"></i>  Approve</button > <button class="btn btn-dark btn-xs"><i class="fa fa-edit"></i>  Edit</button></td>
								</tr>
								<tr>
									<td>SA150795</td>
									<td>Tiger Nixon</td>
									<td>Laptop</td>
									<td>Elektronik</td>
									<td>2011/04/25</td>
									<td style="text-align: center;">
										<span class="label label-default">Approved</span>
									</td>
									<td style="text-align: left;"><button class="btn btn-success btn-xs"><i class="fa fa-check"></i>  Approve</button > <button class="btn btn-success btn-xs"><i class="fa fa-edit"></i>  Edit</button></td>
								</tr>
								<tr>
									<td>SA150795</td>
									<td>Tiger Nixon</td>
									<td>Motor</td>
									<td>Kendaraan</td>
									<td>2011/04/25</td>
									<td style="text-align: center;">
										<span class="label label-success">Approved</span>
										<span class="label label-success">Dipinjam</span>
									</td>
									<td style="text-align: left;"><button class="btn btn-dark btn-xs"><i class="fa fa-check"></i>  Approve</button > <button class="btn btn-success btn-xs"><i class="fa fa-edit"></i>  Edit</button></td>
								</tr>
								<tr>
									<td>SA150795</td>
									<td>Tiger Nixon</td>
									<td>Motor</td>
									<td>Kendaraan</td>
									<td>2011/04/25</td>
									<td style="text-align: center;">
										<span class="label label-success">Approved</span>
										<span class="label label-success">Dikembalikan</span>
									</td>
									<td style="text-align: left;"><button class="btn btn-dark btn-xs"><i class="fa fa-check"></i>  Approve</button > <button class="btn btn-dark btn-xs"><i class="fa fa-edit"></i>  Edit</button></td>
								</tr>
								<tr>
									<td>SA150795</td>
									<td>Tiger Nixon</td>
									<td>Laptop</td>
									<td>Elektronik</td>
									<td>2011/04/25</td>
									<td style="text-align: center;">
										<span class="label label-default">Approved</span>
									</td>
									<td style="text-align: left;"><button class="btn btn-success btn-xs"><i class="fa fa-check"></i>  Approve</button > <button class="btn btn-success btn-xs"><i class="fa fa-edit"></i>  Edit</button></td>
								</tr>
								<tr>
									<td>SA150795</td>
									<td>Tiger Nixon</td>
									<td>Motor</td>
									<td>Kendaraan</td>
									<td>2011/04/25</td>
									<td style="text-align: center;">
										<span class="label label-success">Approved</span>
										<span class="label label-success">Dipinjam</span>
									</td>
									<td style="text-align: left;"><button class="btn btn-dark btn-xs"><i class="fa fa-check"></i>  Approve</button > <button class="btn btn-success btn-xs"><i class="fa fa-edit"></i>  Edit</button></td>
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