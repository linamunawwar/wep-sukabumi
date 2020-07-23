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
						<h2>Master Menu </h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a href="{{url('admin/permission/create')}}"><button class="btn btn-success"> Tambah Data</button></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Menu</th>
									<th>Nama Pegawai</th>
									<th>Role</th>
									<th width="15%">Action</th>
								</tr>
							</thead>
							<tbody>
								@php $no = 1; @endphp
								@foreach ($permission as $item)									
									<tr>
										<td><span>{{$no}}</td>
										<td> {{ $item->menu->nama }} </td>
										<td> {{ $item->user->name }} </td>
										<td> {{ $item->menu->default_role }} </td>
										<td> 
											<a href="{{url('admin/permission/update/'.$item->id.'')}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>  Edit</a>
											<button type="button" var="{{ $item->id }}" class="btn btn-xs btn-danger" id="delete"><i class="fa fa-trash"></i> Delete </button>
										</td>
									</tr>
									@php $no++; @endphp
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
    </div>
	<!-- /page content -->
@endsection
@push('scripts')
  <script type="text/javascript">
	$(function() {
		var url_page = '{{url("/admin/permission")}}';

		$('#datatable').on('click','#delete',function(e){
			e.preventDefault();
			var $this = $(this);
			bootbox.confirm({
				size: "small",
				message: "Yakin akan hapus data?",
				callback: function(result){
					if(result) {
						var id = $this.attr('var');
						$.ajax({
							url : url_page+'/delete/'+id,
							type : 'POST',
							data : { id: id, _method: 'POST', _token:'{{csrf_token()}}' },
							success:function(html){
								if(html==1) {
									history.go(0);
								}
							}
						});
					}
				}
			})
		});
	});
  </script>
 @endpush