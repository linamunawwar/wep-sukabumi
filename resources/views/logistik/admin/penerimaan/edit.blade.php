@extends('logistik.layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
    <style type="text/css">
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
						<ul class="nav navbar-right panel_toolbox">
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"method="POST">
							<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="kode_permintaan" class="kode_permintaan" value="{{$penerimaan->kode_permintaan}}">
							<input type="hidden" name="kode_penerimaan" class="kode_penerimaan" value="{{$penerimaan->kode_penerimaan}}">
							<div class="form-group">
								<label style="display: inline-block;" for="nama">Kode Permintaan :</label>
								<p style="display: inline-block;" id="kode_permintaan_id">{{$penerimaan->kode_permintaan}}</p>
							</div>
							<div class="form-group">
								<label style="display: inline-block;" for="nama">Kode Penerimaan :</label>
								<p style="display: inline-block;" id="kode_penerimaan_id">{{$penerimaan->kode_penerimaan}}</p>
							</div>
							<div class="form-group">
								<p style="display: inline-block;">(*) Mohon Dicentang hanya saat <u>semua</u> material sudah diterima</p>
							</div>
							<input type="hidden" name="jumlah_data" class="jumlah_data" id="jumlah_data" value="{{count($details)}}">
							<table class="table table-bordered waste" id="table_waste">
								<tr>
									<th rowspan="2">No.</th>
									<th rowspan="2" style="width: 200px;">Nama Material</th>
									<th colspan="5" align="center" style="text-align: center;">VOLUME</th>
									<th rowspan="2">Satuan</th>
									<th rowspan="2" style="width: 120px;">Harga Satuan</th>
									<th rowspan="2" >Sesuai (*)</th>
									<th rowspan="2" style="width: 150px;">Keterangan/ Uraian</th>
								</tr>
								<tr>
									<th>Total Permintaan</th>
									<th>sd. yang Lalu</th>
									<th>Saat ini</th>
									<th>sd. Saat ini</th>
									<th>Sisa</th>
								</tr>
								<tbody class="data">
									<?php $no = 0;$i=0; ?>
	                                @foreach ($details as $detail)
		                                <?php $no++; ?>
		                                <tr  class='data_"+jumlah_data+"'>
					                		<td>{{$no}}</td>
					                		<td>{{$detail->material->nama}}
					                		<input type='hidden' name='material[]' value="{{$detail->material_id}}" id="material_{{$no}}">
					                		</td>
					                		<td>
					                		<input type='text' class='form-control vol_permintaan' id_data="{{$no}}" name='vol_permintaan[]' value="{{$detail->penerimaan->permintaan->permintaanDetail[$i]->volume}}" id="vol_permintaan_{{$no}}">
					                		</td>
					                		<td><input type='text' class='form-control vol_lalu' id_data="{{$no}}" name='vol_lalu[]' value="{{$detail->vol_lalu}}" id="vol_lalu_{{$no}}">
					                		</td>
					                		<td><input type='text' class='form-control vol_saat_ini' id_data="{{$no}}" name='vol_saat_ini[]' id="vol_saat_ini_{{$no}}" value="{{$detail->vol_saat_ini}}">
					                		</td>
					                		<td><input type='text' class='form-control vol_jumlah' id_data="{{$no}}" name='vol_jumlah[]'  id='vol_jumlah_{{$no}}' value="{{$detail->vol_jumlah}}">
					                		</td>
					                		<td><input type='text' class='form-control vol_sisa' id_data="{{$no}}" name='vol_sisa[]' value="{{$detail->vol_sisa}}" id='vol_sisa_{{$no}}' >
					                		</td>
					                		<td>{{$detail->satuan}}
					                		<input type='hidden' name='satuan[]' value='{{$detail->satuan}}' id='satuan_{{$no}}'>
					                		</td>
					                		<td>
					                		<input type='text' name='harga_satuan[]' class='form-control' id='harga_satuan_{{$no}}' value="{{$detail->harga}}">
					                		</td>
					                		<td>
					                		@if($detail->status == 1)
					                		<?php
					                			$checked = 'checked';
					                		?>
					                		@else
					                		<?php
					                			$checked='';
					                		?>
					                		@endif
					                		<input type='checkbox' name='status[{{$i}}]' class='form-control' id='status_{{$no}}' {{$checked}} value='1'> Sesuai
					                		</td>
					                		<td>
					                		<textarea  name='keterangan[]' class='form-control' id='keterangan_{{$no}}'>{{$detail->keterangan}}</textarea>
					                		</td>
			                			</tr>
										<?php $i++?>
									@endforeach		
								</tbody>
							</table>
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
		$(document).on("change", ".vol_saat_ini", function(e){
			console.log($(this).val());
			var vol_saat_ini = $(this).val();
			var id_data = $(this).attr('id_data');
			var vol_permintaan = $('#vol_permintaan_'+id_data).val();
			var vol_lalu = $('#vol_lalu_'+id_data).val();
			var jumlah = parseInt(vol_lalu) + parseInt(vol_saat_ini);
			var sisa = parseInt(vol_permintaan) - parseInt(jumlah);
			$('#vol_jumlah_'+id_data).val(jumlah);
			$('#vol_sisa_'+id_data).val(sisa);


		});
	</script>
@endpush