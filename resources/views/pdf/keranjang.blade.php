

<!-- <img src="{{asset('/img/uploaded')}}/{{ $info->icon_web }}"> -->
<!-- {{asset('/img/uploaded')}}/{{ $info->icon_web }} -->
  <h3><center>Data Keranjang</center></h3>
  <center>{{ date('d F Y - H:i:s', $tgl_pembelian->created_at->timestamp) }}</center>
  <table border="0" cellspacing="0" cellpadding="5">
    <tr>
      <th>No.</th>
      <th>Nama Barang</th>
      <th>Jumlah</th>
      <th>Total</th>
    </tr>
    @foreach($keranjangs as $keranjang) 
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td>{{$keranjang->nama_barang}}</td>
      <td>{{$keranjang->jumlah_keranjang}}</td>
      <td>{{$keranjang->total_keranjang}}</td>
    </tr>
    @endforeach
  </table>
  Total Harga: {{ $total_harga[0]->total_harga }} </br>
  Total Unit: {{ $total_barang[0]->total_barang  }} </br>
  Kasir: {{ auth()->user()->name }}
  