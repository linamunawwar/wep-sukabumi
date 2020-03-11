@extends('logistik.layouts.blank')

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
						<h2>Pengajuan Material </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div id="form1">
							<div class="row">
								<div class="col-md-6"  style="padding: 0; margin: 0;">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Kode Penerimaan <span class="required">*</span>:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
		                                    <input type="text" name="kode_penerimaan" id="kode_penerimaan" class="form-control col-md-7 col-xs-12 kode_penerimaan" placeholder="Kode Penerimaan">
										</div>
										<div class="col-md-2">
											<button class="btn btn-primary pull-right" id="search">Search</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="alert alert-danger not-found" style="display: none;">
						  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
						  <div class="isi">
						  	<strong>Perhatian!</strong> Data dengan Kode penerimaan tersebut tidak ditemukan!
						  </div>
						</div>
						<div class="alert alert-danger alert-notif" style="display: none;">
						  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
						  <div class="isi">
						  	<strong>Perhatian!</strong> Data dengan Kode penerimaan tersebut belum disetujui oleh SPLEM!
						  </div>
						</div>

						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"method="POST" style="display: none;">
							<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
							<div class="form-group">
								<label style="display: inline-block;" for="nama">Kode Penerimaan :</label>
								<p style="display: inline-block;" id="kode_penerimaan_id"></p>
								<input type="hidden" name="kodePenerimaan" id="kode_penerimaan_id" class="kode_penerimaan_id">
							</div>							
							<div class="row">
								<div class="col-md-3 col-sm-3 col-xs-3">
									<div class="form-group">
										<label style="display: inline-block;" for="nama">Jenis Pekerjaan </label>
										<p style="display: inline-block;">
											<select class="form-control jenisPekerjaan" name="jenisPekerjaan" id="jenisPekerjaan" style="width: 110%; !important" required='required'>
												<option value="">Pilih jenisPekerjaan</option>
												@foreach($jenisPekerjaans as $jenisPekerjaan)
													<option value="{{$jenisPekerjaan->id}}">{{$jenisPekerjaan->nama}}</option>
												@endforeach
											</select>
										</p>
									</div>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-3">
									<div class="form-group">
										<label style="display: inline-block;" for="nama">Lokasi Pekerjaan </label>
										<p style="display: inline-block;">
											<select class="form-control lokasiPekerjaan" name="lokasiPekerjaan" id="lokasiPekerjaan" style="width: 130%; !important" required='required'>
												<option value="">Pilih lokasiPekerjaan</option>
												@foreach($lokasiPekerjaans as $lokasiPekerjaan)
													<option value="{{$lokasiPekerjaan->id}}">{{$lokasiPekerjaan->nama}}</option>
												@endforeach
											</select>
										</p>
									</div>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-3">
									<div class="form-group">
										<label style="display: inline-block;" for="nama">Volume </label>
										<p style="display: inline-block;">
											<input type="text" name="volume" class='form-control volume' id="volume" required='required'>
										</p>
									</div>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-3">
									<div class="form-group">
										<label style="display: inline-block;" for="nama">No. WBS </label>
										<p style="display: inline-block;">
											<input type="text" name="no_wbs" class='form-control no_wbs' id="no_wbs" >
										</p>
									</div>
								</div>
							</div>
							<br>
							<input type="hidden" name="jumlah_data" class="jumlah_data" id="jumlah_data" value="0">
							<table class="table table-bordered waste" id="table_waste">
								<tr>
									<th rowspan="2">No.</th>
									<th rowspan="2" style="width: 200px;">Tanggal Pengajuan</th>
									<th rowspan="2" style="width: 200px;">Element Activity</th>
									<th rowspan="2" align="center" style="text-align: center;">Nama Material</th>
									<th colspan="2" align="center" style="text-align: center;">Penerimaan Material</th>
									<th colspan="2" align="center" style="text-align: center;">Permintaan</th>
								</tr>
								<tr>
									<th>Jumlah</th>
									<th>Satuan</th>
									<th>Satuan</th>
									<th>Jumlah</th>
								</tr>
								<tbody class="data">
									
								</tbody>
							</table>
							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
									<a class="btn btn-primary" href="{{url('/Logistik/user/pengajuan')}}">Cancel</a>
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
	$('#jenisPekerjaan').select2();
	$('#lokasiPekerjaan').select2();
	$('#datepicker1').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
	});

  	$('#search').on('click', function() {
	  var kode_penerimaan = $('#kode_penerimaan').val();
	  var _token = $('#_token').val();
	
	  	$.ajax({
            type: 'post',
            url : '{{ url('Logistik/admin/pengajuan/cekData') }}',
            data: {
                'kode_penerimaan' : kode_penerimaan,
                '_token': _token
            },
            success: function(response){
            	var data = JSON.parse(response);
            	$('.kode_penerimaan_id').val(kode_penerimaan);
            	$('#kode_penerimaan_id').html(kode_penerimaan);
            	if(data == 0){
            		$('.alert-notif').show();
            		$('.not-found').hide();
            	}else{
	                if(data != null){
						
		                if(data.length != 0){
		                	$('#form1').hide();
		                	$('#demo-form2').show();
		                	var dt;
		                	var nomor = 1; var checked='';;
		                	for (var i = 0; i < data.length; i++) {
		                		var jumlah_data = $('#jumlah_data').val();
						        	jumlah_data++;
						        $('#jumlah_data').val(jumlah_data);
						        dt += "<tr  class='data_"+jumlah_data+"'>";
								dt += "<td>"+nomor+"</td>";
								dt +=  "<td>";
								dt +=  "<div class='input-group date' class='datepicker'><span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span><input type='date' id='tanggal_pengajuan"+jumlah_data+"' id_data='"+jumlah_data+"' name='tanggal_pengajuan[]' class='form-control' required='required' placeholder='dd-mm-yyyy' /></div>";
								dt +=  '</td>';
								dt +=  "<td>";
								dt +=  "<input type='text' class='form-control element_activity' id_data='"+jumlah_data+"' name='element_activity[]' value='' id='element_activity_"+jumlah_data+"'>";
								dt +=  '</td>';
		                		dt +=  "<td style='text-align: center; vertical-align: middle;'>"+data[i].material_nama;
		                		dt +=  "<input type='hidden' name='material[]' value='"+data[i].material_id+"' id='material_"+jumlah_data+"'>";
		                		dt +=  '</td>';	
		                		dt +=  "<td style='text-align: center; vertical-align: middle;'>"+data[i].sisa_stok;
		                		dt +=  '</td>';	
		                		dt +=  "<td style='text-align: center; vertical-align: middle;'>"+data[i].satuan;
		                		dt +=  '</td>';	                		
		                		dt +=  "<td><input type='text' class='form-control permintaan_satuan' id_data='"+jumlah_data+"' name='permintaan_satuan[]' value='"+data[i].material_satuan+"' id='permintaan_satuan_"+jumlah_data+"' required='required'>";
		                		dt +=  '</td>';
		                		dt +=  "<td><input type='text' class='form-control permintaan_jumlah' id_data='"+jumlah_data+"' name='permintaan_jumlah[]' value='' id='permintaan_jumlah_"+jumlah_data+"' required='required'>";
		                		dt +=  '</td>';
		                		dt += '</tr>';
		                			nomor++;
		                	}
		                	$('#table_waste tbody.data').append(dt);
		                }else{
		                	$('.alert-danger').show();
		                }
		            }else{
	                	$('.alert-notif').hide();
	                	$('.not-found').show();
	                }
	            }
            }
        });	  
	});

	/*$(document).ready(function(){
		var kode_penerimaan = $('#kode_penerimaan').val();
	  	var _token = $('#_token').val();
		//var jumlah_data = $('#jumlah_data').val();
		
		console.log(data.length);
		for(var i = 0; i < jumlah_data.length; i++){
			$('#permintaan_jumlah_'+i).blur(function(){
				var permintaanJumlah = $(this).val();
	
				$.ajax({
					type	: 'POST',
					url 	: '{{ url('Logistik/admin/pengajuan/pengajuanValidasi') }}',
					data: {
						'permintaan_jumlah' : permintaanJumlah,
						'kode_penerimaan' : kode_penerimaan,
						'_token': _token
					},
					success	: function(data){
						$('#pesan').html(data);
					}
				})
			});
		}
	});*/
	
  </script>
@endpush