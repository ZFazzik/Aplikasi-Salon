

@extends('template.base-sb2')

@section('title')
{{ $info->nama_web }} - Info
@stop

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}"> 
@stop


@section('page-content')


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">

@if(isset ($errors) && count($errors) > 0)
    <div class="alert alert-warning" role="alert">
        <ul class="list-unstyled mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::get('success', false))
    <?php $data = Session::get('success'); ?>
    @if (is_array($data))
        @foreach ($data as $msg)
            <div class="alert alert-warning" role="alert">
                <i class="fa fa-check"></i>
                {{ $msg }}
            </div>
        @endforeach
    @else
        <div class="alert alert-warning" role="alert">
            <i class="fa fa-check"></i>
            {{ $data }}
        </div>
    @endif
@endif

@if(auth()->user()->level == 2)
    Kamu adalah kasir, kamu tidak diperbolehkan dipage ini.
    <small id="helpId" class="form-text text-muted">Hentikan percobaan pemalsuan data atau anda akan dikenakan penalty.</small>
@else

    <form  method="post" action="{{ route('info.perform') }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" name="id" id="id" value="1" />
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                  <label for="">Nama Web</label>
                  <input type="text"
                    class="form-control" name="nama_web" id="" aria-describedby="helpId" placeholder=""  value="{{ $info->nama_web }}">
                  <small id="helpId" class="form-text text-muted"></small>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                  <label for=""></label>
                  <input type="file" class="form-control-file" name="img" id="img" placeholder="" aria-describedby="fileHelpId">
                  <div class="d-flex justify-content-center">
                  Current Web Logo
                  </div>
                  @if($info->icon_web == '' || $info->icon_web == null)
                    <img src="{{asset('/img/No_image_available.png')}}" class="img-thumbnail ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                  @else
                    <img src="{{asset('/img/uploaded')}}/{{ $info->icon_web }}" class="img-thumbnail ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                  @endif
                  <div class="row d-flex justify-content-center">
                    <button type="button" class="btn btn-danger hapus-img" data-dismiss="modal">Hapus Gambar</button>
                  </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                  <label for=""></label>
                  <input type="file" class="form-control-file" name="img_loginscreen" id="img" placeholder="" aria-describedby="fileHelpId">
                  <div class="d-flex justify-content-center">
                  Current Login and Registerscreen Image
                  </div>
                  @if($info->loginscreen_web == '' || $info->loginscreen_web == null)
                    <img src="{{asset('/img/No_image_available.png')}}" class="img-thumbnail ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                  @else
                    <img src="{{asset('/img/uploaded')}}/{{ $info->loginscreen_web }}" class="img-thumbnail ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                  @endif
                  <div class="row d-flex justify-content-center">
                    <button type="button" class="btn btn-danger hapus-img" data-dismiss="modal">Hapus Gambar</button>
                  </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Ubah Info
                </button>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </form>


        </div>
    </div>

@stop

@section('script')   
<script>
$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click','.hapus-img', function (e) {
        var id = $('#id').val();
        var textConfirm = "Apakah kamu yakin menghapus foto profil?";
        let url = "{{route('hapus-img.pegawai', ':id' )}}";
        url = url.replace(':id', id)
        
        if(confirm(textConfirm) == true){
            $.ajax({
                type: "DELETE",
                url: url,
                success: function (data){
                    $(window).attr('location',"{{ route('profile') }}")
                },
                error: function(data){
                    console.log('error: ',data);
                }
            });
        }
    });
});
    
</script>

@endif

@stop