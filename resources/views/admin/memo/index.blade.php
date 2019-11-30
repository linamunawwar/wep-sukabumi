@extends('layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

@section('main_container')

    <!-- page content -->
    <div class="right_col" role="main">
    	<div class="row">
			<div class="col-md-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Pesan Internal</small></h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							</li>
							<li><a class="close-link"><i class="fa fa-close"></i></a>
							</li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="col-sm-3" style="padding-bottom: 20px;">
							<a id="compose" class="btn btn-sm btn-success btn-block" href="{{url('admin/memo/create')}}">Pesan Baru</a>
						</div>
						<div class="row">
							<div class="col-sm-12 mail_list_column">
								@if($memos)
								<table style="width: 100%;">
									@foreach($memos as $memo)
										<tr>
											<td>
							 					<a href="{{url('user/memo/detail/'.$memo->id.'')}}">
													<div class="mail_list">
														<div class="left" style="width: 0%;">
															<i class="fa fa-circle"></i>
														</div>
														<div class="right">
															<?php
																$datetime = explode(' ',$memo->waktu);
															?>
															@if($memo->memoPegawai->viewed_at == '0000-00-00 00:00:00')
																<h3>{{$memo->judul}} 
																	<small>{{konversi_tanggal($datetime[0])}} {{$datetime[1]}}</small>
																</h3>
															@else
																<p style="font-size: 15px; margin: 0 0 6px;">{{$memo->judul}} <small style="float: right;color: #ADABAB; font-size: 11px;line-height: 20px;">{{konversi_tanggal($datetime[0])}} {{$datetime[1]}}</small></p>
															@endif
															<div class="pull-right">
																<a class="btn btn-primary btn-xs" href="{{url('admin/memo/edit/'.$memo->id.'')}}"><i class="fa fa-edit"></i>  Edit</a>
																<button data-toggle="modal"  id_memo='{{$memo->id}}' data-target="#DeleteModal" class="btn btn-xs btn-danger" id="modal-delete" onclick='deleteData("{{$memo->id}}")'><i class="fa fa-trash"></i> Delete</button>
															</div>
															@if($memo->cc)
																<p><span class="badge">CC</span> {{$memo->cc}}</p>
															@endif
															<p style="display: inline-block;">{{trim_text($memo->isi,150)}}</p>
														</div>
													</div>
												</a>
											</td>
										</tr>
									@endforeach
								</table>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    <!-- /page content -->
<div id="DeleteModal" class="modal fade text-danger" role="dialog">
   <div class="modal-dialog ">
     <!-- Modal content-->
     <form action="{{ url("admin/memo/delete") }}" id="deleteForm" method="post" >
         <div class="modal-content">
             <div class="modal-header bg-danger">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title text-center">DELETE CONFIRMATION</h4>
             </div>
             <div class="modal-body">
                 {{ csrf_field() }}
                 {{ method_field('DELETE') }}
                 <p class="text-center">Anda yakin ingin menghapus data ini ?</p>
                 <input type="hidden" name="id_memo" id="id_memo">
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
  		var id_memo = $(this).attr('id_memo');
         $('#id_memo').val(id_memo);
     
  	});
     function deleteData(id)
     {
         var id = id;
         var url = '{{ url("admin/memo/delete") }}';
         // url = url.replace(':id', id);
         console.log(id);
         $('#id_memo').val(id);
         $("#deleteForm").attr('action', url);
     }

     function formSubmit()
     {
         $("#deleteForm").submit();
     }
  </script>
 @endpush