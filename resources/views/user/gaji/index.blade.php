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
						@if($gaji)
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
							<div class="row">
								<div class="col-md-6">
									<h4><b>Pendapatan</b></h4>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-5 col-sm-5 col-xs-12" for="nama">Gaji Pokok: <span class="required">*</span></label>
										<div class="col-md-4 col-sm-4 col-xs-12">
											@if($gaji->gaji_pokok)
												<p class="data">{{$gaji->gaji_pokok}}</p>
											@endif
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group total">
										<label class="control-label col-md-5 col-sm-5 col-xs-12" for="role"> <b>Total Pendapatan: <span class="required">*</span>:</b></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											@if($gaji->gaji_pokok && $gaji->tunj_komunikasi && $gaji->uang_makan && $gaji->tunj_transportasi && $gaji->tunj_pph21)
												<p class="data">{{$gaji->gaji_pokok + $gaji->tunj_komunikasi + $gaji->uang_makan + $gaji->tunj_transportasi + $gaji->tunj_pph21}}</p>
											@endif
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group ">
										<label class="control-label col-md-5 col-sm-5 col-xs-12" for="role"> Tunjangan Komunikasi: <span class="required">*</span>:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											@if($gaji->tunj_komunikasi)
											<p class="data">{{$gaji->tunj_komunikasi}}</p>
											@endif
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group total">
										<label class="control-label col-md-5 col-sm-5 col-xs-12" for="nama"><b>Total Potongan: <span class="required">*</span>:</b></label>
										<div class="col-md-4 col-sm-4 col-xs-12">
											@if($gaji->pph21)
												<p class="data">{{$gaji->pph21}}</p>
											@endif
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-5 col-sm-5 col-xs-12" for="role"> Uang Makan: <span class="required">*</span>:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											@if($gaji->uang_makan)
												<p class="data">{{$gaji->uang_makan}}</p>
											@endif
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group total">
										<label class="control-label col-md-5 col-sm-5 col-xs-12" for="nama"><b>Pendapatan Bersih: <span class="required">*</span>:</b></label>
										<div class="col-md-4 col-sm-4 col-xs-12">
											@if($gaji->gaji_pokok && $gaji->tunj_komunikasi && $gaji->uang_makan && $gaji->tunj_transportasi && $gaji->tunj_pph21)
												<p class="data">{{$gaji->gaji_pokok + $gaji->tunj_komunikasi + $gaji->uang_makan + $gaji->tunj_transportasi}}</p>
											@endif
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label class="col-md-5 col-sm-5 col-xs-12 pull-left" for="role"> Lain - lain</label>
										<div class="ln_solid"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-5 col-sm-5 col-xs-12" for="nama">Tunjangan Transportasi: <span class="required">*</span></label>
										<div class="col-md-4 col-sm-4 col-xs-12">
											@if($gaji->tunj_trasportasi)
												<p class="data">{{$gaji->tunj_transportasi}}</p>
											@endif
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="ln_solid"></div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label class="col-md-5 col-sm-5 col-xs-12 pull-left" for="role"> Potongan</label>
										<div class="ln_solid"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-5 col-sm-5 col-xs-12" for="nama">PPH 21: <span class="required">*</span></label>
										<div class="col-md-4 col-sm-4 col-xs-12">
											@if($gaji->pph21)
												<p class="data">{{$gaji->pph21}}</p>
											@endif
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="ln_solid"></div>
								</div>
							</div>
							
						</form>
						@endif
					</div>
				</div>
			</div>
		</div>
    </div>
    <!-- /page content -->
@endsection