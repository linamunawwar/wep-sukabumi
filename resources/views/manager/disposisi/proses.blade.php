@extends('layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
    <style type="text/css">
    	.data{
    		padding: 6px 12px;
    	}
    </style>
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
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Nomor Agenda <span class="required">*</span>:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">{{$disposisi->no_agenda}}</p>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12">Sifat:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">{{strtoupper($disposisi->sifat)}}</p>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Pengirim <span class="required">*</span>:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">{{$disposisi->pengirim}}</p>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12">Perihal:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">{{$disposisi->perihal}}</p>
										</div>
									</div>
								</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Kepada <span class="required">*</span>:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data">{{$disposisi->kepada}}</p>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12">Tugas:</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="data" style="font-size: 15px;"><b>{{$disposisi->tugas}}</b></p>
										</div>
									</div>
								</div>
							<div class="form-group">
								<label for="tanggal" class="control-label col-md-2 col-sm-2 col-xs-12">Tanggal Terima *:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<p class="data">{{konversi_tanggal($disposisi->tanggal_terima)}}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12" for="nama">Nomor Surat <span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<p class="data">{{$disposisi->no_surat}}</p>
								</div>
							</div>
							<div class="form-group">
								<label for="tanggal" class="control-label col-md-2 col-sm-2 col-xs-12">Tanggal Surat *:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<p class="data">{{konversi_tanggal($disposisi->tanggal_surat)}}</p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12">Surat Perintah *:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<br>
									<b><a href='{{url("upload/surat_masuk/".$disposisi->surat->file_surat."")}}' class="col-md-7 col-xs-12" target="_blank">
										<i class="fa fa-search-plus"></i>&nbsp&nbsp&nbspPreview
									</a></b>
									<iframe style="display: none;" src ="{{asset('vendor')}}/ViewerJS/#../../upload/surat_masuk/{{$disposisi->surat->file_surat}}" width='724' height='1024'	 allowfullscreen webkitallowfullscreen>
									</iframe>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12">Note :</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<textarea name="alasan" class="form-control col-md-7 col-xs-12" cols="15" rows="8" readonly="readonly">{{$disposisi->note}}</textarea>
								</div>
							</div>
							
							
							
							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
									<button class="btn btn-primary" type="button">Cancel</button>
									<button class="btn btn-primary" type="reset">Reset</button>
									<button type="submit" class="btn btn-success">Selesai</button>
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