@extends('logistik.layouts.blank')

@push('stylesheets')
    <!-- Example -->
	<!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush
<style>
	#datatable tbody tr td {
		text-align: center;
		vertical-align: middle;
		font-family: "Helvetica Neue",Roboto,Arial,"Droid Sans",sans-serif;
		font-size: 13px;
		font-weight: 400;
	}
</style>

@section('main_container')

    <!-- page content -->
    <div class="right_col" role="main">
    	<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Permintaan Material</h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a href="{{url('Logistik/pm/permintaan/create')}}"><button class="btn btn-success"> Tambah Data</button></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th scope="col"> No </th>
									<th scope="col"> Kode Permintaan </th>
									<th scope="col"> Nama Peminta </th>
									<th scope="col"> Tanggal </th>
									<th scope="col"> Status </th>
									<th scope="col"> Status Penyerahan</th>
									<th scope="col"> Action </th>
								</tr>
							</thead>
							<tbody>	
								<?php $no = 1 ?>
								@foreach ($permintaans as $permintaan)
									<tr>
										<td>{{ $no++ }}</td>
										<td>{{ $permintaan->kode_permintaan }}</td>
										<td>{{ $permintaan->permintaanUser->name }}</td>
										<td>{{ date('d F Y', strtotime($permintaan->tanggal)) }}</td>
										<td style="color:{{ $permintaan->color }};">
											{{ $permintaan->text }} 
											@if(($permintaan->is_som == '0') || ($permintaan->is_slem == '0') || ($permintaan->is_scarm == '0') || ($permintaan->is_pm == '0'))
												<br>
												<button data-toggle="modal"  id_permintaan='{{$permintaan->id}}' data-target="#NoteModal" class="btn btn-danger btn-xs" style="background-color:#D63031; color:#FFFFFF; padding:0.5em 0.7em 0.5em 0.7em;" id="modal-note" onclick='noteData("{{$permintaan->id}}")'>Note</button>
											@endif
										</td>
										@if ($permintaan->is_datang == 1)
											<td style="color:#0984E3;"> Lengkap, Sesuai </td>
										@elseif($permintaan->is_datang == -1)
											<td style="color:#1AAD19;"> Diterima Dengan Catatan </td>
										@else
											<td style="color:#1AAD19;"> Menunggu Konfirmasi </td>
										@endif	
										<td style="text-align:center;">
											<span><a href="{{ url('Logistik/pm/permintaan/detail/'.$permintaan->id.'') }}" class="btn btn-default btn-xs" title="Detail" style="background-color :{{$permintaan->notifColor}}; color:#FFFFFF; padding:0.5em 0.7em 0.5em 0.7em;"><i class="fa fa-th-list" style="font-size:15px;"></i></a> <sup style="{{$permintaan->notifStyle}}"> <i class="{{$permintaan->notifIcon}}" style='font-size:12px;'> </i> </sup>   </span>
											<a class="btn btn-default btn-xs" title="Edit" style="background-color:#1AAD19; color:#FFFFFF; padding:0.5em 0.7em 0.5em 0.7em;" href="{{url('Logistik/pm/permintaan/edit/'.$permintaan->id.'')}}"><i class="fa fa-pencil" style="font-size:15px;"></i>  </a>
											<button data-toggle="modal" title="Hapus"  id_permintaan='{{$permintaan->id}}' data-target="#DeleteModal" class="btn btn-danger btn-xs" style="background-color:#D63031; color:#FFFFFF; padding:0.5em 0.7em 0.5em 0.7em;" id="modal-delete" onclick='deleteData("{{$permintaan->id}}")'><i class="fa fa-trash" style="font-size:15px;"></i></button>
											@if ($permintaan->is_pm == 1)
											<a class="btn btn-default btn-xs" title="Download" style="background-color:#0984E3; color:#FFFFFF; padding:0.5em 0.7em 0.5em 0.7em;" href="{{url('Logistik/admin/permintaan/unduh/'.$permintaan->id.'')}}"><i class="fa fa-download" style="font-size:15px;"></i>  </a>
											@else
											<a class="btn btn-dark btn-xs" title="Download" style="color:#FFFFFF; padding:0.5em 0.7em 0.5em 0.7em; opacity: 0.5;"><i class="fa fa-download" style="font-size:15px;opacity: 0.5;"></i>  </a>
											@endif

											@if ((\Auth::user()->pegawai->posisi_id == 1) && ($permintaan->is_som == 1) && ($permintaan->is_slem == 1) && ($permintaan->is_scarm == 1) && ($permintaan->is_pm != 1))
												<br><a class="btn btn-default btn-xs" title="Approve" style="background-color:#049372; color:#FFFFFF; padding:0.5em 0.7em 0.5em 0.7em;" href="{{url('Logistik/pm/permintaan/approve/'.$permintaan->id.'')}}"><i class="fa fa-check" title="Approve" style="font-size:15px;"></i> Approve </a>
											@elseif((\Auth::user()->pegawai->posisi_id == 1) && ($permintaan->is_som == 1) && ($permintaan->is_slem == 1) && ($permintaan->is_scarm == 1) && ($permintaan->is_pm == 1))
												<br><a class="btn btn-default btn-xs" title="Approve" style="background-color:#607D8B; color:#FFFFFF; padding:0.5em 0.7em 0.5em 0.7em;"><i class="fa fa-close" style="font-size:15px;"></i> Approve </a>
											@endif
											@if (($permintaan->status_penyerahan == 1) && (\Auth::user()->id == $permintaan->user_id))
											<a class="btn btn-default btn-xs" title="Edit" style="background-color:#1AAD19; color:#FFFFFF; padding:0.5em 0.7em 0.5em 0.7em;" href="{{url('Logistik/admin/permintaan/konfirmasi/'.$permintaan->id.'')}}">Konfirmasi Penyerahan </a>
											@endif
										</td>
									</tr>
								@endforeach							
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
    </div>
	<!-- /page content -->
	<div id="DeleteModal" class="modal fade text-danger" role="dialog">
			<div class="modal-dialog ">
				<!-- Modal content-->
				<form action="{{ url("Logistik/pm/permintaan/delete") }}" id="deleteForm" method="post" >
					<div class="modal-content">
						<div class="modal-header bg-danger">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title text-center">DELETE CONFIRMATION</h4>
						</div>
						<div class="modal-body">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
							<p class="text-center">Anda yakin ingin menghapus data ini ?</p>
							<input type="hidden" name="id_permintaan" id="id_permintaan">
						</div>
						<div class="modal-footer">
							<center>
								<button type="button" class="btn btn-success" data-dismiss="modal">Batal</button>
								<button type="submit" name="" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">Ya, Hapus</button>
							</center>
						</div>
					</div>
				</form>
			</div>
		</div>
@endsection
@push('scripts')
  <script type="text/javascript">
  	$('#modal-delete').on("click",function(){
  		var id_permintaan = $(this).attr('id_permintaan');
         $('#id_permintaan').val(id_permintaan);
     
  	});
     function deleteData(id)
     {
         var id = id;
         var url = '{{ url("Logistik/pm/permintaan/delete") }}';
         // url = url.replace(':id', id);
         console.log(id);
         $('#id_permintaan').val(id);
         $("#deleteForm").attr('action', url);
     }

     function formSubmit()
     {
         $("#deleteForm").submit();
     }

     var table = $('#datatable').DataTable();
		
	// Sort by column 1 and then re-draw
	table
	    .order( [ 5, 'desc' ] )
	    .draw();
  </script>
 @endpush