<?php

use App\KodeBagian;
$kode = KodeBagian::all();

?>
@extends('layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
    <style type="text/css">
    	.data{
    		padding: 6px 12px;
    		font-size: 15px;
    		margin: 0px;
    	}
    </style>
@endpush

@section('main_container')

    <!-- page content -->
    <div class="right_col" role="main">
    	<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<div class="pull-left">
							<a href="{{url('pegawai/edit_cv')}}" class="btn btn-primary"><i class="fa fa-edit"></i>  Edit CV</a>
						</div>
						<div class="pull-right">
							<a href="" class="btn btn-success"><i class="fa fa-download"></i>    Download CV</a>
							<a href="" class="btn btn-success"><i class="fa fa-download"></i>    Download MCU</a>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="x_content" style="display: none;">
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
							<div class="x_title">
								<h4>Data Pribadi </h4>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Nama Karyawan: <span class="required">*</span></label>
										<div class="col-md-4 col-sm-4 col-xs-12">
											<p class="data">{{Auth::user()->name}}</p>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="role"> Role: <span class="required">*</span>:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">User</p>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="gelar_depan">Gelar Depan: <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">-</p>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12">Gender</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">Male</p>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="gelar_blkg" class="control-label col-md-4 col-sm-4 col-xs-12">Gelar Belakang</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">S.Kom</p>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="agama">Agama <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">Islam</p>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="tempat_lahir" class="control-label col-md-4 col-sm-4 col-xs-12">Tempat Lahir</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">Semarang</p>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="status_kawin">Status Perkawinan <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">Belum Kawin</p>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="tgl_lahir" class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Lahir *</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">22-02-1990</p>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="suami_istri" class="control-label col-md-4 col-sm-4 col-xs-12">Nama Suami / Istri</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">-</p>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nip">NIP <span class="required">*</span>:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">SA220290</p>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama_anak">Nama Anak <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">-</p>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="alamat_tetap" class="control-label col-md-4 col-sm-4 col-xs-12">Alamat Rumah Tetap</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">Jalan Plamongan Indah Blok D5 Semarang</p>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="no_telp">No. Telepon <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">-</p>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="alamat_sementara" class="control-label col-md-4 col-sm-4 col-xs-12">Alamat Rumah Sementara</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">Perum Elok Asri Blok D5 Bekasi</p>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="no_hp">No. HP <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">08567553675</p>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="email_pribadi">Alamat Email Pribadi <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">pegawai1@gmail.com</p>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="no_fax">No. Faximile <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">-</p>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="email_kantor">Alamat Email Kantor <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">pegawai1@waskita.co.id</p>
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
											<p class="data">BNI</p>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="no_rek">No. Rekening <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">027282497</p>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="npwp" class="control-label col-md-4 col-sm-4 col-xs-12">No. NPWP</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">84.661.833.4-847.000</p>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="jamsostek" class="control-label col-md-4 col-sm-4 col-xs-12">No. Jamsostek</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">98679642157</p>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="dplk" class="control-label col-md-4 col-sm-4 col-xs-12">No. DPLK</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">-</p>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="jiwasraya" class="control-label col-md-4 col-sm-4 col-xs-12">No. Jiwasraya</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">-</p>
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
												<td>SMA</td>
												<td>SMA N 3 Semarang</td>
												<td>Semarang</td>
												<td>IPA</td>
												<td> 12-05-2013</td>
												<td>0382390823023</td>
											</tr>
											<tr>
												<td>2</td>
												<td>S1</td>
												<td>Universitas Diponegoro</td>
												<td>Semarang</td>
												<td>Teknik Industri</td>
												<td>14-08-2018</td>
												<td>238292922245</td>
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
							<div class="ln_solid"></div>
						</form>
					</div>
					<div class="x_content">
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
							<div class="x_title">
								<h4>Data Pribadi </h4>
								<div class="alert alert-danger alert-dismissible fade in" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
									</button>
									<strong>Akun Belum Diverifikasi!</strong> Harap Segera Lengkapi CV Anda. Silahkan Tekan Tombol Edit CV
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Nama Karyawan: <span class="required">*</span></label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<p class="data">{{Auth::user()->name}}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4 col-xs-12">Gender</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<p class="data">Male</p>
								</div>
							</div>
							<div class="form-group">
								<label for="tgl_lahir" class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Lahir *</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<p class="data">22-02-1990</p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nip">NIP <span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<p class="data">SA220290</p>
								</div>
							</div>
							<div class="ln_solid"></div>
						</form>
					</div>
				</div>
			</div>
		</div>
    </div>
    <!-- /page content -->
@endsection