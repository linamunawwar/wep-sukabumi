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
						<h2>Material / Bahan </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Kode Material <span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="hidden" name="kode_material" id="kode" class='form-control' value="{{$kodeMaterial}}"/>
									<input type="text" name="kode_material" id="kode_material" class='form-control' value="{{$kodeMaterial}}"/>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Kategori Material <span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="radio" name="kategoriMaterial" id="SAP" value="1" required="required" checked/> Sesuai SAP <br>
                                    <input type="radio" name="kategoriMaterial" id="NonSAP" value="2" required="required" /> Keterangan Di Lapangan
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama Material <span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="nama" class='form-control' required="required" />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Satuan Material <span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="satuan" class='form-control' required="required" />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Keterangan <span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea name="keterangan" rows="10" cols="100" class="keterangan form-control"></textarea>
								</div>
							</div>
							
							<div class="ln_solid"></div>
							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
									<a class="btn btn-primary" href="{{url('Logistik/admin/material')}}">Cancel</a>
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
			$(function () {
				var kode = document.getElementById("kode").value;
				$("input[name='kategoriMaterial']").click(function () {
					if ($("#SAP").is(":checked")) {
						$("#kode_material").removeAttr("disabled");
						$("#kode_material").val("");
						$("#kode_material").focus();
					} else {
						$("#kode_material").attr("disabled", "disabled");
						$("#kode_material").val(kode);
					}
				});
			});
		});
	</script>
@endpush