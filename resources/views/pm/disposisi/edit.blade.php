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
						<h2>Disposisi </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Nomor Agenda <span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<p class="data">{{$disposisi->no_agenda}}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Pengirim <span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<p class="data">{{$disposisi->pengirim}}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Kepada <span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<p class="data">{{$disposisi->kepada}}</p>
								</div>
							</div>
							<div class="form-group">
								<label for="tanggal" class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Terima *:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<p class="data">{{konversi_tanggal($disposisi->tanggal_terima)}}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Nomor Surat <span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<p class="data">{{$disposisi->no_surat}}</p>
								</div>
							</div>
							<div class="form-group">
								<label for="tanggal" class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Surat *:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<p class="data">{{konversi_tanggal($disposisi->tanggal_surat)}}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4 col-xs-12">Perihal:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<p class="data">{{$disposisi->perihal}}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4 col-xs-12">Sifat:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<p class="data">{{$disposisi->sifat}}</p>
								</div>
							</div>
							<div class="ln_solid"></div>
							<table class="table">
								<thead>
									<th></th>
									<th>Mengetahui</th>
									<th>Menyelesaikan</th>
									<th>Memproses</th>
									<th>Memeriksa</th>
									<th>X</th>
								</thead>
								<tbody>
									<tr style="display: none;">
										<td>PM</td>
										<td><input type="radio" name="PM" class="checkbox" style="width: 50px; margin-left: 10px;" value="Diketahui"></td>
										<td><input type="radio" name="PM" class="checkbox" style="width: 50px; margin-left: 10px;" value="Diselesaikan"></td>
										<td><input type="radio" name="PM" class="checkbox" style="width: 50px; margin-left: 10px;" value="Diproses"></td>
										<td><input type="radio" name="PM" class="checkbox" style="width: 50px; margin-left: 10px;" value="Diperiksa"></td>
									</tr>
									<tr>
										<td>SOM</td>
										<td>
											<?php $checked = ($tugas['SOM']->tugas == 'Diketahui')? 'checked':''; ?>
											<input type="radio" name="SOM" class="checkbox" style="width: 50px; margin-left: 10px;" value="Diketahui" {{$checked}}>
										</td>
										<td>
											<?php $checked = ($tugas['SOM']->tugas == 'Diselesaikan')? 'checked':''; ?>
											<input type="radio" name="SOM" class="checkbox" style="width: 50px; margin-left: 10px;" value="Diselesaikan"  {{$checked}}>
										</td>
										<td>
											<?php $checked = ($tugas['SOM']->tugas == 'Diproses')? 'checked':''; ?>
											<input type="radio" name="SOM" class="checkbox" style="width: 50px; margin-left: 10px;" value="Diproses" {{$checked}}>
										</td>
										<td>
											<?php $checked = ($tugas['SOM']->tugas == 'Diperiksa')? 'checked':''; ?>
											<input type="radio" name="SOM" class="checkbox" style="width: 50px; margin-left: 10px;" value="Diperiksa" {{$checked}}>
										</td>
										<td><button id="SOM" data="SOM" class="btn btn-small btn-danger" type="button">X</button></td>
									</tr>
									<tr>
										<td>SPLEM</td>
										<td>
											<?php $checked = ($tugas['SPLEM']->tugas == 'Diketahui')? 'checked':''; ?>
											<input type="radio" name="SPLEM" class="checkbox" style="width: 50px; margin-left: 10px;" value="Diketahui" {{$checked}}>
										</td>
										<td>
											<?php $checked = ($tugas['SPLEM']->tugas == 'Diselesaikan')? 'checked':''; ?>
											<input type="radio" name="SPLEM" class="checkbox" style="width: 50px; margin-left: 10px;" value="Diselesaikan"  {{$checked}}>
										</td>
										<td>
											<?php $checked = ($tugas['SPLEM']->tugas == 'Diproses')? 'checked':''; ?>
											<input type="radio" name="SPLEM" class="checkbox" style="width: 50px; margin-left: 10px;" value="Diproses" {{$checked}}>
										</td>
										<td>
											<?php $checked = ($tugas['SPLEM']->tugas == 'Diperiksa')? 'checked':''; ?>
											<input type="radio" name="SPLEM" class="checkbox" style="width: 50px; margin-left: 10px;" value="Diperiksa" {{$checked}}>
										</td>
										<td><button id="SPLEM" data="SPLEM" class="btn btn-small btn-danger" type="button">X</button></td>
									</tr>
									<tr>
										<td>SQHSEM</td>
										<td>
											<?php $checked = ($tugas['QHSEM']->tugas == 'Diketahui')? 'checked':''; ?>
											<input type="radio" name="QC" class="checkbox" style="width: 50px; margin-left: 10px;" value="Diketahui" {{$checked}}>
										</td>
										<td>
											<?php $checked = ($tugas['QHSEM']->tugas == 'Diselesaikan')? 'checked':''; ?>
											<input type="radio" name="QC" class="checkbox" style="width: 50px; margin-left: 10px;" value="Diselesaikan"  {{$checked}}>
										</td>
										<td>
											<?php $checked = ($tugas['QHSEM']->tugas == 'Diproses')? 'checked':''; ?>
											<input type="radio" name="QC" class="checkbox" style="width: 50px; margin-left: 10px;" value="Diproses" {{$checked}}>
										</td>
										<td>
											<?php $checked = ($tugas['QHSEM']->tugas == 'Diperiksa')? 'checked':''; ?>
											<input type="radio" name="QC" class="checkbox" style="width: 50px; margin-left: 10px;" value="Diperiksa" {{$checked}}>
										</td>
										<td><button id="QHSEM" data="SOM" class="btn btn-small btn-danger" type="button">X</button></td>
									</tr>
									<tr>
										<td>SEM</td>
										<td>
											<?php $checked = ($tugas['SEM']->tugas == 'Diketahui')? 'checked':''; ?>
											<input type="radio" name="SEM" class="checkbox" style="width: 50px; margin-left: 10px;" value="Diketahui" {{$checked}}>
										</td>
										<td>
											<?php $checked = ($tugas['SEM']->tugas == 'Diselesaikan')? 'checked':''; ?>
											<input type="radio" name="SEM" class="checkbox" style="width: 50px; margin-left: 10px;" value="Diselesaikan"  {{$checked}}>
										</td>
										<td>
											<?php $checked = ($tugas['SEM']->tugas == 'Diproses')? 'checked':''; ?>
											<input type="radio" name="SEM" class="checkbox" style="width: 50px; margin-left: 10px;" value="Diproses" {{$checked}}>
										</td>
										<td>
											<?php $checked = ($tugas['SEM']->tugas == 'Diperiksa')? 'checked':''; ?>
											<input type="radio" name="SEM" class="checkbox" style="width: 50px; margin-left: 10px;" value="Diperiksa" {{$checked}}>
										</td>
										<td><button id="SEM" data="SEM" class="btn btn-small btn-danger" type="button">X</button></td>
									</tr>
									<tr>
										<td>SCARM</td>
										<td>
											<?php $checked = ($tugas['SCARM']->tugas == 'Diketahui')? 'checked':''; ?>
											<input type="radio" name="SCARM" class="checkbox" style="width: 50px; margin-left: 10px;" value="Diketahui" {{$checked}}>
										</td>
										<td>
											<?php $checked = ($tugas['SCARM']->tugas == 'Diselesaikan')? 'checked':''; ?>
											<input type="radio" name="SCARM" class="checkbox" style="width: 50px; margin-left: 10px;" value="Diselesaikan"  {{$checked}}>
										</td>
										<td>
											<?php $checked = ($tugas['SCARM']->tugas == 'Diproses')? 'checked':''; ?>
											<input type="radio" name="SCARM" class="checkbox" style="width: 50px; margin-left: 10px;" value="Diproses" {{$checked}}>
										</td>
										<td>
											<?php $checked = ($tugas['SCARM']->tugas == 'Diperiksa')? 'checked':''; ?>
											<input type="radio" name="SCARM" class="checkbox" style="width: 50px; margin-left: 10px;" value="Diperiksa" {{$checked}}>
										</td>
										<td><button id="SCAM" data="SCARM" class="btn btn-small btn-danger" type="button">X</button></td>
									</tr>
									<tr>
										<td>SAM</td>
										<td>
											<?php $checked = ($tugas['SAM']->tugas == 'Diketahui')? 'checked':''; ?>
											<input type="radio" name="SAM" class="checkbox" style="width: 50px; margin-left: 10px;" value="Diketahui" {{$checked}}>
										</td>
										<td>
											<?php $checked = ($tugas['SAM']->tugas == 'Diselesaikan')? 'checked':''; ?>
											<input type="radio" name="SAM" class="checkbox" style="width: 50px; margin-left: 10px;" value="Diselesaikan"  {{$checked}}>
										</td>
										<td>
											<?php $checked = ($tugas['SAM']->tugas == 'Diproses')? 'checked':''; ?>
											<input type="radio" name="SAM" class="checkbox" style="width: 50px; margin-left: 10px;" value="Diproses" {{$checked}}>
										</td>
										<td>
											<?php $checked = ($tugas['SAM']->tugas == 'Diperiksa')? 'checked':''; ?>
											<input type="radio" name="SAM" class="checkbox" style="width: 50px; margin-left: 10px;" value="Diperiksa" {{$checked}}>
										</td>
										<td><button id="SAM" data="SAM" class="btn btn-small btn-danger" type="button">X</button></td>
									</tr>
									<!-- <tr>
										<td>HSE</td>
										<td><input type="radio" name="HSE" class="checkbox" style="width: 50px; margin-left: 10px;" value="Diketahui"></td>
										<td><input type="radio" name="HSE" class="checkbox" style="width: 50px; margin-left: 10px;" value="Diselesaikan"></td>
										<td><input type="radio" name="HSE" class="checkbox" style="width: 50px; margin-left: 10px;" value="Diproses"></td>
										<td><input type="radio" name="HSE" class="checkbox" style="width: 50px; margin-left: 10px;" value="Diperiksa"></td>
									</tr> -->
									<tr>
										<td>Public Relation</td>
										<td>
											<?php $checked = ($tugas['Public']->tugas == 'Diketahui')? 'checked':''; ?>
											<input type="radio" name="Public" class="checkbox" style="width: 50px; margin-left: 10px;" value="Diketahui" {{$checked}}>
										</td>
										<td>
											<?php $checked = ($tugas['Public']->tugas == 'Diselesaikan')? 'checked':''; ?>
											<input type="radio" name="Public" class="checkbox" style="width: 50px; margin-left: 10px;" value="Diselesaikan"  {{$checked}}>
										</td>
										<td>
											<?php $checked = ($tugas['Public']->tugas == 'Diproses')? 'checked':''; ?>
											<input type="radio" name="Public" class="checkbox" style="width: 50px; margin-left: 10px;" value="Diproses" {{$checked}}>
										</td>
										<td>
											<?php $checked = ($tugas['Public']->tugas == 'Diperiksa')? 'checked':''; ?>
											<input type="radio" name="Public" class="checkbox" style="width: 50px; margin-left: 10px;" value="Diperiksa" {{$checked}}>
										</td>
										<td><button id="Public" data="Public" class="btn btn-small btn-danger" type="button">X</button></td>
									</tr>
								</tbody>
							</table>
							<br>
							<div class="form-group">
								<label class="control-label col-md-1 col-sm-1 col-xs-12">Note :</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<textarea name="note_pm" class="form-control col-md-7 col-xs-12" cols="15" rows="8" required="required">{{$disposisi->note_pm}}</textarea>
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
	$('.btn-small').click(function(){
		var data = $(this).attr('data');
		$('input[name='+data+']').removeAttr('checked');
	})
</script>
@endpush