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
							<li><a href="{{url('admin/gaji/list_transfer/unduh')}}"><button class="btn btn-success"><i class="fa fa-download"></i> Download</button></a></li>
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
								@foreach($datas as $data)
									<?php
										if(($data->gaji->gaji_pokok == null) || ($data->gaji->gaji_pokok == '')){
											$data->gaji->gaji_pokok = 0;
										}
										if(($data->gaji->tunj_komunikasi == null) || ($data->gaji->tunj_komunikasi == '')){
											$data->gaji->tunj_komunikasi = 0;
										}
										if(($data->gaji->tunj_transportasi == null) || ($data->gaji->tunj_transportasi == '')){
											$data->gaji->tunj_transportasi = 0;
										}
										if(($data->gaji->uang_makan == null) || ($data->gaji->uang_makan == '')){
											$data->gaji->uang_makan = 0;
										}
										if(($data->gaji->tunj_pph21 == null) || ($data->gaji->tunj_pph21 == '')){
											$data->gaji->tunj_pph21 = 0;
										}
									?>
									<tr>
										<td>{{$data->nip}}</td>
										<td>{{$data->nama}}</td>
										<td>{{$data->bank->nama_bank}}</td>
										<td>{{$data->bank->no_rekening}}</td>
										<td>{{$data->gaji->gaji_pokok + $data->gaji->tunj_komunikasi + $data->gaji->tunj_transportasi + $data->gaji->uang_makan + $data->gaji->tunj_pph21}}</td>
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