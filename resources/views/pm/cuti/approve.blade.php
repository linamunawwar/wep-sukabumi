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
						<h2>Cuti Pegawai </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
							<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">NIP <span class="required">*</span>:</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<p style="padding: 6px 12px; font-size: 15px;">SA150795</p>
									</div>
								</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama Karyawan <span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<p style="padding: 6px 12px;">{{Auth::user()->name}}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Jabatan <span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<p style="padding: 6px 12px;">Staff Quality Control</p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Maksud Cuti izin:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<p style="padding: 6px 12px; font-size: 15px;">Acara Keluarga</p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Alat Angkutan yang digunakan:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<p style="padding: 6px 12px; font-size: 15px;">Pesawat</p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Penyerahan Tugas Kepada <span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<p style="padding: 6px 12px; font-size: 15px;">SL170793 - Garrett Winters</p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Keterangan tentang cuti / izin yang pernah dijalani <span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<p style="padding: 6px 12px; font-size: 15px;"> - </p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Catatan Tentang Cuti<span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<p  style="padding: 6px 12px;"> Tidak Berkeberatan</p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Persetujuan Cuti<span class="required">*</span>:</label>
								<div class="col-md-8 col-sm-8 col-xs-12">
									<p  style="padding: 6px 12px;"> Disetujui <input type="text" name="" style="width: 40px;"> hari kerja tidak termasuk hari libur, tanggal 
										<div class="control-group">
											<div class="controls">
												<div class="col-md-11 xdisplay_inputx form-group has-feedback">
													<input type="text" class="form-control has-feedback-left" id="single_cal1" name="tgl_lahir" aria-describedby="inputSuccess2Status" style="width: 200px;">
													<span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
										 			<span id="inputSuccess2Status" class="sr-only">(success)</span>
												</div>
											</div>
										</div>
									</p>
								</div>
							</div>
							
							<div class="ln_solid"></div>
							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
									<button class="btn btn-primary" type="button">Cancel</button>
									<button class="btn btn-primary" type="reset">Tolak</button>
									<button type="submit" class="btn btn-success">Approve</button>
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