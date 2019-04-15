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
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Posisi Jabatan <span class="required">*</span>:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" id="unit_kerja" name="unit_kerja" required="required" class="unit_kerja form-control col-md-7 col-xs-12">
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Uraian Singkat Tugas Pokok <span class="required">*</span>:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<textarea id="unit_kerja" name="unit_kerja" required="required" class="unit_kerja form-control col-md-7 col-xs-12"></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Persyaratan Jabatan</label>
									</div>
									<div class="ln_solid"></div>
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Peringkat Pendidikan <span class="required">*</span>:</label>
										<div class="col-md-3 col-sm-3 col-xs-12">
											<select class="kebutuhan form-control col-md-7 col-xs-12">
												<option>SMA</option>
												<option>SMK</option>
												<option>STM</option>
												<option>S1</option>
												<option>S2</option>
												<option>S3</option>
											</select>
										</div>
									</div>
									<div class="ln_solid"></div>
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Pengalaman Kerja</label>
									</div>
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Tahun :</label>
										<div class="col-md-2 col-sm-2 col-xs-12">
											<input type="text" id="kebutuhan" name="kebutuhan" required="required" class="kebutuhan form-control col-md-7 col-xs-12">
										</div>
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Jenis Pek. :</label>
										<div class="col-md-3 col-sm-3 col-xs-12">
											<input type="text" id="kebutuhan" name="kebutuhan" required="required" class="kebutuhan form-control col-md-7 col-xs-12">
										</div>
									</div>
									<div class="ln_solid"></div>
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Potensi</label>
									</div>
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">TPA :</label>
										<div class="col-md-2 col-sm-2 col-xs-12">
											<input type="text" id="kebutuhan" name="kebutuhan" required="required" class="kebutuhan form-control col-md-7 col-xs-12">
										</div>
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">EPT :</label>
										<div class="col-md-2 col-sm-2 col-xs-12">
											<input type="text" id="kebutuhan" name="kebutuhan" required="required" class="kebutuhan form-control col-md-7 col-xs-12">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Jumlah yang Dibutuhkan :</label>
										<div class="col-md-2 col-sm-2 col-xs-12">
											<input type="text" id="masuk" name="masuk" required="required" class="masuk form-control col-md-7 col-xs-12">
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Waktu Penempatan :</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" id="keluar" name="keluar" required="required" class="keluar form-control col-md-7 col-xs-12">
										</div>
									</div>
								</div>
							</div>

							<br>
							<div class="form-group">
								<div class="col-md-12" style="padding-right: 100px;">
									<button type="submit" class="btn btn-success pull-right"> Submit</button>
								</div>
							</div>
							<div class="ln_solid"></div>
							<table class="table table-bordered">
								<tr>
									<th rowspan="3">No.</th>
									<th rowspan="3">Posisi Jabatan</th>
									<th rowspan="3" style="width: 200px;">Uraian Tugas Pokok</th>
									<th colspan="5">Persyaratan Jabatan</th>
									<th rowspan="3" style="width: 20px;">Jumlah Yang Dibutuhkan</th>
									<th rowspan="3">Waktu Penempatan</th>
								</tr>
								<tr>
									<th rowspan="2">Peringkat Pendidikan</th>
									<th colspan="2">Pengalaman Kerja</th>
									<th colspan="2">Potensi</th>
								</tr>
								<tr>
									<th>Tahun</th>
									<th>Jenis Pekerjaan</th>
									<th>TPA</th>
									<th>EPT</th>
								</tr>
								<tbody>
									<tr>
										<td>1.</td>
										<td> Staff Engineering</td>
										<td> Bertanggung jawab terhadap mesin - mesin</td>
										<td> S1</td>
										<td> 2018</td>
										<td> Teknisi</td>
										<td> 500</td>
										<td> 480</td>
										<td> 2</td>
										<td> 02 Mei 2019</td>
									</tr>
									<!-- <tr>
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
									</tr> -->
								</tbody>
							</table>
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