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
						<h2>Arsip </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Nama Form</th>
									<th>Bagian</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($arsips as $arsip)
									<tr>
										<td>{{$arsip->nama_form}}</td>
										<td>
											@if(($arsip->PM == 'on') && ($arsip->SO == 'on') && ($arsip->SC == 'on') && ($arsip->SA == 'on') && ($arsip->SE == 'on') && ($arsip->SL == 'on') && ($arsip->HS == 'on') && ($arsip->QC == 'on'))
												Semua Bagian
											@else
												@if($arsip->PM == 'on')
													PM
												@endif
												@if($arsip->SO == 'on')
													SO
												@endif
												@if($arsip->SC == 'on')
													SC
												@endif
												@if($arsip->SA == 'on')
													SA
												@endif
												@if($arsip->SE == 'on')
													SE
												@endif
												@if($arsip->SL == 'on')
													SL
												@endif
												@if($arsip->HS == 'on')
													HS
												@endif
												@if($arsip->QC == 'on')
													QC
												@endif
											@endif
										</td>
										<td style="text-align: left;">
											<a  href="{{url('/')}}/upload/arsip/{{$arsip->nama_file}}" class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Form</a >
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