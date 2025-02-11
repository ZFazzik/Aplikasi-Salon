@extends('template.base-sb2')

@section('title')
{{ $info->nama_web }} - Barang
@stop

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}"> 

<link  href="{{asset ('css/jquery.dataTables.min.css')}}" rel="stylesheet">
@stop


@section('page-content')
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row p-3">
                <div class="col-sm-5">
                    <h6 class="m-0 font-weight-bold text-primary">Data Barang</h6>
                </div>
                <div class="col-sm-2">
                    <input type="date" class="form-control" name="" id="dari" aria-describedby="helpId" placeholder=""  data-toggle="tooltip" data-placement="top"  title="Isi kolom ini saja untuk melihat satu tanggal yg dipilih.">
                </div>
                <div class="col-sm-2">
                    <input type="date" class="form-control" name="" id="sampai" aria-describedby="helpId" placeholder="" data-toggle="tooltip" data-placement="top"  title="Isi kolom ini juga jika ingin melihat dari tanggal berapa sampai tanggal berapa.">
                </div>
                <div class="col-sm-1">
                    <a name="" id="print-pdf" class="btn btn-primary btnPrint" href="" role="button" target=""><i class="fa fa-print" aria-hidden="true"></i></a>
                </div>

                <div class="col-sm-2">
                    @if(auth()->user()->level == 1)
                    <button type="button" class="btn btn-primary float-right add-barang" data-toggle="modal" data-target="#modelId"><i class="fa fa-plus" aria-hidden="true"></i>Add Data</button>
                    @endif
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                      <select class="form-control" name="bulan" id="bulan">
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                      </select>
                      <label for="">Bulan:</label>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                      <input type="text"
                        class="form-control" name="tahun" id="tahun" aria-describedby="helpId" placeholder="">
                      <label for="">Tahun:</label>
                    </div>
                </div>
                <div class="col-sm-4">
                    <a name="" id="print-pdf-bulanan" class="btn btn-primary btnPrintBulanan float-right" href="" role="button" target=""><i class="fa fa-print" aria-hidden="true"></i> Print Laporan Bulan Ini.</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="">
                <table class="table table-bordered data-barang" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang atau Jasa</th>
                            <th>Gambar</th>
                            <th>Jenis</th>
                            <th>Harga</th>
                            <th>Jumlah Terjual</th>
                            <th>Total Modal</th>
                            <th>Total Laba</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang atau Jasa</th>
                            <th>Gambar</th>
                            <th>Jenis</th>
                            <th>Harga</th>
                            <th>Jumlah Terjual</th>
                            <th>Total Modal</th>
                            <th>Total Laba</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>

                </table>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                      <label for="">Total laba:</label>
                      <input type="text"
                        class="form-control text-right" name="total_laba" id="total_laba" aria-describedby="helpId" placeholder="" readonly>
                      <small id="helpId" class="form-text text-muted">hanya tabel page sekarang saja</small>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                      <label for="">Total modal:</label>
                      <input type="text"
                        class="form-control text-right" name="total_modal" id="total_modal" aria-describedby="helpId" placeholder="" readonly>
                      <small id="helpId" class="form-text text-muted">hanya tabel page sekarang saja</small>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                      <label for="">Total jumlah terjual:</label>
                      <input type="text"
                        class="form-control text-right" name="total_jumlah" id="total_jumlah" aria-describedby="helpId" placeholder="" readonly>
                      <small id="helpId" class="form-text text-muted">hanya tabel page sekarang saja</small>
                    </div>
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

                <form id="form-barang" name="form-barang" class="form-barang">
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
                            <div class="col-sm-3">Supplier</div>
                            <div class="col-sm-1">:</div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <div class="form-group">
                                    <select class="form-control" name="supplier" id="supplier">
                                        <option disabled selected value> -- Pilih Supplier -- </option>
                                    </select>
                                    </div>
                                </div>
                                
                                <small id="helpId" class="form-text text-muted">Supplier otomatis dikosongkan jika anda memilih Jasa.</small>
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
                                  <input type="text"
                                    class="form-control" name="nama" id="nama" aria-describedby="helpId" placeholder="">
                                  <small id="helpId" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                Upload Image:
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                  <input type="file" class="form-control-file" name="img" id="img" placeholder="" aria-describedby="fileHelpId">
                                  <small id="fileHelpId" class="form-text text-muted">jpg,png,jpeg,gif,svg. max:2MB</small>
                                </div>
                            </div>
                        </div>
                        

                        <div class="row">
                            <div class="col-sm-3">Modal</div>
                            <div class="col-sm-1">:</div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                  <input type="text"
                                    class="form-control" name="modal" id="modal" aria-describedby="helpId" placeholder="">
                                  <small id="helpId" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">Harga</div>
                            <div class="col-sm-1">:</div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                  <input type="text"
                                    class="form-control" name="harga" id="harga" aria-describedby="helpId" placeholder="">
                                  <small id="helpId" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">Jumlah terjual</div>
                            <div class="col-sm-1">:</div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                  <input type="text"
                                    class="form-control" name="jumlah" id="jumlah" aria-describedby="helpId" placeholder="" readonly>
                                  <small id="helpId" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">Sisa Stok</div>
                            <div class="col-sm-1">:</div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                  <input type="text"
                                    class="form-control" name="sisa" id="sisa" aria-describedby="helpId" placeholder="">
                                  <small id="helpId" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger invisible hapus-img" data-dismiss="modal">Hapus Gambar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary save" data-dismiss="modal">Tambah Data</button>
            </div>
            
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit or Add -->
<div class="modal fade" id="modelDetail" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5>Detail </h5>
                    <h5 class="font-weight-bold" id="barangDetail"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                <div class="container-fluid">

                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="col-sm-3">
                                Gambar
                            </div>
                            <div class="col-sm-1">
                                :
                            </div>
                            <div class="col-sm-8">
                                <div id="imgDetail"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                Jenis
                            </div>
                            <div class="col-sm-1">
                                :
                            </div>
                            <div class="col-sm-8 font-weight-bold">
                                <div id="jenisDetail"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                Supplier
                            </div>
                            <div class="col-sm-1">
                                :
                            </div>
                            <div class="col-sm-8 font-weight-bold">
                                <div id="supplierDetail"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                Modal
                            </div>
                            <div class="col-sm-1">
                                :
                            </div>
                            <div class="col-sm-8 font-weight-bold">
                                <div id="modalDetail"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                Harga
                            </div>
                            <div class="col-sm-1">
                                :
                            </div>
                            <div class="col-sm-8 font-weight-bold">
                                <div id="hargaDetail"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                Jumlah terjual
                            </div>
                            <div class="col-sm-1">
                                :
                            </div>
                            <div class="col-sm-8 font-weight-bold">
                                <div id="jumlahDetail"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                Sisa stok
                            </div>
                            <div class="col-sm-1">
                                :
                            </div>
                            <div class="col-sm-8 font-weight-bold">
                                <div id="sisaDetail"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                Tanggal ditambah
                            </div>
                            <div class="col-sm-1">
                                :
                            </div>
                            <div class="col-sm-8 font-weight-bold">
                                <div id="tanggalDetail"></div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

            
        </div>
    </div>
