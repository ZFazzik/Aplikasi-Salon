@extends('template.base-sb2')

@section('title')
{{ $info->nama_web }} - Transaksi
@stop

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}"> 

<!-- <link  href="{{asset ('css/jquery.dataTables.min.css')}}" rel="stylesheet"> -->
<link href="https://cdn.datatables.net/v/bs5/dt-2.0.1/datatables.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/3.0.0/css/responsive.bootstrap5.css">
@stop


@section('page-content')

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">Kasir</h6>
            

            <button type="button" class="btn btn-primary float-right add-transaksi" data-toggle="modal" data-target="#modelId"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button>
        </div>
        <div class="card-body">
            <div class="">
                <table class="table table-bordered data-transaksi" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang atau Jasa</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang atau Jasa</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>

                </table>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Total Bayar</label>
                      <input type="text" class="form-control text-right" name="" id="total_bayar" aria-describedby="helpId" placeholder="" readonly value="">
                      <input type="number" id="total_bayar_hide" class="d-none">
                      <small id="helpId" class="form-text text-muted"></small>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Bayar</label>
                      <input type="number" class="form-control text-right" name="" id="bayar" aria-describedby="helpId" placeholder="">
                      <small id="helpId" class="form-text text-muted"></small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                      <input type="text" class="form-control text-right" name="" id="kembalian" aria-describedby="helpId" placeholder="" readonly>
                      <input type="number" id="kembalian_hide" class="d-none">
                      <small id="helpId" class="form-text text-muted"></small>
                      <label for="" id="textKembalian">Kembalian</label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <a name="" id="" class="btn btn-success btnBayar" href="#" role="button"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></a>
                    <a name="" id="" class="btn btn-primary btnPrint" href="#" role="button" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                    <a name="" id="" class="btn btn-danger btnReset" href="#" role="button"><i class="fa fa-recycle" aria-hidden="true"></i></a>
                    
                </div>
            </div>
        </div>

    </div>

</div>



<!-- Modal Edit or Add -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
            <div class="modal-body">
                <div class="container-fluid">

                <form id="form-transaksi" name="form-transaksi" class="form-transaksi">
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="col-sm-3">Jenis</div>
                            <div class="col-sm-1">:</div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <div class="form-group">
                                    <select class="form-control" name="jenis" id="jenis"> 
                                        <option disabled selected value> -- Pilih Jenis Data -- </option>
                                    </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3 class-nama">
                                Nama
                            </div>
                            <div class="col-sm-1">
                                :
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <div class="form-group">
                                    <select class="form-control" name="id_barang" id="id_barang"> 
                                        <option disabled selected value> -- Pilih Nama Barang atau Jasa -- </option>
                                    </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <input type="hidden" name="nama_pegawai" id="nama_pegawai" value="{{ auth()->user()->name }}">

                        <div class="row">
                            <div class="col-sm-3">
                                Gambar
                            </div>
                            <div class="col-sm-1">
                                :
                            </div>
                            <div class="col-sm-8">
                                <div id="img"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">Jumlah</div>
                            <div class="col-sm-1">:</div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                  <input type="number"
                                    class="form-control" name="jumlah" id="jumlah" aria-describedby="helpId" placeholder="">
                                  <small id="helpId" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">Harga Jual</div>
                            <div class="col-sm-1">:</div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                  <input type="number"
                                    class="form-control" name="harga" id="harga" aria-describedby="helpId" placeholder="" readonly>
                                  <small id="helpId" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">Total</div>
                            <div class="col-sm-1">:</div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                  <input type="number"
                                    class="form-control" name="total" id="total" aria-describedby="helpId" placeholder="" readonly>
                                  <small id="helpId" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">Keterangan</div>
                            <div class="col-sm-1">:</div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                  <input type="text"
                                    class="form-control" name="keterangan" id="keterangan" aria-describedby="helpId" placeholder="">
                                  <small id="helpId" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary save" data-dismiss="modal">Tambah Data</button>
            </div>
            
            </form>
        </div>
    </div>
</div>


@stop


