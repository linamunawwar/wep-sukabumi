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
						<h2>Rencana Kebutuhan Pegawai </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
							<table class="table table-bordered">
								<tr>
									<th rowspan="3">No.</th>
									<th rowspan="3">Unit Kerja</th>
									<th rowspan="3">Kebutuhan</th>
									<th rowspan="3">Tersedia</th>
									<th rowspan="3">Kurang/ Lebih</th>
									<th colspan="4" >Pemenuhan</th>
									<th rowspan="3">Keterangan</th>
								</tr>
								<tr>
									<th colspan="4">Promosi / Mutasi</th>
								</tr>
								<tr>
									<th>Masuk</th>
									<th>Keluar</th>
									<th>Jumlah</th>
									<th>Rekrut</th>
								</tr>
								<tbody>
									<tr>
										<td>1.</td>
										<td><input type="text" name=""></td>
										<td><input type="text" name="" style="width: 50px;"></td>
										<td><input type="text" name="" style="width: 50px;"></td>
										<td><input type="text" name="" style="width: 50px;"></td>
										<td><input type="text" name="" style="width: 50px;"></td>
										<td><input type="text" name="" style="width: 50px;"></td>
										<td><input type="text" name="" style="width: 50px;"></td>
										<td><input type="text" name="" style="width: 50px;"></td>
										<td><input type="text" name="" style="width: 80px;"></td>
									</tr>
									<tr>
										<td>2.</td>
										<td><input type="text" name=""></td>
										<td><input type="text" name="" style="width: 50px;"></td>
										<td><input type="text" name="" style="width: 50px;"></td>
										<td><input type="text" name="" style="width: 50px;"></td>
										<td><input type="text" name="" style="width: 50px;"></td>
										<td><input type="text" name="" style="width: 50px;"></td>
										<td><input type="text" name="" style="width: 50px;"></td>
										<td><input type="text" name="" style="width: 50px;"></td>
										<td><input type="text" name="" style="width: 80px;"></td>
									</tr>
									<tr>
										<td>3.</td>
										<td><input type="text" name=""></td>
										<td><input type="text" name="" style="width: 50px;"></td>
										<td><input type="text" name="" style="width: 50px;"></td>
										<td><input type="text" name="" style="width: 50px;"></td>
										<td><input type="text" name="" style="width: 50px;"></td>
										<td><input type="text" name="" style="width: 50px;"></td>
										<td><input type="text" name="" style="width: 50px;"></td>
										<td><input type="text" name="" style="width: 50px;"></td>
										<td><input type="text" name="" style="width: 80px;"></td>
									</tr>
									<tr>
										<td>4.</td>
										<td><input type="text" name=""></td>
										<td><input type="text" name="" style="width: 50px;"></td>
										<td><input type="text" name="" style="width: 50px;"></td>
										<td><input type="text" name="" style="width: 50px;"></td>
										<td><input type="text" name="" style="width: 50px;"></td>
										<td><input type="text" name="" style="width: 50px;"></td>
										<td><input type="text" name="" style="width: 50px;"></td>
										<td><input type="text" name="" style="width: 50px;"></td>
										<td><input type="text" name="" style="width: 80px;"></td>
									</tr>
									<tr>
										<td>5.</td>
										<td><input type="text" name=""></td>
										<td><input type="text" name="" style="width: 50px;"></td>
										<td><input type="text" name="" style="width: 50px;"></td>
										<td><input type="text" name="" style="width: 50px;"></td>
										<td><input type="text" name="" style="width: 50px;"></td>
										<td><input type="text" name="" style="width: 50px;"></td>
										<td><input type="text" name="" style="width: 50px;"></td>
										<td><input type="text" name="" style="width: 50px;"></td>
										<td><input type="text" name="" style="width: 80px;"></td>
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