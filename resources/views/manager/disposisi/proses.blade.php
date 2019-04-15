@extends('layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
    <style type="text/css">
    	.data{
    		padding: 6px 12px;
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
						<h2>Disposisi </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Nomor Agenda <span class="required">*</span>:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">SM/WK/II/12/2019</p>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12">Sifat:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">SEGERA</p>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Pengirim <span class="required">*</span>:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">PD. Djembatan Masaa</p>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12">Perihal:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">Penawaran barang</p>
										</div>
									</div>
								</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Kepada <span class="required">*</span>:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">Kepala seksi Quality Control</p>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12">Tugas:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data" style="font-size: 15px;"><b>Memeriksa</b></p>
										</div>
									</div>
								</div>
							<div class="form-group">
								<label for="tanggal" class="control-label col-md-2 col-sm-2 col-xs-12">Tanggal Terima *:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<p class="data">2019/03/23</p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12" for="nama">Nomor Surat <span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<p class="data">SM/WK/II/12/2019</p>
								</div>
							</div>
							<div class="form-group">
								<label for="tanggal" class="control-label col-md-2 col-sm-2 col-xs-12">Tanggal Surat *:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<p class="data">2019/03/23</p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12">Note :</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<textarea name="alasan" class="form-control col-md-7 col-xs-12" cols="15" rows="8" readonly="readonly">Mohon Segera Diselesaikan</textarea>
								</div>
							</div>
							
							
							
							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
									<button class="btn btn-primary" type="button">Cancel</button>
									<button class="btn btn-primary" type="reset">Reset</button>
									<button type="submit" class="btn btn-success">Verifikasi</button>
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