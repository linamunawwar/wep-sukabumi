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
						<h2>Pegawai Resign </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama Karyawan <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="hidden" name="nip" value="{{$resign->nip}}">
									<input type="text" name="nama" readonly="readonly" value="{{$resign->pegawai->nama}}" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Alasan</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<textarea name="alasan" class="form-control" rows="5" readonly="readonly">{{$resign->alasan}}</textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="tgl_lahir" class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Terakhir Kerja * :</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class='input-group date' id='datepicker' class="datepicker">
										<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
						                <input type='text' name='terakhir_kerja' class='form-control' required="required" placeholder="Terakhir Kerja" readonly="readonly" value="{{konversi_tanggal($resign->terakhir_kerja)}}" />
						            </div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Surat Pengunduran Diri: </label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									@if($resign->file_surat)
										<iframe src ="http://docs.google.com/viewer?url={{url('/')}}/upload/resign/{{$resign->nip}}/{{$resign->file_surat}}&embedded=true" width='724' height='1024'	 allowfullscreen webkitallowfullscreen>
									@endif
								</div>
							</div>
							
							<div class="ln_solid"></div>
							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
									<button class="btn btn-primary" type="button">Back</button>
									<button type="submit" class="btn btn-success">Verifikasi</button>
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
		});
	</script>
@endpush