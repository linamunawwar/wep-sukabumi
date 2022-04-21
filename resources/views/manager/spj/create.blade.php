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
						<h2>Pengajuan SPJ </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">NIP <span class="required">*</span>:</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<p style="padding: 6px 12px; font-size: 15px;">{{Auth::user()->pegawai_id}}</p>
									</div>
								</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama Karyawan <span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<p style="padding: 6px 12px;">{{Auth::user()->name}}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">No. SPPD <span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type='text' value='' name='no_sppd' class='form-control' required="required" placeholder="" />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Pemberi Tugas <span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select name='pemberi_tugas' class='form-control' required="required">
										<option>Pilih Pemberi Tugas</option>
										@foreach($pemberi_tugas as $user)
											<option value="{{$user->nip}}">{{$user->nama}} ({{$user->nip}})</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Kota / Tujuan <span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type='text' name='tujuan' class='form-control' required="required" placeholder="" />
								</div>
							</div>
							<div class="form-group">
								<label for="tanggal" class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Berangkat *:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class='input-group date' id='datepicker' class="datepicker">
										<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
						                <input type='text' value='' name='tanggal_berangkat' class='form-control' required="required" placeholder="" />
						            </div>
								</div>
							</div>
							<div class="form-group">
								<label for="tanggal" class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Pulang *:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class='input-group date' id='datepicker2' class="datepicker">
										<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
						                <input type='text' value='' name='tanggal_pulang' class='form-control' required="required" />
						            </div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Alat Angkutan yang digunakan *:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="row">
										<div class="col-md-4">
											<input type="radio" id="angkutan" class="angkutan" name="angkutan" value="pesawat" > Pesawat Terbang
										</div>
										<div class="col-md-6">
											<input type="radio" id="angkutan" class="angkutan" name="angkutan" value="kereta"> Kereta Api / Bus / Travel
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<input type="radio" id="angkutan" class="angkutan" name="angkutan" value="dinas"> Kendaraan Dinas
										</div>
										<div class="col-md-6">
											<input type="radio" id="angkutan" class="angkutan" name="angkutan" value="pribadi"> Kendaraan Pribadi
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Keperluan *:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="keperluan" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Upload Surat Perintah *:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="file" name="lampiran" class="form-control col-md-7 col-xs-12" required="required">
									mohon mengupload bukti perintah
								</div>
							</div>
							
							<div class="ln_solid"></div>
							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
									<button class="btn btn-primary" type="button">Cancel</button>
									<button class="btn btn-primary" type="reset">Reset</button>
									<button type="submit" class="btn btn-success">Submit</button>
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
@push('scripts')
	<script type="text/javascript">
		$(document).ready(function() {
		    $('.pegawai').select2();

		    $('#datepicker').datepicker({
		        format: 'dd-mm-yyyy',
		        autoclose: true
	    	});

	    	$('#datepicker2').datepicker({
		        format: 'dd-mm-yyyy',
		        autoclose: true
	    	});

	    	$('input[type=radio][name=angkutan]').on('change', function() {
			  var angkutan = $(this).val();
			  console.log(angkutan);
			  // switch ($(this).val()) {
				 //    case 'pesawat':
				 //      $('.nominal').val(1000000);
				 //      break;
				 //    case 'kereta':
				 //      $('.nominal').val(500000);
				 //      break;
				 //    case 'dinas':
				 //      $('.nominal').val(100000);
				 //      break;
				 //    case 'pribadi':
				 //      $('.nominal').val(100000);
				 //      break;
				 //  }
			});
		});
	</script>
@endpush