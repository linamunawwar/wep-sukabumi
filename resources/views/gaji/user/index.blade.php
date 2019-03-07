@extends('layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
    <style type="text/css">
    	.data{
    		padding: 6px 12px;
    		font-size: 15px;
    	}
    	.total{
    		font-weight: bold;
    		font-size: 17px;
    	}
    </style>
@endpush

@section('main_container')

    <!-- page content -->
    <div class="right_col" role="main">
    	<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Gaji Pegawai </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
							<div class="row">
								<div class="col-md-6">
									<h4><b>Pendapatan</b></h4>
								</div>
								<div class="col-md-6">
									<h4><b>Pengeluaran</b></h4>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-5 col-sm-5 col-xs-12" for="nama">Gaji Pokok: <span class="required">*</span></label>
										<div class="col-md-4 col-sm-4 col-xs-12">
											<p class="data">5.000.000</p>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">PPh 21: <span class="required">*</span></label>
										<div class="col-md-4 col-sm-4 col-xs-12">
											<p class="data">440.000</p>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-5 col-sm-5 col-xs-12" for="role"> Tunjangan Komunikasi: <span class="required">*</span>:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">200.000</p>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Astek: <span class="required">*</span></label>
										<div class="col-md-4 col-sm-4 col-xs-12">
											<p class="data">230.000</p>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-5 col-sm-5 col-xs-12" for="nama">Tunjangan Transportasi: <span class="required">*</span></label>
										<div class="col-md-4 col-sm-4 col-xs-12">
											<p class="data">300.000</p>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Pinjaman Kantor: <span class="required">*</span></label>
										<div class="col-md-4 col-sm-4 col-xs-12">
											<p class="data">-</p>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-5 col-sm-5 col-xs-12" for="role"> Uang Makan: <span class="required">*</span>:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">450.000</p>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="ln_solid"></div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-5 col-sm-5 col-xs-12" for="role"> Tunjangan Pajak: <span class="required">*</span>:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">210.000</p>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group total">
										<label class="control-label col-md-5 col-sm-5 col-xs-12" for="role"> <b>Total Pendapatan: <span class="required">*</span>:</b></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">210.000</p>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-5 col-sm-5 col-xs-12" for="role"> Over Time: <span class="required">*</span>:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">150.000</p>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group total">
										<label class="control-label col-md-5 col-sm-5 col-xs-12" for="role"> <b>Total Potongan: <span class="required">*</span>:</b></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">210.000</p>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-5 col-sm-5 col-xs-12" for="role"> Kesehatan: <span class="required">*</span>:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">100.000S</p>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group total">
										<label class="control-label col-md-5 col-sm-5 col-xs-12" for="role"> <b>Pendapatan Bersih: <span class="required">*</span>:</b></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">210.000</p>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
    </div>
    <!-- /page content -->
@endsection