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
							<a href="" class="btn btn-success"><i class="fa fa-download"></i>    Download CV</a>
							<a href="" class="btn btn-success"><i class="fa fa-download"></i>    Download MCU</a>
						</div>
						<div class="clearfix"></div>
					</div>
					@if(Auth::user()->pegawai->is_new == 1)
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
					@elseif(Auth::user()->pegawai->is_new == 1 && Auth::user()->pegawai->is_active == 1 )
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
						
					@endif
				</div>
			</div>
		</div>
    </div>
    <!-- /page content -->
@endsection