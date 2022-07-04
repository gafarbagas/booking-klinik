@extends('layouts.dashboard')

@section('title', 'Detail Rekam Medis')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm">
                    <h1 class="mb-3">Detail Rekam Medis</h1>
                    <a href="/diagnosis/{{Crypt::encrypt($data->id)}}/ubah" class="btn btn-secondary btn-sm"><i class="fa fa-pencil-alt"></i> Ubah Data</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <div class="row mb-1">
                                <div class="col-sm-4">Nama Pasien</div>
                                <div class="d-none d-sm-inline">:</div>
                                <div class="col-sm">{{ $data->pasien->user->name }}</div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-sm-4">Tanggal Lahir</div>
                                <div class="d-none d-sm-inline">:</div>
                                <div class="col-sm">{{ Carbon\carbon::parse($data->pasien->tanggal_lahir)->translatedFormat("d F Y") }}</div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-sm-4">Jenis Kelamin</div>
                                <div class="d-none d-sm-inline">:</div>
                                <div class="col-sm text-capitalize">{{ $data->pasien->jenis_kelamin }}</div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-sm-4">NIK</div>
                                <div class="d-none d-sm-inline">:</div>
                                <div class="col-sm">{{ $data->pasien->nik }}</div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-sm-4">No. HP</div>
                                <div class="d-none d-sm-inline">:</div>
                                <div class="col-sm">{{ $data->pasien->no_hp }}</div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-sm-4">Alamat</div>
                                <div class="d-none d-sm-inline">:</div>
                                <div class="col-sm">{{ $data->pasien->alamat }}</div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row mb-1">
                                <div class="col-sm-4">No. RM</div>
                                <div class="d-none d-sm-inline">:</div>
                                <div class="col-sm">{{ $data->no_rm }}</div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-sm-4">Layanan</div>
                                <div class="d-none d-sm-inline">:</div>
                                <div class="col-sm">{{ $data->serviceType->service_type_name }}</div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-sm-4">Dokter</div>
                                <div class="d-none d-sm-inline">:</div>
                                <div class="col-sm">{{ $data->dokter->user->name }}</div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-sm-4">Tanggal Periksa</div>
                                <div class="d-none d-sm-inline">:</div>
                                <div class="col-sm">{{ Carbon\Carbon::parse($data->tanggal_periksa)->translatedFormat('d F Y') }}</div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-sm-4">Keluhan</div>
                                <div class="d-none d-sm-inline">:</div>
                                <div class="col-sm">{{ $data->keluhan }}</div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <p><b>Diagnosis</b></p>
                    <div class="row mb-1">
                        <div class="col-sm-3">Hasil Pemeriksaan</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm">{{ $data->hasil_pemeriksaan }}</div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-sm-3">Diagnosis</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm">{{ $data->diagnosis }}</div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-sm-3">Tindakan</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm">{{ $data->tindakan }}</div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-sm-3">Rencana</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm">{{ $data->rencana }}</div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-sm-3">Foto Sebelum Pemeriksaan</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm">
                            @forelse ($data->imageBefore as $image)
                                <a href="/rekam-medis/foto/sebelum/{{Crypt::encrypt($image->id)}}" target="_blank" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> {{$image->keterangan}}</a>
                            @empty
                                Tidak Ada Foto Sebelum Pemeriksaan
                            @endforelse
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-sm-3">Foto Sesudah Pemeriksaan</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm">
                            @forelse ($data->imageAfter as $image)
                                <a href="/rekam-medis/foto/sesudah/{{Crypt::encrypt($image->id)}}" target="_blank" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> {{$image->keterangan}}</a>
                            @empty
                                Tidak Ada Foto Sesudah Pemeriksaan
                            @endforelse
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-sm-3">Foto Lab</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm">
                            @forelse ($data->imageLab as $image)
                                <a href="/rekam-medis/foto/lab/{{Crypt::encrypt($image->id)}}" target="_blank" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> {{$image->keterangan}}</a>
                            @empty
                                Tidak Ada Foto Lab
                            @endforelse
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-sm-3">Foto Radiologi</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm">
                            @forelse ($data->imageRadiology as $image)
                                <a href="/rekam-medis/foto/radiologi/{{Crypt::encrypt($image->id)}}" target="_blank" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> {{$image->keterangan}}</a>
                            @empty
                                Tidak Ada Foto Radiologi
                            @endforelse
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-sm-3">Resep Obat</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm-6">
                            <table class="table table-sm table-bordered">
                                <tr class="table-secondary">
                                    <th>Nama Obat</th>
                                    <th>Dosis</th>
                                </tr>
                                @foreach ($data->prescription as $resep)
                                <tr>
                                    <td>{{$resep->nama_obat}}</td>
                                    <td>{{$resep->dosis}}</td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
