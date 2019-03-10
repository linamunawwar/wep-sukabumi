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
												<p class="data">SM/WK/II/12/2019</p>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Pengirim <span class="required">*</span>:</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">PD. Djembatan Masaa</p>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Kepada <span class="required">*</span>:</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">Kepala seksi Quality Control</p>
											</div>
										</div>
										<div class="form-group">
											<label for="tanggal" class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Terima *:</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">2019/03/23</p>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Nomor Surat <span class="required">*</span>:</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">SM/WK/II/12/2019</p>
											</div>
										</div>
										<div class="form-group">
											<label for="tanggal" class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Surat *:</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">2019/03/23</p>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12">Perihal:</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">Penawaran barang</p>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12">Sifat:</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">SEGERA</p>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12">Note :</label>
											<div class="col-md-8 col-sm-8 col-xs-12">
												<textarea name="alasan" class="form-control col-md-7 col-xs-12" width="200px" cols="20" rows="8" readonly="readonly">Mohon Untuk Segera Dilaksanakan</textarea>
											</div>
										</div>
									</form>
								</td>
								<td style="width: 50%;">
									<table class="table">
										<thead>
											<th style="width: 25%;"></th>
											<th>Mengetahui</th>
											<th>Menyelesaikan</th>
											<th>Memproses</th>
											<th>Memeriksa</th>
										</thead>
										<tbody>
											<tr>
												<td>KAPRO</td>
												<td>
													<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
													<span class="label label-success">DONE</span>
												</td>
												<td>
													<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
													<span class="label label-default">DONE</span>
												</td>
												<td>
													<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
													<span class="label label-default">DONE</span>
												</td>
												<td>
													<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
													<span class="label label-default">DONE</span>
												</td>
											</tr>
											<tr>
												<td>KALAP</td>
												<td>
													<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
													<span class="label label-success">DONE</span>
												</td>
												<td>
													<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
												</td>
												<td>
													<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
												</td>
												<td>
													<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
													<span class="label label-default">DONE</span>
												</td>
											</tr>
											<tr>
												<td>KASIE LOGLAT</td>
												<td>
													<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
												</td>
												<td>
													<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
												</td>
												<td>
													<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
												</td>
												<td>
													<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
												</td>
											</tr>
											<tr>
												<td>QUALITY CONTROL</td>
												<td>
													<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
													<span class="label label-success">DONE</span>
												</td>
												<td>
													<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
													<span class="label label-default">DONE</span>
												</td>
												<td>
													<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
													<span class="label label-default">DONE</span>
												</td>
												<td>
													<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
													<span class="label label-default">DONE</span>
												</td>
											</tr>
											<tr>
												<td>KASIE TEKNIK</td>
												<td>
													<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
												</td>
												<td>
													<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
												</td>
												<td>
													<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
												</td>
												<td>
													<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
												</td>
											</tr>
											<tr>
												<td>KASIE ADKON</td>
												<td>
													<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
												</td>
												<td>
													<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
												</td>
												<td>
													<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
												</td>
												<td>
													<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
												</td>
											</tr>
											<tr>
												<td>KASIE KSDM</td>
												<td>
													<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
												</td>
												<td>
													<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
												</td>
												<td>
													<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
												</td>
												<td>
													<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
												</td>
											</tr>
											<tr>
												<td>KASIE K3LP</td>
												<td>
													<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
												</td>
												<td>
													<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
												</td>
												<td>
													<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
												</td>
												<td>
													<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
												</td>
											</tr>
											<tr>
												<td>HUMAS</td>
												<td>
													<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
													<span class="label label-success">DONE</span>
												</td>
												<td>
													<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
												</td>
												<td>
													<span style="width: 50px; margin-left: 15px;"><i class="fa fa-minus"></i></span>
												</td>
												<td>
													<span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span>
													<span class="label label-default">DONE</span>
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