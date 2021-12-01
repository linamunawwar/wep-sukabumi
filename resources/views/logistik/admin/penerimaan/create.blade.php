@extends('logistik.layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
    <style type="text/css">
    	.alert-danger {
		  padding: 20px;
		  background-color: #f44336;
		  color: white;
		}

		.alert-success {
		  padding: 20px;
		  background-color: #4CAF50;
		  color: white;
		}

		.closebtn {
		  margin-left: 15px;
		  color: white;
		  font-weight: bold;
		  float: right;
		  font-size: 22px;
		  line-height: 20px;
		  cursor: pointer;
		  transition: 0.3s;
		}

		.closebtn:hover {
		  color: black;
		}
		#table_waste tbody tr th{
			text-align: center;
			vertical-align: middle;
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
						<h2>Penerimaan Material </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div id="form1">
							<div class="row">
								<div class="col-md-6"  style="padding: 0; margin: 0;">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Kode Permintaan <span class="required">*</span>:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
		                                    <input type="text" name="kode_permintaan" id="kode_permintaan" class="form-control col-md-7 col-xs-12 kode_permintaan" placeholder="Kode Permintaan">
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
						  	<strong>Perhatian!</strong> Data dengan Kode permintaan tersebut tidak ditemukan!
						  </div>
						</div>
						<div class="alert alert-danger alert-notif" style="display: none;">
						  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
						  <div class="isi">
						  	<strong>Perhatian!</strong> Data dengan Kode permintaan tersebut belum disetujui oleh SCARM!
						  </div>
						</div>

						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" style="display: none;">
							<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="kode_permintaan" class="kode_permintaan">
							<div class="form-group">
								<label style="display: inline-block;" for="nama">Kode Permintaan :</label>
								<p style="display: inline-block;" id="kode_permintaan_id"></p>
							</div>
							<div class="form-group">
								<p style="display: inline-block;">(*) Mohon Dicentang hanya saat <u>semua</u> material sudah diterima</p>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-6 col-xs-12" style="text-align: left" for="nama">Nama Supplier <span class="required">*</span>:</label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<input type="text" id="supplier" name="supplier" class="supplier form-control col-md-7 col-xs-12" required="required">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-6 col-xs-12" style="text-align: left;" for="nama">Nama Penerima <span class="required">*</span>:</label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<input type="text" id="penerima" name="penerima" class="penerima form-control col-md-7 col-xs-12" required="required">
								</div>
							</div>

							<input type="hidden" name="jumlah_data" class="jumlah_data" id="jumlah_data" value="0">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12" style="overflow-y:auto; overflow-x:scroll;">
									<table class="table table-bordered waste" id="table_waste">
										<thead>
											<tr>
												<th rowspan="2">No.</th>
												<th rowspan="2" style="width: 150px;">Nama Material</th>
												<th rowspan="2" style="width: 100px;">Tanggal Terima</th>
												<th colspan="5" align="center" style="text-align: center;">VOLUME</th>
												<th rowspan="2">Satuan</th>
												<th rowspan="2" style="width: 100px;">Harga Satuan</th>
												<th rowspan="2">Status (*)</th>
												<th rowspan="2" style="width: 120px;">Keterangan/ Uraian</th>
											</tr>
											<tr>
												<th>Total Permintaan</th>
												<th>sd. yang Lalu</th>
												<th>Saat ini</th>
												<th>sd. Saat ini</th>
												<th>Sisa</th>
											</tr>
										</thead>
										<tbody class="data">
											
										</tbody>
									</table>
								</div>
							</div>
							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
									<a class="btn btn-primary" href="{{url('/Logistik/admin/penerimaan')}}">Cancel</a>
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
	  var kode_permintaan = $('#kode_permintaan').val();
	  var _token = $('#_token').val();
	
	  $.ajax({
            type: 'post',
            url : '{{ url('Logistik/admin/penerimaan/cekData') }}',
            data: {
                'kode_permintaan' : kode_permintaan,
                '_token': _token
            },
            success: function(response){
            	var data = JSON.parse(response);
            	$('.kode_permintaan').val(kode_permintaan);
            	$('#kode_permintaan_id').html(kode_permintaan);
            	if(data == 0){
            		$('.alert-notif').show();
            		$('.not-found').hide();
            	}else{
	                if(data != null){
		                if(data.length != 0){
		                	$('.alert').hide();
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
		                		dt +=  "<td>"+data[i].material_nama;
		                		dt +=  "<input type='hidden' name='material[]' value='"+data[i].material_id+"' id='material_"+jumlah_data+"'>";
		                		dt +=  '</td>';
		                		dt +=  "<td>";
	                            dt += "<input type='date' value='' name='tanggal_terima[]' style='width:140px;' class='form-control datepicker' id='tanggal_terima_"+jumlah_data+"' required='required' placeholder='dd-mm-yyyy' />";
		                		dt +=  '</td>';
		                		dt +=  "<td>";
		                		dt +=  "<input type='text' class='form-control vol_permintaan' id_data='"+jumlah_data+"' name='vol_permintaan[]' value='"+data[i].volume+"' id='vol_permintaan_"+jumlah_data+"'>";
		                		dt +=  '</td>';
		                		dt +=  "<td><input type='text' style='width:60px;' class='form-control vol_lalu' id_data='"+jumlah_data+"' name='vol_lalu[]' value='"+data[i].jumlah_lalu+"' id='vol_lalu_"+jumlah_data+"'>";
		                		dt +=  '</td>';
		                		dt +=  "<td><input type='text' style='width:60px;' class='form-control vol_saat_ini' id_data='"+jumlah_data+"' name='vol_saat_ini[]' id='vol_saat_ini_"+jumlah_data+"'>";
		                		dt +=  '</td>';
		                		dt +=  "<td><input type='text' style='width:60px;' class='form-control vol_jumlah' id_data='"+jumlah_data+"' name='vol_jumlah[]' value='' id='vol_jumlah_"+jumlah_data+"'>";
		                		dt +=  '</td>'
		                		dt +=  "<td><input type='text' style='width:60px;' class='form-control vol_sisa' id_data='"+jumlah_data+"' name='vol_sisa[]' value='' id='vol_sisa_"+jumlah_data+"'>";
		                		dt +=  '</td>';;
		                		dt +=  "<td>"+data[i].satuan;
		                		dt +=  "<input type='hidden' name='satuan[]' value='"+data[i].satuan+"' id='satuan_"+jumlah_data+"'>";
		                		dt +=  '</td>';
		                		dt +=  "<td>";
		                		dt +=  "<input type='text' style='width:90px;'  name='harga_satuan[]' class='form-control' id='harga_satuan_"+jumlah_data+"'>";
		                		dt +=  '</td>';
		                		dt +=  "<td>";
		                		if(data[i].status == 1){
		                			checked = 'checked';
		                		}else{
		                			checked='';
		                		}
		                		dt +=  "<input type='checkbox' name='status["+i+"]' class='form-control' id='status_"+jumlah_data+"' "+checked+" value='1'> Sesuai";
		                		dt +=  '</td>';
		                		dt +=  "<td>";
		                		dt +=  "<textarea  name='keterangan[]' class='form-control' id='keterangan_"+jumlah_data+"'></textarea>";
		                		dt +=  '</td>';
		                		dt += '</tr>';
		                			nomor++;
		                	}
		                	$('#table_waste tbody.data').append(dt);	
		                	
		                }else{
		                	$('.not-found').show();
		                	$('.alert-notif').hide();
		                }
		            }else{
	                	$('.not-found').show();
	                	$('.alert-notif').hide();
	                }
	            }
            }
        });
	  
	});
	
	$(document).on("change", ".vol_saat_ini", function(e){
		console.log($(this).val());
		var vol_saat_ini = $(this).val();
		var id_data = $(this).attr('id_data');
		var vol_permintaan = $('#vol_permintaan_'+id_data).val();
		var vol_lalu = $('#vol_lalu_'+id_data).val();
		var jumlah = parseInt(vol_lalu) + parseInt(vol_saat_ini);
		var sisa =  parseInt(jumlah) - parseInt(vol_permintaan);
		$('#vol_jumlah_'+id_data).val(jumlah);
		$('#vol_sisa_'+id_data).val(sisa);
	});

	
  </script>
@endpush