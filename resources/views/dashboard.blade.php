@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-lg-6">
                    @if(Auth::user()->level === "patient")
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body bg-danger rounded-lg d-flex" >
                                    <div class="my-auto">
                                        <h6><b>Selamat Datang, {{ auth()->user()->name }}</b></h6>
                                        <h6>Jangan lupa jaga kesehatanmu dan patuhi protokol kesehatan!</h6>
                                    </div>
                                    <img src="{{ asset('img/SRlogo2.png') }}" width="90px" height="75px" class="m-auto" alt=""/>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @if(Auth::user()->level === "patient")
    <div class="content">
        <div class="container-fluid">
            <h3 style="text-align: center"><b>Pendaftaran Online</b></h3>
            <h6 style="text-align: center">Silahkan Mendaftar Layanan dengan memilih layanan yang anda butuhkan !!!</h6>
            <br>
            <br>
            <div class="row">
                <div class="col-lg-6">
                    <div class="col-lg-6 mx-auto">
                        <h3 class="badge badge-warning" style="font-size: 24px; display: inherit">Dermatologi</h3>
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h4>Layanan</h4>
                                <h3>Dermatologi</h3>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="/janji/tambah/{{Crypt::encrypt($serviceType['Dermatology'])}}" class="small-box-footer">Daftar <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-6 mx-auto">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h4>Layanan</h4>
                                <h3>Cosmetic Medic</h3>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="/janji/tambah/{{Crypt::encrypt($serviceType['Cosmetic Medic'])}}" class="small-box-footer">Daftar <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="col-lg-6 mx-auto">
                        <h3 class="badge badge-warning" style="font-size: 24px; display: inherit">Obgyn</h3>
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h4>Layanan</h4>
                                <h3>Obgyn</h3>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="/janji/tambah/{{Crypt::encrypt($serviceType['Obgyn'])}}" class="small-box-footer">Daftar <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-6 mx-auto">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h4>Layanan</h4>
                                <h3>Fertility</h3>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="/janji/tambah/{{Crypt::encrypt($serviceType['Fertility'])}}" class="small-box-footer">Daftar <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    @elseif(Auth::user()->level === "admin")
        <section class="content">
            <div class="px-2 pt-3">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="card" style="min-height: 90%">
                            <div class="card-body bg-danger rounded-lg d-flex" >
                                <div class="my-auto">
                                    <h4>Selamat Datang, Admin</h4>
                                    <h6>Jangan lupa cek pekerjaanmu dan selamat bekerja!</h6>
                                </div>
                                <img src="{{ asset('img/SRlogo.png') }}" height="75px" class="m-auto" alt="sr logo">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card mt-0">
                            <div class="card-body pt-2">
                                <h6 class=" font-weight-bold">Janji hari ini</h6>
                                <div class="row">
                                    <div class="col-8">
                                        <ul class="chart-legend clearfix my-auto">
                                            <li>
                                                <i class="fa fa-circle fa-fw text-danger"></i>
                                                <p class="d-inline-block mb-1">Menunggu</p>
                                                <span class="text-secondary float-right"> {{ $waiting }}</span>
                                            </li>
                                            <li>
                                                <i class="fa fa-circle fa-fw text-warning"></i>
                                                <p class="d-inline-block mb-1">Diterima</p>
                                                <span class="text-secondary float-right"> {{ $accepted }}</span>
                                            </li>
                                            <li>
                                                <i class="fa fa-circle fa-fw text-info"></i>
                                                <p class="d-inline-block mb-1">Dibatalkan</p>
                                                <span class="text-secondary float-right"> {{  $rejected }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card card-body bg-warning">
                            <h6 class="h6">Data Janji Lampau</h6>
                            <h5 class="h5">{{  $dataLampau }}</h5>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card card-body bg-secondary">
                            <h6 class="h6">Data Janji yang akan datang</h6>
                            <h5 class="h5">{{  $dataDatang }}</h5>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card card-body bg-danger">
                            <h6 class="h6">Data Janji Hari Ini</h6>
                            <h5 class="h5">{{  $dataNow }}</h5>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card card-body bg-primary">
                            <h6 class="h6">Data Pasien</h6>
                            <h5 class="h5">{{  $dataPatient }}</h5>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card card-body bg-success">
                            <h6 class="h6">Data Dokter</h6>
                            <h5 class="h5">{{  $dataDoctor }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @elseif(Auth::user()->level === "doctor")
        <section class="content">
            <div class="px-2 pt-3">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="card" style="min-height: 90%">
                            <div class="card-body bg-danger rounded-lg d-flex" >
                                <div class="my-auto">
                                    <h4>Selamat Datang, {{ auth()->user()->name }}</h4>
                                    <h6>Jangan lupa cek pekerjaanmu dan selamat bekerja!</h6>
                                </div>
                                <img src="{{ asset('img/SRlogo.png') }}" height="75px" class="m-auto" alt="sr logo">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-lg-6">
                        <div class="col-lg-8 float-right">
                            <div class="card card-body bg-primary">
                                <h6 class="h6">Janji Hari Ini</h6>
                                <h5 class="h5">{{  $appointmentDoctor }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="col-lg-8 float-left">
                            <div class="card card-body bg-warning">
                                <h6 class="h6">Total Data Pasien</h6>
                                <h5 class="h5">{{  $totalPatient }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif


</div>
@endsection
