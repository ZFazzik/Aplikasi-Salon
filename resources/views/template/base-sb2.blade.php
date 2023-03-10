<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>
    @if($info->icon_web == '' || $info->icon_web == null)
    <link rel="icon" type="image/x-icon" href="{{asset('/img/No_image_available.png')}}">
    @else
    <link rel="icon" type="image/x-icon" href="{{asset('/img/uploaded')}}/{{ $info->icon_web }}">
    @endif
    <!-- Custom fonts for this template-->
    <link href="{{asset ('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset ('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <!-- Custom css for each page -->
    @yield('css')
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
</head>

<body id="page-top">


        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            @include('template.sidebar-sb2')
            <!-- End of Sidebar -->
    
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
    
                <!-- Main Content -->
                <div id="content">
    
                    <!-- Topbar -->
                        @include('template.topbar-sb2')
                    <!-- End of Topbar -->
    
                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        @yield('page-content')
                        
                    </div>
                    <!-- /.container-fluid -->
    
                </div>
                <!-- End of Main Content -->
    
                <!-- Footer -->
                @include('template.footer-sb2')
                <!-- End of Footer -->
    
            </div>
            <!-- End of Content Wrapper -->
    
        </div>
        <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset ('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset ('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    
    <!-- Core plugin JavaScript-->
    <script src="{{asset ('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset ('js/sb-admin-2.min.js')}}"></script>


    <!-- Custom script for each pages -->
    @yield('script')
    <script>
        $(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on('click','.notif-hapus', function (e) {
                var id = $('#id_notif').val();
                let url = "{{route('hapus-notif.barang', ':id' )}}";
                url = url.replace(':id', id)
                
                $.ajax({
                    type: "DELETE",
                    url: url,
                    success: function (data){
                        $(window).attr('location',"{{ route('barang') }}")
                    },
                    error: function(data){
                        console.log('error: ',data);
                    }
                });
            });
        });
        
    </script>
</body>
</html>