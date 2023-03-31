<!DOCTYPE html>
<html>
<head>
	<title>Laporan Penjualan</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Laporan Penjualan</h4>
		<h6>dari {{ $dari }} sampai {{ $sampai }}</h6>
	</center>
 
	<table class='table table-bordered text-center'>
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Barang</th>
				<th>Jumlah terjual</th>
				<th>Total Harga</th>
				<th>Laba</th>
				<th>Penanggung Jawab</th>
				<th>Tanggal</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($penjualans as $p)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$p->nama_barang}}</td>
				<td>{{$p->jumlah}}</td>
				<td>{{$p->total_harga}}</td>
				<td>{{$p->laba}}</td>
				<td>{{$p->nama_pegawai}}</td>
				<td>{{ date('d F Y', strtotime($p->tanggal)) }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 
	Total Laba: {{ $laba }}</br>
	Total Terjual: {{ $jumlah }}

</body>
</html>