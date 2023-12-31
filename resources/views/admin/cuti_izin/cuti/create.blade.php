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
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama Karyawan <span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select class="form-control pegawai" name="nip" required="required">
										<option value="">Pilih Karyawan</option>
										@foreach($pegawais as $pegawai)
											<option value="{{$pegawai->nip}}">{{strtoupper($pegawai->nip)}} - {{$pegawai->nama}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="tgl_lahir" class="control-label col-md-3 col-sm-3 col-xs-12">Cuti Terkahir * :</label>
								<div class="col-md-3 col-sm-3 col-xs-12">
									<div class='input-group date' id='datepicker' class="datepicker">
										<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
						                <input type='text' value='' name='tanggal_mulai_terakhir' class='form-control' required="required" placeholder="dd-mm-yyyy" />
						            </div>
						            *tanggal mulai cuti terakhir
								</div>
							</div>
							<br>
							<div class="form-group">
								<label for="tgl_lahir" class="control-label col-md-3 col-sm-3 col-xs-12">Mulai Cuti * :</label>
								<div class="col-md-3 col-sm-3 col-xs-12">
									<div class='input-group date' id='datepicker1' class="datepicker">
										<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
						                <input type='text' name='tanggal_mulai' class='form-control tanggal_mulai' id="tanggal_mulai" required="required" placeholder="Mulai Cuti (dd-mm-yyyy)" />
						            </div>
								</div>
							</div>
							<div class="form-group">
								<label for="tgl_lahir" class="control-label col-md-3 col-sm-3 col-xs-12">Selesai Cuti * :</label>
								<div class="col-md-3 col-sm-3 col-xs-12">
									<div class='input-group date' id='datepicker2' class="datepicker">
										<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
						                <input type='text'  name='tanggal_selesai' class='form-control tanggal_selesai' id="tanggal_selesai" required="required" placeholder="Selesai Cuti (dd-mm-yyyy)" readonly="readonly" />
						            </div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Maksud Cuti izin:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<textarea name="alasan" class="form-control col-md-7 col-xs-12"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Tujuan / Alamat Selama Cuti:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<textarea name="alamat_cuti" class="form-control col-md-7 col-xs-12"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Alat Angkutan yang digunakan:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="angkutan" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Penyerahan Tugas Kepada <span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select class="form-control pegawai pengganti" name="pengganti" required="required" id="pengganti">
										<option value="">Pilih Karyawan</option>
										@foreach($penggantis as $pengganti)
											<option value="{{$pengganti->nip}}">{{strtoupper($pengganti->nip)}} - {{$pengganti->nama}}</option>
										@endforeach
									</select>
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

			$('#datepicker1').datepicker({
		        format: 'dd-mm-yyyy',
		        autoclose: true
	    	});	    	

	    	$('#datepicker2').datepicker({
		        format: 'dd-mm-yyyy',
		        autoclose: true
	    	});

	    	$(document).on("keyup", "#datepicker", function(e){
		      var tgl = this.value;
		      var nip = $('#nip').val();
		     
		    });

		    $(document).on("change", "#datepicker", function(e){
		      	var mulai = $('#tanggal_mulai').val().split('-');
		      	mulai = new Date(mulai[2], mulai[1]-1, mulai[0]);
		      	
		      	var selesai = new Date(mulai.getTime()+(5*24*60*60*1000));
		      	
		      	var day = selesai.getDate();

				var month = selesai.getMonth();

			 	var year = selesai.getFullYear();
			 	day = day.toString();
			 	month = month.toString();
			 	year = year.toString();

			  	if (month.length < 2) month = '0' + month;
     			if (day.length < 2) day = '0' + day;
			  	selesai = day+"-"+month+"-"+year;
		      	
		      	$('#tanggal_selesai').val(selesai);
		    });
		});
	</script>
@endpush