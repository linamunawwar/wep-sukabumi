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
						<h2>Pengajuan Slip Gaji </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group">
									<label class="control-label col-md-2 col-sm-2 col-xs-12" for="nama">NIP <span class="required">*</span>:</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<p style="padding: 6px 12px; font-size: 15px;">{{Auth::user()->pegawai_id}}</p>
									</div>
								</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12" for="nama">Nama Karyawan <span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<p style="padding: 6px 12px;">{{Auth::user()->name}}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12" for="periode">Periode <span class="required">*</span>:</label>
								<div class="col-md-2 col-sm-2 col-xs-12">
									<select class="form-control col-md-7 col-xs-12 bulan" name="bulan" id="bulan">
										<option value="01">Januari</option>
										<option value="02">Februari</option>
										<option value="03">Maret</option>
										<option value="04">April</option>
										<option value="05">Mei</option>
										<option value="06">Juni</option>
										<option value="07">Juli</option>
										<option value="08">Agustus</option>
										<option value="09">September</option>
										<option value="10">Oktober</option>
										<option value="11">November</option>
										<option value="12">Desember</option>
									</select>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-12">
									<?php
									  // Sets the top option to be the current year. (IE. the option that is chosen by default).
									  $currently_selected = date('Y'); 
									  // Year to start available options at
									  $earliest_year = $currently_selected - 5; 
									  // Set your latest year you want in the range, in this case we use PHP to just set it to the current year.
									  $latest_year = date('Y'); 

									  print '<select class="form-control col-md-7 col-xs-12 tahun" name="tahun">';
									  // Loops over each int[year] from current year, back to the $earliest_year [1950]
									  foreach ( range( $latest_year, $earliest_year ) as $i ) {
									    // Prints the option with the next year in range.
									    print '<option value="'.$i.'"'.($i === $currently_selected ? ' selected="selected"' : '').'>'.$i.'</option>';
									  }
									  print '</select>';
									  ?>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12" for="nama">Keperluan <span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<textarea class="form-control" name="keperluan"></textarea>
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