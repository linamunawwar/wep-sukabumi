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
						<h2>CV Pegawai</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
							<div class="x_title">
								<h4>Data Pribadi </h4>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Nama Karyawan <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" id="nama" name="nama" required="required" class="nama form-control col-md-7 col-xs-12">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="gelar_depan">Gelar Depan <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" id="gelar_depan" name="gelar_depan"  class="form-control col-md-7 col-xs-12">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12">Gender</label>
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
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="gelar_blkg" class="control-label col-md-4 col-sm-4 col-xs-12">Gelar Belakang</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input id="gelar-blkg" class="form-control col-md-7 col-xs-12 gelar_blkg" type="text" name="gelar_blkg">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="agama">Agama <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" id="agama" name="agama" required="required" class="agama form-control col-md-7 col-xs-12">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="tempat_lahir" class="control-label col-md-4 col-sm-4 col-xs-12">Tempat Lahir</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input id="tempat_lahir" class="form-control col-md-7 col-xs-12 tempat-lahir" type="text" name="tempat_lahir">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="status_kawin">Status Perkawinan <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" id="status_kawin" name="status_kawin" required="required" class="status_kawin form-control col-md-7 col-xs-12">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="tgl_lahir" class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Lahir *</label>
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
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="suami_istri" class="control-label col-md-4 col-sm-4 col-xs-12">Nama Suami / Istri</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input id="suami_istri" class="form-control col-md-7 col-xs-12 suami_istri-lahir" type="text" name="suami_istri">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="alamat_tetap" class="control-label col-md-4 col-sm-4 col-xs-12">Alamat Rumah Tetap</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<textarea id="alamat_tetap" class="form-control col-md-7 col-xs-12 alamat_tetap" type="text" name="alamat_tetap"></textarea>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama_anak">Nama Anak <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<textarea id="nama_anak" name="nama_anak" required="required" class="nama form-control col-md-7 col-xs-12"></textarea>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="alamat_sementara" class="control-label col-md-4 col-sm-4 col-xs-12">Alamat Rumah Sementara</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<textarea id="alamat_sementara" class="form-control col-md-7 col-xs-12 alamat_sementara" type="text" name="alamat_sementara"></textarea>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="no_telp">No. Telepon <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" id="no_telp" name="no_telp"  class="form-control col-md-7 col-xs-12">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="email_pribadi">Alamat Email Pribadi <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="email" id="email_pribadi" name="email_pribadi"  class="form-control col-md-7 col-xs-12">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="no_hp">No. HP <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" id="no_hp" name="no_hp"  class="form-control col-md-7 col-xs-12">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="email_kantor">Alamat Email Kantor <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="email" id="email_kantor" name="email_kantor"  class="form-control col-md-7 col-xs-12">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="no_fax">No. Faximile <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" id="no_fax" name="no_fax"  class="form-control col-md-7 col-xs-12">
										</div>
									</div>
								</div>
							</div>
							
							<div class="ln_solid"></div>
							<!-- ----------------------------------------------------- -->
							<div class="x_title">
								<h4>Data Bank & Asuransi </h4>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama_bank">Nama Bank <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" id="nama_bank" name="nama_bank" required="required" class="nama_bank form-control col-md-7 col-xs-12">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12">Asuransi Lainnya</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="no_rek">No. Rekening <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" id="no_rek" name="no_rek"  class="form-control col-md-7 col-xs-12">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12">Nama Asuransi</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" id="nama_asuransi" name="nama_asuransi" class="nama_asuransi form-control col-md-7 col-xs-12">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="npwp" class="control-label col-md-4 col-sm-4 col-xs-12">No. NPWP</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input id="npwp" class="form-control col-md-7 col-xs-12 npwp" type="text" name="npwp">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nomor_asuransi">Nomor </label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" id="nomor_asuransi" name="nomor_asuransi" class="nomor_asuransi form-control col-md-7 col-xs-12">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="jamsostek" class="control-label col-md-4 col-sm-4 col-xs-12">No. Jamsostek</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input id="jamsostek" class="form-control col-md-7 col-xs-12 jamsostek" type="text" name="jamsostek">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="dplk" class="control-label col-md-4 col-sm-4 col-xs-12">No. DPLK</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" id="dplk" class="form-control col-md-7 col-xs-12 dplk" type="text" name="dplk">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="jiwasraya" class="control-label col-md-4 col-sm-4 col-xs-12">No. Jiwasraya</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" id="jiwasraya" class="form-control col-md-7 col-xs-12 jiwasraya" type="text" name="jiwasraya">
										</div>
									</div>
								</div>
							</div>
							<!-- ------------------------------------------------------------------------------------- -->
							<div class="ln_solid"></div>
							<div class="x_title">
								<h4>Pendidikan Formal </h4>
							</div>
							<div class="row">
								<div class="col-md-12">
									<table class="table table-bordered">
										<thead>
											<th>No.</th>
											<th>Jenjang</th>
											<th>Asal Sekolah</th>
											<th>Kota</th>
											<th>Jurusan</th>
											<th>Tanggal & Tahun Lulus</th>
											<th>No. Ijazah</th>
										</thead>
										<tbody>
											<tr>
												<td>1</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td>2</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td>3</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td>4</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>

							<!-- ------------------------------------------------------------------------------------- -->
							<div class="ln_solid"></div>
							<div class="x_title">
								<h4>Data Sertifikat (Keahlian / Keterampilan) </h4>
							</div>
							<div class="row">
								<div class="col-md-12">
									<table class="table table-bordered">
										<thead>
											<th>No.</th>
											<th>Tanggal Mulai</th>
											<th>Tanggal Selesai</th>
											<th>Sertifikat</th>
											<th>No. Sertifikat</th>
											<th>Institusi</th>
										</thead>
										<tbody>
											<tr>
												<td>1</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td>2</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td>3</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td>4</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td>5</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							
							<!-- ------------------------------------------------------------------------------------- -->
							<div class="ln_solid"></div>
							<div class="x_title">
								<h4>Data Pelatihan & Pengembangan </h4>
							</div>
							<div class="row">
								<div class="col-md-12">
									<table class="table table-bordered">
										<thead>
											<th>No.</th>
											<th>Tanggal</th>
											<th>Nama Pelatihan / Pengembangan</th>
											<th>Tempat</th>
											<th>Jumlah Jam / Hari</th>
											<th>Penyelenggara</th>
										</thead>
										<tbody>
											<tr>
												<td>1</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td>2</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td>3</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td>4</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td>5</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>

							<!-- ------------------------------------------------------------------------------------- -->
							<div class="ln_solid"></div>
							<div class="x_title">
								<h4>Pengalaman Kerja di Luar Waskita Karya </h4>
							</div>
							<div class="row">
								<div class="col-md-12">
									<table class="table table-bordered">
										<thead>
											<th>No.</th>
											<th>Tanggal Mulai</th>
											<th>Tanggal Akhir</th>
											<th>Nama Organisasi / Perusahaan</th>
											<th>Jabatan</th>
											<th>Keterangan</th>
										</thead>
										<tbody>
											<tr>
												<td>1</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td>2</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td>3</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td>4</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td>5</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<!--------------Data gaji---------------- -->
							<div class="ln_solid"></div>
							<div class="x_title">
								<h4>Data Gaji </h4>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Gaji Pokok:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" name="komunikasi" class="form-control col-md-7 col-xs-12">
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Tunjangan Komunikasi:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" name="komunikasi" class="form-control col-md-7 col-xs-12">
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Uang Makan:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" name="makan" class="form-control col-md-7 col-xs-12">
										</div>
									</div>
									<div class="ln_solid"></div>
									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Lain - Lain</label>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Tunjangan Transportasi:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" name="transportasi" class="form-control col-md-7 col-xs-12">
										</div>
									</div>
									<div class="ln_solid"></div>
									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Total Pendapatan:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" name="transportasi" class="form-control col-md-7 col-xs-12" readonly="readonly">
										</div>
									</div>
									<br>
									<div class="x_title">
										<h4>Pengeluaran </h4>
										<div class="clearfix"></div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Status:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p style="padding: 8px 12px;">TK</p>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">PPh 21:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" name="pph21" class="form-control col-md-7 col-xs-12" readonly="readonly">
										</div>
									</div>
									<div class="ln_solid"></div>
									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Total Potongan:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" name="transportasi" class="form-control col-md-7 col-xs-12" readonly="readonly">
										</div>
									</div>

									
									<div class="ln_solid"></div>
									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Pendapatan Bersih:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" name="transportasi" class="form-control col-md-7 col-xs-12" readonly="readonly">
										</div>
									</div>
								</div>
							</div>


							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
									<button class="btn btn-primary" type="button">Cancel</button>
									<button class="btn btn-primary" type="reset">Reset</button>
									<button type="submit" class="btn btn-success">Verifikasi</button>
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