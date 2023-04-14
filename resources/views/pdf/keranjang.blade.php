<link href="{{public_path ('css/sb-admin-2.min.css')}}" rel="stylesheet">

<center>
  <div class="sidebar-brand-icon">
      <img src="{{public_path('/img/uploaded')}}/{{ $info->icon_web }}" style="width: 50px; background-color: rgba(0,0,0,.1)" class="img-thumbnail rounded" alt="">
  </div>
</center>

  <center>{{ $info->cabang }}</center>
  <center>{{ $info->alamat }}</center>
  <center>{{ $info->sosmed }}</center>
  <!-- <center>{{ date('d F Y - H:i:s', $tgl_pembelian->created_at->timestamp) }}</center> -->
  ================================</br>
  <table>
    <tr>
      {{date_default_timezone_set("Asia/Bangkok")}}
      <td>Tanggal</td>
      <td> :</td>
      <td> {{ date('d F Y') }}</td>
    </tr>
    <tr>
      <td>Jam</td>
      <td> :</td>
      <td> {{ date('H:i:s') }}</td>
    </tr>
    <tr>
      <td>Kasir</td>
      <td> :</td>
      <td> {{ auth()->user()->name }}</td>
    </tr>
  </table>
  ================================</br>

    @foreach($keranjangs as $keranjang) 
      {{$keranjang->nama_barang}}</br><div class="float-right">{{$keranjang->total_keranjang}}</div>
      {{$keranjang->jumlah_keranjang}} x @ {{$keranjang->harga_barang}}</br> 
    @endforeach
  </br>
  <table align="right">
    <tr>
      <td>Bayar</td>
      <td> :</td>
      <td align="right"> {{ $bayar }}</td>
    </tr>
    <tr>
      <td>Total Harga</td>
      <td> :</td>
      <td align="right"> {{ $total_harga[0]->total_harga }}</td>
    </tr>
    <tr>
      <td>Kembali</td>
      <td> :</td>
      <td align="right"> {{ $kembalian }}</td>
    </tr>
    <tr>
      <td>Total Unit</td>
      <td> :</td>
      <td align="right"> {{ $total_barang[0]->total_barang }}</td>
    </tr>
  </table>
  
    ================================</br>
  <center>Terima Kasih</center>
  <center>Selamat Datang Kembali</center>