</div>


@stop


@section('script')   

    <script src="{{asset ('js/jquery-1.9.1.js')}}"></script>  
    <script src="{{asset ('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset ('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.13.2/api/sum().js"></script>
    <!-- <script src="{{asset ('js/demo/datatables-demo.js')}}"></script> -->

    <!-- <script src="{{asset ('js/jquery-3.4.1.min.js')}}"></script> -->
    <script type="text/javascript">
        $(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('.data-barang').DataTable({
                processing : true,
                serverSide : true,
                ajax: "{{route ('ajax-barang.index')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', "width": 20,className: "dt-center"},
                    {data: 'nama', name:'nama'},
                    {data: 'img', name:'img'},
                    {data: 'jenis', name:'jenis'},
                    {data: 'harga', name:'harga'},
                    {data: 'jumlah', name:'jumlah'},
                    {data: 'total_modal', name:'total_modal'},
                    {data: 'total_laba', name:'total_laba'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, width : "@if(auth()->user()->level == 2) 5% @else 20% @endif", className: "dt-center"}
                ],
                drawCallback: function () {
                    $('.page-item').removeClass('paginate_button');
                    var api = this.api();
                    var laba = api.column( 7, {page:'all'} ).data().sum();
                    var modal = api.column( 6, {page:'all'} ).data().sum();
                    var nf = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                    
                    $('#total_laba').val(
                        nf.format(laba)
                    );
                    $('#total_modal').val(
                        nf.format(modal)
                    );
                    $('#total_jumlah').val(
                        api.column( 5, {page:'all'} ).data().sum()
                    );
                },
                fnDrawCallback: function( oSettings ) {
                    $('.page-item').removeClass('paginate_button');
                }
            });

            $(document).on('click', '.detailBarang', function() {
                var id= $(this).data("id");

                $.get("{{route('ajax-barang.index')}}" + '/'+ id +'/edit',function(data){
                    var tanggal_base = data.created_at;
                    var tanggal = tanggal_base.slice(0,10);
                    var NoImg = "{{asset('/img/No_image_available.png')}}";
                    var Img = "{{asset('/img/uploaded')}}" +'/'+ data.img;

                    if(data.img == null || data.img == ''){
                        $('#imgDetail').html("<img src='"+ NoImg +"' class='img-thumbnail rounded-top' alt=''>");
                    }else{
                        $('#imgDetail').html("<img src='"+ Img +"' class='img-thumbnail rounded-top' alt=''>");
                    }
                    
                    $('#barangDetail').html(data.nama);
                    $('#jenisDetail').html(data.jenis);
                    $('#supplierDetail').html(data.supplier);
                    $('#modalDetail').html(data.modal);
                    $('#hargaDetail').html(data.harga);
                    $('#jumlahDetail').html(data.jumlah);
                    $('#sisaDetail').html(data.sisa);
                    $('#tanggalDetail').html(tanggal);
                });

            });

            $(document).on('click', '.add-barang', function() {
                $('.modal-title').html('Tambah Data');
                $('.save-barang').html('Simpan Data');
                $('.save').removeClass('edit-barang');
                $('.save').addClass('save-barang');
                $('.save').html('Tambah Data');
                $('#id').val('');
                $('.form-barang').trigger('reset');
                $('#modal').attr('disabled', false);
                $('#supplier').attr('disabled', false);
                $('#sisa').attr('disabled', false);
                $('.hapus-img').addClass('invisible');

                $('#jumlah').val('0');
                $('#jenis').empty()
                    .append('<option disabled selected value> -- Pilih Jenis Data -- </option>');
                $('#supplier').empty()
                    .append('<option disabled selected value> -- Silahkan pilih Jenis -- </option>');

                
            });
            $(document).on('click','#jenis', function (e) {
                e.preventDefault();
                $.get("{{route('find-type','Jenis')}}",function(datas){
                    $('#jenis').empty()
                        .append('<option disabled selected value> -- Pilih Jenis Data -- </option>');

                    $.each(datas, function (i, data) {
                        $('#jenis').append($('<option>', { 
                            value: data.nama,
                            text : data.nama 
                        }));
                    });
                });
            });
            $(document).on('click','#supplier', function (e) {
                e.preventDefault();
                $('#supplier').empty()
                        .append('<option disabled selected value> -- Silahkan pilih Supplier -- </option>');
                    $.get("{{route('find-type','Supplier')}}",function(datas){

                        $.each(datas, function (i, data) {
                            $('#supplier').append($('<option>', { 
                                value: data.nama,
                                text : data.nama 
                            }));
                        });
                    });
            });

            $(document).on('change','#jenis', function(e){
                e.preventDefault();

                if($('#jenis').val() === 'Jasa'){
                    $('.class-nama').html('Nama Jasa');
                    $("input[name=sisa]").attr('disabled', true);
                    $("input[name=modal]").attr('disabled', true);
                    $("#supplier").attr('disabled', true);
                    $("#modal").val('');
                    $("#sisa").val('');
                    $('#supplier').empty()
                        .append('<option disabled selected value> -- Anda memilih Jasa -- </option>');
                }else{
                    $('.class-nama').html('Nama Barang');
                    $("input[name=sisa]").attr('disabled', false);
                    $("input[name=modal]").attr('disabled', false);
                    $("#supplier").attr('disabled', false);
                    $('#supplier').empty()
                        .append('<option disabled selected value> -- Silahkan pilih Supplier -- </option>');
                    $.get("{{route('find-type','Supplier')}}",function(datas){

                        $.each(datas, function (i, data) {
                            $('#supplier').append($('<option>', { 
                                value: data.nama,
                                text : data.nama 
                            }));
                        });
                    });
                }
                
            })

            $(document).on('click','.save-barang',function(e) {
                // alert('data saved');
                e.preventDefault();
                $(this).html('Mengirim...');
                var id = $('#id').val();
                var barang = $('#barang').val();
                var img = $('#img').val();
                var deskripsi = $('#deskripsi').val();
                var data = $('#form-barang').serialize(); // ini buat tanpa image

                let fd = new FormData(document.getElementById("form-barang"));
                
                // alert(data);
                $.ajax({
                    data:fd,
                    url: "{{ route('ajax-barang.store')}}",
                    type: "POST",
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        console.log('berhasil',data);
                        $('.form-barang').trigger('reset');
                        table.draw();
                        $(this).html('Tambah Data');
                    },
                    error: function (data) {
                        console.log('Error: ', data);
                        table.draw();
                        $('.save-barang').html('Simpan Data');
                        $(this).html('Tambah Data');
                        JSON.stringify(data);

                        // $.each(data.responseJSON.errors, function(k, v) {
                        //         $('[name=\"img\"]').after('<p class="error">'+v[0]+'</p>');
                        // });
                    }
                });

            });
            $(document).on('click','.deleteBarang',function (e) {
                var id= $(this).data("id");
                var textConfirm = "Apakah kamu yakin menghapus " + id + "?";

                if(confirm(textConfirm) == true){
                    $.ajax({
                        type: "DELETE",
                        url:"{{route ('ajax-barang.store') }}"+'/'+id,
                        success: function (data){
                            table.draw();
                        },
                        error: function(data){
                            console.log('error: ',data);
                        }
                    });
                }
                    
            
            });
            $(document).on('click','.hapus-img', function (e) {
                var id = $('#id').val();
                var textConfirm = "Apakah kamu yakin menghapus gambar " + id + "?";
                let url = "{{route('hapus-img.barang', ':id' )}}";
                url = url.replace(':id', id)
                
                if(confirm(textConfirm) == true){
                    $.ajax({
                        type: "DELETE",
                        url: url,
                        success: function (data){
                            table.draw();
                        },
                        error: function(data){
                            console.log('error: ',data);
                        }
                    });
                }
            });
            $(document).on('click','.editBarang', function (e) {
                $('.hapus-img').removeClass('invisible');
                $('.save-barang').html('Edit Data');
                var id= $(this).data("id");
                $('.save').removeClass('save-barang');
                $('.save').addClass('edit-barang');
                $('.save').html('Edit Data');
                
                $.get("{{route('ajax-barang.index')}}" + '/'+ id +'/edit',function(data){

                    if(data.jenis == 'Jasa'){
                        $('#supplier').attr('disabled', true);
                        $('#modal').attr('disabled', true);
                        $('#sisa').attr('disabled', true);
                        $('.class-nama').html('Nama Jasa');
                        $('#supplier').empty()
                            .append('<option selected value> -- Anda memilih Jasa -- </option>');
                    }else if(data.jenis == 'Barang'){
                        $('#supplier').attr('disabled', false);
                        $('#modal').attr('disabled', false);
                        $('#sisa').attr('disabled', false);
                        $('.class-nama').html('Nama Barang');
                        $('#supplier').empty()
                            .append('<option selected value="'+ data.supplier+'"> '+ data.supplier+' </option>');
                    }
                    $('#jenis').empty()
                        .append('<option selected value='+ data.jenis+'> '+ data.jenis+' </option>');
                    
                    
                    $('#nama').val(data.nama);
                    $('#modal').val(data.modal);
                    $('#harga').val(data.harga);
                    $('#jumlah').val(data.jumlah);
                    $('#sisa').val(data.sisa);
                });

                $('.modal-title').html('Edit Data '+id);

                $('#id').val(id);

            });

            $(document).on('click','.edit-barang', function(e){
                
                var id= $('.editBarang').data('id');
                var barang = $('#barang').val();
                var deskripsi = $('#deskripsi').val();


                e.preventDefault();
                $('.save-barang').html('Edit Data');
                var id = $('#id').val();
                var barang = $('#barang').val();
                var img = $('#img').val();
                var deskripsi = $('#deskripsi').val();
                var data = $('#form-barang').serialize(); // ini buat tanpa image

                let fd = new FormData(document.getElementById("form-barang"));
                

                // alert(data);
                $.ajax({
                    data:fd,
                    url: "{{ route('ajax-barang.store')}}",
                    type: "POST",
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        console.log('berhasil',data);
                        $('.form-barang').trigger('reset');
                        table.draw();
                        $('.save-barang').html('Edit Data');
                    },
                    error: function (data) {
                        console.log('Error: ', data);
                        table.draw();
                        $('.save-barang').html('Edit Data');

                        // $.each(data.responseJSON.errors, function(k, v) {
                        //         $('[name=\"img\"]').after('<p class="error">'+v[0]+'</p>');
                        // });
                    }
                });


            });
            
            
            $(document).on('click','#print-pdf',function (e) {
                e.preventDefault();
                var dari = $('#dari').val();
                var sampai = $('#sampai').val();
                var opsi = 'pick';
                let url = "{{route('cetak.barang', [':dari',':sampai',':opsi'] )}}";

                if(dari == '' && sampai == ''){
                    dari = '1970-01-01';
                    sampai = '2099-12-12';
                }else if(sampai == ''){
                    sampai = dari;
                }

                url = url.replace(':dari', dari);
                url = url.replace(':sampai', sampai);
                url = url.replace(':opsi', opsi);
                
                window.open(url);
            });

            $(document).on('click','#print-pdf-bulanan',function (e) {
                e.preventDefault();

                var bulan = $('#bulan').val();
                var tahun = $('#tahun').val();
                var opsi = 'bulanan';
                var bulan_depan = Number(bulan) + 1;
                var tahun_depan = Number(tahun) + 1 ;
                if(bulan < 10){
                    bulan = '0'+bulan;
                }
                if(bulan_depan < 10){
                    bulan_depan = '0'+bulan_depan;
                }
                if(bulan == 12){
                    bulan_depan = '0'+ 1;
                    var dari = tahun + '-'+ bulan + '-01';
                    var sampai = tahun_depan + '-'+ bulan_depan + '-01';
                }else{
                    var dari = tahun + '-'+ bulan + '-01';
                    var sampai = tahun + '-'+ bulan_depan + '-01';
                }
                let url = "{{route('cetak.barang', [':dari',':sampai',':opsi'] )}}";

                if(dari == '' && sampai == ''){
                    dari = '1970-01-01';
                    sampai = '2099-12-12';
                }else if(sampai == ''){
                    sampai = dari;
                }

                url = url.replace(':dari', dari);
                url = url.replace(':sampai', sampai);
                url = url.replace(':opsi', opsi);
                
                window.open(url);
            });

            $(document).on('change','#bulan',function (e) {
                var bulan = $("#bulan option:selected").text();
                var tahun = $('#tahun').val();
                $('#print-pdf-bulanan').html('Laporan Bulan '+ bulan +' Tahun '+ tahun +'.'); 
            });

            $(document).on('keyup','#tahun',function (e) {
                var bulan = $("#bulan option:selected").text();
                var tahun = $('#tahun').val();
                $('#print-pdf-bulanan').html('Laporan Bulan '+ bulan +' Tahun '+ tahun +'.'); 
            });

            jQuery(document).ready(function(){
                $('#tahun').val("{{ date('Y') }}");
                var i;
                for(i = 1;i <13;i++){
                    var bulan = i;
                    if(bulan < 10){
                        bulan = '0' + i;
                    }
                    if( {{ date('m') }} == bulan ){
                        $('#bulan option[value='+i+']').attr('selected','selected');
                    }
                }
                var bulan = $("#bulan option:selected").text();
                var tahun = $('#tahun').val();
                $('#print-pdf-bulanan').html('Laporan Bulan '+ bulan +' Tahun '+ tahun +'.');
            });

        });

//PREVENT INSPECT ELEMENT SECTION

// // Disable right-click
// document.addEventListener('contextmenu', (e) => e.preventDefault());

// function ctrlShiftKey(e, keyCode) {
//   return e.ctrlKey && e.shiftKey && e.keyCode === keyCode.charCodeAt(0);
// }

// document.onkeydown = (e) => {
//   // Disable F12, Ctrl + Shift + I, Ctrl + Shift + J, Ctrl + U
//   if (
//     event.keyCode === 123 ||
//     ctrlShiftKey(e, 'I') ||
//     ctrlShiftKey(e, 'J') ||
//     ctrlShiftKey(e, 'C') ||
//     (e.ctrlKey && e.keyCode === 'U'.charCodeAt(0))
//   )
//     return false;
// };

    </script>
@stop