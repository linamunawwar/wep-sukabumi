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
						<h2>Slip Gaji </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="x_title">
							<h4>Pendapatan </h4>
							<div class="clearfix"></div>
						</div>
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama Karyawan <span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select class="form-control col-md-7 col-xs-12">
										<option value="0">Pilih Karyawan</option>
										<option value="SA150795">SA150795 - Tiger Nixon</option>
										<option value="SL170793">SL170793 - Garrett Winters</option>
										<option value="HS1506795">HS1506795 - Cedric Kelly</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Tunjangan Komunikasi:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="komunikasi" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Tunjangan Transportasi:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="transportasi" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Uang Makan:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="makan" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Tunjangan Pajak:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="pajak" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Overtime:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="overtime" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Kesehatan:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="kesehatan" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<br>
							<div class="x_title">
								<h4>Pengeluaran </h4>
								<div class="clearfix"></div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">PPh 21:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="pph21" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Astek:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="astek" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Pinjaman Kantor:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="pinjaman" class="form-control col-md-7 col-xs-12">
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