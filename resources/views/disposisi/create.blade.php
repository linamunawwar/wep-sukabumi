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
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nomor Agenda <span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="alasan" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Pengirim <span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="alasan" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Kepada <span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="alasan" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="form-group">
								<label for="tanggal" class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Terima *:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<fieldset>
										<div class="control-group">
											<div class="controls">
												<div class="col-md-11 xdisplay_inputx form-group has-feedback">
													<input type="text" class="form-control has-feedback-left" id="single_cal1" placeholder="Tanggal" name="tanggal" aria-describedby="inputSuccess2Status">
													<span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
										 			<span id="inputSuccess2Status" class="sr-only">(success)</span>
												</div>
											</div>
										</div>
									</fieldset>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nomor Surat <span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select class="form-control col-md-7 col-xs-12">
										<option value="0">Pilih Surat</option>
										<option value="SA150795">SM/WK/II/12/2019</option>
										<option value="SL170793">SM/WK/II/12/2019</option>
										<option value="HS1506795">SM/WK/II/12/2019</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="tanggal" class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Surat *:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<fieldset>
										<div class="control-group">
											<div class="controls">
												<div class="col-md-11 xdisplay_inputx form-group has-feedback">
													<input type="text" class="form-control has-feedback-left" id="single_cal1" placeholder="Tanggal" name="tanggal" aria-describedby="inputSuccess2Status">
													<span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
										 			<span id="inputSuccess2Status" class="sr-only">(success)</span>
												</div>
											</div>
										</div>
									</fieldset>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Perihal:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<textarea name="alasan" class="form-control col-md-7 col-xs-12"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Sifat:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="radio" checked="" name="sifat" value="penting" style="margin: 12px;">Penting
									<input type="radio" checked="" name="sifat" value="segera" style="margin: 12px;">Segera
									<input type="radio" checked="" name="sifat" value="biasa" style="margin: 12px;">Biasa

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
								</thead>
								<tbody>
									<tr>
										<td>KAPRO</td>
										<td><input type="checkbox" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="checkbox" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="checkbox" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="checkbox" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
									</tr>
									<tr>
										<td>KALAP</td>
										<td><input type="checkbox" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="checkbox" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="checkbox" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="checkbox" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
									</tr>
									<tr>
										<td>KASIE LOGLAT</td>
										<td><input type="checkbox" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="checkbox" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="checkbox" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="checkbox" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
									</tr>
									<tr>
										<td>QUALITY CONTROL</td>
										<td><input type="checkbox" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="checkbox" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="checkbox" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="checkbox" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
									</tr>
									<tr>
										<td>KASIE TEKNIK</td>
										<td><input type="checkbox" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="checkbox" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="checkbox" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="checkbox" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
									</tr>
									<tr>
										<td>KASIE ADKON</td>
										<td><input type="checkbox" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="checkbox" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="checkbox" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="checkbox" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
									</tr>
									<tr>
										<td>KASIE KSDM</td>
										<td><input type="checkbox" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="checkbox" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="checkbox" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="checkbox" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
									</tr>
									<tr>
										<td>KASIE K3LP</td>
										<td><input type="checkbox" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="checkbox" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="checkbox" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="checkbox" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
									</tr>
									<tr>
										<td>HUMAS</td>
										<td><input type="checkbox" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="checkbox" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="checkbox" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
										<td><input type="checkbox" name="kapro[]" class="checkbox" style="width: 50px; margin-left: 10px;"></td>
									</tr>
								</tbody>
							</table>
							<br>
							<div class="form-group">
								<label class="control-label col-md-1 col-sm-1 col-xs-12">Note :</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<textarea name="alasan" class="form-control col-md-7 col-xs-12" cols="15" rows="8"></textarea>
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