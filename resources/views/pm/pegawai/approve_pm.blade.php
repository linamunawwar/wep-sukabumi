
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
	                                              <small>Data Pegawai</small>
	                                          </span>
	                          </a>
	                        </li>
	                        <li>
	                          <a href="#step-2">
	                            <span class="step_no">2</span>
	                            <span class="step_descr">
	                                              Langkah 2<br />
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
	                      	</div>
		                      <div id="step-2">
		                        <h2 class="StepTitle">Data Gaji</h2>
		                        <div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Gaji Pokok:</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" name="gaji_pokok" class="form-control col-md-7 col-xs-12 gaji_pokok" id="gaji_pokok" readonly="readonly" value="{{$gaji->gaji_pokok}}">
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Tunjangan Komunikasi:</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" name="tunj_komunikasi" class="form-control col-md-7 col-xs-12 tunj_komunikasi" id="tunj_komunikasi" readonly="readonly" value="{{$gaji->tunj_komunikasi}}">
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Uang Makan:</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" name="uang_makan" class="form-control col-md-7 col-xs-12" readonly="readonly" value="{{$gaji->uang_makan}}">
											</div>
										</div>
										<div class="ln_solid"></div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Lain - Lain</label>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Tunjangan Transportasi:</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" name="tunj_transportasi" class="form-control col-md-7 col-xs-12 tunj_transportasi" id="tunj_transportasi" readonly="readonly" value="{{$gaji->tunj_transportasi}}">
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
												<input type="text" name="tot_pendapatan" class="form-control col-md-7 col-xs-12" readonly="readonly" value="{{$gaji->gaji_pokok + $gaji->tunj_komunikasi + $gaji->uang_makan + $gaji->tunj_transportasi}}">
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
												<input type="text" name="tot_potongan" class="form-control col-md-7 col-xs-12 tot_potongan" id="tot_potongan" readonly="readonly" value="{{$pph21}}">
											</div>
										</div>

										
										<div class="ln_solid"></div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Pendapatan Bersih:</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" name="pendapatan_bersih" class="form-control col-md-7 col-xs-12 pendapatan_bersih" id="pendapatan_bersih" readonly="readonly" value="{{$gaji->gaji_pokok + $gaji->tunj_komunikasi + $gaji->uang_makan + $gaji->tunj_transportasi - $pph21}}">
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