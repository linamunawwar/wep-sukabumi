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
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama Form <span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="alasan" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Bagian:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="checkbox" name="kapro[]" > Project Manager <br>
									<input type="checkbox" name="kapro[]" > Site Operasional <br>
									<input type="checkbox" name="kapro[]" > Site Commercial <br>
									<input type="checkbox" name="kapro[]" > Site Administration <br>
									<input type="checkbox" name="kapro[]" > Site Engineering <br>
									<input type="checkbox" name="kapro[]" > Site Logistic <br>
									<input type="checkbox" name="kapro[]" > Health & Safety <br>
									<input type="checkbox" name="kapro[]" > Quality Control <br>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Upload Form:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="file" name="alasan" class="form-control col-md-7 col-xs-12">
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