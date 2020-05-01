<style type="text/css">
	hr {
		width: 250px;
	}
</style>
<div style="border: 3px solid black; width: 420px; font-family: sans-serif;">
	<div>
		<img src="{{asset('public/img/kop.png')}}" style="width: 400px; margin: 10	px; ">
	</div>
	<h4 align="center" style="margin-top: 5px; padding-top: 5px;">PROYEK JALAN TOL BECAKAYU SEKSI 2A UJUNG</h4>

	<table cellspacing="2" style="font-size: 11px;">
		<tr>
			<td>Nomor Agenda</td>
			<td>:</td>
			<td>{{$disposisi->no_agenda}}<hr/></td>
		</tr>
		<tr>
			<td>Pengirim</td>
			<td>:</td>
			<td>{{$disposisi->pengirim}}<hr/></td>
		</tr>
		<tr>
			<td>Kepada</td>
			<td>:</td>
			<td>{{$disposisi->kepada}}<hr/></td>
		</tr>
		<tr>
			<td>Tanggal Terima</td>
			<td>:</td>
			<td>{{formatTanggalPanjang($disposisi->tanggal_terima)}}<hr/></td>
		</tr>
		<tr>
			<td>Nomor Surat</td>
			<td>:</td>
			<td>{{$disposisi->nomor_surat}}<hr/></td>
		</tr>
		<tr>
			<td>Tanggal Surat</td>
			<td>:</td>
			<td>{{$disposisi->tanggal_surat}}<hr/></td>
		</tr>
		<tr>
			<td>Perihal</td>
			<td>:</td>
			<td>{{$disposisi->perihal}}<hr/></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td>
				<div style="display: inline-block;">Penting </div>
				<div style="display: inline-block; margin-left: 40px;">Segera </div>
				<div style="display: inline-block; margin-left: 40px;">Biasa </div>
			</td>
		</tr>
		<tr>
			<td>Sifat</td>
			<td>:</td>
			<td>
				@if($disposisi->sifat == 'Penting')
					<div style="display: inline-block;"><img src="{{ asset("public/img/check.png") }}" style="width: 25px; padding: 5px; border: 1px solid black;"></div>
				@else
					<div style="display: inline-block; width:35px;border: 1px solid black; height: 35px;"></div>
				@endif
				@if($disposisi->sifat == 'Segera')
					<div style="margin-left: 35px;display: inline-block;"><img src="{{ asset("public/img/check.png") }}" style="width: 25px;padding: 5px; border: 1px solid black;"></div>
				@else
					<div style="display: inline-block; width:35px;border: 1px solid black; margin-left: 40px; height: 35px;"></div>
				@endif
				@if($disposisi->sifat == 'Biasa')
					<div style="margin-left: 35px;display: inline-block;"><img src="{{ asset("public/img/check.png") }}" style="width: 25px;padding: 5px; border: 1px solid black;"></div>
				@else
					<div style="display: inline-block; width:35px;border: 1px solid black; margin-left: 35px; height: 35px;"></div>
				@endif
			<td></td>
		</tr>
	</table>
	<div style="width: 418px; height: 0.1px; border: 2px solid black;"></div>
	<h4 align="center" style="margin: 0; padding: 6px;">DISPOSISI SURAT MASUK</h4>
	<div style="width: 418px; height: 0.1px; border: 2px solid black;"></div>
	<br>
	<div>
		<img src="{{ asset('public/img/header_disposisi.png')}}" style="margin-left: 90px; height: 85px; width: 300px; margin-bottom: 0; padding: 0;">
		<table cellpadding="4" style="margin: 0; padding: 0;">
			<tr>
				<td width="50">* PM</td>
				<td>
					<div style="border: 2px solid black; width: 20px; height: 30px; margin: 0; padding-top: 5px;" align="center">
						@if($disposisi->PM == 'Diketahui')
							v
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 20px; height: 30px; margin: 0; padding-top: 5px;" align="center">
						@if($disposisi->PM == 'Diselesaikan')
							v
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 20px; height: 30px; margin: 0; padding-top: 5px;" align="center">
						@if($disposisi->PM == 'Diproses')
							v
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 20px; height: 30px; margin: 0; padding-top: 5px;" align="center">
						@if($disposisi->PM == 'Diperiksa')
							v
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 50px; height: 30px;">
						@if($pm['status'] == 1)
							<?php $dt_pm = getPM('Cuti',$disposisi->id); ?>
							<img src="{{ asset('upload/pegawai/'.$dt_pm->nip.'/paraf.png')}}" style=" height: 27px; width: 47px; margin-bottom: 0; padding: 0;">
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 110px; height: 30px; margin-left: 5px;padding-top: 7px;" align="center">
						@if($pm['status'] == 1)
							<?php $tanggal = explode(' ',$pm['done_at']); ?>
							{{konversi_tanggal($tanggal[0])}}
						@endif
					</div>
				</td>
			</tr>
			<tr>
				<td width="40">* SOM</td>
				<td>
					<div style="border: 2px solid black; width: 20px; height: 30px; margin: 0; padding-top: 5px;" align="center">
						@if($disposisi->SOM == 'Diketahui')
							v
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 20px; height: 30px; margin: 0; padding-top: 5px;" align="center">
						@if($disposisi->SOM == 'Diselesaikan')
							v
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 20px; height: 30px; margin: 0; padding-top: 5px;" align="center">
						@if($disposisi->SOM == 'Diproses')
							v
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 20px; height: 30px; margin: 0; padding-top: 5px;" align="center">
						@if($disposisi->SOM == 'Diperiksa')
							v
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 50px; height: 30px;">
						@if($som['status'] == 1)
							<?php $dt_som = getManager('SO','Disposisi',$disposisi->id); ?>
							<img src="{{ asset('upload/pegawai/'.$dt_som->nip.'/paraf.png')}}" style="height: 27px; width: 47px; margin-bottom: 0; padding: 0;">
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 110px; height: 30px; margin-left: 5px;padding-top: 7px;" align="center">
						@if($som['status'] == 1)
							<?php $tanggal = explode(' ',$som['done_at']); ?>
							{{konversi_tanggal($tanggal[0])}}
						@endif
					</div>
				</td>
			</tr>
			<tr>
				<td width="40">* SPLEM</td>
				<td>
					<div style="border: 2px solid black; width: 20px; height: 30px; margin: 0; padding-top: 5px;" align="center">
						@if($disposisi->SPLEM == 'Diketahui')
							v
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 20px; height: 30px; margin: 0; padding-top: 5px;" align="center">
						@if($disposisi->SPLEM == 'Diselesaikan')
							v
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 20px; height: 30px; margin: 0; padding-top: 5px;" align="center">
						@if($disposisi->SPLEM == 'Diproses')
							v
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 20px; height: 30px; margin: 0; padding-top: 5px;" align="center">
						@if($disposisi->SPLEM == 'Diperiksa')
							v
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 50px; height: 30px;">
						@if($splem['status'] == 1)
							<?php $dt_splem = getManager('SL','Disposisi',$disposisi->id); ?>
							<img src="{{ asset('upload/pegawai/'.$dt_splem->nip.'/paraf.png')}}" style="height: 27px; width: 47px; margin-bottom: 0; padding: 0;">
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 110px; height: 30px; margin-left: 5px;padding-top: 7px;" align="center">
						@if($splem['status'] == 1)
							<?php $tanggal = explode(' ',$splem['done_at']); ?>
							{{konversi_tanggal($tanggal[0])}}
						@endif
					</div>
				</td>
			</tr>
			<tr>
				<td width="40">* SQHSEM</td>
				<td>
					<div style="border: 2px solid black; width: 20px; height: 30px; margin: 0; padding-top: 5px;" align="center">
						@if($disposisi->QC == 'Diketahui')
							v
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 20px; height: 30px; margin: 0; padding-top: 5px;" align="center">
						@if($disposisi->QC == 'Diselesaikan')
							v
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 20px; height: 30px; margin: 0; padding-top: 5px;" align="center">
						@if($disposisi->QC == 'Diproses')
							v
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 20px; height: 30px; margin: 0; padding-top: 5px;" align="center">
						@if($disposisi->QC == 'Diperiksa')
							v
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 50px; height: 30px;">
						@if($qc['status'] == 1)
							<?php $dt_qc = getManager('QHSE','Disposisi',$disposisi->id); ?>
							<img src="{{ asset('upload/pegawai/'.$dt_qc->nip.'/paraf.png')}}" style="height: 27px; width: 47px; margin-bottom: 0; padding: 0;">
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 110px; height: 30px; margin-left: 5px;padding-top: 7px;" align="center">
						@if($qc['status'] == 1)
							<?php $tanggal = explode(' ',$qc['done_at']); ?>
							{{konversi_tanggal($tanggal[0])}}
						@endif
					</div>
				</td>
			</tr>
			<tr>
				<td width="40">* SEM</td>
				<td>
					<div style="border: 2px solid black; width: 20px; height: 30px; margin: 0; padding-top: 5px;" align="center">
						@if($disposisi->SEM == 'Diketahui')
							v
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 20px; height: 30px; margin: 0; padding-top: 5px;" align="center">
						@if($disposisi->SEM == 'Diselesaikan')
							v
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 20px; height: 30px; margin: 0; padding-top: 5px;" align="center">
						@if($disposisi->SEM == 'Diproses')
							v
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 20px; height: 30px; margin: 0; padding-top: 5px;" align="center">
						@if($disposisi->SEM == 'Diperiksa')
							v
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 50px; height: 30px;">
						@if($sem['status'] == 1)
							<?php $dt_sem = getManager('SE','Disposisi',$disposisi->id); ?>
							<img src="{{ asset('upload/pegawai/'.$dt_sem->nip.'/paraf.png')}}" style="height: 27px; width: 47px; margin-bottom: 0; padding: 0;">
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 110px; height: 30px; margin-left: 5px;padding-top: 7px;" align="center">
						@if($sem['status'] == 1)
							<?php $tanggal = explode(' ',$sem['done_at']); ?>
							{{konversi_tanggal($tanggal[0])}}
						@endif
					</div>
				</td>
			</tr>
			<tr>
				<td width="40">* SCARM</td>
				<td>
					<div style="border: 2px solid black; width: 20px; height: 30px; margin: 0; padding-top: 5px;" align="center">
						@if($disposisi->SCARM == 'Diketahui')
							v
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 20px; height: 30px; margin: 0; padding-top: 5px;" align="center">
						@if($disposisi->SCARM == 'Diselesaikan')
							v
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 20px; height: 30px; margin: 0; padding-top: 5px;" align="center">
						@if($disposisi->SCARM == 'Diproses')
							v
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 20px; height: 30px; margin: 0; padding-top: 5px;" align="center">
						@if($disposisi->SCARM == 'Diperiksa')
							v
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 50px; height: 30px;">
						@if($scarm['status'] == 1)
							<?php $dt_scarm = getManager('SC','Disposisi',$disposisi->id); ?>
							<img src="{{ asset('upload/pegawai/'.$dt_scarm->nip.'/paraf.png')}}" style="height: 27px; width: 47px; margin-bottom: 0; padding: 0;">
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 110px; height: 30px; margin-left: 5px;padding-top: 7px;" align="center">
						@if($scarm['status'] == 1)
							<?php $tanggal = explode(' ',$scarm['done_at']); ?>
							{{konversi_tanggal($tanggal[0])}}
						@endif
					</div>
				</td>
			</tr>
			<tr>
				<td width="40">* SAM</td>
				<td>
					<div style="border: 2px solid black; width: 20px; height: 30px; margin: 0; padding-top: 5px;" align="center">
						@if($disposisi->SAM == 'Diketahui')
							v
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 20px; height: 30px; margin: 0; padding-top: 5px;" align="center">
						@if($disposisi->SAM == 'Diselesaikan')
							v
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 20px; height: 30px; margin: 0; padding-top: 5px;" align="center">
						@if($disposisi->SAM == 'Diproses')
							v
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 20px; height: 30px; margin: 0; padding-top: 5px;" align="center">
						@if($disposisi->SAM == 'Diperiksa')
							v
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 50px; height: 30px;">
						@if($sam['status'] == 1)
							<?php $dt_sam = getManager('SA','Disposisi',$disposisi->id); ?>
							<img src="{{ asset('upload/pegawai/'.$dt_sam->nip.'/paraf.png')}}" style="height: 27px; width: 47px; margin-bottom: 0; padding: 0;">
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 110px; height: 30px; margin-left: 5px;padding-top: 7px;" align="center">
						@if($sam['status'] == 1)
							<?php $tanggal = explode(' ',$sam['done_at']); ?>
							{{konversi_tanggal($tanggal[0])}}
						@endif
					</div>
				</td>
			</tr>
			<!-- <tr>
				<td width="40">* HSE</td>
				<td>
					<div style="border: 2px solid black; width: 20px; height: 30px; margin: 0; padding-top: 5px;" align="center">
						@if($disposisi->HSE == 'Diketahui')
							v
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 20px; height: 30px; margin: 0; padding-top: 5px;" align="center">
						@if($disposisi->HSE == 'Diselesaikan')
							v
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 20px; height: 30px; margin: 0; padding-top: 5px;" align="center">
						@if($disposisi->HSE == 'Diproses')
							v
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 20px; height: 30px; margin: 0; padding-top: 5px;" align="center">
						@if($disposisi->HSE == 'Diperiksa')
							v
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 50px; height: 30px;">
						
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 110px; height: 30px; margin-left: 5px;padding-top: 7px;" align="center">
						
					</div>
				</td>
			</tr> -->
			<tr>
				<td width="40">* Public Relation</td>
				<td>
					<div style="border: 2px solid black; width: 20px; height: 30px; margin: 0; padding-top: 5px;" align="center">
						@if($disposisi->HM == 'Diketahui')
							v
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 20px; height: 30px; margin: 0; padding-top: 5px;" align="center">
						@if($disposisi->HM == 'Diselesaikan')
							v
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 20px; height: 30px; margin: 0; padding-top: 5px;" align="center">
						@if($disposisi->HM == 'Diproses')
							v
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 20px; height: 30px; margin: 0; padding-top: 5px;" align="center">
						@if($disposisi->HM == 'Diperiksa')
							v
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 50px; height: 30px;">
						@if($hm['status'] == 1)
							<?php $dt_hm = getPublicRelation('Disposisi',$disposisi->id); ?>
							<img src="{{ asset('upload/pegawai/'.$dt_hm->nip.'/paraf.png')}}" style="height: 27px; width: 47px; margin-bottom: 0; padding: 0;">
						@endif
					</div>
				</td>
				<td>
					<div style="border: 2px solid black; width: 110px; height: 30px; margin-left: 5px;padding-top: 7px;" align="center">
						@if($hm['status'] == 1)
							<?php $tanggal = explode(' ',$hm['done_at']); ?>
							{{konversi_tanggal($tanggal[0])}}
						@endif
					</div>
				</td>
			</tr>
		</table>
		<div style="border: 1px solid black; width: 375px; margin-left: 10px; margin-right: 10px; height: 145px; padding:5px; font-size: 11px;">
			Note:<br>
			{{$disposisi->note_pm}}<br><br>
			{{$disposisi->note}}
		</div>
		<p align="center" style="margin: 0; padding: 0;">Mohon dikembalikan untuk diarsipkan</p>
	</div>
</div>