@extends('logistik.layouts.blank')

@push('stylesheets')
    <!-- Example -->
	<!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush
<style>
	#datatable thead tr th {
		text-align: center;
		vertical-align: middle;
		font-family: "Helvetica Neue",Roboto,Arial,"Droid Sans",sans-serif;
		font-size: 13px;
		font-weight: 400;
	}

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
						<h2>Penerimaan Material </h2>
						<ul class="nav navbar-right panel_toolbox">
							<li></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th scope="col"> No </th>
									<th scope="col"> Kode penerimaan </th>
									<th scope="col"> Tanggal </th>
									<th scope="col"> Status </th>
									<th scope="col"> Action </th>
								</tr>
							</thead>
							<tbody>	
                                    <?php $no = 0; ?>
                                    @foreach ($penerimaans as $penerimaan)
                                    <?php $no++; ?>
									<tr>
									<td>{{ $no }}</td>
									<td>{{ $penerimaan->kode_penerimaan }}</td>
									<td>{{ $penerimaan->tanggal }}</td>
									<td style="color:{{ $penerimaan->color }};">{{ $penerimaan->text }}</td>
									<td style="text-align:center;">
										@if($penerimaan->is_pm == 1)
											<a class="btn btn-default btn-xs" title="Download" style="background-color:#0984E3; color:#FFFFFF; padding:0.5em 0.7em 0.5em 0.7em;" href="{{url('Logistik/admin/penerimaan/unduh/'.$penerimaan->id.'')}}"><i class="fa fa-download" style="font-size:15px;"></i>  </a>
										@else
											<a class="btn btn-dark btn-xs" title="Download" style="color:#FFFFFF; padding:0.5em 0.7em 0.5em 0.7em; opacity: 0.5;"><i class="fa fa-download" style="font-size:15px;opacity: 0.5;"></i>  </a>
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
@endsection
@push('scripts')
  <script type="text/javascript">
  	$('#modal-delete').on("click",function(){
  		var id_penerimaan = $(this).attr('id_penerimaan');
         $('#id_penerimaan').val(id_penerimaan);
     
  	});
     function deleteData(id)
     {
         var id = id;
         var url = '{{ url("Logistik/admin/penerimaan/delete") }}';
         // url = url.replace(':id', id);
         console.log(id);
         $('#id_penerimaan').val(id);
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