<?php

use App\KodeBagian;
$kode = KodeBagian::all();

?>
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
						<h2>Tambah Pegawai</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Nama Karyawan <span class="required">*</span>:</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input type="text" id="nama" name="nama" required="required" class="nama form-control col-md-7 col-xs-12">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-xs-12">Gender :</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div id="gender" class="btn-group" data-toggle="buttons">
											<label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
												<input type="radio" name="gender" value="male"> &nbsp; Male &nbsp;
											</label>
											<label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
												<input type="radio" name="gender" value="female"> Female
											</label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="tgl_lahir" class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Lahir * :</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<fieldset>
											<div class="control-group">
												<div class="controls">
													<div class="col-md-11 xdisplay_inputx form-group has-feedback">
														<input type="text" class="form-control has-feedback-left" id="single_cal1" placeholder="Tanggal Lahir" name="tgl_lahir" aria-describedby="inputSuccess2Status">
														<span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
											 			<span id="inputSuccess2Status" class="sr-only">(success)</span>
													</div>
												</div>
											</div>
										</fieldset>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="kode_bagian"> Bagian <span class="required">*</span>:</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<select class="form-control col-md-7 col-xs-12" required="required">
											<option value="">Pilih Bagian</option>
											@foreach($kode as $kd)
												<option value="{{$kd->kode}}">{{$kd->description}}</option>
											@endforeach
										</select>
									</div>
								</div>
							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
									<button class="btn btn-primary" type="button">Cancel</button>
									<button class="btn btn-primary" type="reset">Reset</button>
									<button type="submit" class="btn btn-success">Submit</button>
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