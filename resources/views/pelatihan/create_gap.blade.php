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
						<h2>GAP Analysis </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
							<div class="form-group">
								<label for="tanggal" class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal *:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<fieldset>
										<div class="control-group">
											<div class="controls">
												<div class="col-md-11 xdisplay_inputx form-group has-feedback">
													<input type="text" class="form-control has-feedback-left" id="single_cal1" placeholder="Tanggal" name="tanggal" aria-describedby="inputSuccess2Status">
													<span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
										 			<span id="inputSuccess2Status" class="sr-only">(success)</span>
												</div>
											</div>
										</div>
									</fieldset>
								</div>
							</div>
							<table class="table table-bordered">
								<tr>
									<th>No.</th>
									<th>Nama</th>
									<th>Grade</th>
									<th style="width: 250px;" >Syarat Kompetensi</th>
									<th style="width: 250px;">Evaluasi Kompetensi</th>
									<th>Gap</th>
									<th>Keterangan</th>
								</tr>
								
								<tbody>
									<tr>
										<td>1.</td>
										<td><input type="text" name=""></td>
										<td><input type="text" name="" style="width: 50px;"></td>
										<td><textarea rows="15" style="width: 250px;"></textarea></td>
										<td><textarea rows="15" style="width: 250px;"></textarea></td>
										<td><input type="text" name="" style="width: 30px;"></td>
										<td><textarea rows="15" style="width: 150px;"></textarea></td>
									</tr>
									<tr>
										<td>2.</td>
										<td><input type="text" name=""></td>
										<td><input type="text" name="" style="width: 50px;"></td>
										<td><textarea rows="15" style="width: 250px;"></textarea></td>
										<td><textarea rows="15" style="width: 250px;"></textarea></td>
										<td><input type="text" name="" style="width: 30px;"></td>
										<td><textarea rows="15" style="width: 150px;"></textarea></td>
									</tr>
								</tbody>
							</table>
							
							
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