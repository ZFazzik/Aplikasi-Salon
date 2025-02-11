@extends('template.base-sb2')

@section('title')
{{ $info->nama_web }} - Penjualan
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
            <div class="row p-3">
                <div class="col-sm-7">
                    <h6 class="m-0 font-weight-bold text-primary">Data Penjualan</h6>
                </div>
                <div class="col-sm-2">
                    <input type="date" class="form-control" name="" id="dari" aria-describedby="helpId" placeholder=""  data-toggle="tooltip" data-placement="top"  title="Isi kolom ini saja untuk melihat satu tanggal yg dipilih.">
                    
                </div>
                <div class="col-sm-2">
                    <input type="date" class="form-control" name="" id="sampai" aria-describedby="helpId" placeholder="" data-toggle="tooltip" data-placement="top"  title="Isi kolom ini juga jika ingin melihat dari tanggal berapa sampai tanggal berapa.">
                </div>
                <div class="col-sm-1">
                    <a name="" id="print-pdf" class="btn btn-primary btnPrint" href="" role="button" target=""><i class="fa fa-print" aria-hidden="true" data-toggle="tooltip" data-placement="top"  title="Jangan isi semua kolom jika anda ingin melihat seluruh tanggal laporan."></i></a>
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
                <table class="table table-bordered data-penjualan" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Laba</th>
                            <th>Deskripsi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Laba</th>
                            <th>Deskripsi</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>

                </table>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                      <label for="">Total laba:</label>
                      <input type="text" class="form-control text-right" name="laba" id="laba" aria-describedby="helpId" placeholder="" readonly>
                      <small id="helpId" class="form-text text-muted">hanya tabel page sekarang saja</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
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

                <form id="form-penjualan" name="form-penjualan" class="form-penjualan">
                <input type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="col-sm-4">
                                Gambar
                            </div>
                            <div class="col-sm-1">
                                :
                            </div>
                            <div class="col-sm-7">
                                <div id="imgDetail"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                Jenis
                            </div>
                            <div class="col-sm-1">
                                :
                            </div>
                            <div class="col-sm-7 font-weight-bold">
                                <div id="jenisDetail"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                Supplier
                            </div>
                            <div class="col-sm-1">
                                :
                            </div>
                            <div class="col-sm-7 font-weight-bold">
                                <div id="supplierDetail"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                Modal
                            </div>
                            <div class="col-sm-1">
                                :
                            </div>
                            <div class="col-sm-7 font-weight-bold">
                                <div id="modalDetail"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                Harga Satuan
                            </div>
                            <div class="col-sm-1">
                                :
                            </div>
                            <div class="col-sm-7 font-weight-bold">
                                <div id="hargaSatuanDetail"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                Jumlah barang (terjual)
                            </div>
                            <div class="col-sm-1">
                                :
                            </div>
                            <div class="col-sm-7 font-weight-bold">
                                <div id="jumlahDetail"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                Total Harga
                            </div>
                            <div class="col-sm-1">
                                :
                            </div>
                            <div class="col-sm-7 font-weight-bold">
                                <div id="totalDetail"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                Laba
                            </div>
                            <div class="col-sm-1">
                                :
                            </div>
                            <div class="col-sm-7 font-weight-bold">
                                <div id="labaDetail"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                Keterangan
                            </div>
                            <div class="col-sm-1">
                                :
                            </div>
                            <div class="col-sm-7 font-weight-bold">
                                <div id="ketDetail"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                Penanggung Jawab
                            </div>
                            <div class="col-sm-1">
                                :
                            </div>
                            <div class="col-sm-7 font-weight-bold">
                                <div id="pegawaiDetail"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                Tanggal pembelian
                            </div>
                            <div class="col-sm-1">
                                :
                            </div>
                            <div class="col-sm-7 font-weight-bold">
                                <div id="tanggalDetail"></div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('.data-penjualan').DataTable({
                responsive : true,
                processing : true,
                serverSide : true,
                ajax: "{{route ('ajax-penjualan.index')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', "width": 20,className: "dt-center"},
                    {data: 'nama_barang', name:'nama'},
                    {data: 'jumlah', name:'jumlah'},
                    {data: 'total_harga', name:'total_harga'},
                    {data: 'laba', name:'laba'},
                    {data: 'deskripsi',name:'deskripsi'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, width : "5%", className: "dt-center"}
                ],
                fnDrawCallback: function( oSettings ) {
                    $('.page-item').removeClass('paginate_button');
                },
                drawCallback: function () {
                    $('.page-item').removeClass('paginate_button');
                    var api = this.api();
                    var laba = api.column( 4, {page:'all'} ).data().sum();
                    var nf = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                    
                    $('#laba').val(
                        nf.format(laba)
                    );
                },
            });

            $(document).on('click', '.detailPenjualan', function() {
                var id= $(this).data("id");
                $('.modal-title').html('Detail');
                let url = "{{route('penjualan.detail', ':id' )}}";
                url = url.replace(':id', id)

                $.get(url,function(data){
                    var tanggal_base = data.penjualan.created_at;
                    var tanggal = tanggal_base.slice(0,10);
                    var NoImg = "{{asset('/img/No_image_available.png')}}";
                    var Img = "{{asset('/img/uploaded')}}" +'/'+ data.penjualan.img;

                    if(data.penjualan.img == null || data.penjualan.img == ''){
                        $('#imgDetail').html("<img src='"+ NoImg +"' class='img-thumbnail rounded-top' alt=''>");
                    }else{
                        $('#imgDetail').html("<img src='"+ Img +"' class='img-thumbnail rounded-top' alt=''>");
                    }
                    
                    $('.modal-title').html('Detail: '+data.penjualan.nama_barang);
                    $('#jenisDetail').html(data.penjualan.jenis);
                    $('#supplierDetail').html(data.penjualan.supplier);
                    $('#modalDetail').html(data.penjualan.modal);
                    $('#hargaSatuanDetail').html(data.penjualan.harga_satuan);
                    $('#jumlahDetail').html(data.penjualan.jumlah);
                    $('#totalDetail').html(data.penjualan.total_harga);
                    $('#labaDetail').html(data.penjualan.laba);
                    $('#ketDetail').html(data.penjualan.deskripsi);
                    $('#pegawaiDetail').html(data.penjualan.nama_pegawai);
                    $('#tanggalDetail').html(tanggal);
                });

            });
            

        });

        $(document).on('click','#print-pdf',function (e) {
            e.preventDefault();
            var dari = $('#dari').val();
            var sampai = $('#sampai').val();
            var opsi = 'pick';
            let url = "{{route('cetak.penjualan', [':dari',':sampai',':opsi'] )}}";

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
            let url = "{{route('cetak.penjualan', [':dari',':sampai',':opsi'] )}}";

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

    </script>
@stop