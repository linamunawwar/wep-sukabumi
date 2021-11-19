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
						<div id="form1">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Bulan <span class="required">*</span>:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<select class="form-control data_bulan" name="data_bulan" required="required" id="data_bulan">
												<option value="">Pilih Bulan</option>
												<option value="01">Januari</option>
												<option value="02">Februari</option>
												<option value="03">Maret</option>
												<option value="04">April</option>
												<option value="05">Mei</option>
												<option value="06">Juni</option>
												<option value="07">Juli</option>
												<option value="08">Agustus</option>
												<option value="09">September</option>
												<option value="10">Oktober</option>
												<option value="11">November</option>
												<option value="12">Desember</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-6"  style="padding: 0; margin: 0;">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Tahun <span class="required">*</span>:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
		                                    <input type="text" name="data_tahun" id="data_tahun" class="form-control col-md-7 col-xs-12" placeholder="tahun">
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-6" style="padding: 0; margin: 0;">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Jenis Pekerjaan :</label>
										<div class="col-md-8 col-sm-8 col-xs-12">
											<select class="form-control jenis" name="jenis" required="required" id="jenis">
												<option value="">Pilih Jenis Pekerjaan</option>
												@foreach($jenis_kerjas as $jenis_kerja)
													<option value="{{$jenis_kerja->id}}">{{$jenis_kerja->nama}}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-6" style="padding: 0; margin: 0;">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Lokasi :</label>
										<div class="col-md-8 col-sm-8 col-xs-12">
											<select class="form-control lokasi" name="lokasi" required="required" id="lokasi">
												<option value="">Pilih Lokasi</option>
												@foreach($lokasis as $lokasi)
													<option value="{{$lokasi->id}}">{{$lokasi->nama}}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
							</div>
							<br>
							<button class="btn btn-primary pull-right" id="search">Search</button>
						</div>
						<br><br><br>
						<div class="alert alert-danger" style="display: none;">
						  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
						  <div class="isi">
						  	<strong>Perhatian!</strong> Data sudah pernah diinput! Silahkan tekan tombol edit untuk mengubah data.
						  </div>
						</div>

						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"method="POST" style="display: none;">
							<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label style="display: inline-block;" for="nama">Jenis Pekerjaan :</label>
										<p style="display: inline-block;" id="jenis_kerja"></p>
										<input type="hidden" name="jenis_kerja_id" id="jenis_kerja_id">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label style="display: inline-block;" for="nama">Lokasi :</label>
										<p style="display: inline-block;" id="lokasi_kerja"></p>
										<input type="hidden" name="lokasi_id" id="lokasi_id">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label style="display: inline-block;" for="nama">Periode :</label>
										<p style="display: inline-block;" id="periode"></p>
										<input type="hidden" name="bulan" id="bulan">
										<input type="hidden" name="tahun" id="tahun">
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
  	$('#lokasi').select2();
  	$('#jenis').select2();
  	$('#data_bulan').select2();
  	$('#lokasi').select2();
  	$('#pelaksana').select2();

  	$('#search').on('click', function() {
	  var lokasi = $('#lokasi').val();
	  var jenis_kerja = $('#jenis').val();
	  var bulan = $('#data_bulan').val();
	  var tahun = $('#data_tahun').val();
	  var _token = $('#_token').val();
	  console.log(lokasi,bulan,tahun);
	  $.ajax({
            type: 'post',
            url : '{{ url('Logistik/admin/waste/cekData') }}',
            data: {
                'lokasi' : lokasi,
                'jenis_kerja' : jenis_kerja,
                'bulan' : bulan,
                'tahun' : tahun,
                '_token': _token
            },
            success: function(response){
            	var data = JSON.parse(response);
            	var periode = ($('#data_bulan').find('option:selected').text())+' '+tahun;
            	$('#periode').html(periode);
            	$('#lokasi_id').val(lokasi);
            	$('#lokasi_kerja').html($('#lokasi').find('option:selected').text());
            	$('#jenis_kerja').html($('#jenis').find('option:selected').text());
            	$('#jenis_kerja_id').val(jenis_kerja);
            	$('#bulan').val(bulan);
            	$('#tahun').val(tahun);
                if(data != null){
                	$('#demo-form2').show();
                	$('#form1').hide();
	                if(data.length != 0){
	                	var dt;
	                	var nomor = 1;
	                	for (var i = 0; i < data.length; i++) {
	                		var jumlah_data = $('#jumlah_data').val();
					        	jumlah_data++;
					        $('#jumlah_data').val(jumlah_data);
					        dt += "<tr  class='data_"+jumlah_data+"'>";
	                		dt += "<td>"+nomor+"</td>";
	                		dt +=  "<td style='width:250px;'>"+data[i].material;
	                		dt +=  "<input type='hidden' name='material[]' value='"+data[i].material_id+"' id='material_"+jumlah_data+"' jml_data='"+jumlah_data+"'>";
	                		dt +=  '</td>';
	                		dt +=  "<td>"+data[i].sat;
	                		dt +=  "<input type='hidden' name='satuan[]' value='"+data[i].sat+"' id='satuan_"+jumlah_data+"' jml_data='"+jumlah_data+"'>";
	                		dt +=  '</td>';
	                		dt +=  "<td><input type='text' name='vol_app[]' value='' id='vol_app_"+jumlah_data+"' class='vol_app width-60' jml_data='"+jumlah_data+"'>";
	                		dt +=  '</td>';
	                		dt +=  "<td><input type='text' name='progress_persen[]' value='' id='progress_persen_"+jumlah_data+"' class='progress_persen width-60' jml_data='"+jumlah_data+"'>";
	                		dt +=  '</td>';
	                		dt +=  "<td><input type='text' name='vol_progress[]' value='' id='vol_progress_"+jumlah_data+"' class='width-60' jml_data='"+jumlah_data+"' readonly='readonly'>";
	                		dt +=  '</td>';
	                		dt +=  "<td><input type='text' name='pemakaian[]' value='"+data[i].pemakaian+"' id='pemakaian_"+jumlah_data+"' class='width-60' jml_data='"+jumlah_data+"' readonly='readonly'>";
	                		dt +=  '</td>';
	                		dt +=  "<td><input type='text' name='deviasi_vol[]' value='' id='deviasi_vol_"+jumlah_data+"' class='width-60' jml_data='"+jumlah_data+"' readonly='readonly'>";
	                		dt +=  '</td>';
	                		dt +=  "<td><input type='text' name='deviasi[]' value='' id='deviasi_"+jumlah_data+"' class='width-60' jml_data='"+jumlah_data+"' readonly='readonly'>";
	                		dt +=  '</td>';
	                		dt +=  "<td><input type='text' name='rencana_waste[]' value='' id='rencana_waste_"+jumlah_data+"' class='rencana_waste width-60' jml_data='"+jumlah_data+"'>";
	                		dt +=  '</td>';
	                		dt +=  "<td><input type='text' name='realisasi[]' value='' id='realisasi_"+jumlah_data+"' class='width-60' jml_data='"+jumlah_data+"' readonly='readonly'>";
	                		dt +=  '</td>';
	                		// dt +=  '<td>'
	                		// dt += "<a class='btn btn-sm btn-block btn-danger del' idsub='"+jumlah_data+"' style='width:40px;'><span class='fa fa-trash'></span></a>"
	                		// dt += '</td>';
	                		dt += '</tr>';
	                			nomor++;
	                	}
	                	$('#table_waste tbody.data').append(dt);
	                }else{
	                	$('#volume_pekerjaan').show();
	                }
	            }else{
	            	$('.alert-danger').show();
	            }
            }
        });
	  
	});

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