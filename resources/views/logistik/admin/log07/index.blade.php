@extends('logistik.layouts.blank')

@push('stylesheets')
    <!-- Example -->
	<!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush
<style>
	#datatable thead tr th {
		text-align: center;
		vertical-align: middle;
		font-family: "Helvetica Neue",Roboto,Arial,"Droid Sans",sans-serif;
		font-size: 13px;
		font-weight: 400;
	}

	#datatable tbody tr td {
		text-align: center;
		vertical-align: middle;
		font-family: "Helvetica Neue",Roboto,Arial,"Droid Sans",sans-serif;
		font-size: 13px;
		font-weight: 400;
	}
</style>

@section('main_container')

    <!-- page content -->
    <div class="right_col" role="main">
    	<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Buku Harian Pengeluaran Bahan (Log-07) </h2>
						<ul class="nav navbar-right panel_toolbox">
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"method="POST">
							<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="tgl_lahir" class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Mulai :</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class='input-group date' id='datepicker1' class="datepicker">
												<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
								                <input type='text' value='' name='tanggal_mulai' class='form-control' required="required" placeholder="dd-mm-yyyy" />
								            </div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="tgl_lahir" class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Selesai :</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class='input-group date' id='datepicker2' class="datepicker">
												<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
								                <input type='text' value='' name='tanggal_selesai' class='form-control' required="required" placeholder="dd-mm-yyyy" />
								            </div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Lokasi <span class="required">*</span>:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<select class="form-control col-md-7 col-xs-12 lokasi" id="lokasi" name="lokasi" required="required">
												<option value="">Pilih Lokasi</option>
												@foreach($lokasis as $lokasi)
													<option value="{{$lokasi->id}}">{{$lokasi->nama}}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Jenis Pekerjaan <span class="required">*</span>:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<select class="form-control col-md-7 col-xs-12 jenis" id="jenis" name="jenis" required="required">
												<option value="">Pilih Jenis Pekerjaan</option>
												@foreach($jeniss as $jenis)
													<option value="{{$jenis->id}}">{{$jenis->nama}}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Volume Pekerjaan <span class="required">*</span>:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" class="form-control col-md-7 col-xs-12 volume" id="volume" name="volume">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">SOM/ Superintendent Pekerjaan <span class="required">*</span>:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" class="form-control col-md-7 col-xs-12 som" id="som" name="som">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Nomor Pekerjaan <span class="required">*</span>:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" class="form-control col-md-7 col-xs-12 nomor_pekerjaan" id="nomor_pekerjaan" name="nomor_pekerjaan">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">No. Buku <span class="required">*</span>:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" class="form-control col-md-7 col-xs-12 no_buku" id="no_buku" name="no_buku">
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4 pull-right">
									<button type="submit" class="btn btn-success pull-right" style="margin-right: 80px;">Proses</button>
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
  	$('#datepicker1').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
	});

	$('#datepicker2').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
	});
	$('#lokasi').select2();
	$('#jenis').select2();
  </script>
 @endpush