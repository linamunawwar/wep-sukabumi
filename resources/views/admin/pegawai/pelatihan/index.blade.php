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
						<h2>Monitoring Pelatihan </h2>
						<ul class="nav navbar-right panel_toolbox">
							<a href="{{url('admin/pegawai/pelatihan/create')}}"><button class="btn btn-success"> Tambah Data</button></a>
						</ul>
						<br><br>
						<form action="{{url('admin/pegawai/pelatihan/unduh')}}" method="POST">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="row">
								<div class="col-md-2">
									<?php
									  // Sets the top option to be the current year. (IE. the option that is chosen by default).
									  $currently_selected = date('Y'); 
									  // Year to start available options at
									  $earliest_year = $currently_selected - 5; 
									  // Set your latest year you want in the range, in this case we use PHP to just set it to the current year.
									  $latest_year = date('Y'); 

									  print '<select class="form-control tahun" name="tahun" required="required">';
									  print '<option value="">Pilih Tahun</option>';
									  print '<option value="all">Semua</option>';
									  // Loops over each int[year] from current year, back to the $earliest_year [1950]
									  foreach ( range( $latest_year, $earliest_year ) as $i ) {
									    // Prints the option with the next year in range.
									    print '<option value="'.$i.'"'.($i === $currently_selected ? ' selected="selected"' : '').'>'.$i.'</option>';
									  }
									  print '</select>';
									  ?>
								</div>
								<div class="col-md-6">
									<button class="btn btn-primary" type="submit"> Unduh</button>
								</div>
							</div>
						</form>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>NIP</th>
									<th>Nama</th>
									<th>Jabatan</th>
									<th>Nama Pelatihan</th>
									<th>Tanggal Mulai Pelatihan</th>
									<th>Tanggal Berakhirnya Pelatihan</th>
									<th>Tempat Pelaksanaan</th>
									<th>Penyelenggara</th>
									<th>NO IM</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@if(count($pelatihans) != 0)
									@foreach($pelatihans as $pelatihan)
										<tr>
											<td>{{$pelatihan->nip}}</td>
											<td>{{$pelatihan->pegawai->nama}}</td>
											<td>{{$pelatihan->pegawai->posisi->posisi}}</td>
											<td>{{$pelatihan->nama_pelatihan}}</td>
											<td>{{konversi_tanggal($pelatihan->tanggal_mulai)}}</td>
											<td>{{konversi_tanggal($pelatihan->tanggal_selesai)}}</td>
											<td>{{$pelatihan->tempat}}</td>
											<td>{{$pelatihan->penyelenggara}}</td>
											<td>{{$pelatihan->no_im}}</td>
											<td>
												<a href="{{'pelatihan/edit/'.$pelatihan->id.''}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i>  Edit</a>
												<a href="{{'pelatihan/delete/'.$pelatihan->id.''}}" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>  Delete</a>
											</td>
										</tr>
									@endforeach
								@endif
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
    </div>
    <!-- /page content -->
@endsection