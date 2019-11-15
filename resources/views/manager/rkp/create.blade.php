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
						<h2>Rencana Kebutuhan Pegawai </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"method="POST">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							KEBUTUHAN<hr>
							<div class="row"> 
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label col-md-6 col-sm-6 col-xs-12" for="nama">Unit Kerja <span class="required">*</span>:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<select class="form-control col-md-7 col-xs-12 unit_kerja" id="unit_kerja" name="unit_kerja">
												<option value="">Pilih Unit Kerja</option>
												@foreach($posisi as $kd)
													<option value="{{$kd->id}}">{{$kd->posisi}}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label col-md-6 col-sm-6 col-xs-12" for="nama">Kebutuhan <span class="required">*</span>:</label>
										<div class="col-md-4 col-sm-4 col-xs-12">
											<input type="text" id="kebutuhan" name="kebutuhan" class="kebutuhan form-control col-md-7 col-xs-12">
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label col-md-6 col-sm-6 col-xs-12" for="nama">Tersedia <span class="required">*</span>:</label>
										<div class="col-md-4 col-sm-4 col-xs-12">
											<input type="text" id="tersedia" name="tersedia" class="tersedia form-control col-md-7 col-xs-12">
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label col-md-6 col-sm-6 col-xs-12" for="nama">Kurang/Lebih <span class="required">*</span>:</label>
										<div class="col-md-4 col-sm-4 col-xs-122">
											<input type="text" id="kurang_lebih" name="kurang_lebih" class="kurang_lebih form-control col-md-7 col-xs-12">
										</div>
									</div>
								</div>
							</div>
							<br>PROMOSI / MUTASI<br><br>
							<div class="row"> 
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label col-md-6 col-sm-6 col-xs-12" for="nama">Masuk <span class="required">*</span>:</label>
										<div class="col-md-4 col-sm-4 col-xs-122">
											<input type="text" id="masuk" name="masuk" class="masuk form-control col-md-7 col-xs-12">
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label col-md-6 col-sm-6 col-xs-12" for="nama">Keluar <span class="required">*</span>:</label>
										<div class="col-md-4 col-sm-4 col-xs-12">
											<input type="text" id="keluar" name="keluar" class="keluar form-control col-md-7 col-xs-12">
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label col-md-6 col-sm-6 col-xs-12" for="nama">Jumlah <span class="required">*</span>:</label>
										<div class="col-md-4 col-sm-4 col-xs-12">
											<input type="text" id="jumlah" name="jumlah" class="jumlah form-control col-md-7 col-xs-12">
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label col-md-6 col-sm-6 col-xs-12" for="nama">Rekrut <span class="required">*</span>:</label>
										<div class="col-md-4 col-sm-4 col-xs-122">
											<input type="text" id="rekrut" name="rekrut" class="rekrut form-control col-md-7 col-xs-12">
										</div>
									</div>
								</div>
							</div>
							<hr>
							SPESIFIKASI
							<div class="row">
								<div class="col-md-6">
									<!-- <div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Posisi Jabatan <span class="required">*</span>:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" id="posisi" name="posisi" class="posisi form-control col-md-7 col-xs-12">
										</div>
									</div> -->
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Uraian Singkat Tugas Pokok <span class="required">*</span>:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<textarea id="tugas" name="tugas"  class="tugas form-control col-md-7 col-xs-12"></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Peringkat Pendidikan <span class="required">*</span>:</label>
										<div class="col-md-3 col-sm-3 col-xs-12">
											<select class="form-control col-md-7 col-xs-12 pendidikan" name="pendidikan" id="pendidikan">
												<option value="SMA">SMA</option>
												<option value="SMK">SMK</option>
												<option value="STM">STM</option>
												<option value="S1">S1</option>
												<option value="S2">S2</option>
												<option value="S3">S3</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Jumlah yang Dibutuhkan :</label>
										<div class="col-md-2 col-sm-2 col-xs-12">
											<input type="text" id="butuh" name="butuh" class="butuh form-control col-md-7 col-xs-12">
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Waktu Penempatan :</label>
										<div class="col-md-6 col-sm-6 col-xs-12"> 
											<input type="text" id="waktu" name="waktu" class="waktu form-control col-md-7 col-xs-12">
										</div>
									</div>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-6">
									<div class="row">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Pengalaman Kerja</label>
										</div>
									</div>
									<div class="row">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Tahun :</label>
											<div class="col-md-2 col-sm-2 col-xs-12">
												<input type="text" id="tahun" name="tahun" class="tahun form-control col-md-7 col-xs-12">
											</div>
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Jenis Pek. :</label>
											<div class="col-md-3 col-sm-3 col-xs-12">
												<input type="text" id="jenis_kerja" name="jenis_kerja"  class="jenis_kerja form-control col-md-7 col-xs-12">
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Potensi</label>
									</div>
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">TPA :</label>
										<div class="col-md-2 col-sm-2 col-xs-12">
											<input type="text" id="tpa" name="tpa" class="tpa form-control col-md-7 col-xs-12">
										</div>
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">EPT :</label>
										<div class="col-md-2 col-sm-2 col-xs-12">
											<input type="text" id="ept" name="ept" class="ept form-control col-md-7 col-xs-12">
										</div>
									</div>
								</div>
							</div>
							<hr>
							<div class="form-group">
								<div class="col-md-12" style="padding-right: 100px;">
									<button type="button" class="btn btn-success pull-right tambah"><i><span class="fa fa-plus"></span></i>  Tambah</button>
								</div>
							</div>
							<div class="ln_solid"></div>
							<input type="hidden" name="jumlah_data" class="jumlah_data" id="jumlah_data" value="0">
							<table class="table table-bordered rkp" id="table_rkp">
								<tr>
									<th rowspan="3">No.</th>
									<th rowspan="3">Posisi Jabatan</th>
									<th rowspan="3" style="width: 200px;">Uraian Tugas Pokok</th>
									<th colspan="5">Persyaratan Jabatan</th>
									<th rowspan="3" style="width: 20px;">Jumlah Yang Dibutuhkan</th>
									<th rowspan="3">Waktu Penempatan</th>
									<th rowspan="3">Action</th>
								</tr>
								<tr>
									<th rowspan="2">Peringkat Pendidikan</th>
									<th colspan="2">Pengalaman Kerja</th>
									<th colspan="2">Potensi</th>
								</tr>
								<tr>
									<th>Tahun</th>
									<th>Jenis Pekerjaan</th>
									<th>TPA</th>
									<th>EPT</th>
								</tr>
								<tbody class="data">
									
								</tbody>
							</table>
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
		$('.unit_kerja').select2();
		$(document).on("click", "button.tambah", function(e){
			e.preventDefault();
			var unit_kerja = $('#unit_kerja').val();
			var kebutuhan = $('#kebutuhan').val();
			var tersedia = $('#tersedia').val();
			var kurang_lebih = $('#kurang_lebih').val();
			var masuk = $('#masuk').val();
			var keluar = $('#keluar').val();
			var jumlah = $('#jumlah').val();
			var rekrut = $('#rekrut').val();
			var posisi = $('#unit_kerja').val();
	        var tugas = $('#tugas').val();
	        var pendidikan = $('#pendidikan').val();
	        var tahun = $('#tahun').val();
	        var jenis_kerja = $('#jenis_kerja').val();
	        var tpa = $('#tpa').val();
	        var ept = $('#ept').val();
	        var butuh = $('#butuh').val();
	        var waktu = $('#waktu').val();
	        var jumlah_data = $('#jumlah_data').val();
	        	jumlah_data++;
	        $('#jumlah_data').val(jumlah_data);
	        
	        var table = "<tr  class='data_"+jumlah_data+"'>";
	        	table += "<td>"+jumlah_data+"</td>";
	        	table += "<td style='display:none;'>"+unit_kerja+"<input type='hidden' name='unit_kerja[]' value='"+unit_kerja+"' id='unit_kerja_"+jumlah_data+"'></td>";
	        	table += "<td style='display:none;'>"+kebutuhan+"<input type='hidden' name='kebutuhan[]' value='"+kebutuhan+"' id='kebutuhan_"+jumlah_data+"'></td>";
	        	table += "<td style='display:none;'>"+tersedia+"<input type='hidden' name='tersedia[]' value='"+tersedia+"' id='tersedia_"+jumlah_data+"'></td>";
	        	table += "<td style='display:none;'>"+kurang_lebih+"<input type='hidden' name='kurang_lebih[]' value='"+kurang_lebih+"' id='kurang_lebih_"+jumlah_data+"'></td>";
	        	table += "<td style='display:none;'>"+masuk+"<input type='hidden' name='masuk[]' value='"+masuk+"' id='masuk_"+jumlah_data+"'></td>";
	        	table += "<td style='display:none;'>"+keluar+"<input type='hidden' name='keluar[]' value='"+keluar+"' id='keluar_"+jumlah_data+"'></td>";
	        	table += "<td style='display:none;'>"+jumlah+"<input type='hidden' name='jumlah[]' value='"+jumlah+"' id='jumlah_"+jumlah_data+"'></td>";
	        	table += "<td style='display:none;'>"+rekrut+"<input type='hidden' name='rekrut[]' value='"+rekrut+"' id='rekrut_"+jumlah_data+"'></td>";
	        	table += "<td>"+posisi+"<input type='hidden' name='posisi[]' value='"+posisi+"' id='posisi_"+jumlah_data+"'></td>";
	        	table += "<td>"+tugas+"<input type='hidden' name='tugas[]' value='"+tugas+"' id='tugas_"+jumlah_data+"'></td>";
	        	table += "<td>"+pendidikan+"<input type='hidden' name='pendidikan[]' value='"+pendidikan+"' id='pendidikan_"+jumlah_data+"'></td>";
	        	table += "<td>"+tahun+"<input type='hidden' name='tahun_kerja[]' value='"+tahun+"'' id='tahun_kerja_"+jumlah_data+"'></td>";
	        	table += "<td>"+jenis_kerja+"<input type='hidden' name='jenis_kerja[]' value='"+jenis_kerja+"' id='jenis_kerja_"+jumlah_data+"'></td>";
	        	table += "<td>"+tpa+"<input type='hidden' name='tpa[]' value='"+tpa+"' id='tpa_"+jumlah_data+"'></td>";
	        	table += "<td>"+ept+"<input type='hidden' name='ept[]' value='"+ept+"' id='ept_"+jumlah_data+"'></td>";
	        	table += "<td>"+butuh+"<input type='hidden' name='butuh[]' value='"+butuh+"' id='butuh_"+jumlah_data+"'></td>";
	        	table += "<td>"+waktu+"<input type='hidden' name='waktu[]' value='"+waktu+"' id='waktu_"+jumlah_data+"'></td>";
	        	table+="<td>";
                table+="<a class='btn btn-sm btn-block btn-danger del' idsub='"+jumlah_data+"' style='width:40px;'><span class='fa fa-trash'></span></a>";
                table+="</td>";
	        	table += "</tr>";

	        $('#table_rkp tbody.data').append(table);

	        $('#unit_kerja option[value=""]').attr('selected','selected');
			$('#kebutuhan').val('');
			$('#tersedia').val('');
			$('#kurang_lebih').val('');
			$('#masuk').val('');
			$('#keluar').val('');
			$('#jumlah').val('');
			$('#rekrut').val('');
	        $('#posisi').val('');
	        $('#tugas').val('');
	        $('#pendidikan').val('SMA');
	        $('#tahun').val('');
	        $('#jenis_kerja').val('');
	        $('#tpa').val('');
	        $('#ept').val('');
	        $('#butuh').val('');
	        $('#waktu').val('');
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