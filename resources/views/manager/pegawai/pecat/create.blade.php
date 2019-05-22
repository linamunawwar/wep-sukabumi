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
						<h2>Pemberhentian Kerja Pegawai </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama Karyawan <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select class="form-control nip" id="nip" name="nip" required="required">
										<option value="">Pilih Karyawan</option>
										@foreach($pegawais as $pegawai)
											<option value="{{$pegawai->nip}}">{{strtoupper($pegawai->nip)}} - {{$pegawai->nama}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Alasan</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<textarea name="alasan" class="form-control" rows="5"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="tgl_lahir" class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Terakhir Kerja * :</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class='input-group date' id='datepicker' class="datepicker">
										<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
						                <input type='text' value='' name='terakhir_kerja' class='form-control' required="required" placeholder="dd-mm-yyyy" id="terakhir_kerja" />
						            </div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Pesangon</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="pesangon" class="form-control pesangon" id="pesangon" readonly="readonly" value="">
								</div>
							</div>
							
							<div class="ln_solid"></div>
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
		$(document).ready(function() {
		    $('.nip').select2();

		    $('#datepicker').datepicker({
		        format: 'dd-mm-yyyy',
		        autoclose: true
	    	});

		    function monthDiff(d1, d2) {
			    var months;
			    months = (d2.getFullYear() - d1.getFullYear()) * 12;
			    months -= d1.getMonth();
			    months += d2.getMonth();
			    return months <= 0 ? 0 : months;
			}

	    	$(document).on("keyup", "#terakhir_kerja", function(e){
		      var tgl = this.value;
		      var nip = $('#nip').val();
		      $.ajax({
		            url  : laravel_base+'/manager/pegawai/pecat/tanggal_masuk/'+nip,
		            type : 'get',
		            success:function(response){
		                var keluar = $('#terakhir_kerja').val().split('-');
		                keluar = new Date(keluar[2], keluar[1]-1, keluar[0]);
		                var masuk = response.tanggal_masuk;
		                masuk = masuk.split('-');
		                masuk = new Date(masuk[2], masuk[1]-1, masuk[0]);

		                var month = monthDiff(masuk, keluar);

		                var gaji = response.gaji.gaji_pokok;

		                if(month <= 2){
		                	var pesangon = (month / 12) * gaji;
		                }else{
		                	var pesangon = 2 * gaji;
		                }

		                $('#pesangon').val(pesangon);
		            }
		        });
		    });

		    $(document).on("change", "#terakhir_kerja", function(e){
		      var tgl = this.value;
		      var nip = $('#nip').val();
		      $.ajax({
		            url  : laravel_base+'/manager/pegawai/pecat/tanggal_masuk/'+nip,
		            type : 'get',
		            success:function(response){
		            	var keluar = $('#terakhir_kerja').val().split('-');
		                keluar = new Date(keluar[2], keluar[1]-1, keluar[0]);
		                var masuk = response.tanggal_masuk;
		                masuk = masuk.split('-');
		                masuk = new Date(masuk[2], masuk[1]-1, masuk[0]);

		                var month = monthDiff(masuk, keluar);
		                var gaji = response.gaji.gaji_pokok;
		                if(month <= 2){
		                	var pesangon = (month / 12) * gaji;
		                }else{
		                	var pesangon = 2 * gaji;
		                }

		                $('#pesangon').val(pesangon);
		            }
		        });
		    });
		});
	</script>
@endpush