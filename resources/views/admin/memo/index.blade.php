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
@endsection