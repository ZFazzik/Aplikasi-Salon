@extends('template.base-sb2')

@section('title')
{{ $info->nama_web }} - Properti
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
            <h6 class="m-0 font-weight-bold text-primary float-left">Data Properti</h6>
            <button type="button" class="btn btn-primary float-right add-properti" data-toggle="modal" data-target="#modelId"><i class="fa fa-plus" aria-hidden="true"></i>Add Data</button>
        </div>
        <div class="card-body">
                <table class="table table-bordered data-properti" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Properti</th>
                            <th>Type Properti</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Properti</th>
                            <th>Type Properti</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>

                </table>
        </div>
    </div>

</div>



<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
            <div class="modal-body">
                <div class="container-fluid">

                <form id="form-properti" name="form-properti" class="form-properti">
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="col-sm-3">
                                Nama Properti
                            </div>
                            <div class="col-sm-1">
                                :
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama" id="nama" aria-describedby="helpId" placeholder="">
                                <small id="helpId" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                Type Properti
                            </div>
                            <div class="col-sm-1">
                                :
                            </div>
                            <div class="col-sm-8">
                                <div class="row">
                                    <input type="radio" class="form-check-input" name="typeRadio" id="typeRadio" value="Jenis">
                                    Jenis
                                </div>
                                <div class="row">
                                    <input type="radio" class="form-check-input" name="typeRadio" id="typeRadio" value="Supplier">
                                    Supplier
                                </div>
                                <div class="row">
                                    <input type="radio" class="form-check-input" name="typeRadio" id="typeRadio" value="Lain">
                                    Yang Lain (isi sendiri)
                                </div>
                                <div class="row">
                                      <input type="text"
                                        class="form-control" name="type" id="type" aria-describedby="helpId" placeholder="" readonly>
                                      <small id="helpId" class="form-text text-muted"></small>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                Keterangan
                            </div>
                            <div class="col-sm-1">
                                :
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="keterangan" id="keterangan" aria-describedby="helpId" placeholder="">
                                <small id="helpId" class="form-text text-muted"></small>
                            </div>
                        </div>

                    </form>
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
    <script src="{{asset ('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset ('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- <script src="{{asset ('js/demo/datatables-demo.js')}}"></script> -->

    <!-- <script src="{{asset ('js/jquery-3.4.1.min.js')}}"></script> -->
    <script type="text/javascript">
        $(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('.data-properti').DataTable({
                processing : true,
                serverSide : true,
                ajax: "{{route ('ajax-properti.index')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', "width": 20,className: "dt-center"},
                    {data: 'nama', name:'nama'},
                    {data: 'type', name:'type'},
                    {data: 'keterangan',name:'keterangan'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, width : "13%", className: "dt-center"}
                ],
                fnDrawCallback: function( oSettings ) {
                    $('.page-item').removeClass('paginate_button');
                }
            });
            $(document).on('change','#typeRadio', function (e) {
                e.preventDefault();
                var typeRadio = $(this).val();

                if( typeRadio === 'Jenis'){
                    $('#type').val('Jenis');
                    $('#type').attr('readonly',true);
                }else if( typeRadio === 'Supplier'){
                    $('#type').val('Supplier');
                    $('#type').attr('readonly',true);
                }else{
                    $('#type').val('');
                    $('#type').attr('readonly',false);
                }
            });
            $(document).on('click', '.add-properti', function() {
                $('.modal-title').html('Tambah Data');
                $('.save-properti').html('Simpan Data');
                $('.save').removeClass('edit-properti');
                $('.save').addClass('save-properti');
                $('.save').html('Tambah Data');
                $('#id').val('');
                $('.form-properti').trigger('reset');
            });
            $(document).on('click','.save-properti',function(e) {
                // alert('data saved');
                e.preventDefault();
                var nama = $('#nama').val();
                var type = $('#type').val();

                if(nama === '' || nama === null){
                    alert('Nama properti wajib diisi.');
                }else if(type ==='' || type === null){
                    alert('Type properti wajib diisi.');
                }else{
                    $(this).html('Mengirim...');
                    var id = $('#id').val();
                    var nama = $('#nama').val();
                    var type = $('#type').val();
                    var keterangan = $('#keterangan').val();
                    var data = $("#form-properti :input[name!=typeRadio]").serialize(); // ini buat tanpa image

                    let fd = new FormData(document.getElementById("form-properti"));
                    

                    // alert(data);
                    $.ajax({
                        data:data,
                        url: "{{ route('ajax-properti.store')}}",
                        type: "POST",
                        dataType: 'json',
                        success: function (data) {
                            console.log('berhasil',data);
                            $('.form-properti').trigger('reset');
                            table.draw();
                            $(this).html('Tambah Data');
                        },
                        error: function (data) {
                            console.log('Error: ', data);
                            table.draw();
                            $('.save-properti').html('Simpan Data');
                            $(this).html('Tambah Data');
                            JSON.stringify(data);
                        }
                    });
                }
            });
            
            $(document).on('click','.deleteProperti',function (e) {
                var id= $(this).data("id");
                var selectedRows = table.rows('.selected').data();
                //if you are getting array of objects inside main object
                // alert(selectedRows[0].nama);
                // alert(selectedRows[0].type);
                var textConfirm = "Apakah kamu yakin menghapus " + selectedRows[0].nama + "?";


                if(confirm(textConfirm) == true){
                    $.ajax({
                        type: "DELETE",
                        url:"{{route ('ajax-properti.store') }}"+'/'+id,
                        success: function (data){
                            table.draw();
                        },
                        error: function(data){
                            console.log('error: ',data);
                            $('#dataTable tbody tr').removeClass('selected');
                        }
                    });
                }else{
                    $('#dataTable tbody tr').removeClass('selected');
                }
                    
            
            });

            $('#dataTable tbody').on('click', 'tr', function () {
                $(this).toggleClass('selected');
            });

            $(document).on('click','.editProperti', function (e) {
                $('.save-properti').html('Edit Data');
                var id= $(this).data("id");
                $('.save').removeClass('save-properti');
                $('.save').addClass('edit-properti');
                $('.save').html('Edit Data');
                $.get("{{route('ajax-properti.index')}}" + '/'+ id +'/edit',function(data){

                    if(data.type === 'Jenis' || data.type === 'Supplier'){
                        if(data.type === 'Jenis'){
                            $("input[name=typeRadio][value='Jenis']").prop('checked', true);
                        }else if(data.type === 'Supplier'){
                            $("input[name=typeRadio][value='Supplier']").prop('checked', true);
                        }
                        $('#type').attr('readonly', true);
                    }else{
                        $("input[name=typeRadio][value='Lain']").prop('checked', true);
                        $('#type').attr('readonly', false);
                    }

                    $('#nama').val(data.nama);
                    $('#type').val(data.type);
                    $('#keterangan').val(data.keterangan);

                });

                $('.modal-title').html('Edit Data '+id);

                $('#id').val(id);

            });

            $(document).on('click','.edit-properti', function(e){
                e.preventDefault();
                $('.save-properti').html('Edit Data');
                var id = $('#id').val();
                var barang = $('#barang').val();
                var img = $('#img').val();
                var deskripsi = $('#deskripsi').val();
                var data = $('#form-properti :input[name!=typeRadio]').serialize(); // ini buat tanpa image

                let fd = new FormData(document.getElementById("form-properti"));
                
                if(nama === '' || nama === null){
                    alert('Nama properti wajib diisi.');
                }else if(type ==='' || type === null){
                    alert('Type properti wajib diisi.');
                }else{
                    // alert(data);
                    $.ajax({
                        data:data,
                        url: "{{ route('ajax-properti.store')}}",
                        type: "POST",
                        dataType: 'json',
                        success: function (data) {
                            console.log('berhasil',data);
                            $('.form-properti').trigger('reset');
                            table.draw();
                            $('.save-properti').html('Edit Data');
                        },
                        error: function (data) {
                            console.log('Error: ', data);
                            table.draw();
                            $('.save-properti').html('Edit Data');

                            // $.each(data.responseJSON.errors, function(k, v) {
                            //         $('[name=\"img\"]').after('<p class="error">'+v[0]+'</p>');
                            // });
                        }
                    });
                }
                


            });
            

        });

       



    </script>
    
@endif
@stop