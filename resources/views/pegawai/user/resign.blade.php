@extends('layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

@section('main_container')
<?php
	$resign = 1;
?>
    <!-- page content -->
    <div class="right_col" role="main">
    	<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Pengajuan Resign </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						@if($resign != 1)
							<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama Karyawan <span class="required">*</span>:</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<p style="padding: 6px 12px; font-size: 15px;">{{Auth::user()->name}}</p>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">NIP <span class="required">*</span>:</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<p style="padding: 6px 12px; font-size: 15px;">SA150795</p>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Alasan:</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<textarea name="alasan" class="form-control" rows="5"></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Surat Pengunduran Diri: <br>*Sudah di ttd direct manager</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input type="file" name="surat_undur_diri" class="form-control">
									</div>
								</div>
								
								<div class="ln_solid"></div>
								<div class="ln_solid"></div>
								<div class="form-group">
									<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
										<button class="btn btn-primary" type="button">Cancel</button>
										<button class="btn btn-primary" type="reset">Reset</button>
										<button type="submit" class="btn btn-success">Submit</button>
									</div>
								</div>
							</form>
						@else
							<div>
								<h4 for="nama" style="display: inline-block;">Status Pengajuan resign:</h4>
								<div style="padding: 10px 12px;display: inline-block; font-size: 18px;">
									<span class="label label-default">Menunggu Approve SDM</span>
								</div>
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
    </div>
    <!-- /page content -->
@endsection