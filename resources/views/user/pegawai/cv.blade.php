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
						<div class="alert alert-success">
							Dimohon untuk tidak me-refresh atau memuat ulang halaman ini selama pengisian data, dikarenakan data yang sudah ditulis akan hilang.
						</div>
						<form class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data">
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
												<textarea id="anak" name="anak" required="required" class="anak form-control col-md-7 col-xs-12" value="{{$pegawai->anak}}"></textarea>
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
								@if($bank)
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
													<select id="nama_bank" name="nama_bank" required="required" class="nama_bank form-control col-md-7 col-xs-12">
															<option value="">--Pilih Bank----</option>
															<?php $selected = ($bank->nama_bank == 'BRI')? 'selected': '';?>
															<option value="BRI" {{$selected}}>BRI</option>
															<?php $selected = ($bank->nama_bank == 'Mandiri')? 'selected': '';?>
															<option value="Mandiri" {{$selected}}>Mandiri</option>
															<?php $selected = ($bank->nama_bank == 'BNI')? 'selected': '';?>
															<option value="BNI" {{$selected}}>BNI</option>
															<?php $selected = ($bank->nama_bank == 'BCA')? 'selected': '';?>
															<option value="BCA" {{$selected}}>BCA</option>
														</select>
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
								@else
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
													<select id="nama_bank" name="nama_bank" required="required" class="nama_bank form-control col-md-7 col-xs-12">
														<option value="">--Pilih Bank--</option>
														<option value="BCA">BCA</option>
														<option value="BNI">BNI</option>
														<option value="Mandiri">Mandiri</option>
														<option value="BRI">BRI</option>
													</select>
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
													<input id="npwp" class="form-control col-md-7 col-xs-12 npwp" type="text" name="npwp"><br>
													*jika NPWP tidak diisi maka dianggap tidak memiliki NPWP
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
													<input type="text" id="dplk" class="form-control col-md-7 col-xs-12 dplk" type="text" name="dplk" >
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="jiwasraya" class="control-label col-md-4 col-sm-4 col-xs-12">No. Jiwasraya</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input type="text" id="jiwasraya" class="form-control col-md-7 col-xs-12 jiwasraya" type="text" name="jiwasraya" >
												</div>
											</div>
										</div>
									</div>
								@endif
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
													<?php $i=0;?>
													@foreach($pendidikans as $pendidikan)
														<tr>
															<td>{{$i+1}}</td>
															<td>
																<input type="text"  name="jenjang[]"  class="form-control col-md-7 col-xs-12 jenjang_1" value="{{$pendidikan['jenjang']}}">
															</td>
															<td>
																<input type="text" name="asal_sekolah[]"  class="form-control col-md-7 col-xs-12 asal_sekolah_1" value="{{$pendidikan['asal_sekolah']}}">
															</td>
															<td>
																<input type="text"  name="kota[]"  class="form-control col-md-7 col-xs-12 kota_1" value="{{$pendidikan['kota']}}">
															</td>
															<td>
																<input type="text"name="jurusan[]"  class="form-control col-md-7 col-xs-12 jurusan_1" value="{{$pendidikan['jurusan']}}">
															</td>
															<td>
																<input type="text" name="tahun_lulus[]"  class="form-control col-md-7 col-xs-12" value="{{$pendidikan['tahun_lulus']}}" >
															</td>
															<td>
																<input type="text" name="no_ijazah[]"  class="form-control col-md-7 col-xs-12" value="{{$pendidikan['no_ijazah']}}">
															</td>
														</tr>
														<?php $i++; ?>
													@endforeach
													@if($i < 4)
														<?php 
															$kurang = 4 - $i;
															for ($j=1; $j <= $kurang ; $j++) { 
														?>
																<tr>
																	<td>{{$j + $i}}</td>
																	<td><input type="text" id="jenjang_2" name="jenjang[]"  class="form-control col-md-7 col-xs-12 jenjang_2"></td>
																	<td>
																		<input type="text" id="asal_sekolah_2" name="asal_sekolah[]"  class="form-control col-md-7 col-xs-12 asal_sekolah_2">
																	</td>
																	<td>
																		<input type="text" id="kota_2" name="kota[]"  class="form-control col-md-7 col-xs-12 kota_2">
																	</td>
																	<td>
																		<input type="text" id="jurusan_2" name="jurusan[]"  class="form-control col-md-7 col-xs-12 jurusan_2">
																	</td>
																	<td>
																		<input type="text" id="lulus_2" name="tahun_lulus[]"  class="form-control col-md-7 col-xs-12 lulus_2">
																	</td>
																	<td>
																		<input type="text" id="ijazah_2" name="no_ijazah[]"  class="form-control col-md-7 col-xs-12 ijazah_2">
																	</td>
																</tr>
														<?php	} ?>
													@endif
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
													<?php $i=0;?>
													@foreach($sertifikats as $sertifikat)
														<tr>
															<td>{{$i+1}}</td>
															<td>
																<input type="text" name="sertifikat_mulai[]"  class="form-control col-md-7 col-xs-12 sertifikat_mulai" value="{{konversi_tanggal($sertifikat['tanggal_mulai'])}}" placeholder="dd-mm-yyyy">
															</td>
															<td>
																<input type="text" name="sertifikat_akhir[]"  class="form-control col-md-7 col-xs-12 sertifikat_akhir" value="{{konversi_tanggal($sertifikat['tanggal_akhir'])}}" placeholder="dd-mm-yyyy">
															</td>
															<td>
																<input type="text" name="sertifikat[]"  class="form-control col-md-7 col-xs-12 sertifikat" value="{{$sertifikat['sertifikat']}}">
															</td>
															<td>
																<input type="text" name="no_sertifikat[]"  class="form-control col-md-7 col-xs-12" value="{{$sertifikat['no_sertifikat']}}">
															</td>
															<td>
																<input type="text" name="institusi_sertifikat[]"  class="form-control col-md-7 col-xs-12" value="{{$sertifikat['institusi']}}">
															</td>
														</tr>
													<?php $i++; ?>
													@endforeach
													@if($i < 5)
														<?php 
															$kurang = 5 - $i;
															for ($j=1; $j <= $kurang ; $j++) { 
														?>
																<tr>
																	<td>{{$j + $i}}</td>
																	<td>
																		<input type="text" name="sertifikat_mulai[]"  class="form-control col-md-7 col-xs-12 sertifikat_mulai" placeholder="dd-mm-yyyy">
																	</td>
																	<td>
																		<input type="text" name="sertifikat_akhir[]"  class="form-control col-md-7 col-xs-12 sertifikat_akhir" placeholder="dd-mm-yyyy">
																	</td>
																	<td>
																		<input type="text" name="sertifikat[]"  class="form-control col-md-7 col-xs-12 sertifikat">
																	</td>
																	<td>
																		<input type="text" name="no_sertifikat[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																	<td>
																		<input type="text" name="institusi_sertifikat[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																</tr>
														<?php	} ?>
													@endif
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
												<?php $i=0;?>
													@foreach($pelatihans as $pelatihan)
														<tr>
															<td>{{$i+1}}</td>
															<td>
																<input type="text" name="pelatihan_tanggal[]"  class="form-control col-md-7 col-xs-12" value="{{konversi_tanggal($pelatihan['tanggal'])}}" placeholder="dd-mm-yyyy">
															</td>
															<td>
																<input type="text" name="nama_pelatihan[]"  class="form-control col-md-7 col-xs-12" value="{{$pelatihan['nama_pelatihan']}}">
															</td>
															<td>
																<input type="text" name="tempat_pelatihan[]"  class="form-control col-md-7 col-xs-12" value="{{$pelatihan['tempat']}}">
															</td>
															<td>
																<input type="text" name="jam_hari[]"  class="form-control col-md-7 col-xs-12" value="{{$pelatihan['jam_hari']}}">
															</td>
															<td>
																<input type="text" name="penyelenggara_pelatihan[]"  class="form-control col-md-7 col-xs-12" value="{{$pelatihan['penyelenggara']}}">
															</td>
														<?php $i++; ?>
													@endforeach
													@if($i < 3)
														<?php 
															$kurang = 3 - $i;
															for ($j=1; $j <= $kurang ; $j++) { 
														?>
																<tr>
																	<td>{{$j + $i}}</td>
																	<td>
																		<input type="text" name="pelatihan_tanggal[]"  class="form-control col-md-7 col-xs-12" placeholder="dd-mm-yyyy">
																	</td>
																	<td>
																		<input type="text" name="nama_pelatihan[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																	<td>
																		<input type="text" name="tempat_pelatihan[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																	<td>
																		<input type="text" name="jam_hari[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																	<td>
																		<input type="text" name="penyelenggara_pelatihan[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																</tr>
														<?php	} ?>
													@endif
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
												<?php $i=0;?>
													@foreach($pengalamans as $pengalaman)
														<tr>
															<td>{{$i+1}}</td>
															<td>
																<input type="text" name="mulai_kerja[]"  class="form-control col-md-7 col-xs-12" value="{{konversi_tanggal($pengalaman['tanggal_mulai'])}}" placeholder="dd-mm-yyyy">
															</td>
															<td>
																<input type="text" name="akhir_kerja[]"  class="form-control col-md-7 col-xs-12" value="{{konversi_tanggal($pengalaman['tanggal_akhir'])}}" placeholder="dd-mm-yyyy">
															</td>
															<td>
																<input type="text" name="nama_perusahaan[]"  class="form-control col-md-7 col-xs-12" value="{{$pengalaman['nama_perusahaan']}}">
															</td>
															<td>
																<input type="text" name="jabatan[]"  class="form-control col-md-7 col-xs-12" value="{{$pengalaman['jabatan']}}">
															</td>
															<td>
																<input type="text" name="keterangan[]"  class="form-control col-md-7 col-xs-12" value="{{$pengalaman['keterangan']}}">
															</td>
														</tr>
														<?php $i++; ?>
													@endforeach
													@if($i < 4)
														<?php 
															$kurang = 4 - $i;
															for ($j=1; $j <= $kurang ; $j++) { 
														?>
																<tr>
																	<td>{{$j + $i}}</td>
																	<td>
																		<input type="text" name="mulai_kerja[]"  class="form-control col-md-7 col-xs-12" placeholder="dd-mm-yyyy">
																	</td>
																	<td>
																		<input type="text" name="akhir_kerja[]"  class="form-control col-md-7 col-xs-12" placeholder="dd-mm-yyyy">
																	</td>
																	<td>
																		<input type="text" name="nama_perusahaan[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																	<td>
																		<input type="text" name="jabatan[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																	<td>
																		<input type="text" name="keterangan[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																</tr>
														<?php	} ?>
													@endif
											</tbody>
										</table>
									</div>
								</div>
								<!-- ------------------------------------------------------------------------------------- -->
								<div class="ln_solid"></div>
								<div class="x_title">
									<h4>Penugasan Karyawan</h4>
								</div>
								<div class="row">
									<div class="col-md-12">
										<table class="table table-bordered" style="width: 1500px; overflow: scroll; background: white;">
											<thead>
												<tr>
													<th rowspan="2">No.</th>
													<th rowspan="2">Tanggal Mulai</th>
													<th rowspan="2">Tanggal Akhir</th>
													<th rowspan="2">No SK</th>
													<th rowspan="2">Jabatan</th>
													<th rowspan="2">Unit Bisnis/ Kerja</th>
													<th rowspan="2">KJ</th>
													<th rowspan="2">KK</th>
													<th rowspan="2">Tempat Kerja/ Proyek</th>
													<th colspan="2">Prestasi Kerja**</th>
													<th rowspan="2">Nama Atasan Langsung</th>
													<th rowspan="2">Jabatan Atasan</th>
												</tr>
												<tr>
													<th>Rencana</th>
													<th>Realisasi</th>
												</tr>
											</thead>
											<tbody>
												<?php $i=0;?>
													@foreach($penugasans as $penugasan)
														<tr>
															<td>{{$i+1}}</td>
															<td>
																<input type="text" name="mulai_tugas[]"  class="form-control col-md-7 col-xs-12" value="{{konversi_tanggal($penugasan['tanggal_mulai'])}}" placeholder="dd-mm-yyyy">
															</td>
															<td>
																<input type="text" name="akhir_tugas[]"  class="form-control col-md-7 col-xs-12" value="{{konversi_tanggal($penugasan['tanggal_akhir'])}}" placeholder="dd-mm-yyyy">
															</td>
															<td>
																<input type="text" name="no_sk[]"  class="form-control col-md-7 col-xs-12" value="{{$penugasan['no_sk']}}">
															</td>
															<td>
																<input type="text" name="jabatan_tugas[]"  class="form-control col-md-7 col-xs-12" value="{{$penugasan['jabatan']}}">
															</td>
															<td>
																<input type="text" name="unit_kerja[]"  class="form-control col-md-7 col-xs-12" value="{{$penugasan['unit_kerja']}}">
															</td>
															<td>
																<input type="text" name="kj[]"  class="form-control col-md-7 col-xs-12" value="{{$penugasan['KJ']}}">
															</td>
															<td>
																<input type="text" name="kk[]"  class="form-control col-md-7 col-xs-12" value="{{$penugasan['KK']}}">
															</td>
															<td>
																<input type="text" name="tempat_kerja[]"  class="form-control col-md-7 col-xs-12" value="{{$penugasan['tempat_kerja']}}">
															</td>
															<td>
																<input type="text" name="prestasi_rencana[]"  class="form-control col-md-7 col-xs-12" value="{{$penugasan['prestasi_rencana']}}">
															</td>
															<td>
																<input type="text" name="prestasi_realisasi[]"  class="form-control col-md-7 col-xs-12" value="{{$penugasan['prestasi_realisasi']}}">
															</td>
															<td>
																<input type="text" name="nama_atasan[]"  class="form-control col-md-7 col-xs-12" value="{{$penugasan['nama_atasan']}}">
															</td>
															<td>
																<input type="text" name="jabatan_atasan[]"  class="form-control col-md-7 col-xs-12" value="{{$penugasan['jabatan_atasan']}}">
															</td>
														</tr>
														<?php $i++; ?>
													@endforeach
													@if($i < 12)
														<?php 
															$kurang = 12 - $i;
															for ($j=1; $j <= $kurang ; $j++) { 
														?>
																<tr>
																	<td>{{$j + $i}}</td>
																	<td>
																		<input type="text" name="mulai_tugas[]"  class="form-control col-md-7 col-xs-12" placeholder="dd-mm-yyyy">
																	</td>
																	<td>
																		<input type="text" name="akhir_tugas[]"  class="form-control col-md-7 col-xs-12" placeholder="dd-mm-yyyy">
																	</td>
																	<td>
																		<input type="text" name="no_sk[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																	<td>
																		<input type="text" name="jabatan_tugas[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																	<td>
																		<input type="text" name="unit_kerja[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																	<td>
																		<input type="text" name="kj[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																	<td>
																		<input type="text" name="kk[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																	<td>
																		<input type="text" name="tempat_kerja[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																	<td>
																		<input type="text" name="prestasi_rencana[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																	<td>
																		<input type="text" name="prestasi_realisasi[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																	<td>
																		<input type="text" name="nama_atasan[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																	<td>
																		<input type="text" name="jabatan_atasan[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																</tr>
														<?php	} ?>
													@endif
											</tbody>
										</table>
										<p>** : - Untuk Kepala Proyek (Ex Kapro) diisi BK/PU</p>
										<p> &nbsp&nbsp&nbsp&nbsp&nbsp   - Untuk Kepala Cabang (Ex Kacab) diisi NKB</p>
									</div>
								</div>
								<!-- ------------------------------------------------------------------------------------- -->
								<div class="ln_solid"></div>
								<div class="x_title">
									<h4>Karya Ilmiah</h4>
								</div>
								<div class="row">
									<div class="col-md-12">
										<table class="table table-bordered">
											<thead>
												<th>No.</th>
												<th>Tanggal</th>
												<th style="width: 30%;">Judul Karya Ilmiah Dipresentasikan</th>
												<th>Tempat</th>
												<th>Sifat Karya Ilmiah<br> (Gagasan, Ulasan, Tinjauan) *</th>
												<th>Lingkup Kegiatan<br> (Internasional, Nasional, Lokal) *</th>
												<th>Referensi</th>
											</thead>
											<tbody>
												<?php $i=0;?>
													@foreach($presentasis as $presentasi)
														<tr>
															<td>{{$i+1}}</td>
															<td>
																<input type="text" name="tanggal_presentasi[]"  class="form-control col-md-7 col-xs-12" value="{{konversi_tanggal($presentasi['tanggal'])}}" placeholder="dd-mm-yyyy">
															</td>
															<td>
																<input type="text" name="judul_presentasi[]"  class="form-control col-md-7 col-xs-12" value="{{$presentasi['judul']}}">
															</td>
															<td>
																<input type="text" name="tempat_presentasi[]"  class="form-control col-md-7 col-xs-12" value="{{$presentasi['tempat']}}">
															</td>
															<td>
																<input type="text" name="sifat_presentasi[]"  class="form-control col-md-7 col-xs-12" value="{{$presentasi['sifat']}}">
															</td>
															<td>
																<input type="text" name="lingkup_presentasi[]"  class="form-control col-md-7 col-xs-12" value="{{$presentasi['lingkup_kegiatan']}}">
															</td>
															<td>
																<input type="text" name="referensi_presentasi[]"  class="form-control col-md-7 col-xs-12" value="{{$presentasi['referensi']}}">
															</td>
														</tr>
														<?php $i++; ?>
													@endforeach
													@if($i < 3)
														<?php 
															$kurang = 3 - $i;
															for ($j=1; $j <= $kurang ; $j++) { 
														?>
																<tr>
																	<td>{{$j + $i}}</td>
																	<td>
																		<input type="text" name="tanggal_presentasi[]"  class="form-control col-md-7 col-xs-12" placeholder="dd-mm-yyyy">
																	</td>
																	<td>
																		<input type="text" name="judul_presentasi[]"  class="form-control col-md-7 col-xs-12 sertifikat_akhir">
																	</td>
																	<td>
																		<input type="text" name="tempat_presentasi[]"  class="form-control col-md-7 col-xs-12 sertifikat">
																	</td>
																	<td>
																		<input type="text" name="sifat_presentasi[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																	<td>
																		<input type="text" name="lingkup_presentasi[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																	<td>
																		<input type="text" name="referensi_presentasi[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																</tr>
															<?php	} ?>
													@endif
											</tbody>
										</table>
										<table class="table table-bordered">
											<thead>
												<th>No.</th>
												<th>Tanggal</th>
												<th style="width: 30%;">Judul Karya Ilmiah Tidak Dipresentasikan</th>
												<th>Tempat</th>
												<th>Sifat Karya Ilmiah<br> (Gagasan, Ulasan, Tinjauan) *</th>
												<th>Lingkup Kegiatan<br> (Internasional, Nasional, Lokal) *</th>
												<th>Referensi</th>
											</thead>
											<tbody>
												<?php $i=0;?>
													@foreach($nopresentasis as $nopresentasi)
														<tr>
															<td>{{$i+1}}</td>
															<td>
																<input type="text" name="tanggal_nopresentasi[]"  class="form-control col-md-7 col-xs-12" value="{{konversi_tanggal($nopresentasi['tanggal'])}}" placeholder="dd-mm-yyyy">
															</td>
															<td>
																<input type="text" name="judul_nopresentasi[]"  class="form-control col-md-7 col-xs-12" value="{{$nopresentasi['judul']}}">
															</td>
															<td>
																<input type="text" name="tempat_nopresentasi[]"  class="form-control col-md-7 col-xs-12" value="{{$nopresentasi['tempat']}}">
															</td>
															<td>
																<input type="text" name="sifat_nopresentasi[]"  class="form-control col-md-7 col-xs-12" value="{{$nopresentasi['sifat']}}">
															</td>
															<td>
																<input type="text" name="lingkup_nopresentasi[]"  class="form-control col-md-7 col-xs-12" value="{{$nopresentasi['lingkup_kegiatan']}}">
															</td>
															<td>
																<input type="text" name="referensi_nopresentasi[]"  class="form-control col-md-7 col-xs-12" value="{{$nopresentasi['referensi']}}">
															</td>
														<?php $i++; ?>
													@endforeach
													@if($i < 3)
														<?php 
															$kurang = 3 - $i;
															for ($j=1; $j <= $kurang ; $j++) { 
														?>
																<tr>
																	<td>{{$j + $i}}</td>
																	<td>
																		<input type="text" name="tanggal_nopresentasi[]"  class="form-control col-md-7 col-xs-12" placeholder="dd-mm-yyyy">
																	</td>
																	<td>
																		<input type="text" name="judul_nopresentasi[]"  class="form-control col-md-7 col-xs-12 sertifikat_akhir">
																	</td>
																	<td>
																		<input type="text" name="tempat_nopresentasi[]"  class="form-control col-md-7 col-xs-12 sertifikat">
																	</td>
																	<td>
																		<input type="text" name="sifat_nopresentasi[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																	<td>
																		<input type="text" name="lingkup_nopresentasi[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																	<td>
																		<input type="text" name="referensi_nopresentasi[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																</tr>
													<?php	} ?>
													@endif
											</tbody>
										</table>
										<table class="table table-bordered">
											<thead>
												<th>No.</th>
												<th>Tanggal</th>
												<th style="width: 30%;">Judul Karya Ilmiah Tidak Dipublikasikan</th>
												<th>Tempat</th>
												<th>Sifat Karya Ilmiah<br> (Gagasan, Ulasan, Tinjauan) *</th>
												<th>Lingkup Kegiatan<br> (Internasional, Nasional, Lokal) *</th>
												<th>Referensi</th>
											</thead>
											<tbody>
												<?php $i=0;?>
													@foreach($nopublikasis as $nopublikasi)
														<tr>
															<td>{{$i+1}}</td>
															<td>
																<input type="text" name="tanggal_nopublikasi[]"  class="form-control col-md-7 col-xs-12" value="{{konversi_tanggal($nopublikasi['tanggal'])}}" placeholder="dd-mm-yyyy">
															</td>
															<td>
																<input type="text" name="judul_nopublikasi[]"  class="form-control col-md-7 col-xs-12" value="{{$nopublikasi['judul']}}">
															</td>
															<td>
																<input type="text" name="tempat_nopublikasi[]"  class="form-control col-md-7 col-xs-12" value="{{$nopublikasi['tempat']}}">
															</td>
															<td>
																<input type="text" name="sifat_nopublikasi[]"  class="form-control col-md-7 col-xs-12" value="{{$nopublikasi['sifat']}}">
															</td>
															<td>
																<input type="text" name="lingkup_nopublikasi[]"  class="form-control col-md-7 col-xs-12" value="{{$nopublikasi['lingkup_kegiatan']}}">
															</td>
															<td>
																<input type="text" name="referensi_nopublikasi[]"  class="form-control col-md-7 col-xs-12" value="{{$nopublikasi['referensi']}}">
															</td>
														</tr>
												<?php $i++; ?>
													@endforeach
													@if($i < 3)
														<?php 
															$kurang = 3 - $i;
															for ($j=1; $j <= $kurang ; $j++) { 
														?>
																<tr>
																	<td>{{$j + $i}}</td>
																	<td>
																		<input type="text" name="tanggal_nopublikasi[]"  class="form-control col-md-7 col-xs-12" placeholder="dd-mm-yyyy">
																	</td>
																	<td>
																		<input type="text" name="judul_nopublikasi[]"  class="form-control col-md-7 col-xs-12 sertifikat_akhir">
																	</td>
																	<td>
																		<input type="text" name="tempat_nopublikasi[]"  class="form-control col-md-7 col-xs-12 sertifikat">
																	</td>
																	<td>
																		<input type="text" name="sifat_nopublikasi[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																	<td>
																		<input type="text" name="lingkup_nopublikasi[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																	<td>
																		<input type="text" name="referensi_nopublikasi[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																</tr>
													<?php	} ?>
													@endif
											</tbody>
										</table>
									</div>
								</div>
								<!-- ------------------------------------------------------------------------------------- -->
								<div class="ln_solid"></div>
								<div class="x_title">
									<h4>Penunjang</h4>
								</div>
								<div class="row">
									<div class="col-md-12">
										<table class="table table-bordered">
											<thead>
												<th>No.</th>
												<th>Tanggal</th>
												<th>Tema Pertemuan</th>
												<th>Organisasi Penyelenggara</th>
												<th>Hadir Sebagai (Moderator, Penyaji, Peserta, Panitia) *</th>
												<th>Lingkup Kegiatan<br> (Internasional, Nasional, Lokal) *</th>
												<th>Referensi</th>
											</thead>
											<tbody>
												<?php $i=0;?>
													@foreach($pertemuans as $pertemuan)
														<tr>
															<td>{{$i+1}}</td>
															<td>
																<input type="text" name="tanggal_pertemuan[]"  class="form-control col-md-7 col-xs-12" value="{{konversi_tanggal($pertemuan['tanggal'])}}" placeholder="dd-mm-yyyy">
															</td>
															<td>
																<input type="text" name="tema[]"  class="form-control col-md-7 col-xs-12 " value="{{$pertemuan['tema']}}">
															</td>
															<td>
																<input type="text" name="organisasi_penyelenggara[]"  class="form-control col-md-7 col-xs-12 " value="{{$pertemuan['penyelenggara']}}">
															</td>
															<td>
																<input type="text" name="tempat_pertemuan[]"  class="form-control col-md-7 col-xs-12" value="{{$pertemuan['tempat']}}">
															</td>
															<td>
																<input type="text" name="hadir_sebagai[]"  class="form-control col-md-7 col-xs-12" value="{{$pertemuan['hadir_sebagai']}}">
															</td>
															<td>
																<input type="text" name="lingkup_pertemuan[]"  class="form-control col-md-7 col-xs-12" value="{{$pertemuan['lingkup_kegiatan']}}">
															</td>
															<td>
																<input type="text" name="referensi_pertemuan[]"  class="form-control col-md-7 col-xs-12" value="{{$pertemuan['referensi']}}">
															</td>
														<?php $i++; ?>
													@endforeach
													@if($i < 3)
														<?php 
															$kurang = 3 - $i;
															for ($j=1; $j <= $kurang ; $j++) { 
														?>
																<tr>
																	<td>{{$j + $i}}</td>
																	<td>
																		<input type="text" name="tanggal_pertemuan[]"  class="form-control col-md-7 col-xs-12" placeholder="dd-mm-yyyy">
																	</td>
																	<td>
																		<input type="text" name="tema[]"  class="form-control col-md-7 col-xs-12 ">
																	</td>
																	<td>
																		<input type="text" name="organisasi[]"  class="form-control col-md-7 col-xs-12 ">
																	</td>
																	<td>
																		<input type="text" name="tempat_pertemuan[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																	<td>
																		<input type="text" name="hadir_sebagai[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																	<td>
																		<input type="text" name="lingkup_pertemuan[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																	<td>
																		<input type="text" name="referensi_pertemuan[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																</tr>
													<?php	} ?>
													@endif
											</tbody>
										</table>
										<table class="table table-bordered">
											<thead>
												<th>No.</th>
												<th>Tanggal</th>
												<th>Nama Organisasi</th>
												<th>Tempat</th>
												<th>Aktif Sebagai (Ketua Umum, Wakil Ketua, Bendahara, Sekretaris, Pengurus Pendukung, Anggota) *</th>
												<th>Lingkup Kegiatan<br> (Internasional, Nasional, Lokal) *</th>
												<th>Referensi</th>
											</thead>
											<tbody>
												<?php $i=0;?>
													@foreach($organisasis as $organisasi)
														<tr>
															<td>{{$i+1}}</td>
															<td>
																<input type="text" name="tanggal_organisasi[]"  class="form-control col-md-7 col-xs-12" value="{{konversi_tanggal($organisasi['tanggal'])}}" placeholder="dd-mm-yyyy">
															</td>
															<td>
																<input type="text" name="nama_organisasi[]"  class="form-control col-md-7 col-xs-12" value="{{$organisasi['nama_organisasi']}}">
															</td>
															<td>
																<input type="text" name="tempat_organisasi[]"  class="form-control col-md-7 col-xs-12" value="{{$organisasi['tempat']}}">
															</td>
															<td>
																<input type="text" name="aktif_sebagai[]"  class="form-control col-md-7 col-xs-12" value="{{$organisasi['aktif_sebagai']}}">
															</td>
															<td>
																<input type="text" name="lingkup_organisasi[]"  class="form-control col-md-7 col-xs-12" value="{{$organisasi['lingkup_kegiatan']}}">
															</td>
															<td>
																<input type="text" name="referensi_organisasi[]"  class="form-control col-md-7 col-xs-12" value="{{$organisasi['referensi']}}">
															</td>
														</tr>
												<?php $i++; ?>
													@endforeach
													@if($i < 3)
														<?php 
															$kurang = 3 - $i;
															for ($j=1; $j <= $kurang ; $j++) { 
														?>
																<tr>
																	<td>{{$j + $i}}</td>
																	<td>
																		<input type="text" name="tanggal_organisasi[]"  class="form-control col-md-7 col-xs-12" placeholder="dd-mm-yyyy">
																	</td>
																	<td>
																		<input type="text" name="nama_organisasi[]"  class="form-control col-md-7 col-xs-12 sertifikat_akhir">
																	</td>
																	<td>
																		<input type="text" name="tempat_organisasi[]"  class="form-control col-md-7 col-xs-12 sertifikat">
																	</td>
																	<td>
																		<input type="text" name="aktif_sebagai[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																	<td>
																		<input type="text" name="lingkup_organisasi[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																	<td>
																		<input type="text" name="referensi_organisasi[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																</tr>
																<?php	} ?>
														@endif
											</tbody>
										</table>
										<table class="table table-bordered">
											<thead>
												<th>No.</th>
												<th>Tanggal</th>
												<th>Nama Publikasi / Organisasi</th>
												<th>Tempat</th>
												<th>Aktif Sebagai (Editor, Reader, Penyunting Proseding) *</th>
												<th>Lingkup Kegiatan<br> (Internasional, Nasional, Lokal) *</th>
												<th>Referensi</th>
											</thead>
											<tbody>
												<?php $i=0;?>
													@foreach($publikasis as $publikasi)
														<tr>
															<td>{{$i+1}}</td>
															<td>
																<input type="text" name="tanggal_publikasi[]"  class="form-control col-md-7 col-xs-12" value="{{konversi_tanggal($publikasi['tanggal'])}}" placeholder="dd-mm-yyyy">
															</td>
															<td>
																<input type="text" name="nama_publikasi[]"  class="form-control col-md-7 col-xs-12" value="{{$publikasi['nama_publikasi']}}">
															</td>
															<td>
																<input type="text" name="tempat_publikasi[]"  class="form-control col-md-7 col-xs-12" value="{{$publikasi['tempat']}}">
															</td>
															<td>
																<input type="text" name="aktif_sebagai_publikasi[]"  class="form-control col-md-7 col-xs-12" value="{{$publikasi['aktif_sebagai']}}">
															</td>
															<td>
																<input type="text" name="lingkup_publikasi[]"  class="form-control col-md-7 col-xs-12" value="{{$publikasi['lingkup_kegiatan']}}">
															</td>
															<td>
																<input type="text" name="referensi_publikasi[]"  class="form-control col-md-7 col-xs-12" value="{{$publikasi['referensi']}}">
															</td>
														</tr>
												<?php $i++; ?>
													@endforeach
													@if($i < 3)
														<?php 
															$kurang = 3 - $i;
															for ($j=1; $j <= $kurang ; $j++) { 
														?>
																<tr>
																	<td>{{$j + $i}}</td>
																	<td>
																		<input type="text" name="tanggal_publikasi[]"  class="form-control col-md-7 col-xs-12" placeholder="dd-mm-yyyy">
																	</td>
																	<td>
																		<input type="text" name="nama_publikasi[]"  class="form-control col-md-7 col-xs-12 sertifikat_akhir">
																	</td>
																	<td>
																		<input type="text" name="tempat_publikasi[]"  class="form-control col-md-7 col-xs-12 sertifikat">
																	</td>
																	<td>
																		<input type="text" name="aktif_sebagai_publikasi[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																	<td>
																		<input type="text" name="lingkup_publikasi[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																	<td>
																		<input type="text" name="referensi_publikasi[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																</tr>
															<?php	} ?>
														@endif
											</tbody>
										</table>
									</div>
								</div>
								<!-- ------------------------------------------------------------------------------------- -->
								<div class="ln_solid"></div>
								<div class="x_title">
									<h4>Tenaga Pengajar </h4>
								</div>
								<div class="row">
									<div class="col-md-12">
										<table class="table table-bordered">
											<thead>
												<th>No.</th>
												<th>Tanggal Mulai</th>
												<th>Materi</th>
												<th>Institusi</th>
												<th>Tempat</th>
												<th>Aktif Sebagai (Pengajar, Pembimbing, Instruktur) *)</th>
												<th>Lingkup Kegiatan (Internasional, Nasional, Lokal) *)</th>
												<th>Referensi</th>
											</thead>
											<tbody>
												<?php $i=0;?>
													@foreach($pengajars as $pengajar)
														<tr>
															<td>{{$i+1}}</td>
															<td>
																<input type="text" name="mulai_pengajar[]"  class="form-control col-md-7 col-xs-12" value="{{konversi_tanggal($pengajar['tanggal_mulai'])}}" placeholder="dd-mm-yyyy">
															</td>
															<td>
																<input type="text" name="materi[]"  class="form-control col-md-7 col-xs-12" value="{{$pengajar['materi']}}">
															</td>
															<td>
																<input type="text" name="institusi[]"  class="form-control col-md-7 col-xs-12" value="{{$pengajar['institusi']}}">
															</td>
															<td>
																<input type="text" name="tempat_pengajar[]"  class="form-control col-md-7 col-xs-12" value="{{$pengajar['tempat']}}">
															</td>
															<td>
																<input type="text" name="aktif_sebagai_pengajar[]"  class="form-control col-md-7 col-xs-12" value="{{$pengajar['aktif_sebagai']}}">
															</td>
															<td>
																<input type="text" name="lingkup_pengajar[]"  class="form-control col-md-7 col-xs-12" value="{{$pengajar['lingkup_kegiatan']}}">
															</td>
															<td>
																<input type="text" name="referensi_pengajar[]"  class="form-control col-md-7 col-xs-12"  value="{{$pengajar['referensi']}}">
															</td>
														</tr>
														<?php $i++; ?>
													@endforeach
													@if($i < 3)
														<?php 
															$kurang = 3 - $i;
															for ($j=1; $j <= $kurang ; $j++) { 
														?>
																<tr>
																	<td>{{$j + $i}}</td>
																	<td>
																		<input type="text" name="mulai_pengajar[]"  class="form-control col-md-7 col-xs-12" placeholder="dd-mm-yyyy">
																	</td>
																	<td>
																		<input type="text" name="materi[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																	<td>
																		<input type="text" name="institusi[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																	<td>
																		<input type="text" name="tempat_pengajar[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																	<td>
																		<input type="text" name="aktif_sebagai_pengajar[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																	<td>
																		<input type="text" name="lingkup_pengajar[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																	<td>
																		<input type="text" name="referensi_pengajar[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																</tr>
															<?php	} ?>
														@endif
											</tbody>
										</table>
									</div>
								</div>
								<!-- ------------------------------------------------------------------------------------- -->
								<div class="ln_solid"></div>
								<div class="x_title">
									<h4>Penghargaan</h4>
								</div>
								<div class="row">
									<div class="col-md-12">
										<table class="table table-bordered">
											<thead>
												<th>No.</th>
												<th>Tanggal</th>
												<th>Nama Penghargaan</th>
												<th>Tempat</th>
												<th>Jenis Penghargaan</th>
												<th>Lingkup Kegiatan (Internasional, Nasional, Lokal) *)</th>
												<th>Referensi</th>
											</thead>
											<tbody>
												<?php $i=0;?>
													@foreach($penghargaans as $penghargaan)
														<tr>
															<td>{{$i+1}}</td>
															<td>
																<input type="text" name="tanggal_penghargaan[]"  class="form-control col-md-7 col-xs-12" value="{{konversi_tanggal($penghargaan['tanggal'])}}" placeholder="dd-mm-yyyy">
															</td>
															<td>
																<input type="text" name="nama_penghargaan[]"  class="form-control col-md-7 col-xs-12" value="{{$penghargaan['nama_penghargaan']}}">
															</td>
															<td>
																<input type="text" name="tempat_penghargaan[]"  class="form-control col-md-7 col-xs-12" value="{{$penghargaan['tempat']}}">
															</td>
															<td>
																<input type="text" name="jenis_penghargaan[]"  class="form-control col-md-7 col-xs-12" value="{{$penghargaan['jenis_penghargaan']}}">
															</td>
															<td>
																<input type="text" name="lingkup_penghargaan[]"  class="form-control col-md-7 col-xs-12" value="{{$penghargaan['lingkup_kegiatan']}}">
															</td>
															<td>
																<input type="text" name="referensi_penghargaan[]"  class="form-control col-md-7 col-xs-12" value="{{$penghargaan['referensi']}}">
															</td>
														</tr>
														<?php $i++; ?>
													@endforeach
													@if($i < 3)
														<?php 
															$kurang = 3 - $i;
															for ($j=1; $j <= $kurang ; $j++) { 
														?>
																<tr>
																	<td>{{$j + $i}}</td>
																	<td>
																		<input type="text" name="tanggal_penghargaan[]"  class="form-control col-md-7 col-xs-12" placeholder="dd-mm-yyyy">
																	</td>
																	<td>
																		<input type="text" name="nama_penghargaan[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																	<td>
																		<input type="text" name="tempat_penghargaan[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																	<td>
																		<input type="text" name="jenis_penghargaan[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																	<td>
																		<input type="text" name="lingkup_penghargaan[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																	<td>
																		<input type="text" name="referensi_penghargaan[]"  class="form-control col-md-7 col-xs-12">
																	</td>
																</tr>
															<?php	} ?>
														@endif
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
		                        		@if(count($data_mcus) !=0)
			                        		<?php $i = 0;?>
			                        		@foreach($data_mcus as $key=>$mcu)
			                        			<tr>
			                        				<td>{{$i+1}}</td>
			                        				<td>{{$mcu->mcu->pernyataan}}
			                        					<input type="hidden" name="pernyataan[{{$key}}]" value="{{$mcu->pernyataan_id}}">
			                        				</td>
			                        				<td>
			                        					<?php $checked = ($mcu->nilai == '1')? 'checked' : ''; ?>
			                        					<input type="radio" name="mcu[{{$key}}]" value="1" {{$checked}} required="required"> Ya
			                        				</td>
			                        				<td>
			                        					<?php $checked = ($mcu->nilai == '0')? 'checked' : ''; ?>
			                        					<input type="radio" name="mcu[{{$key}}]" value="0" {{$checked}} required="required"> Tidak
			                        				</td>
			                        			</tr>
			                        			<?php $i++; ?>
			                        		@endforeach
			                        	@else
			                        		<?php $i = 0;?>
			                        		@foreach($mcus as $key=>$mcu)
			                        			<tr>
			                        				<td>{{$i+1}}</td>
			                        				<td>{{$mcu->pernyataan}}
			                        					<input type="hidden" name="pernyataan[]" value="{{$mcu->pernyataan_id}}">
			                        				</td>
			                        				<td>
			                        					<input type="radio" name="mcu[{{$key}}]" value="1"> Ya
			                        				</td>
			                        				<td>
			                        					<input type="radio" name="mcu[{{$key}}]" value="0"> Tidak
			                        				</td>
			                        			</tr>
			                        			<?php $i++; ?>
			                        		@endforeach
			                        	@endif
		                        	</tbody>
		                        </table>
		                      </div>
		                      <div id="step-3">
		                        <h2 class="StepTitle">Step 3 Content</h2>
		                        
		                        <p>
		                          sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
		                          eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		                        </p>
		                        <p>
		                          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
		                          in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		                        </p>
		                        <div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="no_rek">Tanda Tangan <span class="required">*</span>:</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input type="file" id="ttd" name="ttd"  class="form-control col-md-7 col-xs-12">
										<p>Tanda Tangan harus berupa file .jpg / .png, dengan ukuran maksimum 1 MB</p>
									</div>
								</div>
								* Untuk Projek Manager, Manager dan Staff Public Relation harap mengupload paraf
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="no_rek">Paraf <span class="required">*</span>:</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input type="file" id="ttd" name="paraf"  class="form-control col-md-7 col-xs-12">
										<p>Paraf harus berupa file .jpg / .png, dengan ukuran maksimum 1 MB</p>
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

      $('input[type=radio][name=status_kawin]').change(function () {
      		console.log('sd');
            if ($("input[name='status_kawin']:checked").val() == 'TK') {
            	$('#anak').attr('readonly','readonly');
            	$('#suami_istri').attr('readonly','readonly');
            }
            if ($("input[name='status_kawin']:checked").val() == 'K0') {
            	$('#anak').attr('readonly','readonly');
            	$('#suami_istri'). removeAttr('readonly');
            }
            if (($("input[name='status_kawin']:checked").val() == 'K1') || ($("input[name='status_kawin']:checked").val() == 'K2') || ($("input[name='status_kawin']:checked").val() == 'K3')) {
            	$('#anak').removeAttr('readonly');
            	$('#suami_istri'). removeAttr('readonly');
            }
         });
  	});

</script>
@endpush