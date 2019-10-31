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
<?php
	if($gaji){
		if(($gaji->gaji_pokok == null) || ($gaji->gaji_pokok == '')){
			$gaji->gaji_pokok = 0;
		}
		if(($gaji->tunj_komunikasi == null) || ($gaji->tunj_komunikasi == '')){
			$gaji->tunj_komunikasi = 0;
		}
		if(($gaji->tunj_transportasi == null) || ($gaji->tunj_transportasi == '')){
			$gaji->tunj_transportasi = 0;
		}
		if(($gaji->uang_makan == null) || ($gaji->uang_makan == '')){
			$gaji->uang_makan = 0;
		}
		if(($gaji->tunj_pph21 == null) || ($gaji->tunj_pph21 == '')){
			$gaji->tunj_pph21 = 0;
		}
	}
?>

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
													<input type="radio" value="TK" name="status_kawin" {{$checked}} required="required"> Belum Kawin </br>
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
										                <input type='text' name='tgl_lahir' class='form-control' required="required" value="{{konversi_tanggal($pegawai->tanggal_lahir)}}" readonly="readonly" placeholder="dd-mm-yyyy" />
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
													<textarea id="alamat_tetap" class="form-control col-md-7 col-xs-12 alamat_tetap" type="text" name="alamat_tetap">{{$pegawai->alamat_tetap}}</textarea>
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
													<textarea id="alamat_sementara" class="form-control col-md-7 col-xs-12 alamat_sementara" type="text" name="alamat_sementara">{{$pegawai->alamat_sementara}}</textarea>
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
													<textarea id="alamat_keluarga" name="alamat_keluarga"  class="form-control col-md-7 col-xs-12 alamat_keluarga" >{{$pegawai->alamat_keluarga}}</textarea>
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
															<option value="">--Pilih Bank----</option>
															<option value="BRI">BRI</option>
															<option value="Mandiri">Mandiri</option>
															<option value="BNI">BNI</option>
															<option value="BCA">BCA</option>
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
														<input type="text" id="jiwasraya" class="form-control col-md-7 col-xs-12 jiwasraya" type="text" name="jiwasraya">
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
																<input type="text"  name="jenjang[]"  class="form-control col-md-7 col-xs-12 jenjang_1" value="{{$pendidikan['jenjang']}}" readonly="readonly">
															</td>
															<td>
																<input type="text" name="asal_sekolah[]"  class="form-control col-md-7 col-xs-12 asal_sekolah_1" value="{{$pendidikan['asal_sekolah']}}" readonly="readonly">
															</td>
															<td>
																<input type="text"  name="kota[]"  class="form-control col-md-7 col-xs-12 kota_1" value="{{$pendidikan['kota']}}" readonly="readonly">
															</td>
															<td>
																<input type="text"name="jurusan[]"  class="form-control col-md-7 col-xs-12 jurusan_1" value="{{$pendidikan['jurusan']}}" readonly="readonly">
															</td>
															<td>
																<input type="text" name="tahun_lulus[]"  class="form-control col-md-7 col-xs-12" value="{{$pendidikan['tahun_lulus']}}" readonly="readonly" >
															</td>
															<td>
																<input type="text" name="no_ijazah[]"  class="form-control col-md-7 col-xs-12" value="{{$pendidikan['no_ijazah']}}" readonly="readonly">
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
																	<td><input type="text" id="jenjang_2" name="jenjang[]"  class="form-control col-md-7 col-xs-12 jenjang_2" readonly="readonly"></td>
																	<td>
																		<input type="text" id="asal_sekolah_2" name="asal_sekolah[]"  class="form-control col-md-7 col-xs-12 asal_sekolah_2" readonly="readonly">
																	</td>
																	<td>
																		<input type="text" id="kota_2" name="kota[]"  class="form-control col-md-7 col-xs-12 kota_2" readonly="readonly">
																	</td>
																	<td>
																		<input type="text" id="jurusan_2" name="jurusan[]"  class="form-control col-md-7 col-xs-12 jurusan_2" readonly="readonly">
																	</td>
																	<td>
																		<input type="text" id="lulus_2" name="tahun_lulus[]"  class="form-control col-md-7 col-xs-12 lulus_2" readonly="readonly">
																	</td>
																	<td>
																		<input type="text" id="ijazah_2" name="no_ijazah[]"  class="form-control col-md-7 col-xs-12 ijazah_2" readonly="readonly">
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
																<input type="text" name="sertifikat_mulai[]"  class="form-control col-md-7 col-xs-12 sertifikat_mulai" value="{{$sertifikat['tanggal_mulai']}}" readonly="readonly">
															</td>
															<td>
																<input type="text" name="sertifikat_akhir[]"  class="form-control col-md-7 col-xs-12 sertifikat_akhir" value="{{$sertifikat['tanggal_akhir']}}" readonly="readonly">
															</td>
															<td>
																<input type="text" name="sertifikat[]"  class="form-control col-md-7 col-xs-12 sertifikat" value="{{$sertifikat['sertifikat']}}" readonly="readonly">
															</td>
															<td>
																<input type="text" name="no_sertifikat[]"  class="form-control col-md-7 col-xs-12" value="{{$sertifikat['no_sertifikat']}}" readonly="readonly">
															</td>
															<td>
																<input type="text" name="institusi_sertifikat[]"  class="form-control col-md-7 col-xs-12" value="{{$sertifikat['institusi']}}" readonly="readonly">
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
																		<input type="text" name="sertifikat_mulai[]"  class="form-control col-md-7 col-xs-12 sertifikat_mulai" readonly="readonly">
																	</td>
																	<td>
																		<input type="text" name="sertifikat_akhir[]"  class="form-control col-md-7 col-xs-12 sertifikat_akhir" readonly="readonly">
																	</td>
																	<td>
																		<input type="text" name="sertifikat[]"  class="form-control col-md-7 col-xs-12 sertifikat" readonly="readonly">
																	</td>
																	<td>
																		<input type="text" name="no_sertifikat[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																	</td>
																	<td>
																		<input type="text" name="institusi_sertifikat[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
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
																	<input type="text" name="pelatihan_tanggal[]"  class="form-control col-md-7 col-xs-12" value="{{$pelatihan['tanggal']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="nama_pelatihan[]"  class="form-control col-md-7 col-xs-12" value="{{$pelatihan['nama_pelatihan']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="tempat_pelatihan[]"  class="form-control col-md-7 col-xs-12" value="{{$pelatihan['tempat']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="jam_hari[]"  class="form-control col-md-7 col-xs-12" value="{{$pelatihan['jam_hari']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="penyelenggara_pelatihan[]"  class="form-control col-md-7 col-xs-12" value="{{$pelatihan['penyelenggara']}}" readonly="readonly">
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
																			<input type="text" name="pelatihan_tanggal[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="nama_pelatihan[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="tempat_pelatihan[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="jam_hari[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="penyelenggara_pelatihan[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
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
																	<input type="text" name="mulai_kerja[]"  class="form-control col-md-7 col-xs-12" value="{{$pengalaman['tanggal_mulai']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="akhir_kerja[]"  class="form-control col-md-7 col-xs-12" value="{{$pengalaman['tanggal_akhir']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="nama_perusahaan[]"  class="form-control col-md-7 col-xs-12" value="{{$pengalaman['nama_perusahaan']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="jabatan[]"  class="form-control col-md-7 col-xs-12" value="{{$pengalaman['jabatan']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="keterangan[]"  class="form-control col-md-7 col-xs-12" value="{{$pengalaman['keterangan']}}" readonly="readonly">
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
																			<input type="text" name="mulai_kerja[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="akhir_kerja[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="nama_perusahaan[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="jabatan[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="keterangan[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
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
										<div class="col-md-12" style="overflow: scroll;">
											<table class="table table-bordered" style="width: 1500px;  background: white;">
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
																	<input type="text" name="mulai_tugas[]"  class="form-control col-md-7 col-xs-12" value="{{$penugasan['tanggal_mulai']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="akhir_tugas[]"  class="form-control col-md-7 col-xs-12" value="{{$penugasan['tanggal_akhir']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="no_sk[]"  class="form-control col-md-7 col-xs-12" value="{{$penugasan['no_sk']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="jabatan_tugas[]"  class="form-control col-md-7 col-xs-12" value="{{$penugasan['jabatan']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="unit_kerja[]"  class="form-control col-md-7 col-xs-12" value="{{$penugasan['unit_kerja']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="kj[]"  class="form-control col-md-7 col-xs-12" value="{{$penugasan['KJ']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="kk[]"  class="form-control col-md-7 col-xs-12" value="{{$penugasan['KK']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="tempat_kerja[]"  class="form-control col-md-7 col-xs-12" value="{{$penugasan['tempat_kerja']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="prestasi_rencana[]"  class="form-control col-md-7 col-xs-12" value="{{$penugasan['prestasi_rencana']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="prestasi_realisasi[]"  class="form-control col-md-7 col-xs-12" value="{{$penugasan['prestasi_realisasi']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="nama_atasan[]"  class="form-control col-md-7 col-xs-12" value="{{$penugasan['nama_atasan']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="jabatan_atasan[]"  class="form-control col-md-7 col-xs-12" value="{{$penugasan['jabatan_atasan']}}" readonly="readonly">
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
																			<input type="text" name="mulai_tugas[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="akhir_tugas[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="no_sk[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="jabatan_tugas[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="unit_kerja[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="kj[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="kk[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="tempat_kerja[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="prestasi_rencana[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="prestasi_realisasi[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="nama_atasan[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="jabatan_atasan[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
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
																	<input type="text" name="tanggal_presentasi[]"  class="form-control col-md-7 col-xs-12" value="{{$presentasi['tanggal']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="judul_presentasi[]"  class="form-control col-md-7 col-xs-12" value="{{$presentasi['judul']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="tempat_presentasi[]"  class="form-control col-md-7 col-xs-12" value="{{$presentasi['tempat']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="sifat_presentasi[]"  class="form-control col-md-7 col-xs-12" value="{{$presentasi['sifat']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="lingkup_presentasi[]"  class="form-control col-md-7 col-xs-12" value="{{$presentasi['lingkup_kegiatan']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="referensi_presentasi[]"  class="form-control col-md-7 col-xs-12" value="{{$presentasi['referensi']}}" readonly="readonly">
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
																			<input type="text" name="tanggal_presentasi[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="judul_presentasi[]"  class="form-control col-md-7 col-xs-12 sertifikat_akhir" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="tempat_presentasi[]"  class="form-control col-md-7 col-xs-12 sertifikat" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="sifat_presentasi[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="lingkup_presentasi[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="referensi_presentasi[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
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
																	<input type="text" name="tanggal_nopresentasi[]"  class="form-control col-md-7 col-xs-12" value="{{$nopresentasi['tanggal']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="judul_nopresentasi[]"  class="form-control col-md-7 col-xs-12" value="{{$nopresentasi['judul']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="tempat_nopresentasi[]"  class="form-control col-md-7 col-xs-12" value="{{$nopresentasi['tempat']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="sifat_nopresentasi[]"  class="form-control col-md-7 col-xs-12" value="{{$nopresentasi['sifat']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="lingkup_nopresentasi[]"  class="form-control col-md-7 col-xs-12" value="{{$nopresentasi['lingkup_kegiatan']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="referensi_nopresentasi[]"  class="form-control col-md-7 col-xs-12" value="{{$nopresentasi['referensi']}}" readonly="readonly">
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
																			<input type="text" name="tanggal_nopresentasi[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="judul_nopresentasi[]"  class="form-control col-md-7 col-xs-12 sertifikat_akhir" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="tempat_nopresentasi[]"  class="form-control col-md-7 col-xs-12 sertifikat" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="sifat_nopresentasi[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="lingkup_nopresentasi[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="referensi_nopresentasi[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
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
																	<input type="text" name="tanggal_nopublikasi[]"  class="form-control col-md-7 col-xs-12" value="{{$nopublikasi['tanggal']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="judul_nopublikasi[]"  class="form-control col-md-7 col-xs-12" value="{{$nopublikasi['judul']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="tempat_nopublikasi[]"  class="form-control col-md-7 col-xs-12" value="{{$nopublikasi['tempat']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="sifat_nopublikasi[]"  class="form-control col-md-7 col-xs-12" value="{{$nopublikasi['sifat']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="lingkup_nopublikasi[]"  class="form-control col-md-7 col-xs-12" value="{{$nopublikasi['lingkup_kegiatan']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="referensi_nopublikasi[]"  class="form-control col-md-7 col-xs-12" value="{{$nopublikasi['referensi']}}" readonly="readonly">
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
																			<input type="text" name="tanggal_nopublikasi[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="judul_nopublikasi[]"  class="form-control col-md-7 col-xs-12 sertifikat_akhir" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="tempat_nopublikasi[]"  class="form-control col-md-7 col-xs-12 sertifikat" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="sifat_nopublikasi[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="lingkup_nopublikasi[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="referensi_nopublikasi[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
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
																	<input type="text" name="tanggal_pertemuan[]"  class="form-control col-md-7 col-xs-12" value="{{$pertemuan['tanggal']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="tema[]"  class="form-control col-md-7 col-xs-12 " value="{{$pertemuan['tema']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="organisasi_penyelenggara[]"  class="form-control col-md-7 col-xs-12 " value="{{$pertemuan['penyelenggara']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="tempat_pertemuan[]"  class="form-control col-md-7 col-xs-12" value="{{$pertemuan['tempat']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="hadir_sebagai[]"  class="form-control col-md-7 col-xs-12" value="{{$pertemuan['hadir_sebagai']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="lingkup_pertemuan[]"  class="form-control col-md-7 col-xs-12" value="{{$pertemuan['lingkup_kegiatan']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="referensi_pertemuan[]"  class="form-control col-md-7 col-xs-12" value="{{$pertemuan['referensi']}}" readonly="readonly">
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
																			<input type="text" name="tanggal_pertemuan[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="tema[]"  class="form-control col-md-7 col-xs-12 " readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="organisasi[]"  class="form-control col-md-7 col-xs-12 " readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="tempat_pertemuan[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="hadir_sebagai[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="lingkup_pertemuan[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="referensi_pertemuan[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
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
																	<input type="text" name="tanggal_organisasi[]"  class="form-control col-md-7 col-xs-12" value="{{$organisasi['tanggal']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="nama_organisasi[]"  class="form-control col-md-7 col-xs-12" value="{{$organisasi['nama_organisasi']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="tempat_organisasi[]"  class="form-control col-md-7 col-xs-12" value="{{$organisasi['tempat']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="aktif_sebagai[]"  class="form-control col-md-7 col-xs-12" value="{{$organisasi['aktif_sebagai']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="lingkup_organisasi[]"  class="form-control col-md-7 col-xs-12" value="{{$organisasi['lingkup_kegiatan']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="referensi_organisasi[]"  class="form-control col-md-7 col-xs-12" value="{{$organisasi['referensi']}}" readonly="readonly">
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
																			<input type="text" name="tanggal_organisasi[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="nama_organisasi[]"  class="form-control col-md-7 col-xs-12 sertifikat_akhir" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="tempat_organisasi[]"  class="form-control col-md-7 col-xs-12 sertifikat" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="aktif_sebagai[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="lingkup_organisasi[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="referensi_organisasi[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
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
																	<input type="text" name="tanggal_publikasi[]"  class="form-control col-md-7 col-xs-12" value="{{$publikasi['tanggal']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="nama_publikasi[]"  class="form-control col-md-7 col-xs-12" value="{{$publikasi['nama_publikasi']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="tempat_publikasi[]"  class="form-control col-md-7 col-xs-12" value="{{$publikasi['tempat']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="aktif_sebagai_publikasi[]"  class="form-control col-md-7 col-xs-12" value="{{$publikasi['aktif_sebagai']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="lingkup_publikasi[]"  class="form-control col-md-7 col-xs-12" value="{{$publikasi['lingkup_kegiatan']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="referensi_publikasi[]"  class="form-control col-md-7 col-xs-12" value="{{$publikasi['referensi']}}" readonly="readonly">
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
																			<input type="text" name="tanggal_publikasi[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="nama_publikasi[]"  class="form-control col-md-7 col-xs-12 sertifikat_akhir" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="tempat_publikasi[]"  class="form-control col-md-7 col-xs-12 sertifikat" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="aktif_sebagai_publikasi[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="lingkup_publikasi[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="referensi_publikasi[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
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
																	<input type="text" name="mulai_pengajar[]"  class="form-control col-md-7 col-xs-12" value="{{$pengajar['tanggal_mulai']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="materi[]"  class="form-control col-md-7 col-xs-12" value="{{$pengajar['materi']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="institusi[]"  class="form-control col-md-7 col-xs-12" value="{{$pengajar['institusi']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="tempat_pengajar[]"  class="form-control col-md-7 col-xs-12" value="{{$pengajar['tempat']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="aktif_sebagai_pengajar[]"  class="form-control col-md-7 col-xs-12" value="{{$pengajar['aktif_sebagai']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="lingkup_pengajar[]"  class="form-control col-md-7 col-xs-12" value="{{$pengajar['lingkup_kegiatan']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="referensi_pengajar[]"  class="form-control col-md-7 col-xs-12"  value="{{$pengajar['referensi']}}" readonly="readonly">
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
																			<input type="text" name="mulai_pengajar[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="materi[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="institusi[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="tempat_pengajar[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="aktif_sebagai_pengajar[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="lingkup_pengajar[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="referensi_pengajar[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
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
																	<input type="text" name="tanggal_penghargaan[]"  class="form-control col-md-7 col-xs-12" value="{{$penghargaan['tanggal']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="nama_penghargaan[]"  class="form-control col-md-7 col-xs-12" value="{{$penghargaan['nama_penghargaan']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="tempat_penghargaan[]"  class="form-control col-md-7 col-xs-12" value="{{$penghargaan['tempat']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="jenis_penghargaan[]"  class="form-control col-md-7 col-xs-12" value="{{$penghargaan['jenis_penghargaan']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="lingkup_penghargaan[]"  class="form-control col-md-7 col-xs-12" value="{{$penghargaan['lingkup_kegiatan']}}" readonly="readonly">
																</td>
																<td>
																	<input type="text" name="referensi_penghargaan[]"  class="form-control col-md-7 col-xs-12" value="{{$penghargaan['referensi']}}" readonly="readonly">
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
																			<input type="text" name="tanggal_penghargaan[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="nama_penghargaan[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="tempat_penghargaan[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="jenis_penghargaan[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="lingkup_penghargaan[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
																		</td>
																		<td>
																			<input type="text" name="referensi_penghargaan[]"  class="form-control col-md-7 col-xs-12" readonly="readonly">
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
			                        <h2 class="StepTitle" style="text-align: center;">PERJANJIAN KERJA WAKTU TERTENTU (PKWT)</h2>
			                        <h4 style="text-align: center;">NOMOR : {{$pegawai->no_pkwt}}</h4><br>
			                        <?php

			                        	if($pegawai->created_at){
			                        		$tanggal = explode(' ', $pegawai->created_at);
			                        	}else{
			                        		$tanggal[0]=0;
			                        	}
			                        ?>
			                        <div>
										Pada hari ini tanggal {{formatTanggalPanjang($tanggal[0])}}, kami yang bertandatangan dibawah ini :
										<br><br>
										<ol type="1">
											<li>Pihak Perusahaan 
												<ul style="list-style-type:none;">
													<li>Nama Perusahaan 	:	PT. Waskita Karya (Persero), Tbk. Proyek Pembangunan Jalan Tol Becakayu 2A Ujung</li>
													<li>Alamat Perusahaan	:	Jl. Ahmad Yani Ruko Mutiara Bekasi Center Blok A9 nomor 7, Bekasi Utara, Bekasi, Jawa Barat.</li>
												</ul>
												<br><br>
												Dalam hal ini diwakili oleh
												<ul style="list-style-type:none;">
													<li>Nama	:	Mochamad Waskito Adi, ST</li>
													<li>Jabatan	:	Kepala Proyek<br><br></li>
												</ul>
												<br>Dalam hal ini bertindak untuk dan atas nama PT. Waskita Karya (Persero) Tbk Proyek Pembangunan Jalan Tol Becakayu 2A Ujung, selanjutnya dalam Perjanjian Kerja Waktu Tertentu ini disebut sebagai PIHAK PERTAMA.
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
												Yang dimaksud Perusahaan dalam perjanjian ini adalah PT. Waskita Karya (Persero) Tbk Proyek Pembangunan Tol Becakayu 2A Ujung.
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
												PIHAK PERTAMA akan mempekerjakan PIHAK KEDUA sebagai pekerja PT. WaskitaKarya (Persero) Tbk Proyek Jalan Tol Becakayu 2A Ujung, dengan status / kedudukan sebagai pekerja waktu tertentu (tidak tetap) dan ditempatkan sebagai ………………………..
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
												PIHAK PERTAMA menerima PIHAK KEDUA sebagai Pegawai Honorer Proyek dan menandatangani PKWT dalam jangka waktu sampai dengan 31 Januari 2019, terhitung sejak ditandatangani yaitu tanggal ............. sampai dengan tanggal .............. Dengan catatan jika proyek ini sudah selesai sebelum tanggal tersebut pihak kedua tidak bisa menuntut pihak pertama.
											</li>
										</ol>
										<div style="text-align: center;">
											Pasal4<br>
										WAKTU KERJA DAN ISTIRAHAT
										</div>
										<ol type="1">
											<li>
												PIHAK KEDUA bersedia mengikuti jam kerja yang diatur oleh PT. Waskita Karya (Persero) Tbk Proyek Jalan Tol Becakayu 2A Ujung.
											</li>
											<li>
												Sesuai dengan kebutuhan pelaksanaan pekerjaan di PT. Waskita Karya (Persero) Tbk Proyek Jalan Tol Becakayu 2A Ujung, PIHAK KEDUA bersedia bekerja secara bergiliran (shift) apabila diperlukan.
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
											<li>Perusahaan dan PIHAK KEDUA menyatakan bahwa tidak ada janji-janji lainnya selain kesepakatan yang tertulis dalam pasal-pasal PKWT ini, kecuali surat-surat edaran dan kebijakan-kebijakan yang telah disepakati bersama oleh kedua belah pihak selama bertugas di proyek Pembangunan Jalan Tol Becakayu 2A Ujung.</li>
										</ol>
										<div style="text-align: center;">
											Pasal 16<br>
										PENYELESAIAN PERSELISIHAN<br><br>
										Apabila terjadi perselisihan pendapa tmengena pelaksanaan PKWT ini, akan diselesaikan secara musyawarah antara Perusahaan dan PIHAK KEDUA, apabila perselisihan tersebut tidak terselesaikan antara kedua pihak, akan diselesaikan secara Bipartit antara Perusahaan dengan Serikat Pekerja Waskita, dan / atau secara Tripatit dengan pejabat perantara dari Departemen Tenaga Kerja RI.<br><br>
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
			                        	@if($gaji)
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Gaji Pokok:</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input type="text" name="gaji_pokok" class="form-control col-md-7 col-xs-12 gaji_pokok" id="gaji_pokok" required="required" value="{{$gaji->gaji_pokok}}">
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Tunjangan Komunikasi:</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input type="text" name="tunj_komunikasi" class="form-control col-md-7 col-xs-12 tunj_komunikasi" id="tunj_komunikasi" required="required" value="{{$gaji->tunj_komunikasi}}">
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Uang Makan:</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input type="text" name="uang_makan" class="form-control col-md-7 col-xs-12 uang_makan" id="uang_makan" required="required" value="{{$gaji->uang_makan}}">
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Uang Lembur:</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input type="text" name="uang_lembur" class="form-control col-md-7 col-xs-12 uang_lembur" id="uang_lembur" required="required" value="{{$gaji->uang_lembur}}">
												</div>
											</div>
											<div class="ln_solid"></div>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Lain - Lain</label>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Tunjangan Transportasi:</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input type="text" name="tunj_transportasi" class="form-control col-md-7 col-xs-12 tunj_transportasi" id="tunj_transportasi" required="required" value="{{$gaji->tunj_transportasi}}">
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
														}else{
															$pph21='';
														}
													?>
													<input type="text" name="tunj_pph21" class="form-control col-md-7 col-xs-12 tunj_pph21" id="tunj_pph21" value="{{$gaji->tunj_pph21}}">
												</div>
											</div>
											<div class="ln_solid"></div>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Total Pendapatan:</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input type="text" name="tot_pendapatan" class="form-control col-md-7 col-xs-12 tot_pendapatan" id="tot_pendapatan" readonly="readonly" value="{{$gaji->gaji_pokok + $gaji->tunj_komunikasi + $gaji->tunj_transportasi + $gaji->uang_makan + $gaji->tunj_pph21}}">
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
													<input type="text" name="pph21" class="form-control col-md-7 col-xs-12 pph21"  value="{{$gaji->pph21}}">
												</div>
											</div>
											<div class="ln_solid"></div>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Total Potongan:</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input type="text" name="tot_potongan" class="form-control col-md-7 col-xs-12 tot_potongan" id="tot_potongan" value="{{$gaji->pph21}}">
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
										@else
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Gaji Pokok:</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input type="text" name="gaji_pokok" class="form-control col-md-7 col-xs-12 gaji_pokok" id="gaji_pokok" required="required">
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Tunjangan Komunikasi:</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input type="text" name="tunj_komunikasi" class="form-control col-md-7 col-xs-12 tunj_komunikasi" id="tunj_komunikasi" required="required">
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Uang Makan:</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input type="text" name="uang_makan" class="form-control col-md-7 col-xs-12 uang_makan" id="uang_makan" required="required">
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Uang Lembur:</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input type="text" name="uang_lembur" class="form-control col-md-7 col-xs-12 uang_lembur" id="uang_lembur" required="required">
												</div>
											</div>
											<div class="ln_solid"></div>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Lain - Lain</label>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Tunjangan Transportasi:</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input type="text" name="tunj_transportasi" class="form-control col-md-7 col-xs-12 tunj_transportasi" id="tunj_transportasi" required="required">
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
														}else{
															$pph21='';
														}
													?>
													<input type="text" name="tunj_pph21" class="form-control col-md-7 col-xs-12 tunj_pph21" id="tunj_pph21" value="{{$pph21}}">
												</div>
											</div>
											<div class="ln_solid"></div>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Total Pendapatan:</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input type="text" name="tot_pendapatan" class="form-control col-md-7 col-xs-12 tot_pendapatan" id="tot_pendapatan" readonly="readonly">
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
													<input type="text" name="pph21" class="form-control col-md-7 col-xs-12 pph21" value="{{$pph21}}">
												</div>
											</div>
											<div class="ln_solid"></div>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Total Potongan:</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input type="text" name="tot_potongan" class="form-control col-md-7 col-xs-12 tot_potongan" id="tot_potongan"  value="{{$pph21}}">
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
										@endif
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

      $(document).on("change", ".gaji_pokok", function(e){
	     var pokok = $('.gaji_pokok').val();
	     if(!pokok){pokok = 0;}
	     var komunikasi = $('.tunj_komunikasi').val();
	     if(!komunikasi){komunikasi = 0;}
	     var makan = $('.uang_makan').val();
	     if(!makan){makan = 0;}
	     var lembur = $('.uang_lembur').val();
	     if(!lembur){lembur = 0;}
	     var transport = $('.tunj_transportasi').val();
	     if(!transport){transport = 0;}
	     var tot_pendapatan = parseInt(pokok) + parseInt(komunikasi) + parseInt(makan) + parseInt(lembur) + parseInt(transport);
	     var potongan = $('.tot_potongan').val();
	     var bersih = tot_pendapatan - potongan;
	     $('#tot_pendapatan').val(tot_pendapatan);
	     $('#pendapatan_bersih').val(bersih);
	  });

	  $(document).on("change", ".tunj_komunikasi", function(e){
	     var pokok = $('.gaji_pokok').val();
	     if(!pokok){pokok = 0;}
	     var komunikasi = $('.tunj_komunikasi').val();
	     if(!komunikasi){komunikasi = 0;}
	     var makan = $('.uang_makan').val();
	     if(!makan){makan = 0;}
	     var lembur = $('.uang_lembur').val();
	     if(!lembur){lembur = 0;}
	     var transport = $('.tunj_transportasi').val();
	     if(!transport){transport = 0;}
	     var tot_pendapatan = parseInt(pokok) + parseInt(komunikasi) + parseInt(makan) + parseInt(lembur) + parseInt(transport);
	     var potongan = $('.tot_potongan').val();
	     var bersih = tot_pendapatan - potongan;
	     $('#tot_pendapatan').val(tot_pendapatan);
	     $('#pendapatan_bersih').val(bersih);
	  });

	  $(document).on("change", ".uang_makan", function(e){
	     var pokok = $('.gaji_pokok').val();
	     if(!pokok){pokok = 0;}
	     var komunikasi = $('.tunj_komunikasi').val();
	     if(!komunikasi){komunikasi = 0;}
	     var makan = $('.uang_makan').val();
	     if(!makan){makan = 0;}
	     var lembur = $('.uang_lembur').val();
	     if(!lembur){lembur = 0;}
	     var transport = $('.tunj_transportasi').val();
	     if(!transport){transport = 0;}
	     var tot_pendapatan = parseInt(pokok) + parseInt(komunikasi) + parseInt(makan) + parseInt(lembur) + parseInt(transport);
	     var potongan = $('.tot_potongan').val();
	     var bersih = tot_pendapatan - potongan;
	     $('#tot_pendapatan').val(tot_pendapatan);
	     $('#pendapatan_bersih').val(bersih);
	  });

	  $(document).on("change", ".uang_lembur", function(e){
	     var pokok = $('.gaji_pokok').val();
	     if(!pokok){pokok = 0;}
	     var komunikasi = $('.tunj_komunikasi').val();
	     if(!komunikasi){komunikasi = 0;}
	     var makan = $('.uang_makan').val();
	     if(!makan){makan = 0;}
	     var lembur = $('.uang_lembur').val();
	     if(!lembur){lembur = 0;}
	     var transport = $('.tunj_transportasi').val();
	     if(!transport){transport = 0;}
	     var tot_pendapatan = parseInt(pokok) + parseInt(komunikasi) + parseInt(makan) + parseInt(lembur) + parseInt(transport);
	     var potongan = $('.tot_potongan').val();
	     var bersih = tot_pendapatan - potongan;
	     $('#tot_pendapatan').val(tot_pendapatan);
	     $('#pendapatan_bersih').val(bersih);
	  });

	  $(document).on("change", ".tunj_transportasi", function(e){
	     var pokok = $('.gaji_pokok').val();
	     if(!pokok){pokok = 0;}
	     var komunikasi = $('.tunj_komunikasi').val();
	     if(!komunikasi){komunikasi = 0;}
	     var makan = $('.uang_makan').val();
	     if(!makan){makan = 0;}
	     var lembur = $('.uang_lembur').val();
	     if(!lembur){lembur = 0;}
	     var transport = $('.tunj_transportasi').val();
	     if(!transport){transport = 0;}
	    var tot_pendapatan = parseInt(pokok) + parseInt(komunikasi) + parseInt(makan) + parseInt(lembur) + parseInt(transport);
	     var potongan = $('.tot_potongan').val();
	     var bersih = tot_pendapatan - potongan;
	     $('#tot_pendapatan').val(tot_pendapatan);
	     $('#pendapatan_bersih').val(bersih);
	  });

	  $(document).on("change", ".pph21", function(e){
	     var potongan = $('.pph21').val();
	    
	     $('#tot_potongan').val(potongan);
	  });
  	});

</script>
@endpush