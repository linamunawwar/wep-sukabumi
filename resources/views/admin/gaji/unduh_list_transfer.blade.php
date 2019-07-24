<table border="1">
	<thead>
		<tr>
			<td></td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<tr>
			<th></th>
			<th></th>
			<th style="border: 1px solid #000000;">NIP</th>
			<th style="border: 1px solid #000000;">Nama</th>
			<th style="border: 1px solid #000000;">Bank</th>
			<th style="border: 1px solid #000000;">Nomor Rekening</th>
			<th style="border: 1px solid #000000;">Nominal</th>
		</tr>
	</thead>
	<tbody>
		@foreach($datas as $data)
			<?php
				if(($data->gaji->gaji_pokok == null) || ($data->gaji->gaji_pokok == '')){
					$data->gaji->gaji_pokok = 0;
				}
				if(($data->gaji->tunj_komunikasi == null) || ($data->gaji->tunj_komunikasi == '')){
					$data->gaji->tunj_komunikasi = 0;
				}
				if(($data->gaji->tunj_transportasi == null) || ($data->gaji->tunj_transportasi == '')){
					$data->gaji->tunj_transportasi = 0;
				}
				if(($data->gaji->uang_makan == null) || ($data->gaji->uang_makan == '')){
					$data->gaji->uang_makan = 0;
				}
				if(($data->gaji->tunj_pph21 == null) || ($data->gaji->tunj_pph21 == '')){
					$data->gaji->tunj_pph21 = 0;
				}
			?>
			<tr>
				<td></td>
				<td></td>
				<td style="border: 1px solid #000000;">{{$data->nip}}</td>
				<td style="border: 1px solid #000000;">{{$data->nama}}</td>
				<td style="border: 1px solid #000000;">{{$data->bank->nama_bank}}</td>
				<td style="border: 1px solid #000000;">{{$data->bank->no_rekening}}</td>
				<td style="border: 1px solid #000000;">{{$data->gaji->gaji_pokok + $data->gaji->tunj_komunikasi + $data->gaji->tunj_transportasi + $data->gaji->uang_makan + $data->gaji->tunj_pph21}}</td>
			</tr>
		@endforeach
	</tbody>
</table>