@extends('layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

@section('main_container')

<?php
	if(($gaji->gaji_pokok == null) || ($gaji->gaji_pokok == '')){
		$gaji->gaji_pokok = 0;
	}
	if(($gaji->tunj_komunikasi == null) || ($gaji->tunj_komunikasi == '')){
		$gaji->tunj_komunikasi = 0;
	}
	if(($gaji->tunj_transportasi == null) || ($gaji->tunj_transportasi == '')){
		$gaji->tunj_transportasi = 0;
	}
	if(($gaji->uang_makan == null) || ($gaji->uang_makan == '')){
		$gaji->uang_makan = 0;
	}
	if(($gaji->tunj_pph21 == null) || ($gaji->tunj_pph21 == '')){
		$gaji->tunj_pph21 = 0;
	}
?>

    <!-- page content -->
    <div class="right_col" role="main">
    	<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Data Gaji </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="x_title">
							<h4>Pendapatan </h4>
							<div class="clearfix"></div>
						</div>
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama Karyawan <span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<p style="padding: 6px 12px; font-size: 15px;">{{$gaji->nip}} - {{$gaji->pegawai->nama}}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Gaji Pokok:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="gaji_pokok" class="form-control col-md-7 col-xs-12 gaji_pokok" id="gaji_pokok" value="{{$gaji->gaji_pokok}}">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Tunjangan Komunikasi:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="tunj_komunikasi" class="form-control col-md-7 col-xs-12 tunj_komunikasi" id="tunj_komunikasi" value="{{$gaji->tunj_komunikasi}}">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Uang Makan:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="uang_makan" class="form-control col-md-7 col-xs-12 uang_makan" id="uang_makan" value="{{$gaji->uang_makan}}">
								</div>
							</div>
							<div class="ln_solid"></div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Lain - Lain</label>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Tunjangan Transportasi:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="tunj_transportasi" class="form-control col-md-7 col-xs-12 tunj_transportasi" id="tunj_transportasi" value="{{$gaji->tunj_transportasi}}">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Tunjangan PPh 21:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<?php
										if($gaji->pegawai->status_kawin == 'TK'){
											$pph21 = 500000;
										}elseif ($gaji->pegawai->status_kawin == 'K0') {
											$pph21 = 1000000;
										}elseif ($gaji->pegawai->status_kawin == 'K1') {
											$pph21 = 1500000;
										}elseif ($gaji->pegawai->status_kawin == 'K2') {
											$pph21 = 2000000;
										}elseif ($gaji->pegawai->status_kawin == 'K3') {
											$pph21 = 2500000;
										}else{
											$pph21 = 0;
										}
									?>
									<input type="text" name="tunj_pph21" class="form-control col-md-7 col-xs-12 tunj_pph21" id="tunj_pph21" readonly="readonly" value="{{$pph21}}">
								</div>
							</div>
							<div class="ln_solid"></div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Total Pendapatan:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="tot_pendapatan" class="form-control col-md-7 col-xs-12 tot_pendapatan" id="tot_pendapatan" readonly="readonly" value="{{$gaji->gaji_pokok + $gaji->tunj_komunikasi + $gaji->tunj_transportasi + $gaji->uang_makan + $gaji->tunj_pph21}}">
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
									<p style="padding: 8px 12px;">{{$gaji->pegawai->status_kawin}}</p>
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
									<input type="text" name="pendatan_bersih" class="form-control col-md-7 col-xs-12 pendatan_bersih" id="pendatan_bersih" readonly="readonly">
								</div>
							</div>
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
		var pendapatan = $('#tot_pendapatan').val();
		var potongan = $('#tot_potongan').val();
		$('#pendatan_bersih').val(pendapatan - potongan);

		$(document).on("change", ".gaji_pokok", function(e){
		    var gaji_pokok = $(this).val();
		    var tunj_komunikasi = $('.tunj_komunikasi').val();
		    var uang_makan = $('.uang_makan').val();
		    var tunj_transportasi = $('.tunj_transportasi').val();
		    var tunj_pph21 = $('.tunj_pph21').val();

		    var pendapatan = parseInt(gaji_pokok) + parseInt(tunj_komunikasi) + parseInt(uang_makan) + parseInt(tunj_transportasi) + parseInt(tunj_pph21);
		    $('#tot_pendapatan').val(parseInt(pendapatan));  

		    var potongan = $('#tot_potongan').val();
			$('#pendatan_bersih').val(pendapatan - potongan); 
		});

		$(document).on("change", ".tunj_komunikasi", function(e){
		    var gaji_pokok = $('.gaji_pokok').val();
		    var tunj_komunikasi = $(this).val();
		    var uang_makan = $('.uang_makan').val();
		    var tunj_transportasi = $('.tunj_transportasi').val();
		    var tunj_pph21 = $('.tunj_pph21').val();

		    var pendapatan = parseInt(gaji_pokok) + parseInt(tunj_komunikasi) + parseInt(uang_makan) + parseInt(tunj_transportasi) + parseInt(tunj_pph21);
		    $('#tot_pendapatan').val(parseInt(pendapatan));  

		    var potongan = $('#tot_potongan').val();
			$('#pendatan_bersih').val(pendapatan - potongan); 
		});

		$(document).on("change", ".uang_makan", function(e){
		    var gaji_pokok = $('.gaji_pokok').val();
		    var tunj_komunikasi = $('.tunj_komunikasi').val();
		    var uang_makan = $(this).val();
		    var tunj_transportasi = $('.tunj_transportasi').val();
		    var tunj_pph21 = $('.tunj_pph21').val();

		    var pendapatan = parseInt(gaji_pokok) + parseInt(tunj_komunikasi) + parseInt(uang_makan) + parseInt(tunj_transportasi) + parseInt(tunj_pph21);
		    $('#tot_pendapatan').val(parseInt(pendapatan));  

		    var potongan = $('#tot_potongan').val();
			$('#pendatan_bersih').val(pendapatan - potongan); 
		});

		$(document).on("change", ".tunj_transportasi", function(e){
		    var gaji_pokok = $('.gaji_pokok').val();
		    var tunj_komunikasi = $('.tunj_komunikasi').val();
		    var uang_makan = $('.uang_makan').val();
		    var tunj_transportasi = $(this).val();
		    var tunj_pph21 = $('.tunj_pph21').val();

		    var pendapatan = parseInt(gaji_pokok) + parseInt(tunj_komunikasi) + parseInt(uang_makan) + parseInt(tunj_transportasi) + parseInt(tunj_pph21);
		    $('#tot_pendapatan').val(parseInt(pendapatan)); 

		    var potongan = $('#tot_potongan').val();
			$('#pendatan_bersih').val(pendapatan - potongan);  
		});

		
	});
</script>
@endpush