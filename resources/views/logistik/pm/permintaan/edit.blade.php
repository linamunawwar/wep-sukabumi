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
						<h2>Permintaan Material / Bahan</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form id="demo-form2" data-parsley-validate  method="POST" enctype="multipart/form-data">
							<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
							<span style="float:right;"> Tanggal : {{ date('d F Y', strtotime($permintaan->tanggal)) }} </span>
							<input type="hidden" name="tanggal" value="{{ date('d F Y', strtotime($permintaan->tanggal)) }}">
							<div class="row"> 
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Lampiran :</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="file" name="file" class="form-control col-md-7 col-xs-12">
											@if((file_exists("upload/permintaan/$permintaan->file")) && $permintaan->file)
												<b><a href='{{url("upload/permintaan/$permintaan->file")}}' class="col-md-7 col-xs-12" target="_blank">
													<i class="fa fa-search-plus"></i>&nbsp&nbsp&nbspPreview
												</a></b>
											@endif
										</div>
									</div>
								</div>
							</div>
							<hr>
							<div class="row"> 
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-6 col-sm-6 col-xs-12" for="nama">Material <span class="required">*</span>:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<select class="form-control col-md-7 col-xs-12 material" id="material" name="material">
												<option value="">Pilih Material / Bahan</option>
												@foreach($materials as $material)
													<option value="{{$material->id}}">{{$material->nama}}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-6 col-sm-6 col-xs-12" for="nama">No Part <span class="required">*</span>:</label>
										<div class="col-md-4 col-sm-4 col-xs-12">
											<input type="text" id="no_part" name="no_part" class="no_part form-control col-md-7 col-xs-12">
										</div>
									</div>
								</div>	
							</div>
							<br>
							<div class="row"> 								
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-6 col-sm-6 col-xs-12" for="nama">Volume <span class="required">*</span>:</label>
										<div class="col-md-4 col-sm-4 col-xs-12">
											<input type="text" id="volume" name="volume" class="volume form-control col-md-7 col-xs-12">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-6 col-sm-6 col-xs-12" for="nama">Satuan <span class="required">*</span>:</label>
										<div class="col-md-4 col-sm-4 col-xs-122">
											<input type="text" id="satuan" name="satuan" class="satuan form-control col-md-7 col-xs-12">
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row"> 								
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-6 col-sm-6 col-xs-12" for="nama">Keperluan <span class="required">*</span>:</label>
										<div class="col-md-4 col-sm-4 col-xs-12">
											<textarea id="keperluan" name="keperluan" rows="10" class="keperluan form-control col-md-7 col-xs-12" style="width:48.2em;"></textarea>
										</div>
									</div>
								</div>
							</div>
							<br>	
							<div class="row"> 								
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-6 col-sm-6 col-xs-12" for="nama">Keterangan <sup>(Optional)</sup> :</label>
										<div class="col-md-4 col-sm-4 col-xs-12">
											<textarea id="keterangan" name="keterangan" rows="10" class="keterangan form-control col-md-7 col-xs-12" style="width:48.2em;"></textarea>
										</div>
									</div>
								</div>
							</div>					
							
							<div class="ln_solid"></div>
							<div class="form-group" >
								<div class="col-md-12" style="padding-right: 90px; margin-bottom:1.5em;">
									<button type="button" class="btn btn-success pull-right tambah"><i><span class="fa fa-plus"></span></i>  Tambah</button>
								</div>
							</div>

							<input type="hidden" name="jumlah_data" class="jumlah_data" id="jumlah_data" value="0">
							<table class="table table-bordered permintaan" id="table_permintaan">
								<tr>
									<th>Nama Material</th>
									<th>No.Partype</th>
									<th>Volume</th>
									<th>Satuan</th>
									<th>Untuk Keperluan</th>
									<th>Keterangan</th>
									<th>Action</th>
								</tr>
								<tbody class="data">
									@foreach ($detail as $detail)    
                                    <tr>                            
										<td>{{ $detail->detailPermintaanMaterial->nama }} </td>
										<td>{{ $detail->no_part }} </td>
										<td>{{ $detail->volume }} </td>
										<td>{{ $detail->satuan }} </td>
										<td>{{ $detail->keperluan }} </td>
										<td>{{ $detail->keterangan }} </td>
										<td> 
											<a href="{{url('Logistik/admin/permintaan/deleteDetail/'.$detail->id.'/'.$detail->permintaan_id.'')}}" class="btn btn-sm btn-block btn-danger" style="width:40px;"><span class="fa fa-trash"></span></a> 
										</td>                                           
                                    </tr>					
                                    @endforeach	
								</tbody>
							</table>
							<div class="ln_solid"></div>
							<div class="form-group" style="margin-left:60em;">
								<div class="col-md-12">
									<button class="btn btn-primary" type="button">Cancel</button>
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

	$(document).on("change", ".material", function(){
		var material_id = $('#material').val();
		var _token = $('#_token').val();
		
		$.ajax({
			type: "post",
			url: '{{ url('Logistik/admin/permintaan/getSatuan') }}',
			data: {
				'material_id' : material_id,
                '_token': _token
			},
			success: function(response){
				var data = JSON.parse(response)
				$('.satuan').val(data.satuan);
				console.log(data.satuan);
			}
		})
	});

	$(document).ready(function(){
		$('.material').select2();
		$(document).on("click", "button.tambah", function(e){
			e.preventDefault();
			var material = $('#material').val();
			var nama_material = $('#material').find('option:selected').text();
			var no_part = $('#no_part').val();
			var volume = $('#volume').val();
			var satuan = $('#satuan').val();
			var keperluan = $('#keperluan').val();
			var keterangan = $('#keterangan').val();
			var jumlah_data = $('#jumlah_data').val();
	        	jumlah_data++;
	        $('#jumlah_data').val(jumlah_data);
	        
			var table = "<tr  class='data_"+jumlah_data+"'>";
				table += "<td>"+jumlah_data+"</td>";
				table += "<td>"+nama_material+"<input type='hidden' name='material[]' value='"+material+"' id='material_"+jumlah_data+"'></td>";
				table += "<td>"+no_part+"<input type='hidden' name='no_part[]' value='"+no_part+"' id='no_part_"+jumlah_data+"'></td>";
				table += "<td>"+volume+"<input type='hidden' name='volume[]' value='"+volume+"' id='volume_"+jumlah_data+"'></td>";
				table += "<td>"+satuan+"<input type='hidden' name='satuan[]' value='"+satuan+"' id='satuan_"+jumlah_data+"'></td>";
				table += "<td>"+keperluan+"<input type='hidden' name='keperluan[]' value='"+keperluan+"' id='keperluan_"+jumlah_data+"'></td>";
				table += "<td>"+keterangan+"<input type='hidden' name='keterangan[]' value='"+keterangan+"' id='keterangan_"+jumlah_data+"'></td>";
				table+="<td>";
				table+="<a class='btn btn-sm btn-block btn-danger del' idsub='"+jumlah_data+"' style='width:40px;'><span class='fa fa-trash'></span></a>";
				table+="</td>";
				table += "</tr>";
				
			$('#table_permintaan tbody.data').append(table);
			
	        $('#material option[value=""]').attr('selected','selected');
			$('#no_part').val('');
			$('#volume').val('');
			$('#satuan').val('');
			$('#keperluan').val('');
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
	});
</script>
@endpush