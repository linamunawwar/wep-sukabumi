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
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="x_title">
								<h4>Data Pribadi </h4>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">NIP :</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">{{$pegawai->nip}} </label>
											<input type="hidden" name="nip" value="{{$pegawai->nip}}">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Nama Karyawan <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" id="nama" name="nama" required="required" class="nama form-control col-md-7 col-xs-12" value="{{$pegawai->nama}}">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="gelar_depan">Gelar Depan <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" id="gelar_depan" name="gelar_depan"  class="form-control col-md-7 col-xs-12 gelar_depan" value="{{$pegawai->gelar_depan}}">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12">Gender</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div id="gender" class="btn-group" data-toggle="buttons">
												<?php $active = ($pegawai->gender=='P')?'active':''; ?>
												<label class="btn btn-default {{$active}}" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
													<?php $status = ($pegawai->gender=='P')?'checked':''; ?>
													<input type="radio" name="gender" value="P" {{$status}}> &nbsp; Pria &nbsp;
												</label>
												<?php $active = ($pegawai->gender=='W')?'active':''; ?>
												<label class="btn btn-default {{$active}}" data-toggle-class="btn-default" data-toggle-passive-class="btn-default">
													<?php $status = ($pegawai->gender=='P')?'checked':''; ?>
													<input type="radio" name="gender" value="W" {{$status}}> Wanita
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
											<input id="gelar_belakang" class="form-control col-md-7 col-xs-12 gelar_belakang" type="text" name="gelar_belakang" value="{{$pegawai->gelar_belakang}}">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="agama">Agama <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" id="agama" name="agama" required="required" class="agama form-control col-md-7 col-xs-12 agama" value="{{$pegawai->agama}}">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="tempat_lahir" class="control-label col-md-4 col-sm-4 col-xs-12">Tempat Lahir</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input id="tempat_lahir" class="form-control col-md-7 col-xs-12 tempat-lahir" type="text" name="tempat_lahir" id="tempat_lahir" value="{{$pegawai->tempat_lahir}}">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="status_kawin">Status Perkawinan <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<?php $checked = ($pegawai->status_kawin == 'TK')? 'checked ': ''; ?>
											<input type="radio" value="TK" name="status_kawin" {{$checked}}> Belum Kawin </br>
											<?php $checked = ($pegawai->status_kawin == 'K0')? 'checked ': ''; ?>
											<input type="radio" value="K0" name="status_kawin" {{$checked}}> Kawin </br>
											<?php $checked = ($pegawai->status_kawin == 'K1')? 'checked ': ''; ?>
											<input type="radio" value="K1" name="status_kawin" {{$checked}}> Kawin Anak 1 </br>
											<?php $checked = ($pegawai->status_kawin == 'K2')? 'checked ': ''; ?>
											<input type="radio" value="K2" name="status_kawin" {{$checked}}> Kawin Anak 2 </br>
											<?php $checked = ($pegawai->status_kawin == 'K3')? 'checked ': ''; ?>
											<input type="radio" value="K3" name="status_kawin" {{$checked}}> Kawin Anak 3 atau lebih </br>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="tgl_lahir" class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Lahir *</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class='input-group date' id='datepicker' class="datepicker">
												<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
								                <input type='text' name='tgl_lahir' class='form-control' required="required" value="{{konversi_tanggal($pegawai->tanggal_lahir)}}" readonly="readonly" />
								            </div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="suami_istri" class="control-label col-md-4 col-sm-4 col-xs-12">Nama Suami / Istri</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input id="suami_istri" class="form-control col-md-7 col-xs-12 suami_istri-" type="text" name="suami_istri" value="{{$pegawai->suami_istri}}">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="alamat_tetap" class="control-label col-md-4 col-sm-4 col-xs-12">Alamat Rumah Tetap</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<textarea id="alamat_tetap" class="form-control col-md-7 col-xs-12 alamat_tetap" type="text" name="alamat_tetap" value="{{$pegawai->alamat_tetap}}"></textarea>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama_anak">Nama Anak <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<textarea id="anak" name="anak" required="required" class="anak form-control col-md-7 col-xs-12">{{$pegawai->anak}}</textarea>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="alamat_sementara" class="control-label col-md-4 col-sm-4 col-xs-12">Alamat Rumah Sementara</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<textarea id="alamat_sementara" class="form-control col-md-7 col-xs-12 alamat_sementara" type="text" name="alamat_sementara" value="{{$pegawai->alamat_sementara}}"></textarea>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="no_telp">No. Telepon <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" id="telp" name="telp"  class="form-control col-md-7 col-xs-12 telp" value="{{$pegawai->telp}}">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="email_pribadi">Alamat Email Pribadi <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="email" id="email" name="email"  class="form-control col-md-7 col-xs-12" value="{{$pegawai->email}}">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="no_hp">No. HP <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" id="hp" name="hp"  class="form-control col-md-7 col-xs-12 hp" value="{{$pegawai->hp}}">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="email_kantor">Alamat Email Kantor <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="email" id="email_kantor" name="email_kantor"  class="form-control col-md-7 col-xs-12 email_kantor" value="{{$pegawai->email_kantor}}">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="no_fax">No. Faximile <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" id="fax" name="fax"  class="form-control col-md-7 col-xs-12 fax" value="{{$pegawai->fax}}">
										</div>
									</div>
								</div>
							</div>
							<!-- ----------------------------------------------------- -->
							<br>
							<div class="x_title">
								<h4>Keluarga yang bisa dihubungi </h4>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama_keluarga">Nama Keluarga <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" id="nama_keluarga" name="nama_keluarga"  class="form-control col-md-7 col-xs-12 nama_keluarga" value="{{$pegawai->nama_keluarga}}">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="no_fax">Alamat <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<textarea id="alamat_keluarga" name="alamat_keluarga"  class="form-control col-md-7 col-xs-12 alamat_keluarga" value="{{$pegawai->alamat_keluarga}}"></textarea>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="hub_keluarga">Hubungan Keluarga <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" id="hub_keluarga" name="hub_keluarga"  class="form-control col-md-7 col-xs-12 hub_keluarga" value="{{$pegawai->hub_keluarga}}">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="no_telp">No. Telepon <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" id="telp_keluarga" name="telp_keluarga"  class="form-control col-md-7 col-xs-12 telp_keluarga" value="{{$pegawai->telp_keluarga}}">
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
											<input type="text" id="nama_bank" name="nama_bank" required="required" class="nama_bank form-control col-md-7 col-xs-12" value="{{$bank->nama_bank}}">
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
											<input type="text" id="no_rek" name="no_rek"  class="form-control col-md-7 col-xs-12" value="{{$bank->no_rekening}}">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12">Nama Asuransi</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" id="nama_asuransi" name="nama_asuransi" class="nama_asuransi form-control col-md-7 col-xs-12" value="{{$bank->asuransi_lain}}">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="npwp" class="control-label col-md-4 col-sm-4 col-xs-12">No. NPWP</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input id="npwp" class="form-control col-md-7 col-xs-12 npwp" type="text" name="npwp" value="{{$bank->npwp}}">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nomor_asuransi">Nomor </label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" id="nomor_asuransi" name="nomor_asuransi" class="nomor_asuransi form-control col-md-7 col-xs-12" value="{{$bank->nomor_lain}}">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="jamsostek" class="control-label col-md-4 col-sm-4 col-xs-12">No. Jamsostek</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input id="jamsostek" class="form-control col-md-7 col-xs-12 jamsostek" type="text" name="jamsostek" value="{{$bank->jamsostek}}">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="dplk" class="control-label col-md-4 col-sm-4 col-xs-12">No. DPLK</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" id="dplk" class="form-control col-md-7 col-xs-12 dplk" type="text" name="dplk" value="{{$bank->dplk}}">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="jiwasraya" class="control-label col-md-4 col-sm-4 col-xs-12">No. Jiwasraya</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" id="jiwasraya" class="form-control col-md-7 col-xs-12 jiwasraya" type="text" name="jiwasraya" value="{{$bank->jiwasraya}}">
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
												<td>
													<input type="text" id="jenjang_1" name="jenjang_1"  class="form-control col-md-7 col-xs-12 jenjang_1">
												</td>
												<td>
													<input type="text" id="asal_sekolah_1" name="asal_sekolah_1"  class="form-control col-md-7 col-xs-12 asal_sekolah_1">
												</td>
												<td>
													<input type="text" id="kota_1" name="kota_1"  class="form-control col-md-7 col-xs-12 kota_1">
												</td>
												<td>
													<input type="text" id="jurusan_1" name="jurusan_1"  class="form-control col-md-7 col-xs-12 jurusan_1">
												</td>
												<td>
													<input type="text" id="lulus_1" name="lulus_1"  class="form-control col-md-7 col-xs-12 lulus_1">
												</td>
												<td>
													<input type="text" id="ijazah_1" name="ijazah_1"  class="form-control col-md-7 col-xs-12 ijazah_1">
												</td>
											</tr>
											<tr>
												<td>2</td>
												<td><input type="text" id="jenjang_2" name="jenjang_2"  class="form-control col-md-7 col-xs-12 jenjang_2"></td>
												<td>
													<input type="text" id="asal_sekolah_2" name="asal_sekolah_2"  class="form-control col-md-7 col-xs-12 asal_sekolah_2">
												</td>
												<td>
													<input type="text" id="kota_2" name="kota_2"  class="form-control col-md-7 col-xs-12 kota_2">
												</td>
												<td>
													<input type="text" id="jurusan_2" name="jurusan_2"  class="form-control col-md-7 col-xs-12 jurusan_2">
												</td>
												<td>
													<input type="text" id="lulus_2" name="lulus_2"  class="form-control col-md-7 col-xs-12 lulus_2">
												</td>
												<td>
													<input type="text" id="ijazah_2" name="ijazah_2"  class="form-control col-md-7 col-xs-12 ijazah_2">
												</td>
											</tr>
											<tr>
												<td>3</td>
												<td>
													<input type="text" id="jenjang_3" name="jenjang_3"  class="form-control col-md-7 col-xs-12 jenjang_3">
												</td>
												<td>
													<input type="text" id="asal_sekolah_3" name="asal_sekolah_3"  class="form-control col-md-7 col-xs-12 asal_sekolah_3">
												</td>
												<td>
													<input type="text" id="kota_3" name="kota_3"  class="form-control col-md-7 col-xs-12 kota_3">
												</td>
												<td>
													<input type="text" id="jurusan_3" name="jurusan_3"  class="form-control col-md-7 col-xs-12 jurusan_3">
												</td>
												<td>
													<input type="text" id="lulus_3" name="lulus_3"  class="form-control col-md-7 col-xs-12 lulus_3">
												</td>
												<td>
													<input type="text" id="ijazah_3" name="ijazah_3"  class="form-control col-md-7 col-xs-12 ijazah_3">
												</td>
											</tr>
											<tr>
												<td>4</td>
												<td>
													<input type="text" id="jenjang_4" name="jenjang_4"  class="form-control col-md-7 col-xs-12 jenjang_4">
												</td>
												<td>
													<input type="text" id="asal_sekolah_4" name="asal_sekolah_4"  class="form-control col-md-7 col-xs-12 asal_sekolah_4">
												</td>
												<td>
													<input type="text" id="kota_4" name="kota_4"  class="form-control col-md-7 col-xs-12 kota_4">
												</td>
												<td>
													<input type="text" id="jurusan_4" name="jurusan_4"  class="form-control col-md-7 col-xs-12 jurusan_4">
												</td>
												<td>
													<input type="text" id="lulus_4" name="lulus_4"  class="form-control col-md-7 col-xs-12 lulus_4">
												</td>
												<td>
													<input type="text" id="ijazah_4" name="ijazah_4"  class="form-control col-md-7 col-xs-12 ijazah_4">
												</td>
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
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
									<button class="btn btn-primary" type="button">Cancel</button>
									<button class="btn btn-primary" type="reset">Reset</button>
									<button type="submit" class="btn btn-success">Simpan</button>
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