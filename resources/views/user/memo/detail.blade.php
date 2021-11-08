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
						<h2>Memo</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<h3>{{$memo->judul}}</h3>
						<br>
						cc : {{$memo->cc}}
						<br><br>
						<p>{{$memo->isi}}</p>
						<br>
						@if($memo->nama_file)
							<h4>Lampiran</h4>
							<iframe src ="https://docs.google.com/viewer?url={{url('/')}}/upload/memo/{{$memo->nama_file}}&embedded=true" width='724' height='1024'	 allowfullscreen webkitallowfullscreen>
						@endif
						<br>
						<?php
							$datetime = explode(' ',$memo->waktu);
						?>
						<small>{{konversi_tanggal($datetime[0])}} {{$datetime[1]}}</small>
					</div>
				</div>
			</div>
		</div>
    </div>
    <!-- /page content -->
@endsection