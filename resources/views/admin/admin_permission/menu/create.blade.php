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
						<h2>Create Menu </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-row form-group">
								<div class="form-group col-md-6">
									<label for="id_parent">Parent</label>
									<select id="id_parent" name="id_parent" class="form-control col-md-7 col-xs-12 bagian">
										<option value=""> --- Parent ---</option>
										@foreach ($menu as $row)
											<option value="{{ $row->id }}"> {{ $row->nama }} </option>
										@endforeach
									</select>
								</div>
								<div class="form-group col-md-6">
									<label for="urutan">Urutan</label>
									<input type="text" class="form-control" name="urutan" id="urutan" placeholder="Urutan">
								</div>
							</div>
							<div class="form-row form-group">
								<div class="form-group col-md-6">
									<label for="nama">Nama</label>
									<input type="text" class="form-control" name="nama" id="nama" placeholder="Nama">
								</div>
								<div class="form-group col-md-6">
									<label for="alias">Alias</label>
									<input type="text" class="form-control" name="alias" id="alias" placeholder="alias">
								</div>
							</div>
							<div class="form-row form-group">
								<div class="form-group col-md-12">
									<label for="direktori">Direktori</label>
									<input type="text" class="form-control" name="direktori" id="direktori" placeholder="Direktori">
								</div>								
							</div>
							<div class="form-row form-group">
								<div class="form-group col-md-6">
									<label for="icon">Nama Icon</label>
									<input type="text" class="form-control" name="icon" id="icon" placeholder="Icon">
								</div>
								<div class="form-group col-md-6">
									<label for="default_role">Default Role</label>
									<input type="text" class="form-control" name="default_role" id="default_role" placeholder="Default Role">
								</div>
							</div>	
							<div class="form-row form-group">
								<div class="form-group col-md-6">
									<input type="checkbox" name="active" id="active" value="1">
									<label for="active">Aktifkan Menu</label>
								</div>								
							</div>						
							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-12 col-sm-12 col-xs-12">
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
		$('select').select2();
		});
	</script>
@endpush