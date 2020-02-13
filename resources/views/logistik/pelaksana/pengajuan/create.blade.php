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
						<h2>Pengajuan Pemakaian </h2>
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

						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"method="POST" style="display: none;">
							<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="kode_penerimaan" class="kode_penerimaan">
							<div class="form-group">
								<label style="display: inline-block;" for="nama">Tanggal Permintaan :</label>
								<p style="display: inline-block;" id="tanggal_permintaan"></p>
								<input type="hidden" name="tanggal_permintaan" id="tanggal_permintaan_id">
							</div>
							<div class="form-group">
								<label style="display: inline-block;" for="nama">Tanggal Penyerahan :</label>
								<input type="text" name="tanggal_penyerahan" id="tanggal_penyerahan_id">
							</div>
							<p><b><u>Peruntukan:</u></b></p><br>
							<div class="form-group" style="display: none;">
								<label style="display: inline-block;" for="nama">Volume Pekerjaan :</label>
								<input type="text" style="padding: 5px;" name="volume_pekerjaan" id="volume_pekerjaan" placeholder="..................................................">
							</div>
							<div class="form-group" style="display: none;">
								<label style="display: inline-block;" for="nama">Nomor WBS :</label>
								<input type="text" style="padding: 5px;" name="no_wbs" id="no_wbs" placeholder="..................................................">
							</div>
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
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Lokasi Pekerjaan :</label>
								<div class="col-md-8 col-sm-8 col-xs-12">
									<select class="form-control jenis" name="jenis" required="required" id="jenis">
										<option value="">Pilih Lokasi Pekerjaan</option>
										@foreach($lokasis as $lokasi)
											<option value="{{$lokasi->id}}">{{$lokasi->nama}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<input type="hidden" name="jumlah_data" class="jumlah_data" id="jumlah_data" value="0">
							<table class="table table-bordered waste" id="table_waste">
								<tr>
									<th rowspan="2">No.</th>
									<th colspan="2">Progres Pekerjaan</th>
									<th rowspan="2" style="width: 20px;">Volume Bahan Sesuai Progres</th>
									<th rowspan="2">Realisasi Pemakaian Bahan</th>
									<th rowspan="2">Waste dalam Satuan Volume</th>
									<th colspan="3">Waste Bahan (%)</th>
									<th rowspan="2">Keterangan</th>
									<th rowspan="2">Action</th>
								</tr>
								<tr>
									<th>%</th>
									<th>Volume</th>
									<th>Renc.</th>
									<th>Real.</th>
									<th>Deviasi</th>
								</tr>
								<tr>
									<td></td>
									<td>
										<input type="text" name="progress_persen" id="progress_persen" class="form-control col-md-7 col-xs-12">
									</td>
									<td>
										<input type="text" name="progress_vol" id="progress_vol" class="form-control col-md-7 col-xs-12">
									</td>
									<td>
										<input type="text" name="vol_bahan" id="vol_bahan" class="form-control col-md-7 col-xs-12">
									</td>
									<td>
										<input type="text" name="real_pemakaian" id="real_pemakaian" class="form-control col-md-7 col-xs-12">
									</td>
									<td>
										<input type="text" name="waste_vol" id="waste_vol" class="form-control col-md-7 col-xs-12">
									</td>
									<td>
										<input type="text" name="waste_rencana" id="waste_rencana" class="form-control col-md-7 col-xs-12">
									</td>
									<td>
										<input type="text" name="waste_real" id="waste_real" class="form-control col-md-7 col-xs-12">
									</td>
									<td>
										<input type="text" name="waste_deviasi" id="waste_deviasi" class="form-control col-md-7 col-xs-12">
									</td>
									<td>
										<input type="text" name="keterangan" id="keterangan" class="form-control">
									</td>
									<td>
										<button type="button" class="btn btn-success tambah"><i><span class="fa fa-plus"></span></i></button>
									</td>
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
  	$('#material').select2();
  	$('#jenis').select2();
  	$('#data_bulan').select2();
  	$('#lokasi').select2();
  	$('#pelaksana').select2();

  	$('#search').on('click', function() {
	  var kode_penerimaan = $('#kode_penerimaan').val();
	  var _token = $('#_token').val();
	
	  $.ajax({
            type: 'post',
            url : '{{ url('Logistik/pelaksana/pengajuan/cekData') }}',
            data: {
                'kode_penerimaan' : kode_penerimaan,
                '_token': _token
            },
            success: function(response){
            	var data = JSON.parse(response);
            	$('.kode_penerimaan').val(tahun);
                $('#demo-form2').show();
                $('#form1').hide();
                if(data != null){
	                if(data.length != 0){
	                	var dt;
	                	var nomor = 1;
	                	for (var i = 0; i < data.length; i++) {
	                		var jumlah_data = $('#jumlah_data').val();
					        	jumlah_data++;
					        $('#jumlah_data').val(jumlah_data);
					        dt += "<tr  class='data_"+jumlah_data+"'>";
	                		dt += "<td>"+nomor+"</td>";
	                		dt +=  "<td>"+data[i].lokasi;
	                		dt +=  "<input type='hidden' name='lokasi[]' value='"+data[i].lokasi_kerja_id+"' id='lokasi_"+jumlah_data+"'>";
	                		dt +=  '</td>';
	                		dt +=  "<td>"+data[i].pelaksana_nama;
	                		dt +=  "<input type='hidden' name='pelaksana[]' value='"+data[i].pelaksana+"' id='pelaksana_"+jumlah_data+"'>";
	                		dt +=  '</td>';
	                		dt +=  "<td>"+data[i].progress_persen;
	                		dt +=  "<input type='hidden' name='progress_persen[]' value='"+data[i].progress_persen+"' id='progress_persen_"+jumlah_data+"'>";
	                		dt +=  '</td>';
	                		dt +=  "<td>"+data[i].progress_vol;
	                		dt +=  "<input type='hidden' name='progress_vol[]' value='"+data[i].progress_vol+"' id='progress_vol_"+jumlah_data+"'>";
	                		dt +=  '</td>';
	                		dt +=  "<td>"+data[i].vol_bahan;
	                		dt +=  "<input type='hidden' name='vol_bahan[]' value='"+data[i].vol_bahan+"' id='vol_bahan_"+jumlah_data+"'>";
	                		dt +=  '</td>';
	                		dt +=  "<td>"+data[i].real_pemakaian;
	                		dt +=  "<input type='hidden' name='real_pemakaian[]' value='"+data[i].real_pemakaian+"' id='real_pemakaian_"+jumlah_data+"'>";
	                		dt +=  '</td>';
	                		dt +=  "<td>"+data[i].waste_vol;
	                		dt +=  "<input type='hidden' name='waste_vol[]' value='"+data[i].waste_vol+"' id='waste_vol_"+jumlah_data+"'>";
	                		dt +=  '</td>';
	                		dt +=  "<td>"+data[i].waste_rencana;
	                		dt +=  "<input type='hidden' name='waste_rencana[]' value='"+data[i].waste_rencana+"' id='waste_rencana_"+jumlah_data+"'>";
	                		dt +=  '</td>';
	                		dt +=  "<td>"+data[i].waste_real;
	                		dt +=  "<input type='hidden' name='waste_real[]' value='"+data[i].waste_real+"' id='waste_real_"+jumlah_data+"'>";
	                		dt +=  '</td>';
	                		dt +=  "<td>"+data[i].waste_deviasi
	                		dt +=  "<input type='hidden' name='waste_deviasi[]' value='"+data[i].waste_deviasi+"' id='waste_deviasi_"+jumlah_data+"'>";
	                		dt +=  '</td>';;
	                		dt +=  "<td>"+data[i].keterangan;
	                		dt +=  "<input type='hidden' name='keterangan[]' value='"+data[i].keterangan+"' id='keterangan_"+jumlah_data+"'>";
	                		dt +=  '</td>';
	                		dt +=  '<td>'
	                		dt += "<a class='btn btn-sm btn-block btn-danger del' idsub='"+jumlah_data+"' style='width:40px;'><span class='fa fa-trash'></span></a>"
	                		dt += '</td>';
	                		dt += '</tr>';
	                			nomor++;
	                	}
	                	$('#table_waste tbody.data').append(dt);
	                }else{
	                	$('#volume_pekerjaan').show();
	                }
	            }
            }
        });
	  
	});

	$(document).on("click", "button.tambah", function(e){
		var lokasi_val = $('#lokasi').val();
		var lokasi_nama = $('#lokasi').find('option:selected').text();
		var pelaksana_val = $('#pelaksana').val();
		var pelaksana_nama = $('#pelaksana').find('option:selected').text()
		var progress_persen = $('#progress_persen').val();
		var progress_vol = $('#progress_vol').val();
		var vol_bahan = $('#vol_bahan').val();
		var real_pemakaian = $('#real_pemakaian').val();
		var waste_vol = $('#waste_vol').val();
		var waste_rencana = $('#waste_rencana').val();
		var waste_real = $('#waste_real').val();
        var waste_deviasi = $('#waste_deviasi').val();
        var keterangan = $('#keterangan').val();

        var jumlah_data = $('#jumlah_data').val();
	        	jumlah_data++;
	    $('#jumlah_data').val(jumlah_data);
	    var table = "<tr  class='data_"+jumlah_data+"'>";
	        table += "<td>"+jumlah_data+"</td>";
	        table += "<td>"+lokasi_nama;
	        table += "<input type='hidden' name='lokasi[]' value='"+lokasi_val+"' id='lokasi_"+jumlah_data+"'>";
	        table += "</td>";
	        table += "<td>"+pelaksana_nama;
	        table += "<input type='hidden' name='pelaksana[]' value='"+pelaksana_val+"' id='pelaksana_"+jumlah_data+"'>";
	        table += "</td>";
	        table += "<td>"+progress_persen;
	        table += "<input type='hidden' name='progress_persen[]' value='"+progress_persen+"' id='progress_persen_"+jumlah_data+"'>";
	        table += "</td>";
	        table += "<td>"+progress_vol;
	        table += "<input type='hidden' name='progress_vol[]' value='"+progress_vol+"' id='progress_vol_"+jumlah_data+"'>";
	        table += "</td>";
	        table += "<td>"+vol_bahan;
	        table += "<input type='hidden' name='vol_bahan[]' value='"+vol_bahan+"' id='vol_bahan_"+jumlah_data+"'>";
	        table += "</td>";
	        table += "<td>"+real_pemakaian;
	        table += "<input type='hidden' name='real_pemakaian[]' value='"+real_pemakaian+"' id='real_pemakaian_"+jumlah_data+"'>";
	        table += "</td>";
	        table += "<td>"+waste_vol;
	        table += "<input type='hidden' name='waste_vol[]' value='"+waste_vol+"' id='waste_vol"+jumlah_data+"'>";
	        table += "</td>";
	        table += "<td>"+waste_rencana;
	        table += "<input type='hidden' name='waste_rencana[]' value='"+waste_rencana+"' id='waste_rencana_"+jumlah_data+"'>";
	        table += "</td>";
	        table += "<td>"+waste_real;
	        table += "<input type='hidden' name='waste_real[]' value='"+waste_real+"' id='waste_real_"+jumlah_data+"'>";
	        table += "</td>";
	        table += "<td>"+waste_deviasi;
	        table += "<input type='hidden' name='waste_deviasi[]' value='"+waste_deviasi+"' id='lokasi_"+jumlah_data+"'>";
	        table += "</td>";
	        table += "<td>"+keterangan;
	        table += "<input type='hidden' name='keterangan[]' value='"+keterangan+"' id='keterangan_"+jumlah_data+"'>";
	        table += "</td>";
	        table +=  '<td>'
    		table += "<a class='btn btn-sm btn-block btn-danger del' idsub='"+jumlah_data+"' style='width:40px;'><span class='fa fa-trash'></span></a>"
    		table += '</td>';
    		table += '</tr>';

    		$('#table_waste tbody.data').append(table);

			$('#progress_persen').val('');
			$('#progress_vol').val('');
			$('#vol_bahan').val('');
			$('#real_pemakaian').val('');
			$('#waste_vol').val('');
			$('#waste_rencana').val('');
			$('#waste_real').val('');
			$('#waste_deviasi').val('');
			$('#keterangan').val('');

	});

	$(document).on("click", "a.del", function(e){
        e.preventDefault();
        var sub = $(this).attr('idsub');
        var jumlahdata = $('#jumlah_data').val();
        
        jumlahdata--;
        $('#jumlah_data').val(jumlahdata);
        $('.data_'+sub+'').remove();
       });
  </script>
@endpush