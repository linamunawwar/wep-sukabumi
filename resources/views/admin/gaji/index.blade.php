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
							<li><a href="{{url('admin/gaji/list_transfer')}}"><button class="btn btn-primary"> <i class="fa fa-download"></i>  List Transfer</button></a></li>
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
									<th  style="width: 5%;">Tunjangan Telekomunikasi</th>
									<th   style="width: 5%;">Tunjangan Transportasi</th>
									<th>Bank</th>
									<th>No.Rekening</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($gajis as $gaji)
									<tr>
										<td>{{$gaji->nip}}</td>
										<td>{{$gaji->pegawai->nama}}</td>
										<td>{{$gaji->gaji_pokok}}</td>
										<td>{{$gaji->uang_makan}}</td>
										<td>{{$gaji->tunj_komunikasi}}</td>
										<td>{{$gaji->tunj_transportasi}}</td>
										<td>{{$gaji->pegawai->bank->nama_bank}}</td>
										<td>{{$gaji->pegawai->bank->no_rekening}}</td>
										<td style="text-align: center;">
											<a class="btn btn-default btn-xs" href="{{'gaji/edit/'.$gaji->id.''}}"><i class="fa fa-edit"></i>  Edit</a> 
											<a class="btn btn-success btn-xs" href="{{'gaji/slip_gaji/unduh/'.$gaji->id.''}}"><i class="fa fa-download"></i>  Slip Gaji</a>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
    </div>
    <!-- /page content -->
@endsection