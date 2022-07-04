<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>@yield('Title')</title>

    <link rel="shortcut icon" type="image/png" href="{{URL::asset('img/SRlogo2.png')}}"/>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css?v=').time() }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;800&display=swap" rel="stylesheet">
    <style type="text/css">
        .bg-overlay{
            background: linear-gradient(rgba(255,0,0,.7), rgba(255,0,0,.7)), url('http://127.0.0.1:8000/img/image 19.png');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            width: 100%;
            height: 100%;
        }
    </style>
    @yield('css')
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>

</head>
<body style="overflow-x: hidden;">
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="navbarScroll" style="background: white; padding: 1em 7%">
    <a href="{{route('home')}}" class="navbar-brand">
        <img src="{{ URL::asset('img/logos.png')}}" width="65" style="margin-top: -7px ">
        <span class="mt-3">
            <h5 class="font-weight-normal d-inline-block" style="margin-top: 7px;"> Klinik Samratulangi </h5>
        </span>
    </a>
    </nav>
@yield('BawahNavbar')
@yield('Content')
<section class="bg-danger" style="margin-top: 10%">
    <footer class="" style="padding: 2em 7% 2em 7%;">
        <div class="row">
            <div class="col-lg-3 col-xl-2">
                <div class="text-center">
                    <img src="{{ asset('img/SRlogo.png') }}" alt="logo" width="100px">
                    <h6>Klinik Samratulangi</h6>
                </div>
            </div>
            <div class="col-lg col-xl">
                <h5><b>KONTAK INFORMASI</b></h5>
                <table>
                    <tr>
                        <td width=30px class="align-top pb-2"><i class="fa fa-map-marker-alt"></i></td>
                        <td class="pb-2">Jl. Samratulangi No. 22, Manahan, Kec. Banjarsari, Kota Surakarta, Jawa Tengah 57139</td>
                    </tr>
                    <tr>
                        <td width=30px class="align-top pb-2"><i class="fa fa-phone"></i></i></td>
                        <td class="pb-2">Telp. 0856-4742-2653</td>
                    </tr>
                </table>
            </div>
        </div>
        <hr class="w-100">
        <div class="row">
            <div class="col-sm-6 mt-2 text-sm-left text-center">
                <p>Copyright &copy; Klinik Samratulangi 2022</p>
            </div>
            <div class="col-sm-6 text-sm-right text-center">
                <a href="https://www.instagram.com/klinik_inginanak/" target="_blank" class="mr-2 text-white"><i class="fab fa-instagram fa-2x"></i></a>
                <a href="https://www.instagram.com/klinik_samratulangi/" target="_blank" class="mr-2 text-white"><i class="fab fa-instagram fa-2x"></i></a>
                <a href="https://www.facebook.com/klinik.samratulangi" target="_blank" class="mr-2 text-white"><i class="fab fa-facebook fa-2x"></i></a>
                <a href="https://www.youtube.com/channel/UCz4tHztDyKa5-2UBPPYsURg" target="_blank" class="mr-2 text-white"><i class="fab fa-youtube fa-2x"></i></a>
            </div>
        </div>
    </footer>
</section>


<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ URL::asset('lte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ URL::asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ URL::asset('lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ URL::asset('lte/dist/js/adminlte.js') }}"></script>
<!-- PAGE SCRIPTS -->
<script src="{{ URL::asset('lte/dist/js/pages/dashboard2.js') }}"></script>
@include('sweetalert::alert')
</body>
</html>
