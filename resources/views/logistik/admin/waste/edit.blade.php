@extends('logistik.layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
    <style type="text/css">
    	.width-60 {
    		width: 60px;
    		padding:0 !important;
    	}
    	th{
    		vertical-align: middle !important;
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
						<h2>Waste Material </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"method="POST">
							<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label style="display: inline-block;" for="nama">Jenis Pekerjaan : {{$waste->wasteJenisKErja->nama}}</label>
										<p style="display: inline-block;" id="jenis_kerja"></p>
										<input type="hidden" name="jenis_kerja_id" id="jenis_kerja_id" value="{{$waste->jenis_kerja_id}}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label style="display: inline-block;" for="nama">Lokasi : {{$waste->wasteLokasi->nama}}</label>
										<p style="display: inline-block;" id="lokasi_kerja"></p>
										<input type="hidden" name="lokasi_id" id="lokasi_id" value="{{$waste->lokasi_id}}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label style="display: inline-block;" for="nama">Periode : {{periode($waste->tahun.$waste->bulan)}}</label>
										<p style="display: inline-block;" id="periode"></p>
										<input type="hidden" name="bulan" id="bulan" value="{{$waste->bulan}}">
										<input type="hidden" name="tahun" id="tahun" value="{{$waste->tahun}}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group" style="display: none;">
										<label style="display: inline-block;" for="nama">Volume Pekerjaan :</label>
										<input type="text" style="padding: 5px;" name="volume_pekerjaan" id="volume_pekerjaan" placeholder="..................................................">
									</div>
								</div>
							</div>
							<input type="hidden" name="jumlah_data" class="jumlah_data" id="jumlah_data" value="0">
							<table class="table table-bordered waste" id="table_waste">
								<tr>
									<th rowspan="2">No.</th>
									<th rowspan="2" style="text-align: center;">Jenis Material</th>
									<th rowspan="2">Sat</th>
									<th rowspan="2">Vol (APP)</th>
									<th rowspan="2">Progres (%)</th>
									<th rowspan="2" style="width: 20px;">Volume APP Sesuai Progres</th>
									<th rowspan="2">Pemakaian Material di Lapangan</th>
									<th rowspan="2">Deviasi Volume</th>
									<th colspan="3" style="text-align: center;">Waste (%)</th>
								</tr>
								<tr>
									<th>Deviasi terhadap rencana</th>
									<th>Rencana waste di APP (dalam %)</th>
									<th>Realisasi</th>
								</tr>
								<tbody class="data">
									@php $jml_data = 1; @endphp
									@foreach($datas as $key => $data)
										<tr  class='data_{{jumlah_data}}'>
	                						<td>{{$jml_data}}</td>
	                						<td style='width:250px;'>{{$data->material_id}}
	                							<input type='hidden' name='material[]' value="{{$data->material_id}}" id="material_{{$jml_data}}" jml_data="{{$jml_data}}">";
	                						</td>
	                						<td>{{$data->satuan}}
	                							<input type='hidden' name='satuan[]' value="{{$data->satuan}}" id="satuan_{{$jumlah_data}}" jml_data="{{$jml_data}}">
	                						</td>
	                						<td>
	                							<input type='text' name='vol_app[]' value="{{$data->vol_app}}" id="vol_app_{{$jml_data}}" class='vol_app width-60' jml_data="{{$jml_data}}">
	                						</td>
	                						<td>
	                							<input type='text' name='progress_persen[]' value="{{$data->progress_persen}}" id="progress_persen_{{$jml_data}}" class='progress_persen width-60' jjml_data="{{$jml_data}}">";
	                						</td>
	                						<td>
	                							<input type='text' name='vol_progress[]' value="{{$data->vol_progress}}" id="vol_progress_{{$jml_data}}" class='width-60' jml_data="{{$jml_data}}" disabled>";
	                						</td>
	                						<td>
	                							<input type='text' name='pemakaian[]' value="{{$data->pemakaian}}" id='pemakaian_"+jumlah_data+"' class='width-60' jml_data="{{$jml_data}}" disabled>";
	                						</td>
	                						<td>
	                							<input type='text' name='deviasi_vol[]' value="{{$data->deviasi_vol}}" id="deviasi_vol_{{$jml_data}}" class='width-60' jml_data="{{$jml_data}}" disabled>";
	                						</td>
	                						<td>
	                							<input type='text' name='deviasi[]' value="{{$data->deviasi}}" id="deviasi_{{$jml_data}}" class='width-60' jml_data="{{$jml_data}}" disabled>
	                						</td>
	                						<td>
	                							<input type='text' name='rencana_waste[]' value="{{$data->rencana_waste}}" id="rencana_waste_{{$jml_data}}" class='rencana_waste width-60' jml_data="{{$jml_data}}">
	                						</td>
	                						<td>
	                							<input type='text' name='realisasi[]' value="{{$data->realisasi}}" id="realisasi_{{$jumlah_data}}" class='width-60' jml_data="{{$jumlah_data}}"disabled>
	                						</td>
	                						@php $jml_data++; @endphp
									@endforeach
									
								</tbody>
							</table>
							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
									<a class="btn btn-primary" href="{{url('/Logistik/admin/waste')}}">Cancel</a>
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

	$(document).on("change", ".vol_app", function(e){
        var vol_app = $(this).val();
        var jml_data = $(this).attr('jml_data');
        var progress = $('#progress_persen_'+jml_data).val();
        var pemakaian = $('#pemakaian_'+jml_data).val();

        if(vol_app.length !== 0 && progress.length !== 0){
        	var vol_progress = (parseFloat(vol_app) * parseFloat(progress)) / 100;
        	var deviasi_vol = parseFloat(vol_progress) - parseFloat(pemakaian);
        	var deviasi = parseFloat(deviasi_vol) / parseFloat(vol_progress);
        	vol_progress = parseFloat(vol_progress).toFixed(2);
        	deviasi_vol = parseFloat(deviasi_vol).toFixed(2);
        	deviasi = parseFloat(deviasi).toFixed(2);
        }else{
        	var vol_progress=0;
        	var deviasi_vol=0;
        	var deviasi = 0;
        }
        $('#vol_progress_'+jml_data).val(vol_progress);
        $('#deviasi_vol_'+jml_data).val(deviasi_vol);
        $('#deviasi_'+jml_data).val(deviasi);
    });

    $(document).on("change", ".progress_persen", function(e){
        var progress = $(this).val();
        var jml_data = $(this).attr('jml_data');
        var vol_app = $('#vol_app_'+jml_data).val();
        var pemakaian = $('#pemakaian_'+jml_data).val();

        if(vol_app.length !== 0 && progress.length !== 0){
        	var vol_progress = (parseFloat(vol_app) * parseFloat(progress)) / 100;
        	var deviasi_vol = parseFloat(vol_progress) - parseFloat(pemakaian);
        	var deviasi = parseFloat(deviasi_vol) / parseFloat(vol_progress);
        	vol_progress = parseFloat(vol_progress).toFixed(2);
        	deviasi_vol = parseFloat(deviasi_vol).toFixed(2);
        	deviasi = parseFloat(deviasi).toFixed(2);
        }else{
        	var vol_progress=0;
        	var deviasi_vol=0;
        	var deviasi = 0;
        }
        $('#vol_progress_'+jml_data).val(vol_progress);
        $('#deviasi_vol_'+jml_data).val(deviasi_vol);
        $('#deviasi_'+jml_data).val(deviasi);
    });

    $(document).on("change", ".rencana_waste", function(e){
        var rencana_waste = $(this).val();
        var jml_data = $(this).attr('jml_data');
        var deviasi = $('#deviasi_'+jml_data).val();
        console.log(deviasi);
        if(rencana_waste.length !== 0 && deviasi.length !== 0){
        	var realisasi = parseFloat(deviasi) + parseFloat(rencana_waste);
        }else{
        	var realisasi=0;
        }
        $('#realisasi_'+jml_data).val(realisasi);
    });
  </script>
@endpush