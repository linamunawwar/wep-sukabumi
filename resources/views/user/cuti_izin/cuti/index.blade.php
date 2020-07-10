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
						<h2>Daftar Cuti Pegawai </h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a href="{{url('user/cuti/create')}}"><button class="btn btn-success"> Tambah Data</button></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Mulai Cuti</th>
									<th>Selesai Cuti</th>
									<th>Status Cuti</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($cutis as $cuti)
								<tr>
									<td>{{konversi_tanggal($cuti->tanggal_mulai)}}</td>
									<td>{{konversi_tanggal($cuti->tanggal_selesai)}}</td>
									<td>
										@if($cuti->is_verif_pengganti == 0)
												<span class="label label-default">Not Approved</span>
											@endif
										@if($cuti->is_verif_pengganti == 1)
												<span class="label label-primary">Approved by Pengganti</span>
											@endif
											@if($cuti->is_verif_admin == 1)
												<span class="label label-warning">Approved by Admin</span>
											@endif
											@if($cuti->is_verif_mngr == 1)
												<span class="label label-primary">Approved by Manager</span>
											@endif
											@if($cuti->is_verif_sdm == 1)	
												<span class="label label-success">Approved by SDM</span>
											@endif
											@if($cuti->is_verif_pm == 1)
												<span class="label label-success">Approved by PM</span>
											@endif
									</td>
									<td style="text-align: center;">
										@if($cuti->is_verif_pm == 1)
											<a class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Surat Cuti</a>
										@else
											<a class="btn btn-dark btn-xs"><i class="fa fa-download"></i>  Surat Cuti</a>
										@endif
										<!-- <button data-toggle="modal"  id_cuti='{{$cuti->id}}' data-target="#DeleteModal" class="btn btn-xs btn-danger" id="modal-delete" onclick='deleteData("{{$cuti->id}}")'><i class="fa fa-trash"></i> Delete</button> -->
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
                 <input type="hidden" name="id_cuti" id="id_cuti">
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
  		var id_cuti = $(this).attr('id_cuti');
         $('#id_cuti').val(id_cuti);
     
  	});
     function deleteData(id)
     {
         var id = id;
         var url = '{{ url("user/cuti/delete") }}';
         // url = url.replace(':id', id);
         console.log(id);
         $('#id_cuti').val(id);
         $("#deleteForm").attr('action', url);
     }

     function formSubmit()
     {
         $("#deleteForm").submit();
     }
  </script>
 @endpush