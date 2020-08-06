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
						<h2>Update Pegawai Permission </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-row form-group">
								<div class="form-group col-md-6">
									<label for="id_menu">Menu Permission</label>
									<select id="id_menu" name="id_menu" id="select" class="form-control col-md-7 col-xs-12 select">
										<option value=""> --- Menu Permission ---</option>
										@foreach ($labelMenu as $label)
											@php 
												$check = 0; 
												$s = $label->id==$permission->id_menu?'selected="selected"':'';
											@endphp
											@foreach ($subMenu as $sub)
												@if ($label->id == $sub->id_parent)
													@php 
														$check++; 
														$s = $sub->id==$permission->id_menu?'selected="selected"':'';
													@endphp
													<optgroup label=" {{ $label->nama }} {{ $check }}">
													<option {{ $s }} value="{{ $sub->id }}">&nbsp;&nbsp; {{ $sub->nama }} </option>													
												@endif
											@endforeach

											@if ($check == 0)
												<optgroup label="{{ $check }}">
												<option {{ $s }} value="{{ $label->id }}"> {{ $label->nama }} </option>
											@endif
										@endforeach
									</select>
								</div>
								<div class="form-group col-md-6">
									<label for="urutan">Pegawai</label>
									<select id="id_user" name="id_user" id="select" class="form-control col-md-7 col-xs-12 select">
										<option value=""> --- Pegawai ---</option>
										@foreach ($pegawai as $row)
											@php
												$s = $row->id==$permission->id_user?'selected="selected"':'';
											@endphp
											<option {{ $s }} value="{{ $row->id }}"> {{ $row->name }} </option>
										@endforeach
									</select>
								</div>
								{{--  <div class="form-group col-md-6">
									<label for="default_role">Default Role</label> <br>
									<div style="margin-left: 1.5em;">
										<table width="100%">
											<tr>
												<td><input type="checkbox" name="role[]" value="PM" > Project Manager</td>
												<td><input type="checkbox" name="role[]" value="M" > Manager</td>
											</tr>
											<tr>
												<td><input type="checkbox" name="role[]" value="L" > Logistik</td>
												<td><input type="checkbox" name="role[]" value="K" > Karyawan</td>
											</tr>
										</table>
									</div>
								</div>	  --}}
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