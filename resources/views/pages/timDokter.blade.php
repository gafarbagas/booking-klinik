@extends('layouts.main')

@section('Title','Klinik Samratulangi')

@section('BawahNavbar')
    <section class="min-vh-70 w-100">
        <div class="mb-5">
            <div class="row" style="">
                <div class="col-md-12" style="padding-right: 0">
                    <div class="card shadow-none">
                        <img src="{{ URL::asset('img/banner-dokter.png') }}" class="card-img" style="border-radius: 10% 0 0 0;">
                        <span class="card-img-overlay" style="border-radius: 10% 0 0 0;"></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('Content')
    <div class="content">
        <div class="container-fluid">
            <h3 style="text-align: center"><b>Tim Dokter</b></h3>
            <br>
            <br>
            <div class="row">
                <div class="col-lg-6">
                    <h4 style="text-align: center">dr. Aminah Alaydrus Mkes, SpKK</h4>
                        <img src="{{ URL::asset('img/doctor2.jpeg') }}"  alt="" width="200px" height="300px" style="display: block;
                        margin-left: auto; margin-right: auto;">
                    <h5 style="text-align: center">Spesialis Kulit dan Kelamin</h5>
                    <br>
                </div>

                <div class="col-lg-6">
                    <h4 style="text-align: center">DR. dr. Abdurahman Laqif Alaydrus Sp.OG (K)FER </h4>
                    <img src="{{ URL::asset('img/doctor1.jpeg') }}"  alt="" width="200px" height="300px" style="display: block;
                        margin-left: auto; margin-right: auto;">
                    <h5 style="text-align: center">Spesialis Kebidanan & Kandungan <br> Konsultan Fertilitas & Endoktrinologi Reproduksi</h5>
                    <br>
                </div>
            </div>

        </div>

    </div>
@endsection

