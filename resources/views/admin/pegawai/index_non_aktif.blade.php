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
						<h2>Daftar Pegawai Non Aktif </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>NIP</th>
									<th>Nama</th>
									<th style="width: 15%;">Jabatan</th>
									<th style="width: 15%;">Mulai Tugas Di Proyek</th>
									<th style="width: 15%;">Terakhir Tugas Di Proyek</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>

								@foreach($pegawais as $pegawai)
									<tr>
										<td>{{$pegawai->nip}}</td>
										<td>{{$pegawai->nama}}</td>
										<td>{{$pegawai->posisi->posisi}}</td>
										<td>{{konversi_tanggal($pegawai->tanggal_masuk)}}</td>
										@if($pegawai->tanggal_keluar)
											<td>{{konversi_tanggal($pegawai->tanggal_keluar)}}</td>
										@else
											<td></td>
										@endif
										<td>
											<button data-toggle="modal"  nip='{{$pegawai->nip}}' data-target="#DeleteModal" class="btn btn-xs btn-danger" id="modal-delete" onclick='deleteData("{{$pegawai->nip}}")'><i class="fa fa-trash"></i> Delete</button>
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
     <form action="{{ url("admin/pegawai/delete") }}" id="deleteForm" method="post" >
         <div class="modal-content">
             <div class="modal-header bg-danger">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title text-center">DELETE CONFIRMATION</h4>
             </div>
             <div class="modal-body">
                 {{ csrf_field() }}
                 {{ method_field('DELETE') }}
                 <p class="text-center">Anda yakin ingin menghapus data ini ?</p>
                 <input type="hidden" name="nip" id="nip">
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

    <!-- /page content -->
@endsection
@push('scripts')
  <script type="text/javascript">
  	$('#modal-delete').on("click",function(){
  		var nip = $(this).attr('nip');
         $('#nip').val(nip);
     
  	});
     function deleteData(id)
     {
         var id = id;
         var url = '{{ url("admin/pegawai_non_aktif/delete") }}';
         // url = url.replace(':id', id);
         console.log(id);
         $('#nip').val(id);
         $("#deleteForm").attr('action', url);
     }

     function formSubmit()
     {
         $("#deleteForm").submit();
     }
  </script>
 @endpush