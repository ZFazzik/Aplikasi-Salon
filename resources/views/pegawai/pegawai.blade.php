@extends('template.base-sb2')

@section('title')
{{ $info->nama_web }} - Pegawai
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
@if(auth()->user()->level == 2)
Kamu adalah kasir, kamu tidak diperbolehkan dipage ini.
<small id="helpId" class="form-text text-muted">Hentikan percobaan pemalsuan data atau anda akan dikenakan penalty.</small>
@else
            <div class="row p-3">
                <div class="col-sm-10">
                    <h6 class="m-0 font-weight-bold text-primary">Data Pegawai</h6>
                </div>
                <div class="col-sm-2">
                    <a name="" id="" class="btn btn-primary float-right" href="{{ route('register.show') }}" role="button"><i class="fa fa-user-plus" aria-hidden="true"></i> Register</a>
                </div>
            </div>
            
        </div>
        <div class="card-body">
            <div class="">
                <table class="table table-bordered data-pegawai" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pegawai</th>
                            <th>Foto</th>
                            <th>No. HP</th>
                            <th>Alamat</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Pegawai</th>
                            <th>Foto</th>
                            <th>No. HP</th>
                            <th>Alamat</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>

                </table>
            </div>


        </div>
    </div>
</div>

<!-- Modal Detail-->
<div class="modal fade" id="modelDetail" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5>Detail </h5>
                    <h5 class="font-weight-bold" id="namaDetail"></h5>
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
                                Nomor Hp
                            </div>
                            <div class="col-sm-1">
                                :
                            </div>
                            <div class="col-sm-8 font-weight-bold">
                                <div id="hpDetail"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                Alamat
                            </div>
                            <div class="col-sm-1">
                                :
                            </div>
                            <div class="col-sm-8 font-weight-bold">
                                <div id="alamatDetail"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                Level
                            </div>
                            <div class="col-sm-1">
                                :
                            </div>
                            <div class="col-sm-8 font-weight-bold">
                                <div id="levelDetail"></div>
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
                <button type="button" class="btn btn-danger invisible hapus-img" data-dismiss="modal">Hapus Gambar</button>
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

            var table = $('.data-pegawai').DataTable({
                processing : true,
                serverSide : true,
                ajax: "{{route ('ajax-pegawai.index')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', "width": 20,className: "dt-center"},
                    {data: 'name', name:'name'},
                    {data: 'img', name:'img'},
                    {data: 'hp', name:'hp'},
                    {data: 'alamat', name:'alamat'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, width : "15%", className: "dt-center"}
                ],
                drawCallback: function () {
                    $('.page-item').removeClass('paginate_button');
                },
                fnDrawCallback: function( oSettings ) {
                    $('.page-item').removeClass('paginate_button');
                }
            });

            $(document).on('click', '.detailPegawai', function() {
                var id= $(this).data("id");
                $('.hapus-img').removeClass('invisible');

                $.get("{{route('ajax-pegawai.index')}}" + '/'+ id +'/edit',function(data){
                    var tanggal_base = data.created_at;
                    var tanggal = tanggal_base.slice(0,10);
                    var NoImg = "{{asset('/img/No_image_available.png')}}";
                    var Img = "{{asset('/img/uploaded')}}" +'/'+ data.img;

                    if(data.img == null || data.img == ''){
                        $('#imgDetail').html("<img src='"+ NoImg +"' class='img-thumbnail rounded-top' alt=''>");
                    }else{
                        $('#imgDetail').html("<img src='"+ Img +"' class='img-thumbnail rounded-top' alt=''>");
                    }
                    
                    $('#id').val(data.id);
                    $('#namaDetail').html(data.name);
                    $('#hpDetail').html(data.hp);
                    $('#alamatDetail').html(data.alamat);
                    if(data.level == 1){
                        $('#levelDetail').html('Admin');
                    }else if(data.level == 2){
                        $('#levelDetail').html('Kasir');
                    }
                    $('#tanggalDetail').html(tanggal);
                });

            });

            $(document).on('click', '.add-pegawai', function() {
                $('.modal-title').html('Tambah Data');
                $('.save-pegawai').html('Simpan Data');
                $('.save').removeClass('edit-pegawai');
                $('.save').addClass('save-pegawai');
                $('.save').html('Tambah Data');
                $('#id').val('');
                $('.form-pegawai').trigger('reset');
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

            $(document).on('click','.save-pegawai',function(e) {
                // alert('data saved');
                e.preventDefault();
                $(this).html('Mengirim...');
                var id = $('#id').val();
                var pegawai = $('#pegawai').val();
                var img = $('#img').val();
                var deskripsi = $('#deskripsi').val();
                var data = $('#form-pegawai').serialize(); // ini buat tanpa image

                let fd = new FormData(document.getElementById("form-pegawai"));
                
                // alert(data);
                $.ajax({
                    data:fd,
                    url: "{{ route('ajax-pegawai.store')}}",
                    type: "POST",
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        console.log('berhasil',data);
                        $('.form-pegawai').trigger('reset');
                        table.draw();
                        $(this).html('Tambah Data');
                    },
                    error: function (data) {
                        console.log('Error: ', data);
                        table.draw();
                        $('.save-pegawai').html('Simpan Data');
                        $(this).html('Tambah Data');
                        JSON.stringify(data);

                        // $.each(data.responseJSON.errors, function(k, v) {
                        //         $('[name=\"img\"]').after('<p class="error">'+v[0]+'</p>');
                        // });
                    }
                });

            });
            $(document).on('click','.deletePegawai',function (e) {
                var id= $(this).data("id");
                var textConfirm = "Apakah kamu yakin menghapus " + id + "?";

                if(confirm(textConfirm) == true){
                    $.ajax({
                        type: "DELETE",
                        url:"{{route ('ajax-pegawai.store') }}"+'/'+id,
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
                let url = "{{route('hapus-img.pegawai', ':id' )}}";
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
            
            
            $(document).on('click','#print-pdf',function (e) {
                e.preventDefault();
                var dari = $('#dari').val();
                var sampai = $('#sampai').val();
                var opsi = 'pick';
                let url = "{{route('cetak.pegawai', [':dari',':sampai',':opsi'] )}}";

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
                let url = "{{route('cetak.pegawai', [':dari',':sampai',':opsi'] )}}";

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
    @endif
@stop