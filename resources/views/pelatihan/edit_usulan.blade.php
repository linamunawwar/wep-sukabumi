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
						<h2>Usulan Pelatihan </h2>
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
							<div class="row">
								<div class="col-md-6">
									<label for="tanggal" class="control-label col-md-3 col-sm-3 col-xs-12">Kepada *:</label>
									<div class="col-md-7 col-xs-12">
										<input type="checkbox" name="kapro[]" checked="checked" > Kabag SDM, Sistem & TI
									</div>
									<div class=" col-md-7 col-xs-12">
										<input type="checkbox" name="kapro[]"> Kepala Unit Bisnis
									</div>
								</div>
								<div class="col-md-6">
									<label for="tanggal" class="control-label col-md-3 col-sm-3 col-xs-12">Dari *:</label>
									<div class="col-md-7 col-xs-12">
										<input type="checkbox" name="kapro[]" > Kepala Unit Bisnis : DIVISI I
									</div>
									<div class="col-md-7 col-xs-12">
										<input type="checkbox" name="kapro[]" checked="checked" > Kepala Proyek : Becakayu 2A
									</div>
								</div>
							</div>
							<br/>
							<table class="table table-bordered">
								<tr>
									<th rowspan="2">No.</th>
									<th rowspan="2">Nama Pegawai</th>
									<th rowspan="2">Jabatan</th>
									<th rowspan="2">Nama Pelatihan yang diusulkan</th>
									<th colspan="4">Jadwal</th>
								</tr>
								<tr>
									<th>Triwulan I</th>
									<th>Triwulan II</th>
									<th>Triwulan III</th>
									<th>Triwulan IV</th>
								</tr>
								
								<tbody>
									<tr>
										<td>1.</td>
										<td>xxxxxxxxxxxxx</td>
										<td>OJT</td>
										<td>Pembekalan Khusus Calon Kapro Tipe B</td>
										<td><span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>2.</td>
										<td>xxxxxxxxxxxxx</td>
										<td>OJT</td>
										<td> - Pelatihan Leadership Development Program <br> - Pelatihan Metode Konstruksi<br>- General Superintendent Pengairan</td>
										<td><span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td>- Pelatihan Metode Konstruksi</td>
										<td></td>
										<td><span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td>- General Superintendent Pengairan</td>
										<td></td>
										<td></td>
										<td><span style="width: 50px; margin-left: 15px;"><i class="fa fa-check"></i></span></td>
										<td></td>
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