@section('script')   

    <script src="{{asset ('js/jquery-1.9.1.js')}}"></script>
    <script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.0/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/2.0.1/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.0/js/responsive.bootstrap5.js"></script>  
    <script src="https://cdn.datatables.net/plug-ins/1.13.2/api/sum().js"></script>
    <!-- <script src="{{asset ('js/demo/datatables-demo.js')}}"></script> -->

    <!-- <script src="{{asset ('js/jquery-3.4.1.min.js')}}"></script> -->
    <script type="text/javascript">
        $(function(){
            
            var nf = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('.data-transaksi').DataTable({
                responsive : true,
                processing : true,
                serverSide : true,
                paging:false,
                searching: false,
                ajax: "{{route ('ajax-transaksi.index')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', "width": 20,className: "dt-center"},
                    {data: 'nama_barang', name:'nama_barang'},
                    // {data: 'id_pegawai', name:'id_pegawai'},
                    {data: 'jumlah', name:'jumlah', className: "dt-right"},
                    {data: 'total', name:'total', render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp. ' ), className: "dt-right"},
                    {data: 'action', name: 'action', orderable: false, searchable: false, width : "20%", className: "dt-center"}
                ],
                drawCallback: function () {
                    var api = this.api();
                    var total = api.column( 3, {page:'current'} ).data().sum();
                    $('#total_bayar_hide').val(
                        total
                    );


                    $('#total_bayar').val(
                        nf.format(total)
                    );
                },
                fnDrawCallback: function( oSettings ) {
                    $('.page-item').removeClass('paginate_button');
                }
            });

            
            $(document).on('click','.deleteKeranjang',function (e) {
                var id= $(this).data("id");

                $.ajax({
                    type: "DELETE",
                    url:"{{route ('ajax-transaksi.store') }}"+'/'+id,
                    success: function (data){
                        table.draw();
                    },
                    error: function(data){
                        console.log('error: ',data);
                    }
                });
                    
            
            });
            $(document).on('click', '.add-transaksi', function() {
                $('.modal-title').html('Tambah Data');
                $('.save-keranjang').html('Simpan Data');
                $('.save').removeClass('edit-keranjang');
                $('.save').addClass('save-keranjang');
                $('.save').html('Tambah Data');
                $('#id').val('');
                $('.form-transaksi').trigger('reset');
                $('#modal').attr('disabled', false);
                $('#supplier').attr('disabled', false);
                $('#sisa').attr('disabled', false);
                $('#img').html('');
                $('.class-nama').html('Nama ');

                $('#jenis').empty()
                    .append('<option readonly selected value> -- Pilih Jenis Data -- </option>');
                $('#id_barang').empty()
                    .append('<option readonly selected value> -- Silahkan pilih Jenis -- </option>');

                
            });

            $(document).on('click','.save-keranjang',function(e) {
                // alert('data saved');
                e.preventDefault();
                $(this).html('Mengirim...');
                var data = $('#form-transaksi :input[name!=jenis][name!=harga]').serialize(); // ini buat tanpa image

                let fd = new FormData(document.getElementById("form-transaksi"));
                
                // alert(data);
                $.ajax({
                    data:data,
                    url: "{{ route('ajax-transaksi.store')}}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        console.log('berhasil',data);
                        $('.form-transaksi').trigger('reset');
                        table.draw();
                        $(this).html('Tambah Data');
                    },
                    error: function (data) {
                        console.log('Error: ', data);
                        table.draw();
                        $(this).html('Tambah Data');
                        JSON.stringify(data);

                        // $.each(data.responseJSON.errors, function(k, v) {
                        //         $('[name=\"img\"]').after('<p class="error">'+v[0]+'</p>');
                        // });
                    }
                });

                var sum = $('.data-transaksi').DataTable().column(2).data().sum();
                $('#total_bayar').val(sum);
            });

            $(document).on('click','.edit-keranjang',function(e) {
                // alert('data saved');
                e.preventDefault();
                $(this).html('Mengirim...');
                var data = $('#form-transaksi :input[name!=jenis][name!=harga]').serialize(); // ini buat tanpa image

                let fd = new FormData(document.getElementById("form-transaksi"));
                
                // alert(data);
                $.ajax({
                    data:data,
                    url: "{{ route('ajax-transaksi.store')}}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        console.log('berhasil',data);
                        $('.form-transaksi').trigger('reset');
                        table.draw();
                        $(this).html('Tambah Data');
                    },
                    error: function (data) {
                        console.log('Error: ', data);
                        table.draw();
                        $(this).html('Tambah Data');
                        JSON.stringify(data);

                        // $.each(data.responseJSON.errors, function(k, v) {
                        //         $('[name=\"img\"]').after('<p class="error">'+v[0]+'</p>');
                        // });
                    }
                });

                var sum = $('.data-transaksi').DataTable().column(2).data().sum();
                $('#total_bayar').val(sum);
            });

            $(document).on('click','.editKeranjang', function (e) {
                var id= $(this).data("id");
                $('.save-keranjang').html('Edit Data');
                $('.save').removeClass('save-keranjang');
                $('.save').addClass('edit-keranjang');
                $('.save').html('Edit Data');
                
                $.get("{{route('ajax-transaksi.index')}}" + '/'+ id +'/edit',function(data){
                    var Img = "{{asset('/img/uploaded')}}" +'/'+ data.dataBarang.img;
                    var NoImg = "{{asset('/img/No_image_available.png')}}";
                    $('#id_pegawai').val(data.dataKeranjang.id_pegawai);
                    $('.class-nama').html('Nama '+data.dataBarang.jenis);
                    $('#jenis').empty()
                            .append('<option selected value='+ data.dataBarang.jenis+'> '+ data.dataBarang.jenis+' </option>');

                    $('#id_barang').empty()
                        .append('<option selected value='+ data.dataBarang.id+'> '+ data.dataBarang.nama+' </option>');

                    if(data.dataBarang.img == null || data.dataBarang.img == ''){
                        $('#img').html("<img src='"+ NoImg +"' class='img-thumbnail rounded-top' alt=''>");
                    }else{
                        $('#img').html("<img src='"+ Img +"' class='img-thumbnail rounded-top' alt=''>");
                    }

                    $('#jumlah').val(data.dataKeranjang.jumlah);
                    $('#harga').val(data.dataBarang.harga);
                    $('#keterangan').val(data.dataKeranjang.keterangan);
                    $('#total').val(data.dataKeranjang.jumlah * data.dataBarang.harga);
                    
                });

                $('.modal-title').html('Edit Data '+id);

                $('#id').val(id);

            });

            $(document).on('click','#jenis', function (e) {
                e.preventDefault();
                var type = $(this).val();
                $.get("{{route('find-type','Jenis')}}",function(datas){
                    $('#jenis').empty()
                        .append('<option readonly selected value=""> -- Pilih Jenis Data -- </option>');

                    $.each(datas, function (i, data) {
                        $('#jenis').append($('<option>', { 
                            value: data.nama,
                            text : data.nama 
                        }));
                    });
                });
            });

            $(document).on('change','#jenis', function (e) {
                e.preventDefault();
                var type = $(this).val();
                $('.class-nama').html('Nama '+ type);
                if(type == "" || type == null){
                    $('#id_barang').empty()
                        .append('<option readonly selected value=""> -- Silahkan pilih Jenis -- </option>');
                }else{
                    $('#id_barang').empty()
                        .append('<option readonly selected value=""> -- Pilih Nama '+ type +' -- </option>');
                }

            });

            $(document).on('click','#id_barang', function (e) {
                e.preventDefault();
                var type = $('#jenis').val();
                let url = "{{route('find-barang',':type')}}";
                url = url.replace(':type', type);
                
                $.get(url,function(datas){
                    if(type == 'Jasa'){
                        $('#id_barang').empty()
                            .append('<option readonly selected value="0"> -- Pilih Nama Jasa -- </option>');
                    }else if(type == 'Barang'){
                        $('#id_barang').empty()
                            .append('<option readonly selected value="0"> -- Pilih Nama Barang -- </option>');
                    }else{
                        $('#id_barang').empty()
                            .append('<option readonly selected value="0"> -- Silahkan pilih Jenis -- </option>');
                    }
                    $.each(datas, function (i, data) {
                        
                        $('#id_barang').append($('<option>', { 
                            value: data.id,
                            text : data.nama 
                        }));
                    });
                });
            });

            $(document).on('change','#id_barang', function (e) {
                e.preventDefault();
                
                var id = $('#id_barang').val(); 
                let url = "{{route('find-barang-id',':id')}}";
                url = url.replace(':id', id);

                $.get(url,function(datas){
                    $.each(datas, function (i, data) {
                        
                        var Img = "{{asset('/img/uploaded')}}" +'/'+ data.img;
                        var NoImg = "{{asset('/img/No_image_available.png')}}";
                        
                        $('#harga').val(data.harga);
                       
                        if(data.img == null || data.img == ''){
                            $('#img').html("<img src='"+ NoImg +"' class='img-thumbnail rounded-top' alt=''>");
                        }else{
                            $('#img').html("<img src='"+ Img +"' class='img-thumbnail rounded-top' alt=''>");
                        }
                    });
                });

            });

            $(document).on('keyup change','#jumlah', function (e) {
                e.preventDefault();
                var jumlah = $(this).val();
                var harga_jual = $('#harga').val();
                var total = jumlah * harga_jual;
                
                $('#total').val(total);

            });

            $(document).on('keyup','#bayar', function (e) {
                e.preventDefault();
                var bayar = $(this).val();
                var total_bayar = $('#total_bayar_hide').val();
                var kembalian = bayar - total_bayar;
                console.log(bayar,total_bayar, kembalian);

                if(kembalian < 0){
                    $('#textKembalian').html('Kurang');
                }else{
                    $('#textKembalian').html('Kembalian');
                }

                $('#kembalian').val(nf.format(kembalian));
                $('#kembalian_hide').val(kembalian);
            });
            
            $(document).on('click','.btnBayar', function (e) {
                e.preventDefault();
                var kembalian = $('#kembalian_hide').val();

                if(kembalian < 0){
                    alert('Pelangganmu kurang bayar '+ kembalian + '.');
                }else if(kembalian === '' || kembalian === null){
                    alert('Anda belum memasukan kolom bayar.');
                }else{
                    $.ajax({
                        type: "GET",
                        url:"{{route ('save.penjualan') }}",
                        success: function (data){
                            if(kembalian == 0){
                                alert('Pelangganmu sudah membayar. Jangan lupa untuk mereset keranjang.'); 
                            }else if(kembalian > 0){
                                alert('Pelangganmu sudah membayar. Jangan lupa untuk mereset keranjang dan berikan kembalian '+ kembalian +' kepada pelanggan.'); 
                            }
                        },
                        error: function(data){
                            console.log('error: ',data);
                            alert('System error, coba refresh halaman.');
                        }
                    });
                }

               

            });
            $(document).on('click','.btnPrint', function (e) {
                e.preventDefault(); 
                var bayar = $('#bayar').val();
                var kembalian = $('#kembalian_hide').val();
                var url = "{{route('cetak.keranjang', [':bayar',':kembalian'] )}}"; 

                url = url.replace(':bayar', bayar);
                url = url.replace(':kembalian', kembalian);

                if(kembalian < 0){
                    alert('Pelangganmu kurang bayar '+ kembalian + '.');
                }else if(kembalian === '' || kembalian === null){
                    alert('Anda belum memasukan kolom bayar.');
                }else{
                    window.open(url, '_blank');
                }
                
                
            });
            $(document).on('click','.btnReset', function (e) {
               e.preventDefault();

               $.ajax({
                    type: "GET",
                    url:"{{route ('reset.keranjang') }}",
                    success: function (data){
                        table.draw();
                        alert('Anda sudah mengosongkan keranjang');
                        $('#total_bayar').val(''); 
                        $('#bayar').val(''); 
                        $('#kembalian').val(''); 
                        $(window).attr('location',"{{ route('transaksi') }}");
                    },
                    error: function(data){
                        console.log('error: ',data);
                    }
                });
            });
        });

    </script>
@stop