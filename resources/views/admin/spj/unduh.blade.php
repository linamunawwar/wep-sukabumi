<style type="text/css">
	@page { margin-bottom: 10px; }
body { margin-bottom: 10px; }
</style>
<?php
	$date1 = date_create($spj->tanggal_berangkat);
	$date2 = date_create($spj->tanggal_pulang);
	$diff = date_diff($date2,$date1);
?>

<div style="font-family: sans-serif;">
	<table style="font-size: 10.5px; width: 680px;" cellspacing="0" cellpadding="2">
		<tr>
			<td><img src="{{asset('public/img/Waskita.png')}}" style="width: 45px; height: 40px; margin-bottom: 5px; "></td>
			<td></td>
			<td colspan="7"><p align="right" style="display: inline-block; float: right;margin-top: 30px;">Nomor SPPD : {{$spj->no_sppd}}</p></td>
		</tr>
		<tr>
			<td align="center" style="border: 2px solid black; text-align: center;" colspan="9"><h4 style="padding-left: 120px; margin:0;">FORMULIR SURAT PERINTAH PERJALANAN DINAS</h4></td>
		</tr>
		<tr>
			<td style="margin-top: 20px;" colspan="9"><b>PEMBERI TUGAS</b></td>
		</tr>
		<tr>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 10px; width: 180px;">Nama Lengkap</td>
			<td style="border: 0.5px solid black; border-right: 0; border-left: 0; width: 5px;">:</td>
			<td style="border: 0.5px solid black; border-left: 0;" colspan="7">{{$spj->pegawaiTugas->nama}}</td>
		</tr>
		<tr>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px;">Jabatan</td>
			<td style="border: 0.5px solid black; border-right: 0; border-left: 0; width: 5px;">:</td>
			<td style="border: 0.5px solid black; border-left: 0;" colspan="7">{{$spj->pegawaiTugas->posisi->posisi}}</td>
		</tr>
		<tr>
			<td colspan="9" style="height: 5px;"></td>
		</tr>
		<tr>
			<td style="margin-top: 20px;" colspan="9"><b>DENGAN INI MENUGASKAN KEPADA</b></td>
		</tr>
		<tr>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px;">No. Pegawai</td>
			<td style="border: 0.5px solid black; border-right: 0; border-left: 0; width: 5px;">:</td>
			<td style="border: 0.5px solid black; border-left: 0;" colspan="7">{{$spj->nip}}</td>
		</tr>
		<tr>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px;">Nama Lengkap</td>
			<td style="border: 0.5px solid black; border-right: 0; border-left: 0; width: 5px;">:</td>
			<td style="border: 0.5px solid black; border-left: 0;" colspan="7">{{$spj->pegawai->nama}}</td>
		</tr>
		<tr>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px;">Jabatan</td>
			<td style="border: 0.5px solid black; border-right: 0; border-left: 0; width: 5px;">:</td>
			<td style="border: 0.5px solid black; border-left: 0;" colspan="7">{{$spj->pegawai->posisi->posisi}}</td>
		</tr>
		<tr>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px;">Departemen / Divisi</td>
			<td style="border: 0.5px solid black; border-right: 0; border-left: 0; width: 5px;">:</td>
			<td style="border: 0.5px solid black; border-left: 0;" colspan="7">{{$spj->pegawaiTugas->posisi->posisi}}</td>
		</tr>
		<tr>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px;">Maksud Perjalanan Dinas</td>
			<td style="border: 0.5px solid black; border-right: 0; border-left: 0; width: 5px;">:</td>
			<td style="border: 0.5px solid black; border-left: 0;" colspan="7">{{$spj->keperluan}}</td>
		</tr>
		<tr>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px;">Kota / Tempat Tujuan</td>
			<td style="border: 0.5px solid black; border-right: 0; border-left: 0; width: 5px;">:</td>
			<td style="border: 0.5px solid black; border-left: 0;" colspan="7">{{$spj->tujuan}}</td>
		</tr>
		<tr>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px;">Lamanya Perjalanan Dinas (Hari)</td>
			<td style="border: 0.5px solid black; border-right: 0; border-left: 0; width: 5px;">:</td>
			<td style="border: 0.5px solid black; border-left: 0;" colspan="7">{{$spj->tujuan}}</td>
		</tr>
		<tr>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px;">Tanggal Berangkat</td>
			<td style="border: 0.5px solid black; border-right: 0; border-left: 0; width: 5px;">:</td>
			<td style="border: 0.5px solid black; border-left: 0; border-right: 0; width: 175px;">{{konversi_tanggal($spj->tanggal_berangkat)}}</td>
			<td style="border: 0.5px solid black; border-left: 0; border-right: 0; width: 45px; color: white;">-</td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; width: 80px;">Tanggal Pulang</td>
			<td style="border: 0.5px solid black; width: 2px; border-left: 0; border-right: 0;">:</td>
			<td style="border: 0.5px solid black; border-left: 0; text-align: left;" align="left" colspan="3">{{konversi_tanggal($spj->tanggal_pulang)}}</td>
		</tr>
		<tr>
			<td colspan="9" style="height: 10px;"></td>
		</tr>
		<tr>
			<td style="margin-top: 20px;" colspan="9"><b>TRANSPORTASI YANG DIGUNAKAN</b></td>
		</tr>
		<tr>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; height: 20px;" colspan="2">
				<div style="margin-left: 30px;">
					@if($spj->angkutan == 'pesawat')
						<div style="width: 10px; height: 10px; border: 0.5px solid black; display: inline-block; text-align: center; padding-bottom: 2px;"><b>v</b></div>
					@else
						<div style="width: 10px; height: 10px; border: 0.5px solid black; display: inline-block; text-align: center; padding-bottom: 2px;"></div>
					@endif
					<p style="display: inline-block; margin: 0; padding: 0;">Pesawat Terbang</p>
				</div>
			</td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px;" >
				<div style="margin-left: 30px;">
					@if($spj->angkutan == 'kereta')
						<div style="width: 10px; height: 10px; border: 0.5px solid black; display: inline-block; text-align: center; padding-bottom: 2px;"><b>v</b></div>
					@else
						<div style="width: 10px; height: 10px; border: 0.5px solid black; display: inline-block; text-align: center; padding-bottom: 2px;"></div>
					@endif
					<p style="display: inline-block; margin: 0; padding: 0;">Kereta Api / Bus / Travel</p>
				</div>
			</td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px;" colspan="4">
				<div style="margin-left: 30px;">
					@if($spj->angkutan == 'dinas')
						<div style="width: 10px; height: 10px; border: 0.5px solid black; display: inline-block; text-align: center; padding-bottom: 2px;"><b>v</b></div>
					@else
						<div style="width: 10px; height: 10px; border: 0.5px solid black; display: inline-block; text-align: center; padding-bottom: 2px;"></div>
					@endif
					<p style="display: inline-block; margin: 0; padding: 0;">Kendaraan Dinas</p>
				</div>
			</td>
			<td style="border: 0.5px solid black; margin-left: 5px;" colspan="2">
				<div style="margin-left: 15px;">
					@if($spj->angkutan == 'pribadi')
						<div style="width: 10px; height: 10px; border: 0.5px solid black; display: inline-block; text-align: center; padding-bottom: 2px;"><b>v</b></div>
					@else
						<div style="width: 10px; height: 10px; border: 0.5px solid black; display: inline-block; text-align: center; padding-bottom: 2px;"></div>
					@endif
					<p style="display: inline-block; margin: 0; padding: 0;">Kendaraan Pribadi</p>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="3" style="border: 0.5px solid black; border-right: 0;"></td>
			<td style="border: 0.5px solid black; border-right: 0;" colspan="4">No. Pol:</td>
			<td style="border: 0.5px solid black; text-align: left;" colspan="2" align="left">No. Pol:</td>
		</tr>
		<tr>
			<td colspan="9" style="height: 10px;"></td>
		</tr>
		<tr>
			<td colspan="9"><b>UANG PERJALANAN DINAS</b> dan <b>PEMBEBANAN ANGGARAN</b></td>
		</tr>
		<tr>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: center;">URAIAN</td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: center;" colspan="2">Perhitungan</td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: center;" colspan="2">Dalam Negeri (Rp)</td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: center;" colspan="3">Luar Negeri </td>
			<td style="border: 0.5px solid black; text-align: center;">Keterangan</td>
		</tr>
		<tr>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: left;">A. Pejabat/ Staff</td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: center;" colspan="2"></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: center;" colspan="2"></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: center;" colspan="3"> </td>
			<td style="border: 0.5px solid black; text-align: center;"></td>
		</tr>
		<tr>
			<td style="border: 0.5px solid black; border-right: 0; padding-left: 15px; text-align: left;">   a. Akomodasi</td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="2"></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="2"></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="3"> </td>
			<td style="border: 0.5px solid black; text-align: left;"></td>
		</tr>
		<tr>
			<td style="border: 0.5px solid black; border-right: 0; padding-left: 15px; text-align: left;">  b. Konsumsi</td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="2"></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="2"></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="3"> </td>
			<td style="border: 0.5px solid black; text-align: left;"></td>
		</tr>
		<tr>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: left; color: white;">-</td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="2"></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="2"></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="3"> </td>
			<td style="border: 0.5px solid black; text-align: left;"></td>
		</tr>
		<tr>
			<td style="border: 0.5px solid black; border-right: 0; padding-left: 15px; text-align: left;">  c. Biaya Angkutan yang Diperlukan</td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="2"></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="2"></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="3"> </td>
			<td style="border: 0.5px solid black; text-align: left;"></td>
		</tr>
		<tr>
			<td style="border: 0.5px solid black; border-right: 0; padding-left: 25px; text-align: left;">  1. Akomodasi</td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="2"></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="2"></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="3"> </td>
			<td style="border: 0.5px solid black; text-align: left;"></td>
		</tr>
		<tr>
			<td style="border: 0.5px solid black; border-right: 0; padding-left: 25px; text-align: left;">  2. Kendaraan Laut</td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="2"></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="2"></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="3"> </td>
			<td style="border: 0.5px solid black; text-align: left;"></td>
		</tr>
		<tr>
			<td style="border: 0.5px solid black; border-right: 0; padding-left: 25px; text-align: left;">  3. Kendaraan Darat</td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="2"></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="2"></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="3"> </td>
			<td style="border: 0.5px solid black; text-align: left;"></td>
		</tr>
		<tr>
			<td style="border: 0.5px solid black; border-right: 0; padding-left: 15px; text-align: left;">  d. Airport Tax</td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="2"></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="2"></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="3"> </td>
			<td style="border: 0.5px solid black; text-align: left;"></td>
		</tr>
		<tr>
			<td style="border: 0.5px solid black; border-right: 0; padding-left: 15px;padding-left: 15px; text-align: left;">  e. Tol Bandara</td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="2"></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="2"></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="3"> </td>
			<td style="border: 0.5px solid black; text-align: left;"></td>
		</tr>
		<tr>
			<td style="border: 0.5px solid black; border-right: 0; padding-left: 15px; text-align: left;">  f. Taxi Bandara</td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="2"></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="2"></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="3"> </td>
			<td style="border: 0.5px solid black; text-align: left;"></td>
		</tr>
		<tr>
			<td style="border: 0.5px solid black; border-right: 0; padding-left: 25px; text-align: left;">  <b>Jumlah A</b></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="2"></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="2"></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="3"> </td>
			<td style="border: 0.5px solid black; text-align: left;"></td>
		</tr>
		<tr>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: left;"> B. Pengikut</td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="2"></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="2"></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="3"> </td>
			<td style="border: 0.5px solid black; text-align: left;"></td>
		</tr>
		<tr>
			<td style="border: 0.5px solid black; border-right: 0; padding-left: 15px; text-align: left;">  a. </td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="2"></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="2"></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="3"> </td>
			<td style="border: 0.5px solid black; text-align: left;"></td>
		</tr>
		<tr>
			<td style="border: 0.5px solid black; border-right: 0; padding-left: 15px; text-align: left;">  b.</td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="2"></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="2"></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="3"> </td>
			<td style="border: 0.5px solid black; text-align: left;"></td>
		</tr>
		<tr>
			<td style="border: 0.5px solid black; border-right: 0; padding-left: 15px; text-align: left;"> c.</td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="2"></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="2"></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="3"> </td>
			<td style="border: 0.5px solid black; text-align: left;"></td>
		</tr>
		<tr>
			<td style="border: 0.5px solid black; border-right: 0; padding-left: 25px; text-align: left;">  <b>Jumlah B</b></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="2"></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="2"></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="3"> </td>
			<td style="border: 0.5px solid black; text-align: left;"></td>
		</tr>
		<tr>
			<td style="border: 0.5px solid black; border-right: 0; padding-left: 25px; text-align: left;">  <b>Total A+B</b></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="2"></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="2"></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="3"> </td>
			<td style="border: 0.5px solid black; text-align: left;"></td>
		</tr>
		<tr>
			<td style="border: 0.5px solid black; border-right: 0; padding-left: 15px; text-align: left;">  Pembebanan Anggaran</td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="2"></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="2"></td>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px; text-align: right;" colspan="3"> </td>
			<td style="border: 0.5px solid black; text-align: left;"></td>
		</tr>
		<tr>
			<td colspan="9" style="height: 10px;"></td>
		</tr>
		<tr>
			<td colspan="9"><b>PEMBERI</b> dan <b>PENERIMA TUGAS</b></td>
		</tr>
		<tr>
			<td style="border: 0.5px solid black; border-right: 0; border-bottom: 0; margin-left: 5px; text-align: center;">Pemberi Tugas</td>
			<td style="border: 0.5px solid black; border-right: 0;  border-bottom: 0; margin-left: 5px; text-align: center;" colspan="3">Penerima Tugas</td>
			<td style="border: 0.5px solid black;  border-bottom: 0; margin-left: 5px; text-align: center;" colspan="5">Diperiksa oleh SAS</td>
		</tr>
		<tr>
			<td style="border: 0.5px solid black;  border-top: 0; border-right: 0; margin-left: 5px; text-align: center; height: 60px;">
				<img src="{{ asset('upload/pegawai/'.$spj->pemberi_tugas.'/'.$spj->pegawaiTugas->ttd.'') }}" style="width: 120px; padding: 0; margin: 0;">
			</td>
			<td style="border: 0.5px solid black; border-top: 0; border-right: 0; margin-left: 5px; text-align: center;" colspan="3">
				<img src="{{ asset('upload/pegawai/'.$spj->nip.'/'.$spj->pegawai->ttd.'') }}" style="width: 120px; padding: 0; margin: 0;">
			</td>
			<td style="border: 0.5px solid black; border-top: 0; margin-left: 5px; text-align: center;" colspan="5"></td>
		</tr>
		<tr>
			<td style="border: 0.5px solid black;  border-top: 0; border-right: 0; margin-left: 5px;">Nama   : {{$spj->pegawaiTugas->nama}}	</td>
			<td style="border: 0.5px solid black; border-top: 0; border-right: 0; margin-left: 5px; " colspan="3">Nama   : {{$spj->pegawai->nama}}</td>
			<td style="border: 0.5px solid black; border-top: 0; margin-left: 5px;" colspan="5">Nama   :</td>
		</tr>
		<?php $ttd_tgl = explode(' ', $spj->created_at); ?>
		<tr>
			<td style="border: 0.5px solid black;  border-top: 0; border-right: 0; margin-left: 5px;">Tanggal   :  {{formatTanggalPanjang($ttd_tgl[0])}}	</td>
			<td style="border: 0.5px solid black; border-top: 0; border-right: 0; margin-left: 5px; " colspan="3">Tanggal   :  {{formatTanggalPanjang($ttd_tgl[0])}}</td>
			<td style="border: 0.5px solid black; border-top: 0; margin-left: 5px;" colspan="5">Tanggal   :  {{formatTanggalPanjang($ttd_tgl[0])}}</td>
		</tr>
		<tr>
			<td colspan="9" style="height: 10px;"></td>
		</tr>
		<tr>
			<td colspan="9"><b>PENERIMA UANG PERJALANAN DINAS</b></td>
		</tr>
		<tr>
			<td style="border: 0.5px solid black; border-right: 0; margin-left: 5px;" colspan="3">Nama   : {{$spj->pegawai->nama}}	</td>
			<td style="border: 0.5px solid black;  margin-left: 5px;" colspan="6">Nama  :</td>
		</tr>
		<tr>
			<td style="border: 0.5px solid black; border-right: 0; border-bottom: 0; border-top: 0; margin-left: 5px;" colspan="3">Tanda Tangan   : 	</td>
			<td style="border: 0.5px solid black; border-bottom: 0; border-top: 0;  margin-left: 5px;" colspan="6">Tanda Tangan   :</td>
		</tr>
		<tr>
			<td style="border: 0.5px solid black; border-right: 0; border-top: 0; margin-left: 5px; height: 60px;" colspan="3"> 
				<img src="{{ asset('upload/pegawai/'.$spj->nip.'/'.$spj->pegawai->ttd.'') }}" style="width: 120px; padding: 0; margin: 0;">
			</td>
			<td style="border: 0.5px solid black; border-top: 0;  margin-left: 5px;" colspan="6"></td>
		</tr>
	</table>
	<h4 style="text-align: center;">BIAYA PERJALANAN DINAS DALAM NEGERI</h4>
	<h4 style="text-align: center;">Nomor : {{$spj->no_sppd}}</h4>
	<table cellpadding="3" border="1" style="width: 680px;">
		<tr>
			<td align="center">NO</td>
			<td align="center">RINCIAN BIAYA</td>
			<td align="center">KETERANGAN</td>
			<td align="center">JUMLAH</td>
		</tr>
		<tr>
			<td>1.</td>
			<td>Satuan Uang Harian Perjalanan</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td style="padding-left: 15px;">a. Uang Taksi</td>
			<td>
				@if($spj->uang_taksi)
					{{number_format($spj->uang_taksi)}}
				@endif
			</td>
			<td>
				@if($spj->uang_taksi)
					{{number_format($spj->uang_taksi)}}
				@endif
			</td>
		</tr>
		<tr>
			<td></td>
			<td style="padding-left: 15px;">b. Konsumsi & Akomodasi setempat</td>
			<td>
				@if($spj->uang_konsumsi)
					{{number_format($spj->uang_konsumsi)}}
				@endif
			</td>
			<td>
				@if($spj->uang_konsumsi)
					{{number_format($spj->uang_konsumsi)}}
				@endif
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>2.</td>
			<td>Angkutan yang dipergunakan</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			@if($spj->angkutan == 'pesawat')
				<td style="padding-left: 15px;">- Pesawat Udara</td>
			@elseif($spj->angkutan == 'kereta')
				<td style="padding-left: 15px;">- Kereta Api/ Bus/ Travel</td>
			@elseif($spj->angkutan == 'dinas')
				<td style="padding-left: 15px;">- Kendaraan Dinas</td>
			@elseif($spj->angkutan == 'pribadi')
				<td style="padding-left: 15px;">- Kendaraan Pribadi</td>
			@endif
			<td>
				@if($spj->uang_transport)
					{{number_format($spj->uang_transport)}}
				@endif
			</td>
			<td>
				@if($spj->uang_transport)
					{{number_format($spj->uang_transport)}}
				@endif
			</td>
		</tr>
		<tr>
			<td style="height: 30px;"></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td style="padding-left: 15px;"> Taxi ke Lokasi</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td style="padding-left: 15px;"> Airport Tax</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td>
				@if(!$spj->uang_taksi)
					<?php $spj->uang_taksi= 0;?>
				@endif
				@if(!$spj->uang_konsumsi)
					<?php $spj->uang_konsumsi= 0;?>
				@endif
				@if(!$spj->uang_transport)
					<?php $spj->uang_transport= 0;?>
				@endif
				{{number_format($spj->uang_taksi + $spj->uang_konsumsi + $spj->uang_transport)}}
			</td>
		</tr>
	</table>
	<table style="margin-left: 350px;">
		<tr>
			<td>Dikeluarkan di</td>
			<td>Bekasi</td>
		</tr>
		<tr>
			<td>Pada Tanggal</td>
			<td>{{formatTanggalPanjang($ttd_tgl[0])}}</td>
		</tr>
		<tr>
			<td colspan="2" align="center">PT. WASKITA KARYA</td>
		</tr>
		<tr>
			<td colspan="2" align="center">Penerima</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<img src="{{ asset('upload/pegawai/'.$spj->nip.'/'.$spj->pegawai->ttd.'') }}" style="width: 120px; padding: 0; margin: 0;">
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center"><b>{{$spj->pegawai->nama}}</b></td>
		</tr>
	</table>
</div>
