@extends('layouts.dashboard')

@section('title', 'Detail Surat Rujukan')

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
                        <h1>Detail Surat Rujukan</h1>
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
                            <a href="/surat/rujukan/{{Crypt::encrypt($data->id)}}/cetak" target="_blank" class="btn btn-sm btn-secondary"><i class="fa fa-print"></i> Cetak</a>
                        </div>
                        <h3 class="text-center">KLINIK SAMRATULANGI</h3>
                        <div  class="text-center">No. Ijin : 449.4/0044/B-11/10K/XII/2020</div>
                        <h6 class="text-center">Jl. Samratulangi No. 22 Manahan Solo</h6>
                        <h6 class="text-center">Telp. 08564722653</h6>
                        <hr>
                        <div class="text-center">
                            <u><h4>SURAT RUJUKAN</h4></u>
                        </div>
                        <div class="row mb-5">
                            <div class="col-sm-4 offset-sm-8">
                                Yth. {{$data->tujuan_dokter}}
                                <br>
                                Di <br>
                                {{$data->tujuan_lokasi}}
                            </div>
                        </div>
                        <div class="container">
                            <div class="row mb-5">
                                <div class="col-sm" style="text-indent: 50px;">Mohon pemeriksaan dan pengobatan lebih lanjut terhadap penderita</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">Nama</div>
                                <div>:</div>
                                <div class="col-sm">{{$data->pasien->user->name}}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">Jenis Kelamin</div>
                                <div>:</div>
                                <div class="col-sm">{{$data->pasien->jenis_kelamin}}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">Umur</div>
                                <div>:</div>
                                <div class="col-sm">{{$umur}} Tahun</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">No. Telepon</div>
                                <div>:</div>
                                <div class="col-sm">{{$data->pasien->no_hp}}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">Alamat</div>
                                <div>:</div>
                                <div class="col-sm">{{$data->pasien->alamat}}</div>
                            </div>
                            <div class="mt-5">
                                <p>Anamnese</p>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">Keluhan</div>
                                <div>:</div>
                                <div class="col-sm">{{$data->keluhan}}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">Diagnosa sementara</div>
                                <div>:</div>
                                <div class="col-sm">{{$data->diagnosis_sementara}}</div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-sm-3">Tindakan yang telah diberikan</div>
                                <div>:</div>
                                <div class="col-sm">{{$data->tindakan}}</div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-sm" style="text-indent: 50px;">Demikian surat rujukan ini kami kirim, kami mohon balasan atas surat rujukan ini. Atas perhatian Bapak/Ibu kami ucapkan terima kasih.</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row">
                                        @if ($data->catatan != null)
                                            <div class="col-sm-3">Catatan</div>
                                            <div>:</div>
                                            <div class="col-sm">{{$data->catatan}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="text-center">
                                        Hormat Kami
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
            </div>
        </section>
    </div>
@endsection