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
						<h2>Disposisi </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
							<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Nomor Agenda <span class="required">*</span>:</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">SM/WK/II/12/2019</p>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Pengirim <span class="required">*</span>:</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">PD. Djembatan Masaa</p>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Kepada <span class="required">*</span>:</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">Kepala seksi Quality Control</p>
											</div>
										</div>
										<div class="form-group">
											<label for="tanggal" class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Terima *:</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">2019/03/23</p>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Nomor Surat <span class="required">*</span>:</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">SM/WK/II/12/2019</p>
											</div>
										</div>
										<div class="form-group">
											<label for="tanggal" class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Surat *:</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">2019/03/23</p>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12">Perihal:</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">Penawaran barang</p>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12">Sifat:</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">SEGERA</p>
											</div>
										</div>
							<div class="ln_solid"></div>
							<table class="table">
								<thead>
									<th></th>
									<th>Mengetahui</th>
									<th>Menyelesaikan</th>
									<th>Memproses</th>
									<th>Memeriksa</th>
								</thead>
								<tbody>
									<tr>
										<td>PM</td>
										<td><input type="radio" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="radio" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="radio" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="radio" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
									</tr>
									<tr>
										<td>SOM</td>
										<td><input type="radio" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="radio" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="radio" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="radio" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
									</tr>
									<tr>
										<td>SLEM</td>
										<td><input type="radio" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="radio" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="radio" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="radio" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
									</tr>
									<tr>
										<td>QC</td>
										<td><input type="radio" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="radio" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="radio" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="radio" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
									</tr>
									<tr>
										<td>SEM</td>
										<td><input type="radio" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="radio" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="radio" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="radio" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
									</tr>
									<tr>
										<td>SCM</td>
										<td><input type="radio" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="radio" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="radio" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="radio" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
									</tr>
									<tr>
										<td>SAM</td>
										<td><input type="radio" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="radio" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="radio" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="radio" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
									</tr>
									<tr>
										<td>HSE</td>
										<td><input type="radio" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="radio" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="radio" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="radio" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
									</tr>
									<tr>
										<td>HM</td>
										<td><input type="radio" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="radio" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="radio" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="radio" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
									</tr>
								</tbody>
							</table>
							<br>
							<div class="form-group">
								<label class="control-label col-md-1 col-sm-1 col-xs-12">Note :</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<textarea name="alasan" class="form-control col-md-7 col-xs-12" cols="15" rows="8"></textarea>
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