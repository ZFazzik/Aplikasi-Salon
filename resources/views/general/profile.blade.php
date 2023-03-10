

@extends('template.base-sb2')

@section('title')
{{ $info->nama_web }} - Profile
@stop

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}"> 
@stop


@section('page-content')


<div class="container-fluid">
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
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">

    <form  method="post" action="{{ route('profile.perform') }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" name="id" id="id" value="{{ auth()->user()->id }}" />
        <input type="hidden" name="level" value="{{ auth()->user()->level }}" />
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                  <label for=""></label>
                  <input type="file" class="form-control-file" name="img" id="img" placeholder="" aria-describedby="fileHelpId">
                  <div class="d-flex justify-content-center">
                  Current Photo Profile
                  </div>
                  @if(auth()->user()->img == '' || auth()->user()->img == null)
                    <img src="{{asset('/img/No_image_available.png')}}" class="img-thumbnail ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                  @else
                    <img src="{{asset('/img/uploaded')}}/{{auth()->user()->img}}" class="img-thumbnail ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                  @endif
                  <div class="row d-flex justify-content-center">
                    <button type="button" class="btn btn-danger hapus-img" data-dismiss="modal">Hapus Gambar</button>
                  </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                  <label for="">Nomor Hp</label>
                  <input type="text"
                    class="form-control" name="hp" id="" aria-describedby="helpId" placeholder=""  value="{{auth()->user()->hp}}">
                  <small id="helpId" class="form-text text-muted"></small>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                  <label for="">Alamat</label>
                  <input type="text"
                    class="form-control" name="alamat" id="" aria-describedby="helpId" placeholder=""  value="{{auth()->user()->alamat}}">
                  <small id="helpId" class="form-text text-muted"></small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="">Nama</label>
                    <input type="text" class="form-control" name="name" id="" aria-describedby="helpId" placeholder="" value="{{auth()->user()->name}}" >
                    <small id="helpId" class="form-text text-muted"></small>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" class="form-control" name="username" id="" aria-describedby="helpId" placeholder="" value="{{auth()->user()->username}}">
                    <small id="helpId" class="form-text text-muted"></small>
            @if ($errors->has('username'))
                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
            @endif
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" class="form-control" name="email" id="" aria-describedby="helpId" placeholder="" value="{{auth()->user()->email}}">
                    <small id="helpId" class="form-text text-muted"></small>
            @if ($errors->has('email'))
                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
            @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="">Password Lama</label>
                    <input type="password" class="form-control" name="password" id="" aria-describedby="helpId" placeholder="">
                    <small id="helpId" class="form-text text-muted">Wajib diisi untuk mengkonfirmasi bahwa ini benar-benar anda.</small>
            @if ($errors->has('password'))
                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
            @endif
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="">Password Baru</label>
                    <input type="password" class="form-control" name="new_password" id="" aria-describedby="helpId" placeholder="">
                    <small id="helpId" class="form-text text-muted">Kosongkan kolom ini jika tidak ingin mengubah password</small>
            @if ($errors->has('new_password'))
                <span class="text-danger text-left">{{ $errors->first('new_password') }}</span>
            @endif
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="">Konfirmasi Password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="" aria-describedby="helpId" placeholder="">
                    <small id="helpId" class="form-text text-muted">Kosongkan kolom ini jika tidak ingin mengubah password</small>
            @if ($errors->has('password_confirmation'))
                <span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
            @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-5"></div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Ubah Profil
                </button>
            </div>
            <div class="col-sm-5"></div>
        </div>
    </form>


        </div>
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

@stop