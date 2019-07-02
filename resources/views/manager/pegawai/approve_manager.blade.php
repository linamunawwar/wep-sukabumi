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
						<h2>Data Pegawai</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<!-- Smart Wizard -->
						<form class="form-horizontal form-label-left" method="POST">
	                    <div id="wizard" class="form_wizard wizard_horizontal">
	                      <ul class="wizard_steps">
	                        <li>
	                          <a href="#step-1">
	                            <span class="step_no">1</span>
	                            <span class="step_descr">
	                                              Langkah 1<br />
	                                              <small>CV Pegawai</small>
	                                          </span>
	                          </a>
	                        </li>
	                        <li>
	                          <a href="#step-2">
	                            <span class="step_no">2</span>
	                            <span class="step_descr">
	                                              Langkah 2<br />
	                                              <small>MCU</small>
	                                          </span>
	                          </a>
	                        </li>
	                        <li>
	                          <a href="#step-3">
	                            <span class="step_no">3</span>
	                            <span class="step_descr">
	                                              Langkah 3<br />
	                                              <small>PKWT</small>
	                                          </span>
	                          </a>
	                        </li>
	                        <li>
	                          <a href="#step-4">
	                            <span class="step_no">4</span>
	                            <span class="step_descr">
	                                              Langkah 4<br />
	                                              <small>Gaji</small>
	                                          </span>
	                          </a>
	                        </li>
	                      </ul>
	                      
	                      	<div id="step-1">
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
												<input type="text" id="nama" name="nama" required="required" class="nama form-control col-md-7 col-xs-12" value="{{$pegawai->nama}}" readonly="readonly">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="gelar_depan">Gelar Depan <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" id="gelar_depan" name="gelar_depan"  class="form-control col-md-7 col-xs-12 gelar_depan" value="{{$pegawai->gelar_depan}}" readonly="readonly">
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
														<input type="radio" name="gender" value="P" {{$status}} disabled="disabled"> &nbsp; Pria &nbsp;
													</label>
													<?php $active = ($pegawai->gender=='W')?'active':''; ?>
													<label class="btn btn-default {{$active}}" data-toggle-class="btn-default" data-toggle-passive-class="btn-default">
														<?php $status = ($pegawai->gender=='P')?'checked':''; ?>
														<input type="radio" name="gender" value="W" {{$status}} disabled="disabled"> Wanita
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
												<input id="gelar_belakang" class="form-control col-md-7 col-xs-12 gelar_belakang" type="text" name="gelar_belakang" value="{{$pegawai->gelar_belakang}}" readonly="readonly">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="agama">Agama <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" id="agama" name="agama" required="required" class="agama form-control col-md-7 col-xs-12 agama" value="{{$pegawai->agama}}" readonly="readonly">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="tempat_lahir" class="control-label col-md-4 col-sm-4 col-xs-12">Tempat Lahir</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input id="tempat_lahir" class="form-control col-md-7 col-xs-12 tempat-lahir" type="text" name="tempat_lahir" id="tempat_lahir" value="{{$pegawai->tempat_lahir}}" readonly="readonly">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="status_kawin">Status Perkawinan <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<?php $checked = ($pegawai->status_kawin == 'TK')? 'checked ': ''; ?>
												<input type="radio" value="TK" name="status_kawin" {{$checked}} disabled="disabled"> Belum Kawin </br>
												<?php $checked = ($pegawai->status_kawin == 'K0')? 'checked ': ''; ?>
												<input type="radio" value="K0" name="status_kawin" {{$checked}} disabled="disabled"> Kawin </br>
												<?php $checked = ($pegawai->status_kawin == 'K1')? 'checked ': ''; ?>
												<input type="radio" value="K1" name="status_kawin" {{$checked}} disabled="disabled"> Kawin Anak 1 </br>
												<?php $checked = ($pegawai->status_kawin == 'K2')? 'checked ': ''; ?>
												<input type="radio" value="K2" name="status_kawin" {{$checked}} disabled="disabled"> Kawin Anak 2 </br>
												<?php $checked = ($pegawai->status_kawin == 'K3')? 'checked ': ''; ?>
												<input type="radio" value="K3" name="status_kawin" {{$checked}} disabled="disabled"> Kawin Anak 3 atau lebih </br>
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
												<input id="suami_istri" class="form-control col-md-7 col-xs-12 suami_istri-" type="text" name="suami_istri" value="{{$pegawai->suami_istri}}" readonly="readonly">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="alamat_tetap" class="control-label col-md-4 col-sm-4 col-xs-12">Alamat Rumah Tetap</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<textarea id="alamat_tetap" class="form-control col-md-7 col-xs-12 alamat_tetap" type="text" name="alamat_tetap" value="{{$pegawai->alamat_tetap}}" readonly="readonly"></textarea>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama_anak">Nama Anak <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<textarea id="anak" name="anak" required="required" class="anak form-control col-md-7 col-xs-12" value="{{$pegawai->anak}}" readonly="readonly"></textarea>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="alamat_sementara" class="control-label col-md-4 col-sm-4 col-xs-12">Alamat Rumah Sementara</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<textarea id="alamat_sementara" class="form-control col-md-7 col-xs-12 alamat_sementara" type="text" name="alamat_sementara" value="{{$pegawai->alamat_sementara}}" readonly="readonly"></textarea>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="no_telp">No. Telepon <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" id="telp" name="telp"  class="form-control col-md-7 col-xs-12 telp" value="{{$pegawai->telp}}" readonly="readonly">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="email_pribadi">Alamat Email Pribadi <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="email" id="email" name="email"  class="form-control col-md-7 col-xs-12" value="{{$pegawai->email}}" readonly="readonly">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="no_hp">No. HP <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" id="hp" name="hp"  class="form-control col-md-7 col-xs-12 hp" value="{{$pegawai->hp}}" readonly="readonly">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="email_kantor">Alamat Email Kantor <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="email" id="email_kantor" name="email_kantor"  class="form-control col-md-7 col-xs-12 email_kantor" value="{{$pegawai->email_kantor}}" readonly="readonly">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="no_fax">No. Faximile <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" id="fax" name="fax"  class="form-control col-md-7 col-xs-12 fax" value="{{$pegawai->fax}}" readonly="readonly">
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
												<input type="text" id="nama_keluarga" name="nama_keluarga"  class="form-control col-md-7 col-xs-12 nama_keluarga" value="{{$pegawai->nama_keluarga}}" readonly="readonly">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="no_fax">Alamat <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<textarea id="alamat_keluarga" name="alamat_keluarga"  class="form-control col-md-7 col-xs-12 alamat_keluarga" value="{{$pegawai->alamat_keluarga}}" readonly="readonly"></textarea>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="hub_keluarga">Hubungan Keluarga <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" id="hub_keluarga" name="hub_keluarga"  class="form-control col-md-7 col-xs-12 hub_keluarga" value="{{$pegawai->hub_keluarga}}" readonly="readonly">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="no_telp">No. Telepon <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" id="telp_keluarga" name="telp_keluarga"  class="form-control col-md-7 col-xs-12 telp_keluarga" value="{{$pegawai->telp_keluarga}}" readonly="readonly">
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
												<input type="text" id="nama_bank" name="nama_bank" required="required" class="nama_bank form-control col-md-7 col-xs-12" value="{{$bank->nama_bank}}" readonly="readonly">
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
												<input type="text" id="no_rek" name="no_rek"  class="form-control col-md-7 col-xs-12" value="{{$bank->no_rekening}}" readonly="readonly">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12">Nama Asuransi</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" id="nama_asuransi" name="nama_asuransi" class="nama_asuransi form-control col-md-7 col-xs-12" value="{{$bank->asuransi_lain}}" readonly="readonly">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="npwp" class="control-label col-md-4 col-sm-4 col-xs-12">No. NPWP</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input id="npwp" class="form-control col-md-7 col-xs-12 npwp" type="text" name="npwp" value="{{$bank->npwp}}" readonly="readonly">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nomor_asuransi">Nomor </label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" id="nomor_asuransi" name="nomor_asuransi" class="nomor_asuransi form-control col-md-7 col-xs-12" value="{{$bank->nomor_lain}}" readonly="readonly">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="jamsostek" class="control-label col-md-4 col-sm-4 col-xs-12">No. Jamsostek</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input id="jamsostek" class="form-control col-md-7 col-xs-12 jamsostek" type="text" name="jamsostek" value="{{$bank->jamsostek}}" readonly="readonly">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="dplk" class="control-label col-md-4 col-sm-4 col-xs-12">No. DPLK</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" id="dplk" class="form-control col-md-7 col-xs-12 dplk" type="text" name="dplk" value="{{$bank->dplk}}" readonly="readonly">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="jiwasraya" class="control-label col-md-4 col-sm-4 col-xs-12">No. Jiwasraya</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" id="jiwasraya" class="form-control col-md-7 col-xs-12 jiwasraya" type="text" name="jiwasraya" value="{{$bank->jiwasraya}}" readonly="readonly">
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
														<input type="text" id="jenjang_1" name="jenjang_1"  class="form-control col-md-7 col-xs-12 jenjang_1" readonly="readonly">
													</td>
													<td>
														<input type="text" id="asal_sekolah_1" name="asal_sekolah_1"  class="form-control col-md-7 col-xs-12 asal_sekolah_1" readonly="readonly">
													</td>
													<td>
														<input type="text" id="kota_1" name="kota_1"  class="form-control col-md-7 col-xs-12 kota_1" readonly="readonly">
													</td>
													<td>
														<input type="text" id="jurusan_1" name="jurusan_1"  class="form-control col-md-7 col-xs-12 jurusan_1" readonly="readonly">
													</td>
													<td>
														<input type="text" id="lulus_1" name="lulus_1"  class="form-control col-md-7 col-xs-12 lulus_1" readonly="readonly">
													</td>
													<td>
														<input type="text" id="ijazah_1" name="ijazah_1"  class="form-control col-md-7 col-xs-12 ijazah_1" readonly="readonly">
													</td>
												</tr>
												<tr>
													<td>2</td>
													<td>
														<input type="text" id="jenjang_2" name="jenjang_2"  class="form-control col-md-7 col-xs-12 jenjang_2" readonly="readonly">
													</td>
													<td>
														<input type="text" id="asal_sekolah_2" name="asal_sekolah_2"  class="form-control col-md-7 col-xs-12 asal_sekolah_2" readonly="readonly">
													</td>
													<td>
														<input type="text" id="kota_2" name="kota_2"  class="form-control col-md-7 col-xs-12 kota_2" readonly="readonly">
													</td>
													<td>
														<input type="text" id="jurusan_2" name="jurusan_2"  class="form-control col-md-7 col-xs-12 jurusan_2" readonly="readonly">
													</td>
													<td>
														<input type="text" id="lulus_2" name="lulus_2"  class="form-control col-md-7 col-xs-12 lulus_2" readonly="readonly">
													</td>
													<td>
														<input type="text" id="ijazah_2" name="ijazah_2"  class="form-control col-md-7 col-xs-12 ijazah_2" readonly="readonly">
													</td>
												</tr>
												<tr>
													<td>3</td>
													<td>
														<input type="text" id="jenjang_3" name="jenjang_3"  class="form-control col-md-7 col-xs-12 jenjang_3" readonly="readonly">
													</td>
													<td>
														<input type="text" id="asal_sekolah_3" name="asal_sekolah_3"  class="form-control col-md-7 col-xs-12 asal_sekolah_3" readonly="readonly">
													</td>
													<td>
														<input type="text" id="kota_3" name="kota_3"  class="form-control col-md-7 col-xs-12 kota_3" readonly="readonly">
													</td>
													<td>
														<input type="text" id="jurusan_3" name="jurusan_3"  class="form-control col-md-7 col-xs-12 jurusan_3" readonly="readonly">
													</td>
													<td>
														<input type="text" id="lulus_3" name="lulus_3"  class="form-control col-md-7 col-xs-12 lulus_3" readonly="readonly">
													</td>
													<td>
														<input type="text" id="ijazah_3" name="ijazah_3"  class="form-control col-md-7 col-xs-12 ijazah_3" readonly="readonly">
													</td>
												</tr>
												<tr>
													<td>4</td>
													<td>
														<input type="text" id="jenjang_4" name="jenjang_4"  class="form-control col-md-7 col-xs-12 jenjang_4" readonly="readonly">
													</td>
													<td>
														<input type="text" id="asal_sekolah_4" name="asal_sekolah_4"  class="form-control col-md-7 col-xs-12 asal_sekolah_4" readonly="readonly">
													</td>
													<td>
														<input type="text" id="kota_4" name="kota_4"  class="form-control col-md-7 col-xs-12 kota_4" readonly="readonly">
													</td>
													<td>
														<input type="text" id="jurusan_4" name="jurusan_4"  class="form-control col-md-7 col-xs-12 jurusan_4" readonly="readonly">
													</td>
													<td>
														<input type="text" id="lulus_4" name="lulus_4"  class="form-control col-md-7 col-xs-12 lulus_4" readonly="readonly">
													</td>
													<td>
														<input type="text" id="ijazah_4" name="ijazah_4"  class="form-control col-md-7 col-xs-12 ijazah_4" readonly="readonly">
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
	                      	</div>
		                      <div id="step-2">
		                        <h2 class="StepTitle">KUESIONER  PEMERIKSAAN  KESEHATAN (MCU) SEBELUM  BEKERJA</h2>
		                        <div class="ln_solid"></div>
		                        <table class="table table-striped">
		                        	<thead>
		                        		<th>No.</th>
		                        		<th>Pernahkah Anda Terkena</th>
		                        		<th>Ya</th>
		                        		<th>Tidak</th>
		                        	</thead>
		                        	<tbody>
		                        		<?php $i = 0;?>
		                        		@foreach($data_mcus as $key=>$mcu)
		                        			<tr>
		                        				<td>{{$i+1}}</td>
		                        				<td>{{$mcu->mcu->pernyataan}}
		                        					<input type="hidden" name="pernyataan[]" value="{{$mcu->pernyataan_id}}">
		                        				</td>
		                        				<td>
		                        					<?php $checked = ($mcu->nilai == '1')? 'checked' : ''; ?>
		                        					<input type="radio" name="mcu[{{$key}}]" value="1" {{$checked}} disabled="disabled"> Ya
		                        				</td>
		                        				<td>
		                        					<?php $checked = ($mcu->nilai == '0')? 'checked' : ''; ?>
		                        					<input type="radio" name="mcu[{{$key}}]" value="0" {{$checked}} disabled="disabled"> Tidak
		                        				</td>
		                        			</tr>
		                        			<?php $i++; ?>
		                        		@endforeach
		                        	</tbody>
		                        </table>
		                      </div>
		                      <div id="step-3">
		                        <h2 class="StepTitle" style="text-align: center;">PERJANJIAN KERJA WAKTU TERTENTU (PKWT)</h2>
			                        <h4 style="text-align: center;">NOMOR : {{$pegawai->no_pkwt}}</h4><br>
			                        <?php
			                        	$tanggal = explode(' ', $pegawai->created_at);
			                        ?>
			                        <div>
										Pada hari ini tanggal {{formatTanggalPanjang($tangal[0])}}, kami yang bertandatangan dibawah ini :
										<br><br>
										<ol type="1">
											<li>Pihak Perusahaan 
												<ul style="list-style-type:none;">
													<li>Nama Perusahaan 	:	PT. Waskita Karya (Persero), Tbk. Proyek Pembangunan Jalan Tol Bekasi - Cawang – Kampung Melayu Seksi 2A Ujung</li>
													<li>Alamat Perusahaan	:	Jl. Sriagung No. 28, Desa Taman Gede, Kecamatan Gemuh, Kabupaten Kendal, Jawa Tengah</li>
												</ul>
												<br><br>
												Dalam hal ini diwakili oleh
												<ul style="list-style-type:none;">
													<li>Nama	:	Mochamad Waskito Adi, ST</li>
													<li>Jabatan	:	Kepala Proyek<br><br></li>
												</ul>
												<br>Dalam hal ini bertindak untuk dan atas nama PT. Waskita Karya (Persero) Tbk Proyek Pembangunan Jalan Tol Bekasi - Cawang – Kampung Melayu Seksi 2A Ujung, selanjutnya dalam Perjanjian Kerja Waktu Tertentu ini disebut sebagai PIHAK PERTAMA.
											</li>
											<li>Pihak Pekerja<br>
												<ul style="list-style-type:none;">
													<li>Nama 	:	{{$pegawai->nama}}</li>
													<li>
														<div>
															<p style="display: inline-block; width: 200px;" >{{$pegawai->no_ktp}}</p>
														</div>
													</li><br><br>
												</ul>
												Dalam hal ini bertindak untuk dan atas nama diri sendiri,  selanjutnya dalam Perjanjian Kerja Waktu Tertentu ini disebut sebagai PIHAK KEDUA.<br><br>
											</li>
										</ol>	
										Pihak Pertama dan Pihak Kedua secara bersama – sama disebut Para Pihak. Terlebih dahulu menerangkan hal-hal sebagai berikut:<br>
										<ol type="A">
											<li>	Bahwa Pihak Pertama adalah Proyek Badan Usaha Milik Negara yang memiliki kegiatan usaha utama dalam bidang Industri Jasa Konstruksi.</li>
											<li>	Bahwa Pihak Pertama dalam melaksanakan kegiatan usahanya tersebut membutuhkan sumber daya manusia yang memiliki kemampuan dan keahlian di bidangnya maisng-masing.</li>
											<li>	Bahwa Pihak Kedua telah melaksanakan proses seleksi dalam rangka memenuhi kebutuhan sumber daya manusia sebagaimana tersebut pada poin B diatas.</li>
											<li> 	Bahwa Pihak Kedua telah mengikuti seluruh rangkaian proses seleksi yang diadakan oleh Pihak Pertama, dan dinyatakan lulus.</li>

										</ol>
										<br>
											Berdasarkan hal-hal tersebut diatas, Pihak Pertama dan pihak Kedua sepakat untuk mengikatkan diri satu sama lain dalam perjanjian Kerja Waktu Tertentu, dengan ketentuan sebagaimana dituangkan dalam pasal-pasal di bawah ini :
										<br><br>
										<div style="text-align: center;">
											Pasal 1<br>
											PENGERTIAN
										</div>
										<ol type="1">
											<li>
												Yang dimaksud Perusahaan dalam perjanjian ini adalah PT. Waskita Karya (Persero) Tbk Proyek Pembangunan Tol Batang– Semarang Seksi 3.
											</li>
											<li>
												Perjanjian Kerja Waktu Tertentu (yang selanjutnya disebut PKWT) dalam perjanjian ini adalah perjanjian kerja antara Perusahaan dengan Pegawai yang dibuat secara tertulis untuk jangka waktu tertentu.
											</li>
										</ol>
										<div style="text-align: center;">
											Pasal 2<br>
										PENEMPATAN DAN LINGKUP PEKERJAAN
										</div>
										<ol type="1">
											<li>
												PIHAK PERTAMA akan mempekerjakan PIHAK KEDUA sebagai pekerja PT. WaskitaKarya (Persero) TbkProyekJalan Tol Batang-Semarang Paket 2 (Seksi 3), dengan status / kedudukan sebagai pekerja waktu tertentu (tidak tetap) dan ditempatkan sebagai ………………………..
											</li>
											<li>
												PIHAK KEDUA bersedia menerima dan melaksankan tugas pekerjaannya dengan sebaik-baiknya dan penuh rasa tanggungjawab.
											</li>
											<li>
												Penempatan, penugasan, dan ruang lingkup tugas / pekerjaan PIHAK KEDUA oleh PIHAK PERTAMA ditetapkan melalui ketetapan Kepala Proyek, ditentukan dan dilaksanakan sesuai dengan ketetapan Proyek.
											</li>
										</ol>
										<div style="text-align: center;">
											Pasal 3<br>
										STATUS PEGAWAI
										</div>
										<ol type="1">
											<li>
												PIHAK KEDUA diterima bekerja sebagai pekerja Kontrak / Waktu Tertentu.
											</li>
											<li>
												PIHAK PERTAMA menerima PIHAK KEDUA sebagai Pegawai Honorer Proyek dan menandatangani PKWT dalam jangka waktu sampai dengan 30 September 2018, terhitung sejak ditandatangani yaitu tanggal ............. sampai dengan tanggal .............. Dengan catatan jika proyek ini sudah selesai sebelum tanggal tersebut pihak kedua tidak bisa menuntut pihak pertama.
											</li>
										</ol>
										<div style="text-align: center;">
											Pasal4<br>
										WAKTU KERJA DAN ISTIRAHAT
										</div>
										<ol type="1">
											<li>
												PIHAK KEDUA bersedia mengikuti jam kerja yang diatur oleh PT. Waskita Karya (Persero) Tbk ProyekBatang Semarang Paket 2 (Seksi 3).
											</li>
											<li>
												Sesuai dengan kebutuhan pelaksanaan pekerjaan di PT. Waskita Karya (Persero) Tbk ProyekBatang Semarang Paket 2 (Seksi 3, PIHAK KEDUA bersedia bekerja secara bergiliran (shift) apabila diperlukan.
											</li>
										</ol>
										<div style="text-align: center;">
											Pasal 5<br>
										PENGHASILAN DAN FASILITAS
										</div>
										<ol type="1">
											<li>
												PIHAK PERTAMA akan membayar penghasilan kepada PIHAK KEDUA pada setiap akhir bulan.
											</li>
											<li>
												Selain dari gaji pada ayat 1 (satu) di atas, PIHAK PERTAMA memberikan bantuan / fasilitas kepada PIHAK KEDUA berupa :
												<ol type="a">
													<li>Bantuan uang makan dalam bentuk uang.</li>
													<li>Bantuan tempat tinggal atau mess bagi karyawan luar kota..</li>
												</ol>
											</li>
											<li>
												Tunjangan Hari Raya (THR).
												<ol type="a">
													<li>Bagi pekerja / pegawai yang telah bekerja selama 12 (dua belas) bulan terus menerus akan mendapat Tunjangan Hari Raya (THR) sebesar 1 (satu) bulan upah;</li>
													<li>Bagi pekerja / pegawai yang telah bekerja kurang dari 12 (dua belas) bulan akan diberikan Tunjangan Hari Raya (THR) yang besarnya dihitung secara proporsional.</li>
													<li>Bagi pekerja / pegawai yang bekerja kurang dari 3 (tiga) bulan tidak mendapat Tunjangan Hari Raya (THR).</li>
												</ol>
											</li>
											<li>Segala pajak yang timbul ditanggung oleh pekerja yang bersangkutan kecuali Pajak Penghasilan (PPh Pasal 21) atas gaji.</li>
										</ol>
										<div style="text-align: center;">
											Pasal 6<br>
										LEMBUR
										</div>
										<ol type="1">
											<li>
												Lembur adalah waktu kerja yng melebihi 7 (tujuh) jam sehari dan 40 (empat puluh) jam untuk 6 (enam) hari kerja dalam 1 (satu) minggu atau 8 (delapan) jam sehari dan 40 (empat puluh) jam 1 (satu) minggu untuk 5 (lima) hari kerja (KEPMENAKER No. : KEP.102/IV/2004.
											</li>
											<li>
												Upah atas kerja lembur PIHAK KEDUA sudah termasuk di dalam gaji bulanan jadi pembayaran lembur tidak dibayarkan oleh PIHAK PERTAMA.
											</li>
										</ol>
										<div style="text-align: center;">
											Pasal 7<br>
										KEWAJIBAN PIHAK PERTAMA
										</div>
										<ol type="1">
											<li>
												PIHAK PERTAMA wajib untuk melaksanakan hak-hak PIHAK KEDUA sebagaimana diatur dalam Pasal 4 dan 5 Kesepakatan Kerja ini.
											</li>
											<li>User / Perusahaan pengguna jasa PIHAK KEDUA menyediakan alat-alat kerja yang diperlukan untuk menunjang pekerjaan yang dilakukan oleh PIHAK KEDUA secara wajar.</li>
										</ol>
										<div style="text-align: center;">
											Pasal 8<br>
										KEWAJIBAN PIHAK KEDUA
										</div>
										<ol type="1">
											<li>PIHAK KEDUA wajib melaksanakan tugas dengan penuh tanggungjawab dan sebaik-baiknya sesuai dengan petunjuk PIHAK PERTAMA dan atau perintah atasannya.</li>
											<li>PIHAK KEDUA wajib untuk mentaati dan melaksanakan semua peraturan dan tata tertib PIHAK PERTAMA maupun yang berlaku di lokasi kerja PT. Waskita Karya (Persero) Tbk Proyek Batang Semarang Paket 2 (Seksi 3).</li>
											<li>.PIHAK KEDUA wajib mengganti kerugian yang diderita oleh PIHAK PERTAMA ataupun PT. Waskita Karya (Persero) Tbk, atas kehilangan dan / atau kerusakan barang ataupun asset yang terbukti dilakukan dan diakibatkan oleh kelalaian PIHAK KEDUA.</li>
											<li>PIHAK KEDUA tidak diperkenankan bekerja pada Perusahaan lain dengan cara atau maksud apapun tanpa seijint tertulis dari PIHAK PERTAMA selama jangka waktu pelaksanaan perjanjian ini.</li>
											<li>PIHAK KEDUA tidak menuntut fasilitas / hak / kesejahteraan lain selain yang telah ditentukan / ditetapkan oleh PIHAK PERTAMA dan / atau PT. Waskita Karya (Persero) Tbk.</li>
										</ol>

										<div style="text-align: center;">
											Pasal 9<br>
										PENILAIAN PELAKSANAAN TUGAS DANPEMBINAAN PEGAWAI
										<br><br>
											PIHAK PERTAMA akan melakukan penilaian pelaksanaan tugas PIHAK KEDUA setiap 1 (satu) tahun, sesuai dengan yang ditetapkan perusahaan.
										</div><br><br>
										<div style="text-align: center;">
											Pasal 10<br>
										TATA TERTIB, DISIPLIN KERJA, DAN SANKSI
										</div>
										<ol type="1">
											<li>PIHAK KEDUA wajib mengisi daftar hadir (finger print) setiap hari kerja sesuai dengan yang telah ditentukan.</li>
											<li>PIHAK KEDUA harus sudah berada di lokasi kerja 15 (limabelas) menit sebelum pekerjaan dimulai dan dilarang meninggalkan pekerjaan sebelum waktunya kecuali mendapat izin dari atasannya PIHAK KEDUA.</li>
											<li>PIHAK KEDUA wajib memelihara kerjasama dan saling menghormati satu sama lain demi terciptanya keharmonisan kerja.</li>
											<li>PIHAK KEDUA dilarang bersenda-gurau dalam melaksanakan pekerjaan sehingga dapat dihindari sedini mungkin resiko kecelakaan kerja dan / atau kekeliruan dalam melaksanakan pekerjaan.</li>
											<li>PIHAK KEDUA wajib menggunakan alat-alat keselamatan kerja yang telah disediakan sesuai dengan sifat pekerjaan.</li>
											<li>PIHAK KEDUA wajib mematuhi perintah atasannya dalam pelaksanaan pekerjaan sehari-hari di kantor / lapangan yang belum diatur secara lengkap dalam kesepakatan ini.</li>
											<li>Perusahaan akan mengenakan sanksi atas pelanggaran disiplin kerja yang dilakukan oleh PIHAK KEDUA, sesuai dengan ketentuan yang ditetapkan oleh perusahaan dan/ atau PKB.</li>
										</ol>
										<div style="text-align: center;">
											Pasal 11<br>
										TIDAK MASUK KERJA TANPA UPAH
										</div>
										<ol type="1">
											<li>
												Apabila PIHAK KEDUA tidak masuk kerja tanpa alasan yang jelas (mangkir) atau tanpa alasan yang dapat dipertanggung-jawabkan maka upahnya tidak dibayarkan untuk hari-hari tidak bekerja tersebut sesuai dengan azas “Tidak Bekerja Tidak Dibayar” kecuali undang-undang menetapkan lain.
											</li>
											<li>
												PIHAK PERTAMA berhak untuk melakukan pemotongan upah / imbalan PIHAK KEDUA yang ditempatkan di PT. Waskita Karya, apabila PIHAK KEDUA tidak masuk kerja tanpa keterangan yang dapat diterima, kecuali dengan keterangan yang dapat dibuktikan sedang menjalani perawatan inap, atau berobat jalan berdasarkan Surat Keterangan Dokter. Pemotongan yang dilakukan adalah sebesar Rp 100.000,- per hari ketidakhadiran sampai dengan maksimal 25% dari Gaji / Penghasilan.
											</li>
										</ol>
										<div style="text-align: center;">
											Pasal 12<br>
										BERAKHIRNYA HUBUNGAN KERJA
										</div>
										<ol type="1">
											<li>PIHAK PERTAMA mempunyai hak untuk memutuskan Perjanjian Kerja Waktu Tertentu ini apabila kinerja dan hasil kerja PIHAK KEDUA dinilai tidak memenuhi apa yang ditugaskan kepada yang bersangkutan.</li>
											<li>PWKT ini berakhir  demi hukum, dan hubungan kerja antara PIHAK KEDUA dan PIHAK PERTAMA putus dengan sendirinya, apabila jangka waktu tersebut pasal 3 ayat 2 terpenuhi, dan PIHAK KEDUA tidak berhak menuntut sesuai dengan PKB yang berlaku.</li>
										</ol>
										<div style="text-align: center;">
											Pasal 13<br>
										PENGUNDURAN DIRI<br><br>
										PIHAK KEDUA wajib menyampaikan pemberitahuansecara tertulis perihal pengunduran diri kepada PIHAK PERTAMA paling lambat 30 (tigapuluh) hari sebelum pengunduran diri.<br><br>
										</div>
										
										<div style="text-align: center;">
											Pasal 14<br>
										PENYELESAIAN KELUH KESAH<br><br>
										Apabila dalam melaksanakan tugas PIHAK KEDUA merasa tidak puas atas perlakuan dari pihak proyek dan setelah menyampaikan keluh kesah tersebut secara lisan kepada Atasannya, menurut PIHAK KEDUA dapat mengajukan keluh kesah secara tertulis kepada Atasannya yang lebih tinggi dari Atasannya itu.<br><br>
										</div>
										<div style="text-align: center;">
											Pasal 15<br>
										PEMAHAMAN ISI DAN JANJI LAIN DILUAR PKWT
										</div>
										<ol type="1">
											<li>Bahwa setelah membaca, mengerti dan memahami seluruh isi dan maksud yang terkandung dalam passal - pasal PKWT ini, maka PIHAK KEDUA setuju dan sepakat untuk mengikat kan diri dengan menandatangani PKWT ini.</li>
											<li>Perusahaan dan PIHAK KEDUA menyatakan bahwa tidak ada janji-janji lainnya selain kesepakatan yang tertulis dalam pasal-pasal PKWT ini, kecuali surat-surat edaran dan kebijakan-kebijakan yang telah disepakati bersama oleh kedua belah pihak selama bertugas di proyek Pembangunan Jalan Tol Batang-Semarang Seksi 3.</li>
										</ol>
										<div style="text-align: center;">
											Pasal 16<br>
										PENYELESAIAN PERSELISIHAN<br><br>
										Apabila terjadi perselisihan pendapa tmengena pelaksanaan PKWT ini, akan diselesaikan secara musyawarah antara Perusahaan dan PIHAK KEDUA, apabila perselisihan tersebut tidak terselesaikan antara kedua pihak, akan diselesaikan secara Bipartitantara Perusahaan dengan Serikat Pekerja Waskita, dan / atau secara Tripatit dengan pejabat perantara dari Departemen Tenaga Kerja RI.<br><br>
										</div>

										<div style="text-align: center;">
											Pasal 17<br>
										LAIN-LAIN
										</div>
										<ol type="1">
											<li>Hal-hal lain yang belum diatur dalam Perjanjian ini akan diatur kemudian apabila dianggap perlu untuk melakukan perubahan akan terlebih dahulu dibicarakan antara PIHAK PERTAMA dan PIHAK KEDUA secara musyawarah.</li>
											<li>Apabila dikemudian hari ditemukan kekeliruan pada Perjanjian Kerja ini, maka akan diperbaiki sebagaimana mestinya.</li>
										</ol>
										
										<div style="text-align: center;">
											Pasal 18<br>
										PENUTUP
										</div>
										<ol type="1">
											<li>Perjanjian Kerja Waktu Tertentu ini dibuat dan ditandatangani bersama dan telah dipahami oleh kedua belah pihak serta dengan kesadaran penuh dan tanpa ada unsur paksaan dari pihak manapun untuk dilaksanakan sebagaimana mestinya.</li>
											<li>PIHAK KEDUA dengan ini menyatakan tidak ada janji-janji, syarat-syarat atau pengertian lain apapun selain apa yang tercantum dalam perjanjian ini.</li>
											<li>Perjanjian Kerja Waktu Tertentu ini dibuat dalam rangkap 2 (dua) yang masing-masing sama bunyinya, ditandatangani diatas materai Rp 6.000 dan mempunyai kekuatan hukum yang sama 1 (satu) rangkap dipegang oleh PIHAK PERTAMA dan 1 (satu) rangkap dipegang oleh PIHAK KEDUA.</li>
										</ol>
										
										Demikian, Perjanjian Kerja ini dibuat dan ditandatangani pada tanggal yang disebutkan diatas untuk dilaksanakan dan dipatuhi.
									</div>
		                      </div>
		                      <div id="step-4">
		                        <h2 class="StepTitle">Data Gaji</h2>
		                        <div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Gaji Pokok:</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" name="gaji_pokok" class="form-control col-md-7 col-xs-12 gaji_pokok" id="gaji_pokok" readonly="readonly">
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Tunjangan Komunikasi:</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" name="tunj_komunikasi" class="form-control col-md-7 col-xs-12 tunj_komunikasi" id="tunj_komunikasi" readonly="readonly">
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Uang Makan:</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" name="uang_makan" class="form-control col-md-7 col-xs-12" readonly="readonly">
											</div>
										</div>
										<div class="ln_solid"></div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Lain - Lain</label>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Tunjangan Transportasi:</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" name="tunj_transportasi" class="form-control col-md-7 col-xs-12 tunj_transportasi" id="tunj_transportasi" readonly="readonly">
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Tunjangan PPh 21:</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<?php
													if($pegawai->status_kawin == 'TK'){
														$pph21 = 500000;
													}elseif ($pegawai->status_kawin == 'K0') {
														$pph21 = 1000000;
													}elseif ($pegawai->status_kawin == 'K1') {
														$pph21 = 1500000;
													}elseif ($pegawai->status_kawin == 'K2') {
														$pph21 = 2000000;
													}elseif ($pegawai->status_kawin == 'K3') {
														$pph21 = 2500000;
													}
												?>
												<input type="text" name="tunj_pph21" class="form-control col-md-7 col-xs-12 tunj_pph21" id="tunj_pph21" readonly="readonly" value="{{$pph21}}">
											</div>
										</div>
										<div class="ln_solid"></div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Total Pendapatan:</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" name="tot_pendapatan" class="form-control col-md-7 col-xs-12" readonly="readonly">
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
												<p style="padding: 8px 12px;">{{$pegawai->status_kawin}}</p>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">PPh 21:</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" name="pph21" class="form-control col-md-7 col-xs-12" readonly="readonly" value="{{$pph21}}">
											</div>
										</div>
										<div class="ln_solid"></div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Total Potongan:</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" name="tot_potongan" class="form-control col-md-7 col-xs-12 tot_potongan" id="tot_potongan" readonly="readonly">
											</div>
										</div>

										
										<div class="ln_solid"></div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Pendapatan Bersih:</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" name="pendapatan_bersih" class="form-control col-md-7 col-xs-12 pendapatan_bersih" id="pendapatan_bersih" readonly="readonly">
											</div>
										</div>
									</div>
								</div>
		                      </div>
	                      
	                    </div>
	                    </form>
	                    <!-- End SmartWizard Content -->
					</div>
				</div>
			</div>
		</div>
    </div>
    <!-- /page content -->
@endsection
@push('scripts')
<script type="text/javascript">
	console.log('af');
	// $('.daterangepicker').daterangepicker({
	//     singleDatePicker: true,
	//     showDropdowns: true,
	//     minYear: 1950,
	//     maxYear: parseInt(moment().format('YYYY'),10)
	//    });

	$(document).ready(function(){
      $('#datepicker').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
    	});
      $('#datepicker2').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
    	});
      $('.stepContainer').height('100%');

      $( ".actionBar.buttonFinish" ).replaceWith( "<button type='submit' class='buttonFinish btn btn-default'>Finish</button>" );
  	});

</script>
@endpush