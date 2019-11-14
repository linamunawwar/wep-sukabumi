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
											<label class="control-label col-md-4 col-sm-4 col-xs-12">Note PM:</label>
											<div class="col-md-8 col-sm-8 col-xs-12">
												<textarea name="alasan" class="form-control col-md-7 col-xs-12" width="200px" cols="20" rows="8" readonly="readonly">{{$disposisi->note_pm}}</textarea>
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
													<?php $index = array_search('Diketahui', array_column($pm, 'tugas'));  ?>
													@if(array_search('Diketahui', array_column($pm, 'tugas')) !== false)
														@if($pm[$index]['status'] == 1)
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
													<?php $index = array_search('Diselesaikan', array_column($pm, 'tugas'));  ?>
													@if(array_search('Diselesaikan', array_column($pm, 'tugas')) !== false)
														@if($pm[$index]['status'] == 1)
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
													<?php $index = array_search('Diproses', array_column($pm, 'tugas'));  ?>
													@if(array_search('Diproses', array_column($pm, 'tugas')) !== false)
														@if($pm[$index]['status'] == 1)
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
													<?php $index = array_search('Diperiksa', array_column($pm, 'tugas'));  ?>
													@if(array_search('Diperiksa', array_column($pm, 'tugas')) !== false)
														@if($pm[$index]['status'] == 1)
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
													<?php $index = array_search('Diketahui', array_column($som, 'tugas'));  ?>
													@if(array_search('Diketahui', array_column($som, 'tugas')) !== false)
														@if($som[$index]['status'] == 1)
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
													<?php $index = array_search('Diselesaikan', array_column($som, 'tugas'));  ?>
													@if(array_search('Diselesaikan', array_column($som, 'tugas')) !== false)
														@if($som[$index]['status'] == 1)
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
													<?php $index = array_search('Diproses', array_column($som, 'tugas'));  ?>
													@if(array_search('Diproses', array_column($som, 'tugas')) !== false)
														@if($som[$index]['status'] == 1)
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
													<?php $index = array_search('Diperiksa', array_column($som, 'tugas'));  ?>
													@if(array_search('Diperiksa', array_column($som, 'tugas')) !== false)
														@if($som[$index]['status'] == 1)
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
													<?php $index = array_search('Diketahui', array_column($splem, 'tugas'));  ?>
													@if(array_search('Diketahui', array_column($splem, 'tugas')) !== false)
														@if($splem[$index]['status'] == 1)
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
													<?php $index = array_search('Diselesaikan', array_column($splem, 'tugas'));  ?>
													@if(array_search('Diselesaikan', array_column($splem, 'tugas')) !== false)
														@if($splem[$index]['status'] == 1)
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
													<?php $index = array_search('Diproses', array_column($splem, 'tugas'));  ?>
													@if(array_search('Diproses', array_column($splem, 'tugas')) !== false)
														@if($splem[$index]['status'] == 1)
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
													<?php $index = array_search('Diperiksa', array_column($splem, 'tugas'));  ?>
													@if(array_search('Diperiksa', array_column($splem, 'tugas')) !== false)
														@if($splem[$index]['status'] == 1)
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
													<?php $index = array_search('Diketahui', array_column($sqhsem, 'tugas'));  ?>
													@if(array_search('Diketahui', array_column($sqhsem, 'tugas')) !== false)
														@if($sqhsem[$index]['status'] == 1)
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
													<?php $index = array_search('Diselesaikan', array_column($sqhsem, 'tugas'));  ?>
													@if(array_search('Diselesaikan', array_column($sqhsem, 'tugas')) !== false)
														@if($sqhsem[$index]['status'] == 1)
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
													<?php $index = array_search('Diproses', array_column($sqhsem, 'tugas'));  ?>
													@if(array_search('Diproses', array_column($sqhsem, 'tugas')) !== false)
														@if($sqhsem[$index]['status'] == 1)
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
													<?php $index = array_search('Diperiksa', array_column($sqhsem, 'tugas'));  ?>
													@if(array_search('Diperiksa', array_column($sqhsem, 'tugas')) !== false)
														@if($sqhsem[$index]['status'] == 1)
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
													<?php $index = array_search('Diketahui', array_column($sem, 'tugas'));  ?>
													@if(array_search('Diketahui', array_column($sem, 'tugas')) !== false)
														@if($sem[$index]['status'] == 1)
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
													<?php $index = array_search('Diselesaikan', array_column($sem, 'tugas'));  ?>
													@if(array_search('Diselesaikan', array_column($sem, 'tugas')) !== false)
														@if($sem[$index]['status'] == 1)
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
													<?php $index = array_search('Diproses', array_column($sem, 'tugas'));  ?>
													@if(array_search('Diproses', array_column($sem, 'tugas')) !== false)
														@if($sem[$index]['status'] == 1)
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
													<?php $index = array_search('Diperiksa', array_column($sem, 'tugas'));  ?>
													@if(array_search('Diperiksa', array_column($sem, 'tugas')) !== false)
														@if($sem[$index]['status'] == 1)
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
													<?php $index = array_search('Diketahui', array_column($scarm, 'tugas'));  ?>
													@if(array_search('Diketahui', array_column($scarm, 'tugas')) !== false)
														@if($scarm[$index]['status'] == 1)
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
													<?php $index = array_search('Diselesaikan', array_column($scarm, 'tugas'));  ?>
													@if(array_search('Diselesaikan', array_column($scarm, 'tugas')) !== false)
														@if($scarm[$index]['status'] == 1)
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
													<?php $index = array_search('Diproses', array_column($scarm, 'tugas'));  ?>
													@if(array_search('Diproses', array_column($scarm, 'tugas')) !== false)
														@if($scarm[$index]['status'] == 1)
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
													<?php $index = array_search('Diperiksa', array_column($scarm, 'tugas'));  ?>
													@if(array_search('Diperiksa', array_column($scarm, 'tugas')) !== false)
														@if($scarm[$index]['status'] == 1)
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
													<?php $index = array_search('Diketahui', array_column($sam, 'tugas'));  ?>
													@if(array_search('Diketahui', array_column($sam, 'tugas')) !== false)
														@if($sam[$index]['status'] == 1)
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
													<?php $index = array_search('Diselesaikan', array_column($sam, 'tugas'));  ?>
													@if(array_search('Diselesaikan', array_column($sam, 'tugas')) !== false)
														@if($sam[$index]['status'] == 1)
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
													<?php $index = array_search('Diproses', array_column($sam, 'tugas'));  ?>
													@if(array_search('Diproses', array_column($sam, 'tugas')) !== false)
														@if($sam[$index]['status'] == 1)
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
													<?php $index = array_search('Diperiksa', array_column($sam, 'tugas'));  ?>
													@if(array_search('Diperiksa', array_column($sam, 'tugas')) !== false)
														@if($sam[$index]['status'] == 1)
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
												<td>Public Relation</td>
												<td>
													<?php $index = array_search('Diketahui', array_column($public, 'tugas'));  ?>
													@if(array_search('Diketahui', array_column($public, 'tugas')) !== false)
														@if($public[$index]['status'] == 1)
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
													<?php $index = array_search('Diselesaikan', array_column($public, 'tugas'));  ?>
													@if(array_search('Diselesaikan', array_column($public, 'tugas')) !== false)
														@if($public[$index]['status'] == 1)
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
													<?php $index = array_search('Diproses', array_column($public, 'tugas'));  ?>
													@if(array_search('Diproses', array_column($public, 'tugas')) !== false)
														@if($public[$index]['status'] == 1)
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
													<?php $index = array_search('Diperiksa', array_column($public, 'tugas'));  ?>
													@if(array_search('Diperiksa', array_column($public, 'tugas')) !== false)
														@if($public[$index]['status'] == 1)
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