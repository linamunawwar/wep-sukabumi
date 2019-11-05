@extends('layouts.blank')

@push('stylesheets')
	<style type="text/css">
		.data{
			padding: 6px 12px;
			font-size: 14px;
		}
	</style>
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
						<h2>Monitoring Disposisi </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<img src="{{asset("public/img/kop.png")}}" width="480px" height="80px" >
						<table class="table">
							<tr>	
								<td style="width: 50%;">
									<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Nomor Agenda <span class="required">*</span>:</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">{{$disposisi->monitoring}}</p>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Pengirim <span class="required">*</span>:</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">{{$disposisi->pengirim}}</p>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Kepada <span class="required">*</span>:</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">{{$disposisi->kepada}}</p>
											</div>
										</div>
										<div class="form-group">
											<label for="tanggal" class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Terima *:</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">{{konversi_tanggal($disposisi->tanggal_terima)}}</p>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Nomor Surat <span class="required">*</span>:</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">{{$disposisi->no_surat}}</p>
											</div>
										</div>
										<div class="form-group">
											<label for="tanggal" class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Surat *:</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">{{$disposisi->tanggal_surat}}</p>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12">Perihal:</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">{{$disposisi->perihal}}</p>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12">Sifat:</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">{{strtoupper($disposisi->sifat)}}</p>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12">Note :</label>
											<div class="col-md-8 col-sm-8 col-xs-12">
												<textarea name="alasan" class="form-control col-md-7 col-xs-12" width="200px" cols="20" rows="8" readonly="readonly">{{$disposisi->note}}</textarea>
											</div>
										</div>
									</form>
								</td>
								<td style="width: 50%;">
									<table class="table">
										<thead>
											<th style="width: 25%;"></th>
											<th>Diketahui</th>
											<th>Diselesaikan</th>
											<th>Diproses</th>
											<th>Diperiksa</th>
										</thead>
										<tbody>
											<tr>
												<td>PM</td>
												<td>
													@if($diketahui['posisi_id'] == 1)
														@if($diketahui['status'] == 1)
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-success">DONE</span>
														@else
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-default">DONE</span>
														@endif
													@else
														<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
													@endif
												</td>
												<td>
													@if($diselesaikan['posisi_id'] == 1)
														@if($diselesaikan['status'] == 1)
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-success">DONE</span>
														@else
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-default">DONE</span>
														@endif
													@else
														<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
													@endif
												</td>
												<td>
													@if($diproses['posisi_id'] == 1)
														@if($diproses['status'] == 1)
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-success">DONE</span>
														@else
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-default">DONE</span>
														@endif
													@else
														<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
													@endif
												</td>
												<td>
													@if($diperiksa['posisi_id'] == 1)
														@if($diperiksa['status'] == 1)
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-success">DONE</span>
														@else
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-default">DONE</span>
														@endif
													@else
														<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
													@endif
												</td>
											</tr>
											<tr>
												<td>SOM</td>
												<td>
													@if($diketahui['posisi_id'] == 8)
														@if($diketahui['status'] == 1)
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-success">DONE</span>
														@else
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-default">DONE</span>
														@endif
													@else
														<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
													@endif
												</td>
												<td>
													@if($diselesaikan['posisi_id'] == 8)
														@if($diselesaikan['status'] == 1)
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-success">DONE</span>
														@else
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-default">DONE</span>
														@endif
													@else
														<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
													@endif
												</td>
												<td>
													@if($diproses['posisi_id'] == 8)
														@if($diproses['status'] == 1)
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-success">DONE</span>
														@else
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-default">DONE</span>
														@endif
													@else
														<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
													@endif
												</td>
												<td>
													@if($diperiksa['posisi_id'] == 8)
														@if($diperiksa['status'] == 1)
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-success">DONE</span>
														@else
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-default">DONE</span>
														@endif
													@else
														<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
													@endif
												</td>
											</tr>
											<tr>
												<td>SPLEM</td>
												<td>
													@if($diketahui['posisi_id'] == 7)
														@if($diketahui['status'] == 1)
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-success">DONE</span>
														@else
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-default">DONE</span>
														@endif
													@else
														<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
													@endif
												</td>
												<td>
													@if($diselesaikan['posisi_id'] == 7)
														@if($diselesaikan['status'] == 1)
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-success">DONE</span>
														@else
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-default">DONE</span>
														@endif
													@else
														<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
													@endif
												</td>
												<td>
													@if($diproses['posisi_id'] == 7)
														@if($diproses['status'] == 1)
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-success">DONE</span>
														@else
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-default">DONE</span>
														@endif
													@else
														<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
													@endif
												</td>
												<td>
													@if($diperiksa['posisi_id'] == 7)
														@if($diperiksa['status'] == 1)
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-success">DONE</span>
														@else
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-default">DONE</span>
														@endif
													@else
														<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
													@endif
												</td>
											</tr>
											<tr>
												<td>SQHSEM</td>
												<td>
													@if($diketahui['posisi_id'] == 42)
														@if($diketahui['status'] == 1)
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-success">DONE</span>
														@else
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-default">DONE</span>
														@endif
													@else
														<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
													@endif
												</td>
												<td>
													@if($diselesaikan['posisi_id'] == 42)
														@if($diselesaikan['status'] == 1)
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-success">DONE</span>
														@else
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-default">DONE</span>
														@endif
													@else
														<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
													@endif
												</td>
												<td>
													@if($diproses['posisi_id'] == 42)
														@if($diproses['status'] == 1)
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-success">DONE</span>
														@else
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-default">DONE</span>
														@endif
													@else
														<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
													@endif
												</td>
												<td>
													@if($diperiksa['posisi_id'] == 42)
														@if($diperiksa['status'] == 1)
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-success">DONE</span>
														@else
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-default">DONE</span>
														@endif
													@else
														<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
													@endif
												</td>
											</tr>
											<tr>
												<td>SEM</td>
												<td>
													@if($diketahui['posisi_id'] == 4)
														@if($diketahui['status'] == 1)
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-success">DONE</span>
														@else
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-default">DONE</span>
														@endif
													@else
														<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
													@endif
												</td>
												<td>
													@if($diselesaikan['posisi_id'] == 4)
														@if($diselesaikan['status'] == 1)
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-success">DONE</span>
														@else
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-default">DONE</span>
														@endif
													@else
														<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
													@endif
												</td>
												<td>
													@if($diproses['posisi_id'] == 4)
														@if($diproses['status'] == 1)
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-success">DONE</span>
														@else
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-default">DONE</span>
														@endif
													@else
														<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
													@endif
												</td>
												<td>
													@if($diperiksa['posisi_id'] == 4)
														@if($diperiksa['status'] == 1)
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-success">DONE</span>
														@else
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-default">DONE</span>
														@endif
													@else
														<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
													@endif
												</td>
											</tr>
											<tr>
												<td>SCARM</td>
												<<td>
													@if($diketahui['posisi_id'] == 5)
														@if($diketahui['status'] == 1)
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-success">DONE</span>
														@else
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-default">DONE</span>
														@endif
													@else
														<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
													@endif
												</td>
												<td>
													@if($diselesaikan['posisi_id'] == 5)
														@if($diselesaikan['status'] == 1)
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-success">DONE</span>
														@else
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-default">DONE</span>
														@endif
													@else
														<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
													@endif
												</td>
												<td>
													@if($diproses['posisi_id'] == 5)
														@if($diproses['status'] == 1)
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-success">DONE</span>
														@else
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-default">DONE</span>
														@endif
													@else
														<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
													@endif
												</td>
												<td>
													@if($diperiksa['posisi_id'] == 5)
														@if($diperiksa['status'] == 1)
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-success">DONE</span>
														@else
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-default">DONE</span>
														@endif
													@else
														<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
													@endif
												</td>
											</tr>
											<tr>
												<td>SAM</td>
												<td>
													@if($diketahui['posisi_id'] == 6)
														@if($diketahui['status'] == 1)
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-success">DONE</span>
														@else
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-default">DONE</span>
														@endif
													@else
														<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
													@endif
												</td>
												<td>
													@if($diselesaikan['posisi_id'] == 6)
														@if($diselesaikan['status'] == 1)
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-success">DONE</span>
														@else
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-default">DONE</span>
														@endif
													@else
														<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
													@endif
												</td>
												<td>
													@if($diproses['posisi_id'] == 6)
														@if($diproses['status'] == 1)
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-success">DONE</span>
														@else
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-default">DONE</span>
														@endif
													@else
														<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
													@endif
												</td>
												<td>
													@if($diperiksa['posisi_id'] == 6)
														@if($diperiksa['status'] == 1)
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-success">DONE</span>
														@else
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-default">DONE</span>
														@endif
													@else
														<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
													@endif
												</td>
											</tr>
											<!-- <tr>
												<td>HSE</td>
												<td>
													@if($diketahui['posisi_id'] == 3)
														@if($diketahui['status'] == 1)
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-success">DONE</span>
														@else
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-default">DONE</span>
														@endif
													@else
														<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
													@endif
												</td>
												<td>
													@if($diselesaikan['posisi_id'] == 3)
														@if($diselesaikan['status'] == 1)
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-success">DONE</span>
														@else
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-default">DONE</span>
														@endif
													@else
														<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
													@endif
												</td>
												<td>
													@if($diproses['posisi_id'] == 3)
														@if($diproses['status'] == 1)
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-success">DONE</span>
														@else
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-default">DONE</span>
														@endif
													@else
														<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
													@endif
												</td>
												<td>
													@if($diperiksa['posisi_id'] == 3)
														@if($diperiksa['status'] == 1)
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-success">DONE</span>
														@else
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-default">DONE</span>
														@endif
													@else
														<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
													@endif
												</td>
											</tr> -->
											<tr>
												<td>Public Relation</td>
												<td>
													@if($diketahui['posisi_id'] == 24)
														@if($diketahui['status'] == 1)
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-success">DONE</span>
														@else
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-default">DONE</span>
														@endif
													@else
														<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
													@endif
												</td>
												<td>
													@if($diselesaikan['posisi_id'] == 24)
														@if($diselesaikan['status'] == 1)
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-success">DONE</span>
														@else
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-default">DONE</span>
														@endif
													@else
														<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
													@endif
												</td>
												<td>
													@if($diproses['posisi_id'] == 24)
														@if($diproses['status'] == 1)
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-success">DONE</span>
														@else
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-default">DONE</span>
														@endif
													@else
														<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
													@endif
												</td>
												<td>
													@if($diperiksa['posisi_id'] == 24)
														@if($diperiksa['status'] == 1)
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-success">DONE</span>
														@else
															<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
															<span class="label label-default">DONE</span>
														@endif
													@else
														<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
													@endif
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
    </div>
    <!-- /page content -->
@endsection