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
							<a href="{{url('user/pegawai/edit_cv/'.Auth::user()->pegawai_id)}}" class="btn btn-primary"><i class="fa fa-edit"></i>  Edit CV</a>
						</div>
						<div class="pull-right">
							<a href="{{url('admin/pegawai/unduh_cv/'.Auth::user()->pegawai->id.'')}}" class="btn btn-success"><i class="fa fa-download"></i>    Download CV</a>
							<a href="{{url('admin/pegawai/unduh_mcu/'.Auth::user()->pegawai->id.'')}}" class="btn btn-success"><i class="fa fa-download"></i>    Download MCU</a>
							<a href="{{url('admin/pegawai/unduh_pkwt/'.Auth::user()->pegawai->id.'')}}" class="btn btn-success"><i class="fa fa-download"></i>    Download PKWT</a>
						</div>
						<div class="clearfix"></div>
					</div>
					@if(Auth::user()->pegawai->is_verif_admin == '-1')
						<div class="x_content">
							<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
								<div class="x_title">
									<h4>Data Pribadi </h4>
									<div class="alert alert-danger alert-dismissible fade in" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
										</button>
										<strong>Akun Direject oleh Admin!</strong> Harap Segera Lengkapi CV Anda. Silahkan Tekan Tombol Edit CV
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
										@if(Auth::user()->pegawai->gender == 'P')
											<p class="data">Pria</p>
										@elseif(Auth::user()->pegawai->gender == 'W')
											<p class="data">Wanita</p>
										@endif

									</div>
								</div>
								<div class="form-group">
									<label for="tgl_lahir" class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Lahir *</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<p class="data">{{konversi_tanggal(Auth::user()->pegawai->tanggal_lahir)}}</p>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nip">NIP <span class="required">*</span>:</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<p class="data">{{Auth::user()->pegawai_id}}</p>
									</div>
								</div>
								<div class="ln_solid"></div>
							</form>
						</div>
					@elseif(Auth::user()->pegawai->is_new == 1)
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
										@if(Auth::user()->pegawai->gender == 'P')
											<p class="data">Pria</p>
										@elseif(Auth::user()->pegawai->gender == 'W')
											<p class="data">Wanita</p>
										@endif

									</div>
								</div>
								<div class="form-group">
									<label for="tgl_lahir" class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Lahir *</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<p class="data">{{konversi_tanggal(Auth::user()->pegawai->tanggal_lahir)}}</p>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nip">NIP <span class="required">*</span>:</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<p class="data">{{Auth::user()->pegawai_id}}</p>
									</div>
								</div>
								<div class="ln_solid"></div>
							</form>
						</div>
					@elseif(Auth::user()->pegawai->is_new == 0 && Auth::user()->pegawai->is_active == 0 )
						<div class="x_content">
							<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
								<div class="x_title">
									<h4>Data Pribadi </h4>
									<div class="alert alert-danger alert-dismissible fade in" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
										</button>
										<strong>Akun Belum Diverifikasi!</strong> Harap Tunggu Sampai Akun anda diaktifkan oleh admin.
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
										@if(Auth::user()->pegawai->gender == 'P')
											<p class="data">Pria</p>
										@elseif(Auth::user()->pegawai->gender == 'W')
											<p class="data">Wanita</p>
										@endif

									</div>
								</div>
								<div class="form-group">
									<label for="tgl_lahir" class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Lahir *</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<p class="data">{{konversi_tanggal(Auth::user()->pegawai->tanggal_lahir)}}</p>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nip">NIP <span class="required">*</span>:</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<p class="data">{{Auth::user()->pegawai_id}}</p>
									</div>
								</div>
								<div class="ln_solid"></div>
							</form>
						</div>
					@elseif((Auth::user()->pegawai->is_new == 1 && Auth::user()->pegawai->is_active == 1 ) || (Auth::user()->pegawai->is_new == 0 && Auth::user()->pegawai->is_active == 1 ))
						<div class="x_content">
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
												<p class="data">{{$pegawai->gelar_depan}}</p>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12">Gender</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												@if($pegawai->Gender == 'P')
													<p class="data">Pria</p>
												@else
													<p class="data">Wanita</p>
												@endif
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="gelar_blkg" class="control-label col-md-4 col-sm-4 col-xs-12">Gelar Belakang</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">{{$pegawai->gelar_belakang}}</p>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="agama">Agama <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">{{$pegawai->agama}}</p>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="tempat_lahir" class="control-label col-md-4 col-sm-4 col-xs-12">Tempat Lahir</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">{{$pegawai->tempat_lahir}}</p>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="status_kawin">Status Perkawinan <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">{{$pegawai->status_kawin}}</p>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="tgl_lahir" class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Lahir *</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">{{konversi_tanggal($pegawai->tanggal_lahir)}}</p>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="suami_istri" class="control-label col-md-4 col-sm-4 col-xs-12">Nama Suami / Istri</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">{{$pegawai->suami_istri}}</p>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nip">NIP <span class="required">*</span>:</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">{{$pegawai->nip}}</p>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama_anak">Nama Anak <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">{{$pegawai->anak}}</p>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="alamat_tetap" class="control-label col-md-4 col-sm-4 col-xs-12">Alamat Rumah Tetap</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">{{$pegawai->alamat_tetap}}</p>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="no_telp">No. Telepon <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">{{$pegawai->telp}}</p>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="alamat_sementara" class="control-label col-md-4 col-sm-4 col-xs-12">Alamat Rumah Sementara</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">{{$pegawai->aamat_sementara}}</p>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="no_hp">No. HP <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">{{$pegawai->hp}}</p>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="email_pribadi">Alamat Email Pribadi <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">{{$pegawai->email}}</p>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="no_fax">No. Faximile <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">{{$pegawai->fax}}</p>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="email_kantor">Alamat Email Kantor <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">{{$pegawai->alamat_kantor}}</p>
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
												<p class="data">{{$bank->nama_bank}}</p>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="no_rek">No. Rekening <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">{{$bank->no_rekening}}</p>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="npwp" class="control-label col-md-4 col-sm-4 col-xs-12">No. NPWP</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">{{$bank->npwp}}</p>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="jamsostek" class="control-label col-md-4 col-sm-4 col-xs-12">No. Jamsostek</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">{{$bank->jamsostek}}</p>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="dplk" class="control-label col-md-4 col-sm-4 col-xs-12">No. DPLK</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">{{$bank->dplk}}</p>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="jiwasraya" class="control-label col-md-4 col-sm-4 col-xs-12">No. Jiwasraya</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<p class="data">{{$bank->jiwasraya}}</p>
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
								<div class="ln_solid"></div>
							</form>
						</div>
						
					@endif
				</div>
			</div>
		</div>
    </div>
    <!-- /page content -->
@endsection