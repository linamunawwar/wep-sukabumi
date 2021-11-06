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
						<h2>Update Lokasi Pekerjaan </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{ $location->id }}">
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama Lokasi Pekerjaan <span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="nama" value="{{ $location->nama }}" class='form-control' />									
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Keterangan Lokasi Pekerjaan<span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<textarea name="keterangan" rows="10" cols="100" class="keterangan form-control">{{ $location->keterangan }}</textarea>
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