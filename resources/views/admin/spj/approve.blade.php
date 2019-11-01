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
							<input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token">
							<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">NIP <span class="required">*</span>:</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<p style="padding: 6px 12px; font-size: 15px;">{{$spj->nip}}</p>
									</div>
								</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama Karyawan <span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<p style="padding: 6px 12px;">{{$spj->pegawai->nama}}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">No. SPPD <span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type='text' value='{{$spj->no_sppd}}' name='no_sppd' class='form-control' required="required" placeholder=""/>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Pemberi Tugas <span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select class="form-control pegawai" name="pemberi_tugas" required="required">
										<option value="">Pilih Pemberi Tugas</option>
										@foreach($pegawais as $pegawai)
											<?php $selected = ($spj->pemberi_tugas == $pegawai->nip)? 'selected': ''; ?>
											<option value="{{$pegawai->nip}}" {{$selected}}>{{strtoupper($pegawai->nip)}} - {{$pegawai->nama}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Keperluan *:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="keperluan" class="form-control col-md-7 col-xs-12" value="{{$spj->keperluan}}">
								</div>
							</div>
							<div class="form-group">
								<label for="tanggal" class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Berangkat *:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class='input-group date' id='datepicker' class="datepicker">
										<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
						                <input type='text' value='{{konversi_tanggal($spj->tanggal_berangkat)}}' name='tanggal_berangkat' class='form-control' required="required" placeholder="" id="tanggal_berangkat" />
						            </div>
								</div>
							</div>
							<div class="form-group">
								<label for="tanggal" class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Pulang *:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class='input-group date' id='datepicker2' class="datepicker">
										<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
						                <input type='text' value='{{konversi_tanggal($spj->tanggal_pulang)}}' name='tanggal_pulang' class='form-control' required="required" id="tanggal_pulang" />
						            </div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Alat Angkutan yang digunakan *:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="row">
										<div class="col-md-4">
											<?php $checked = ($spj->angkutan == 'pesawat')? 'checked': ''; ?>
											<input type="radio" id="angkutan" class="angkutan" name="angkutan" value="pesawat" {{$checked}} > Pesawat Terbang
										</div>
										<div class="col-md-6">
											<?php $checked = ($spj->angkutan == 'kereta')? 'checked': ''; ?>
											<input type="radio" id="angkutan" class="angkutan" name="angkutan" value="kereta" {{$checked}}> Kereta Api / Bus / Travel
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<?php $checked = ($spj->angkutan == 'dinas')? 'checked': ''; ?>
											<input type="radio" id="angkutan" class="angkutan" name="angkutan" value="dinas" {{$checked}}> Kendaraan Dinas
										</div>
										<div class="col-md-6">
											<?php $checked = ($spj->angkutan == 'pribadi')? 'checked': ''; ?>
											<input type="radio" id="angkutan" class="angkutan" name="angkutan" value="pribadi" {{$checked}}> Kendaraan Pribadi
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Uang Transport *:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="uang_transport" class="form-control col-md-7 col-xs-12 uang_transport" value="{{$spj->uang_transport}}">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Uang Konsumsi *:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="uang_konsumsi" class="form-control col-md-7 col-xs-12 uang_konsumsi"  value="{{$spj->uang_konsumsi}}">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Akomodasi *:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="uang_akomodasi" class="form-control col-md-7 col-xs-12 uang_akomodasi"  value="{{$spj->uang_akomodasi}}">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Surat Perintah *:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<a href="" class="col-md-7 col-xs-12">
										preview
									</a>
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
			  var tanggal_berangkat = $('#tanggal_berangkat').val();
			  var tanggal_pulang = $('#tanggal_pulang').val();
			  var _token = $('#_token').val();
			  console.log(angkutan);
			  $.ajax({
	                type: 'post',
	                url : '{{ url('user/spj/hitung') }}',
	                data: {
	                    'angkutan' : angkutan,
	                    'tanggal_berangkat' : tanggal_berangkat,
	                    'tanggal_pulang' : tanggal_pulang,
	                    '_token': _token
	                },
	                success: function(response){
	                    console.log(response);
	                    $('.nominal').val(response);
	                }
	            });
			  
			});
		});
	</script>
@endpush