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
    <link href="{{ asset('lte/dist/css/font.css') }}" rel="stylesheet">
    @yield('css')

</head>
<body style="overflow-x: hidden;">
<a id="back-to-top" href="#" class="btn btn-light btn-lg back-to-top d-none d-sm-block" role="button"><i class="fa fa-chevron-up"></i></a>
<section class="">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="navbarScroll" style="background: white; padding: 1em 7%">
        <a href="#" class="navbar-brand">
            <img src="{{ URL::asset('img/logos.png')}}" width="65" alt="logo" style="margin-top: -7px ">
            <h5 class="font-weight-normal d-inline-block" style="margin-top: 7px;"> Klinik Samratulangi </h5>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav ml-auto my-auto mt-lg-0">
                <li class="nav-item pt-1 {{Request::is('/')?' active':''}}">
                    <a href="{{ URL('/') }}" class="nav-link mt-1">Beranda</a>
                </li>
                <li class="nav-item pt-1 {{Request::is('tentang-kami')?' active':''}}">
                    <a href="{{ URL('tentang-kami') }}" class="nav-link mt-1">Tentang Kami</a>
                </li>
                <li class="nav-item pt-1 {{Request::is('tim-dokter')?' active':''}}">
                    <a href="{{ URL('tim-doctor') }}" class="nav-link mt-1">Tim Dokter</a>
                </li>
                @empty(Auth::check())
                    <li class="nav-item pt-1">
                        <a href="{{ URL('login') }}" class="nav-link mt-1">Masuk</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ URL('daftar-akun') }}" class="nav-link">
                            <button class="btn btn-outline-danger">
                                Daftar
                            </button>
                        </a>
                    </li>
                @else
                    <li class="nav-item my-auto">
                        <div class="d-inline-block">
                            <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <button class="btn">{{ auth()->user()->name }}</button>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownUser">
                                <a class="dropdown-item" href="/dashboard">Dashboard</a>
                                <form  action="{{ route('logout') }}" method="post" class="dropdown-item">
                                    @csrf
                                    <button type="submit" class="btn m-0 p-0">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </li>
                @endempty
            </ul>
        </div>
    </nav>
</section>
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
<!-- Icon -->
<script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
<!-- jQuery -->
<script src="{{ URL::asset('lte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ URL::asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ URL::asset('lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ URL::asset('lte/dist/js/adminlte.js') }}"></script>
<!-- OPTIONAL SCRIPTS -->
<script src="{{ URL::asset('lte/dist/js/demo.js') }}"></script>

<script>
    $(document).ready(function(){
        $(window).scroll(function () {
            if ($(this).scrollTop()>50) {
                $('#navbarScroll').css('background-color','white');
            }else{
                $('#navbarScroll').css('background-color','white');
            }
        });
        $(window).scroll(function () {
            if ($(this).scrollTop() > 300) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
        // scroll body to 0px on click
        $("#back-to-top").click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 400);
            return false;
        });
    });
</script>
</body>
</html>
