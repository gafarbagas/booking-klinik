@extends('layouts.dashboard')

@section('title', 'Detail Surat Keterangan Istirahat')

@section('style')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Detail Surat Keterangan Istirahat</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="text-right">
                            <a href="/surat/keterangan-istirahat/{{Crypt::encrypt($data->id)}}/cetak" target="_blank" class="btn btn-sm btn-secondary"><i class="fa fa-print"></i> Cetak</a>
                        </div>
                        <h3 class="text-center">KLINIK SAMRATULANGI</h3>
                        <div  class="text-center">No. Ijin : 449.4/0044/B-11/10K/XII/2020</div>
                        <h6 class="text-center">Jl. Samratulangi No. 22 Manahan Solo</h6>
                        <h6 class="text-center">Telp. 08564722653</h6>
                        <hr>
                        <div class="text-center mb-5">
                            <u><h4>SURAT KETERANGAN ISTIRAHAT</h4></u>
                        </div>
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-sm-4">Nama</div>
                                <div>:</div>
                                <div class="col-sm">{{$data->pasien->user->name}}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4">Umur</div>
                                <div>:</div>
                                <div class="col-sm">{{$umur}} Tahun</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4">Jenis Kelamin</div>
                                <div>:</div>
                                <div class="col-sm">{{$data->pasien->jenis_kelamin}}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4">Alamat</div>
                                <div>:</div>
                                <div class="col-sm">{{$data->pasien->alamat}}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4">Keterangan</div>
                                <div class="col-sm">
                                    <div class="form-check">
                                        @if ($data->keterangan == "Sedang Berobat Jalan")
                                            <img src="{{asset('img/checkbox.png')}}" width="20px">
                                        @else
                                            <img src="{{asset('img/box.png')}}" width="20px">
                                        @endif
                                        <label class="form-check-label">
                                            Sedang Berobat Jalan
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        @if ($data->keterangan == "Post Tindakan")
                                            <img src="{{asset('img/checkbox.png')}}" width="20px">
                                        @else
                                            <img src="{{asset('img/box.png')}}" width="20px">
                                        @endif
                                        <label class="form-check-label">
                                            Post Tindakan
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4">Karena gangguan kesehatan</div>
                                <div class="col-sm">
                                    <div class="form-check">
                                        @if ($data->alasan == "Perlu Istirahat / Kontrol")
                                            <img src="{{asset('img/checkbox.png')}}" width="20px">
                                        @else
                                            <img src="{{asset('img/box.png')}}" width="20px">
                                        @endif
                                        <label class="form-check-label">
                                            Perlu Istirahat / Kontrol
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        @if ($data->alasan == "Masih Memerlukan Istirahat")
                                            <img src="{{asset('img/checkbox.png')}}" width="20px">
                                        @else
                                            <img src="{{asset('img/box.png')}}" width="20px">
                                        @endif
                                        <label class="form-check-label">
                                            Masih Memerlukan Istirahat
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <p>Selama <b>{{$hari}}</b> Hari, terhitung mulai tanggal <b>{{$tanggalMulai}}</b> sampai tanggal <b>{{$tanggalSelesai}}</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 offset-sm-6">
                                    Solo, {{$tanggalSurat}}
                                    <br>
                                    Dokter yang memeriksa
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    {{$data->dokter->user->name}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection