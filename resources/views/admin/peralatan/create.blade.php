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
						<h2>Peminjaman Inventaris Proyek </h2>
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
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Tipe Barang <span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select class="form-control kode_barang" name="kode_barang" required="required">
										<option value="">Pilih barang</option>
										@foreach($alats as $alat)
											<option value="{{$alat->kode_barang}}">{{$alat->nama_barang}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="tanggal" class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Pinjam*:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class='input-group date' id='datepicker' class="datepicker">
										<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
						                <input type='text' value='' name='tanggal_pinjam' class='form-control' required="required" />
						            </div>
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
	$(document).ready(function(){
		$('.pegawai').select2();
		$('.kode_barang').select2();
		
      $('#datepicker').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
    	});
  	});

</script>
@endpush