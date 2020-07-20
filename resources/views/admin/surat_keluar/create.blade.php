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
						<h2>Surat Keluar </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group">
								<label for="tanggal" class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Surat *:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class='input-group date' id='datepicker' class="datepicker">
										<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
						                <input type='text' value='' name='tanggal_surat' id="tanggal_surat" class='form-control' required="required" />
						            </div>
								</div>
							</div>
							
							<div class="button-next" style="text-align: center;">
								<a class="btn btn-primary" id="get_nomor">Get Nomor</a>
							</div>
							<div class="next-form" style="display: none;">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nomor Surat <span class="required">*</span>:</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input type="text" name="no_surat" id="no_surat" class="form-control col-md-7 col-xs-12">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Pengirim <span class="required">*</span>:</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input type="text" name="pengirim" class="form-control col-md-7 col-xs-12">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Kepada <span class="required">*</span>:</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input type="text" name="kepada" class="form-control col-md-7 col-xs-12">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Kategori:</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<select name="kategori" class="form-control col-md-7 col-xs-12" required="required">
											<option value="">-- Pilih Kategori --</option>
											<option value="divisi">Divisi (Waskita)</option>
											<option value="owner">Owner (PT. KKDM)</option>
											<option value="eksternal">Eksternal (Lainnya)</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Perihal:</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<textarea name="perihal" class="form-control col-md-7 col-xs-12"></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Upload Surat:</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input type="file" name="file_surat" class="form-control col-md-7 col-xs-12">
									</div>
								</div>
								
								<div class="ln_solid"></div>
								<div class="form-group">
									<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
										<a class="btn btn-primary" type="button" href='{{url("admin/surat_keluar")}}'>Cancel</a>
										<button class="btn btn-primary" type="reset">Reset</button>
										<button type="submit" class="btn btn-success">Submit</button>
									</div>
								</div>
							</div>
							<div class="message-error" style="display: none;">
								<div class="alert alert-danger not-found">
								  <span class="closebtn" onclick="this.parentElement.style.display='none';" style="text-align: right;">&times;</span> 
								  <div class="isi">
								  	<strong>Perhatian!</strong> Periksa tanggal surat dan Pastikan surat keluar yang sebelumnya sudah anda upload.
								  </div>
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
      $('#datepicker').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
    	});

      $('#get_nomor').on('click', function() {
			  var tanggal = $('#tanggal_surat').val();
			  $.ajax({
	                type: 'get',
	                url : '{{ url('admin/surat_keluar/get_nomor') }}',
	                data: {
	                    'tanggal' : tanggal,
	                },
	                success: function(response){
	                	if(response != 0){
		                    // $('#tanggal_surat').attr('readonly','readonly');
		                    // $('#tanggal_surat').prop('disabled',true);
		                    // $('.input-group-addon').unbind('click');
		                    $('#no_surat').val(response);
		                    $('.next-form').show();
		                    $('.message-error').hide();
		                    $('.button-next').hide();
		                }else{
		                	$('.message-error').show();
		                	$('.alert-danger').show();
		                	$('.button-next').show();
		                	$('.next-form').hide();
		                }
	                }
	            });
			  
			});
  	});

</script>
@endpush