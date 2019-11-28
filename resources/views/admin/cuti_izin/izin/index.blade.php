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
						<h2>Daftar Pegawai Izin </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>NIP</th>
									<th>Nama</th>
									<th>Jabatan</th>
									<th>Mulai Izin</th>
									<th>Selesai Izin</th>
									<th>Tanggal Pengajuan</th>
									<th>Status Izin</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($izins as $izin)
									<tr>
										<td>{{$izin->nip}}</td>
										<td>{{$izin->pegawai->nama}}</td>
										<td>{{$izin->pegawai->posisi->posisi}}</td>
										<td>{{konversi_tanggal($izin->tanggal_mulai)}}</td>
										<td>{{konversi_tanggal($izin->tanggal_selesai)}}</td>
										<td>
											<?php
												$date = explode(' ', $izin->created_at);
											?>
											{{konversi_tanggal($date[0])}}
										</td>
										<td>
											@if(($izin->is_verif_mngr == 1) && ($izin->is_verif_sdm == 1))
												<span class="label label-primary">Approved By Manager</span>
												<span class="label label-success">Approved By SDM</span>
											@elseif(($izin->is_verif_mngr == 1) && ($izin->is_verif_sdm == 0))
												<span class="label label-primary">Approved By Manager</span>
											@else
												<span class="label label-default">Not Approved</span>
											@endif
										</td>
										<td style="text-align: left;">
											@if($izin->is_verif_sdm == 1)
												<a href="{{'izin/surat_izin/'.$izin->id.''}}" class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Unduh</a>
											@else
												<a class="btn btn-dark btn-xs"><i class="fa fa-download"></i>  Unduh</a>
											@endif
											<button data-toggle="modal"  id_izin='{{$izin->id}}' data-target="#DeleteModal" class="btn btn-xs btn-danger" id="modal-delete" onclick='deleteData("{{$izin->id}}")'><i class="fa fa-trash"></i> Delete</button>
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
     <form action="{{ url("admin/izin/delete") }}" id="deleteForm" method="post" >
         <div class="modal-content">
             <div class="modal-header bg-danger">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title text-center">DELETE CONFIRMATION</h4>
             </div>
             <div class="modal-body">
                 {{ csrf_field() }}
                 {{ method_field('DELETE') }}
                 <p class="text-center">Anda yakin ingin menghapus data ini ?</p>
                 <input type="hidden" name="id_izin" id="id_izin">
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
  		var id_izin = $(this).attr('id_izin');
         $('#id_izin').val(id_izin);
     
  	});
     function deleteData(id)
     {
         var id = id;
         var url = '{{ url("admin/izin/delete") }}';
         // url = url.replace(':id', id);
         console.log(id);
         $('#id_izin').val(id);
         $("#deleteForm").attr('action', url);
     }

     function formSubmit()
     {
         $("#deleteForm").submit();
     }
  </script>
 @endpush