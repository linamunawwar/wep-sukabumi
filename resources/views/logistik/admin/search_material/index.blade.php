@extends('logistik.layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

<style>
	#SearchMaterial thead tr th {
		text-align: center;
		vertical-align: middle;
		font-family: "Helvetica Neue",Roboto,Arial,"Droid Sans",sans-serif;
		font-size: 13px;
		font-weight: 400;
	}

	#SearchMaterial tbody tr td {
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
						<h2>Material / Bahan </h2>
						<ul class="nav navbar-right panel_toolbox">
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="SearchMaterial" class="table table-striped table-bordered" style="text-align: center">
							<thead>
								<tr>
									<th style="text-align: center"> Kode Material </th>
									<th style="text-align: center"> Nama Material </th>
									<th style="text-align: center"> Satuan Material </th>
									<th style="text-align: center"> Total Stok </th>
									<th style="text-align: center"> Keterangan </th>
									<th style="text-align: center"> Action </th>
								</tr>
							</thead>
							<tbody>								
								@foreach ($materials as $material)
									<tr>
										<td>{{ $material->kode_material }}</td>
										<td>{{ $material->nama }}</td>
										<td>{{ $material->satuan }}</td>
										<td>{{ $material->jumlahStok }}</td>
										<td>{{ $material->keterangan }}</td>
										<td style="text-align:center;">
											<a class="btn btn-default btn-xs" title="Detail" style="background-color:#FF9800; color:#FFFFFF; padding:0.5em 0.7em 0.3em 0.7em;" href="{{ url('Logistik/admin/search_material/detail/'.$material->id.'') }}"><i class="fa fa-th-list" style="font-size:15px;"></i>
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
	
@endsection
@push('scripts')
  <script type="text/javascript">
    $('#SearchMaterial').DataTable({
        "aLengthMenu": [ [100, 200, 300, 400], [100, 200, 300, 400] ],
        "iDisplayLength" : 100,    
    });
  </script>
 @endpush