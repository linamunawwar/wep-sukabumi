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
						<h2>Arsip </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama Form <span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="nama_form" class="form-control col-md-7 col-xs-12" value="{{$arsip->nama_form}}">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Bagian:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<?php $checked = ($arsip->PM == 'on')? 'checked' : ''; ?>
									<input type="checkbox" name="PM" {{$checked}} > Project Manager <br>
									<?php $checked = ($arsip->SO == 'on')? 'checked' : ''; ?>
									<input type="checkbox" name="SO" {{$checked}}> Site Operasional <br>
									<?php $checked = ($arsip->SC == 'on')? 'checked' : ''; ?>
									<input type="checkbox" name="SC" {{$checked}}> Site Commercial <br>
									<?php $checked = ($arsip->SA == 'on')? 'checked' : ''; ?>
									<input type="checkbox" name="SA" {{$checked}}> Site Administration <br>
									<?php $checked = ($arsip->SE == 'on')? 'checked' : ''; ?>
									<input type="checkbox" name="SE" {{$checked}}> Site Engineering <br>
									<?php $checked = ($arsip->SL == 'on')? 'checked' : ''; ?>
									<input type="checkbox" name="SL" {{$checked}} > Site Logistic <br>
									<?php $checked = ($arsip->HS == 'on')? 'checked' : ''; ?>
									<input type="checkbox" name="HS" {{$checked}}> Health & Safety <br>
									<?php $checked = ($arsip->QC == 'on')? 'checked' : ''; ?>
									<input type="checkbox" name="QC" {{$checked}}> Quality Control <br>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Upload Form:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="file" name="file" class="form-control col-md-7 col-xs-12"><br>
									*pastikan nama file tidak mengandung simbol '/'
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
					</div>
				</div>
			</div>
		</div>
    </div>
    <!-- /page content -->
@endsection