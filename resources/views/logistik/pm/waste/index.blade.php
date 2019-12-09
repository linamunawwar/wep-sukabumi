@extends('logistik.layouts.blank')

@push('stylesheets')
@endpush

@section('main_container')
    <!-- page content -->
    <div class="right_col" role="main">
    	<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Pengajuan Waste Material </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th scope="col"> Nama Material </th>
									<th scope="col"> Jenis Pekerjaan </th>
                                    <th scope="col"> Periode </th>
									<th scope="col"> Status </th>
									<th scope="col"> Action </th>
								</tr>
							</thead>
							<tbody>								
								@foreach ($wastes as $waste)
									<tr>
									<td>{{ $waste->waste->wasteMaterial->nama }}</td>
									<td>{{ $waste->waste->wasteJenisKerja->nama }}</td>
									<td>{{ periode($waste->waste->periode)}}</td>
                                    @if($waste->is_splem == 0)
                                        <td><span class="label label-default">Not Approved</span></td>
                                        <td style="text-align: left;">
                                            <button class="btn btn-dark btn-xs"><i class="fa fa-download"></i>  Unduh</button>
								       </td>
                                    @elseif(($waste->is_splem == 1) && ($waste->is_sem == 0) && ($waste->is_scarm == 0) && ($waste->is_pm == 0))
                                        <td><span class="label label-success">Approved By SPLEM</span></td>
                                        <td style="text-align: left;">
                                            <button class="btn btn-dark btn-xs"><i class="fa fa-download"></i>  Unduh</button>
                                    @elseif(($waste->is_splem == 1) && ($waste->is_sem == 1) && ($waste->is_scarm == 0) && ($waste->is_pm == 0))
                                        <td>
                                            <span class="label label-success">Approved By SPLEM</span>
                                            <span class="label label-success">Approved By SEM</span>
                                        </td>
                                        <td style="text-align: left;">
                                            <button class="btn btn-dark btn-xs"><i class="fa fa-download"></i>  Unduh</button>
                                       </td>
                                     @elseif(($waste->is_splem == 1) && ($waste->is_sem == 1) && ($waste->is_scarm == 1) && ($waste->is_pm == 0))
                                        <td>
                                            <span class="label label-success">Approved By SPLEM</span>
                                            <span class="label label-success">Approved By SEM</span>
                                            <span class="label label-success">Approved By SCARM</span>
                                        </td>
                                        <td style="text-align: left;">
                                           <button class="btn btn-dark btn-xs"><i class="fa fa-download"></i>  Unduh</button>
                                            <a class="btn btn-success btn-xs" href="{{url('Logistik/pm/waste/approve/'.$waste->id.'')}}"><i class="fa fa-check"></i>  Approve</a>
                                       </td>
                                       @elseif(($waste->is_splem == 1) && ($waste->is_sem == 1) && ($waste->is_scarm == 1) && ($waste->is_pm == 1))
                                        <td>
                                            <span class="label label-success">Approved By SPLEM</span>
                                            <span class="label label-success">Approved By SEM</span>
                                            <span class="label label-success">Approved By SCARM</span>
                                            <span class="label label-primary">Approved By PM</span>
                                        </td>
                                        <td style="text-align: left;">
                                            <a class="btn btn-success btn-xs" href="{{url('Logistik/pm/waste/unduh/'.$waste->id.'')}}"><i class="fa fa-download"></i>  Unduh</a>
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
@endsection
@push('scripts')
  <script type="text/javascript">



  </script>
 @endpush