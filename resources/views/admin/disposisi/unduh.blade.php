<div style="border: 1px solid black; width: 420px;">
	<div>
		<img src="{{asset('public/img/kop.PNG')}}" style="width: 400px; margin: 30px; ">
	</div>
	<h4>PROYEK JALAN TOL BECKAYU SEKSI 2A UJUNG</h4>
	<table>
		<tr>
			<td>Nomor Agenda</td>
			<td>:</td>
			<td>{{$disposisi->nomor_agenda}}></td>
		</tr>
		<tr>
			<td>Pengirim</td>
			<td>:</td>
			<td>{{$disposisi->pengirim}}</td>
		</tr>
		<tr>
			<td>Kepada</td>
			<td>:</td>
			<td>{{$disposisi->kepada}}</td>
		</tr>
		<tr>
			<td>Tanggal Terima</td>
			<td>:</td>
			<td>{{formatTanggalPanjang($disposisi->tanggal_terima)}}</td>
		</tr>
		<tr>
			<td>Nomor Surat</td>
			<td>:</td>
			<td>{{$disposisi->nomor_surat}}</td>
		</tr>
		<tr>
			<td>Tanggal Surat</td>
			<td>:</td>
			<td>{{$disposisi->tanggal_surat}}</td>
		</tr>
		<tr>
			<td>Perihal</td>
			<td>:</td>
			<td>{{$disposisi->perihal}}</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td>Penting</td>
			<td></td>
			<td>Segera</td>
			<td></td>
			<td>Biasa</td>
		</tr>
		<tr>
			<td>Sifat</td>
			<td>:</td>
			<td><img src="{{ asset("public/img/check.PNG") }}" style="width: 15px; padding: 2px; border: 1px solid black;"></td>
			<td></td>
			<td><img src="{{ asset("public/img/check.PNG") }}" style="width: 15px;padding: 2px; border: 1px solid black;"></td>
			<td></td>
			<td><img src="{{ asset("public/img/check.PNG") }}" style="width: 15px;padding: 2px; border: 1px solid black;"></td>
			<td></td>
		</tr>
	</table>
	<div style="width: 450px; height: 0.5px; border: 3px solid black;"></div>
	<h4 align="center">DISPOSISI SURAT MASUK</h4>
	<div style="width: 450px; height: 0.5px; border: 3px solid black;"></div>
</div>