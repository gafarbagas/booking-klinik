@extends('layouts.main')

@section('Title','Tentang Kami')

@section('BawahNavbar')
    <section class="">
        <div class="mb-5" style="margin: 0 7%;padding-top: 10%">
            <div class="text-center">
                <h3>Tentang Kami</h3>
                <hr class="bg-danger mt-0" style="width: 3%;">
            </div>
            <div class="row" style="">
                <div class="col-md-5">
                    <div class="card text-center shadow-none">
                        <img src="{{ asset('img/ttgkamii.webp') }}" class="card-img" alt="tentang kami" height="500px">
                    </div>
                </div>
                <div class="col-md-7" style="padding-right: 0">
                    <div class="">
                        <h4><b>Visi</b></h4>
                        <h5 class="text-uppercase">Menjadikan Klinik Samratulangi
                            Sebagai klinik pilihan dengan pelayanan bermutu sesuai kompetensi</h5>
                        <h4 class="mt-4"><b>Misi</b></h4>
                        <h5 class="text-uppercase">Memberikan Pelayanan Kesehatan yang Bermutu, Terjangkau, Profesional dan Berorientasi pada Pasien </h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('Content')
    <div class="text-center mb-5 mt-3 py-3" style="background-color: #E0E0E0">
        <h6 class="small" style="font-size: 12px;">- PELAYANAN KAMI -</h6>
        <h2>Layanan Terpercaya Kami</h2>
    </div>
    <section style="padding: 0 7%">
        <div class="row">
            <div class="col-md-3">
                <div class="text-center mb-4 mt-3">
                    <span class="btn btn-primary" style="font-size: 15px">Layanan Dermatology</span>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12 py-sm-1">
                        <div class="card">
                            <div class="text-center shadow" style="min-height: 250px;">
                                <img src="{{ asset('img/skinclinic.webp') }}" class="img-fluid mb-3" alt="skinclinic" style="height: 200px; width: 350px;">
                                <div class="container">
                                    <h6><b>Skin Clinic</b></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center mb-4 mt-3">
                    <span class="btn btn-primary" style="font-size: 15px">Layanan Cosmetic Medic</span>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12 py-sm-1">
                        <div class="card">
                            <div class="text-center shadow" style="min-height: 250px;">
                                <img src="{{ asset('img/kulit.webp') }}" class="img-fluid mb-3" alt="Kulit" style="height: 200px; width: 350px;">
                                <div class="container">
                                    <h6 style="font-size: 15px"><b>Cosmetic medic & aesthetica</b></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center mb-4 mt-3">
                    <span class="btn btn-primary" style="font-size: 15px">Layanan Obgyn</span>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12 py-sm-1">
                        <div class="card">
                            <div class="text-center shadow" style="min-height: 250px;">
                                <img src="{{ asset('img/kandungan.webp') }}" class="img-fluid mb-3" alt="kandungan" style="height: 200px; width: 350px;">
                                <div class="container">
                                    <h6><b>Obgyn</b></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center mb-4 mt-3">
                    <span class="btn btn-primary" style="font-size: 15px">Layanan Fertility</span>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12 py-sm-1">
                        <div class="card">
                            <div class="text-center shadow" style="min-height: 250px;">
                                <img src="{{ asset('img/fertility.webp') }}" class="img-fluid mb-3" alt="fertility" style="height: 200px; width: 350px;">
                                <div class="container">
                                    <h6><b>Fertility</b></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
