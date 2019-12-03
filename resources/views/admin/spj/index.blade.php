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
						<h2>Daftar Pengajuan SPJ Pegawai</h2>
						<ul class="nav navbar-right panel_toolbox">
							<li style="display: none;"><a href="{{url('admin/spj/create')}}"><button class="btn btn-primary"> <i class="fa fa-plus"></i>  Tambah Data</button></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>NIP</th>
									<th>Nama</th>
									<th>Tanggal Berangkat</th>
									<th>Tanggal Pulang</th>
									<th>Keperluan</th>
									<th>Tanggal Pengajuan</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($spjs as $spj)
									<tr>
										<td>{{$spj->nip}}</td>
										<td>{{$spj->pegawai->nama}}</td>
										<td>{{konversi_tanggal($spj->tanggal_berangkat)}}</td>
										<td>{{konversi_tanggal($spj->tanggal_pulang)}}</td>
										<td>{{$spj->keperluan}}</td>
										<td data-sort="{{strtotime($spj->created_at)}}">
											<?php
												$date = explode(' ', $spj->created_at);
											?>
											{{konversi_tanggal($date[0])}}
										</td>
										@if(($spj->is_verif_sdm == 1) && ($spj->is_verif_admin == 1))
											<td style="text-align: center;">
												<span class="label label-success">Approved By Admin</span>
												<span class="label label-primary">Approved By SDM</span>
											</td>
											<td style="text-align: left;">
												<a class="btn btn-dark btn-xs"><i class="fa fa-check"></i>  Approve</a > 
												<a class="btn btn-success btn-xs" href="{{url('admin/spj/unduh/'.$spj->id.'')}}"><i class="fa fa-download"></i>  Unduh</a>
												<button data-toggle="modal"  id_spj='{{$spj->id}}' data-target="#DeleteModal" class="btn btn-xs btn-danger" id="modal-delete" onclick='deleteData("{{$spj->id}}")'><i class="fa fa-trash"></i> Delete</button>
											</td>
										@elseif(($spj->is_verif_sdm == 0) && ($spj->is_verif_admin == 1))
											<td style="text-align: center;"><span class="label label-success">Approved By Admin</span></td>
											<td style="text-align: left;">
												<a class="btn btn-dark btn-xs"><i class="fa fa-check"></i>  Approve</a > 
												<a class="btn btn-dark btn-xs"><i class="fa fa-download"></i>  Unduh</a>
												<button data-toggle="modal"  id_spj='{{$spj->id}}' data-target="#DeleteModal" class="btn btn-xs btn-danger" id="modal-delete" onclick='deleteData("{{$spj->id}}")'><i class="fa fa-trash"></i> Delete</button>
											</td>
										@else
											<td style="text-align: center;"><span class="label label-default">Not Approved</span></td>
											<td style="text-align: left;">
												<a class="btn btn-success btn-xs" href="{{url('admin/spj/approve/'.$spj->id.'')}}"><i class="fa fa-check"></i>  Approve</a > 
												<a class="btn btn-dark btn-xs"><i class="fa fa-download"></i>  Unduh</a>
												<button data-toggle="modal"  id_spj='{{$spj->id}}' data-target="#DeleteModal" class="btn btn-xs btn-danger" id="modal-delete" onclick='deleteData("{{$spj->id}}")'><i class="fa fa-trash"></i> Delete</button>
											</td>
										@endif

										
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
     <form action="{{ url("admin/spj/delete") }}" id="deleteForm" method="post" >
         <div class="modal-content">
             <div class="modal-header bg-danger">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title text-center">DELETE CONFIRMATION</h4>
             </div>
             <div class="modal-body">
                 {{ csrf_field() }}
                 {{ method_field('DELETE') }}
                 <p class="text-center">Anda yakin ingin menghapus data ini ?</p>
                 <input type="hidden" name="id_spj" id="id_spj">
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
  		var id_spj = $(this).attr('id_spj');
         $('#id_spj').val(id_spj);
     
  	});
     function deleteData(id)
     {
         var id = id;
         var url = '{{ url("admin/spj/delete") }}';
         // url = url.replace(':id', id);
         console.log(id);
         $('#id_spj').val(id);
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