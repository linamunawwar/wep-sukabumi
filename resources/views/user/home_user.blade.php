@extends('layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

@section('main_container')

    <!-- page content -->
	    <div class="right_col" role="main" style="overflow: hidden;">
	    	<div style="background: #1ABB9C; width: 100%; padding: 20px; margin-top:10px; border-radius: 5px;" >
	    		<h4 style="color: white;">Selamat Datang di Aplikasi <b>Waskita E-Office Project</b>.</h4>
	    	</div>
	    	@if(Auth::user()->pegawai->is_new == 1)
		    	<div style="background: #E7E7E7; width: 100%; padding: 20px; margin-top:10px; border-radius: 5px; color:#2A3F54;" >
		    		<ul>
		    			<li> Silahkan Edit CV anda dengan cara masuk pada menu <u> <a href="{{url('user/pegawai')}}">Pegawai</a></u>, kemudian tekan tombil Edit CV.</li>
		    			<li>Mohon Untuk Selalu mengecek surat masuk yang ada pada icon <i class="fa fa-envelope-o"></i> di pojok kanan atas</li>
		    			<li>Mohon Untuk Selalu mengecek notifikasi penggantian tugas yang ada pada icon <i class="fa fa-user"></i> di pojok kanan atas</li>
		    	</div>
	    	@endif
	    </div>
    <!-- /page content -->
@endsection