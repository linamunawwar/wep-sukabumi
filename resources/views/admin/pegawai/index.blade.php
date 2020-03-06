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
						<h2>Daftar Pegawai </h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a href="{{url('admin/pegawai/create')}}"><button class="btn btn-success"> Tambah Data</button></a></li>
						</ul>
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
									<th>Password</th>
									<th>Action</th>
									<th>Status</th>
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
										<td>{{$pegawai->user->pass_asli}}</td>
										<td>
											@if($pegawai->is_new == 1)
												<a class="btn btn-warning btn-xs" href="{{url('admin/pegawai/edit/'.$pegawai->id.'')}}"><i class="fa fa-edit"></i> Edit </a>
											@else
												<a class="btn btn-primary btn-xs" href="{{url('admin/pegawai/edit_cv/'.$pegawai->id.'')}}"><i class="fa fa-edit"></i> Edit CV </a>
												@if($pegawai->is_active == 1)
													<a class="btn btn-success btn-xs" href="{{url('admin/pegawai/unduh_cv/'.$pegawai->id.'')}}"><i class="fa fa-download"></i> CV </a>
													<a class="btn btn-success btn-xs" href="{{url('admin/pegawai/unduh_mcu/'.$pegawai->id.'')}}"><i class="fa fa-download"></i> MCU </a> 
													<a class="btn btn-success btn-xs" href="{{url('admin/pegawai/unduh_pkwt/'.$pegawai->id.'')}}"><i class="fa fa-download"></i> PKWT </a>
												@else
													<a class="btn btn-dark btn-xs"><i class="fa fa-download"></i> CV </a>
													<a class="btn btn-dark btn-xs"><i class="fa fa-download"></i> MCU </a> 
													<a class="btn btn-dark btn-xs"><i class="fa fa-download"></i> PKWT </a>
												@endif
											@endif
												
											<button data-toggle="modal"  nip='{{$pegawai->nip}}' data-target="#DeleteModal" class="btn btn-xs btn-danger" id="modal-delete" onclick='deleteData("{{$pegawai->nip}}")'><i class="fa fa-trash"></i> Delete</button>
										</td>
										<!-- <td style="text-align: center;">
											@if($pegawai->is_verif_admin == 0)
												<span class="label label-default">Not Approved</span>
											@elseif(($pegawai->is_verif_admin == 1) && ($pegawai->is_verif_mngr == 0) && ($pegawai->is_verif_pm == 0))
												<span class="label label-primary">Approved by Admin</span>
											@elseif(($pegawai->is_verif_mngr == 1) && ($pegawai->is_verif_pm == 0))
												<span class="label label-primary">Approved by Admin</span>	
												<span class="label label-success">Approved by Manager</span>
											@elseif($pegawai->is_verif_pm == 1)
												<span class="label label-primary">Approved by Admin</span>	
												<span class="label label-success">Approved by Manager</span>
												<span class="label label-success">Approved by PM</span>
											@endif
										</td> -->
										<td style="text-align: center;">
											@if($pegawai->is_verif_admin == 0)
												<span class="label label-default">Not Approved</span>
											@elseif(($pegawai->is_verif_admin == 1) && ($pegawai->is_verif_pm == 0))
												<!-- <span class="label label-primary">Approved by Admin</span> -->
											@elseif($pegawai->is_verif_admin == -1)
												<span class="label label-danger">Rejected by Admin</span>
											@elseif($pegawai->is_verif_pm == 1)
												<span class="label label-primary">Approved by Admin</span>	
												<!-- <span class="label label-success">Approved by PM</span> -->
											@endif
											<br><br>
											@if(file_exists('upload/pegawai/'.$pegawai->nip.'/'.$pegawai->ttd))
												<img src="{{url('upload/pegawai').'/'.$pegawai->nip.'/'.$pegawai->ttd}}" width="40">
											@else
												Belum ada tanda tangan
											@endif
										</td>
										<td style="text-align: center;">
											<!-- deo minta approval hanya bisa dilakukan sama akun dia -->
											@if(\Auth::user()->pegawai_id == 'SAA10001')
												@if(($pegawai->is_new == 1) || ($pegawai->is_verif_admin != 0))
													<button class="btn btn-dark btn-xs"><i class="fa fa-check"></i>  Approve</button>
												@elseif(($pegawai->is_new == 0) && ($pegawai->is_verif_admin == 0))
													<a class="btn btn-success btn-xs" href="{{url('admin/pegawai/approve/'.$pegawai->id.'')}}"><i class="fa fa-check" ></i>  Pending Approval</a>
													<a class="btn btn-danger btn-xs" href="{{url('admin/pegawai/reject/'.$pegawai->id.'')}}"><i class="fa fa-check" ></i>  Reject</a>
												@endif

												
													<a class="btn btn-success btn-xs" href="{{url('admin/pegawai/update_pkwt/'.$pegawai->id.'')}}"><i class="fa fa-check" ></i>  Update PKWT</a>
												

											@endif
											<a class="btn btn-default btn-xs" href="{{url('admin/pegawai/editrole/'.$pegawai->id.'')}}"><i class="fa fa-edit" ></i>  Edit Role</a>
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
  		console.log('ada');
         console.log(nip);
         $('#nip').val(nip);
     
  	});
     function deleteData(id)
     {
         var id = id;
         var url = '{{ url("admin/pegawai/delete") }}';
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