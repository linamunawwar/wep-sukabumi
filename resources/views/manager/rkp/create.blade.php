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
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Posisi Jabatan <span class="required">*</span>:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" id="posisi" name="posisi" required="required" class="posisi form-control col-md-7 col-xs-12">
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Uraian Singkat Tugas Pokok <span class="required">*</span>:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<textarea id="tugas" name="tugas" required="required" class="tugas form-control col-md-7 col-xs-12"></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Persyaratan Jabatan</label>
									</div>
									<div class="ln_solid"></div>
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Peringkat Pendidikan <span class="required">*</span>:</label>
										<div class="col-md-3 col-sm-3 col-xs-12">
											<select class="kebutuhan form-control col-md-7 col-xs-12 pendidikan" name="pendidikan" id="pendidikan">
												<option value="SMA">SMA</option>
												<option value="SMK">SMK</option>
												<option value="STM">STM</option>
												<option value="S1">S1</option>
												<option value="S2">S2</option>
												<option value="S3">S3</option>
											</select>
										</div>
									</div>
									<div class="ln_solid"></div>
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Pengalaman Kerja</label>
									</div>
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Tahun :</label>
										<div class="col-md-2 col-sm-2 col-xs-12">
											<input type="text" id="tahun" name="tahun" required="required" class="tahun form-control col-md-7 col-xs-12">
										</div>
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Jenis Pek. :</label>
										<div class="col-md-3 col-sm-3 col-xs-12">
											<input type="text" id="jenis_kerja" name="jenis_kerja" required="required" class="jenis_kerja form-control col-md-7 col-xs-12">
										</div>
									</div>
									<div class="ln_solid"></div>
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Potensi</label>
									</div>
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">TPA :</label>
										<div class="col-md-2 col-sm-2 col-xs-12">
											<input type="text" id="tpa" name="tpa" required="required" class="tpa form-control col-md-7 col-xs-12">
										</div>
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">EPT :</label>
										<div class="col-md-2 col-sm-2 col-xs-12">
											<input type="text" id="ept" name="ept" required="required" class="ept form-control col-md-7 col-xs-12">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Jumlah yang Dibutuhkan :</label>
										<div class="col-md-2 col-sm-2 col-xs-12">
											<input type="text" id="jumlah" name="jumlah" required="required" class="jumlah form-control col-md-7 col-xs-12">
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Waktu Penempatan :</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" id="waktu" name="waktu" required="required" class="waktu form-control col-md-7 col-xs-12">
										</div>
									</div>
								</div>
							</div>

							<br>
							<div class="form-group">
								<div class="col-md-12" style="padding-right: 100px;">
									<button type="button" class="btn btn-success pull-right tambah"> Add</button>
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
		$(document).on("click", "button.tambah", function(e){
			e.preventDefault();
			var posisi = $('#posisi').val();
	        var tugas = $('#tugas').val();
	        var pendidikan = $('#pendidikan').val();
	        var tahun = $('#tahun').val();
	        var jenis_kerja = $('#jenis_kerja').val();
	        var tpa = $('#tpa').val();
	        var ept = $('#ept').val();
	        var jumlah = $('#jumlah').val();
	        var waktu = $('#waktu').val();
	        var jumlah_data = $('#jumlah_data').val();
	        	jumlah_data++;

	        var table = "<tr  class='data_"+jumlah_data+"'>";
	        	table += "<td>"+jumlah_data+"</td>";
	        	table += "<td>"+posisi+"</td>";
	        	table += "<td>"+tugas+"</td>";
	        	table += "<td>"+pendidikan+"</td>";
	        	table += "<td>"+tahun+"</td>";
	        	table += "<td>"+jenis_kerja+"</td>";
	        	table += "<td>"+tpa+"</td>";
	        	table += "<td>"+ept+"</td>";
	        	table += "<td>"+jumlah+"</td>";
	        	table += "<td>"+waktu+"</td>";
	        	table+="<td>";
                table+="<a class='btn btn-sm btn-block btn-danger del' idsub='"+jumlah_data+"' style='width:40px;'><span class='fa fa-trash'></span></a>";
                table+="</td>";
	        	table += "</tr>";

	        $('#table_rkp tbody.data').append(table);

	        $('#posisi').val('');
	        $('#tugas').val('');
	        $('#pendidikan').val('SMA');
	        $('#tahun').val('');
	        $('#jenis_kerja').val('');
	        $('#tpa').val('');
	        $('#ept').val('');
	        $('#jumlah').val('');
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