@extends('layouts.main')

@section('Title','Klinik Samratulangi')

@section('BawahNavbar')
    <section>
        <div class="mb-5" style="margin-left: 7%;padding-top: 10%">
            <div class="row" style="">
                <div class="col-md-4 my-5">
                    <h2 class="font-weight-bold" style="line-height: 52px">Professional dalam Tugas
                        <br> Melayani dengan Hati </h2>
                    <a href="{{route('login')}}">
                        <button class="btn btn-danger px-4 py-2 small" style="box-shadow: 0px 0px 0px 0px rgba(255,0,0,0.75);">Buat Janji</button>
                    </a>
                </div>
                <div class="col-md-8" style="padding-right: 0">
                    <div class="card shadow-none">
                        <img src="{{ URL::asset('img/landing.webp') }}" class="card-img" alt="landing">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('Content')
    <section class="py-3">
        <div class="text-center mb-5 mt-3 py-3" style="background-color: #E0E0E0">
            <h6 class="small" style="font-size: 12px;">- JADWAL -</h6>
            <h2>Jadwal Layanan dan Praktek</h2>
        </div>
        <div class="mt-5" style="padding: 0 7%">
            <div class="row">
                <div class="col-md-6">
                    <div style="min-height:55vh" >
                        <div class="row justify-content-center">
                            <div class="card" style="width: 90%; border-radius: 20px;">
                            <div class="card-body bg-danger small" style="border-radius: 20px;">
                                <h4 class="my-3 text-center">Jam Buka <br>
                                    dr. Aminah Alaydrus Mkes, SpKK</h4>
                                <p class="text-center">Dermatology</p>
                                <div id="ttgKami" class="text-center">
                                    <div class="row">
                                        <p class="col-3">Senin</p>
                                        <p class="col-4" color="white">09.00-13.00</p>
                                        <p class="col-4">19.00-21.00</p>
                                    </div>
                                    <div class="row">
                                        <p class="col-3">Selasa</p>
                                        <p class="col-4" color="white">09.00-13.00</p>
                                        <p class="col-4">19.00-21.00</p>
                                    </div>
                                    <div class="row">
                                        <p class="col-3">Rabu</p>
                                        <p class="col-4" color="white">09.00-13.00</p>
                                        <p class="col-4">19.00-21.00</p>
                                    </div>
                                    <div class="row">
                                        <p class="col-3">Kamis</p>
                                        <p class="col-4" color="white">09.00-13.00</p>
                                        <p class="col-4" >19.00-21.00</p>
                                    </div>
                                    <div class="row">
                                        <p class="col-3">Jumat</p>
                                        <p class="col-4" color="white">09.00-13.00</p>
                                        <p class="col-4">19.00-21.00</p>
                                    </div>
                                    <div class="row">
                                        <p class="col-3">Sabtu</p>
                                        <p class="col-4" color="white">09.00-13.00</p>
                                        <p class="col-4">19.00-21.00</p>
                                    </div>
                                    <p class="text-center">Cosmetic Medic dan Aesthetica</p>
                                    <div class="row">
                                        <p class="offset-2 col-4">Senin sd Sabtu</p>
                                        <p class="col-4">09.00-21.00</p>
                                    </div>
                                    <p class="text-center">Tanggal Merah Praktek jam 09.00 sd 13.00, Layanan Cosmetic Medic jam 09:00 sd 16.00
                                        <br>HARI MINGGU TUTUP</p>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div style="min-height:55vh">
                        <div class="row justify-content-center">
                            <div class="card" style="width: 90%; border-radius: 20px;">
                                <div class="card-body bg-primary small" style="border-radius: 20px;">
                                    <h4 class="text-center">Jam Buka <br>DR. dr. A. Laqif Alaydrus Sp.OG (K)FER </h4>
                                    <br>
                                    <p class="text-center">Spesialis Kebidanan dan Kandungan <br>Konsultan Fertilitas & Endoktrinologi Reproduksi</p>
                                    <div id="ttgKami" class="text-center">
                                        <div class="row">
                                            <p class="offset-2 col-4">Senin</p>
                                            <p class="col-4">19.00-21.00</p>
                                        </div>
                                        <div class="row">
                                            <p class="offset-2 col-4">Selasa</p>
                                            <p class="col-4">19.00-21.00</p>
                                        </div>
                                        <div class="row">
                                            <p class="offset-2 col-4">Rabu</p>
                                            <p class="col-4">19.00-21.00</p>
                                        </div>
                                        <div class="row">
                                            <p class="offset-2 col-4">Kamis</p>
                                            <p class="col-4" >19.00-21.00</p>
                                        </div>
                                        <div class="row">
                                            <p class="offset-2 col-4">Jumat</p>
                                            <p class="col-4">19.00-21.00</p>
                                        </div>
                                        <div class="row">
                                            <p class="offset-2 col-4">Sabtu</p>
                                            <p class="col-4">19.00-21.00</p>
                                        </div>
                                        <br>
                                        <br>
                                        <p class="my-4 mb-4">HARI MINGGU DAN TANGGAL MERAH TUTUP </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
