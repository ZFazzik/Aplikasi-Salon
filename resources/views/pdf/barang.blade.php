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
				<th>Gambar</th>
				<th>Jenis</th>
				<th>Supplier</th>
				<th>Modal</th>
				<th>Harga</th>
				<th>Jumlah</th>
				<th>Sisa</th>
				<th>Tanggal</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($barangs as $b)
			<tr>
				<td class="text-center">{{ $i++ }}</td>
				<td class="text-center">{{$b->nama}}</td>
				<td class="text-center">
				@if( $b->img == '' || $b->img == null)
				<img src="{{public_path('/img/No_image_available.png')}}" class='img-thumbnail rounded-top' alt=''>
				@else
				<img src="{{public_path('/img/uploaded/')}}/{{$b->img}}" class='img-thumbnail rounded-top' alt=''>
				@endif
				
				{{$b->img}}
				
				</td>
				<td class="text-center">{{$b->jenis}}</td>
				<td class="text-center">{{$b->supplier}}</td>
				<td class="text-center">{{$b->modal}}</td>
				<td class="text-center">{{$b->harga}}</td>
				<td class="text-center">{{$b->jumlah}}</td>
				<td class="text-center">{{$b->sisa}}</td>
				<td class="text-center">{{ date('d F Y - H:i:s', strtotime($b->created_at)) }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 
	Total Laba: {{ $laba }}</br>
	Total Sisa Stock: {{ $sisa }}</br>
	Total Terjual: {{ $jumlah }}

</body>
</html>