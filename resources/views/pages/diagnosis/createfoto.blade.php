@extends('layouts.dashboard')

@section('title', 'Diagnosis Foto')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Diagnosis Foto</h1>
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
                                    <div class="col-sm-1 d-none d-sm-inline">:</div>
                                    <div class="col-sm">{{ $data->pasien->user->name }}</div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-sm-4">Tanggal Lahir</div>
                                    <div class="col-sm-1 d-none d-sm-inline">:</div>
                                    <div class="col-sm">{{ Carbon\carbon::parse($data->pasien->tanggal_lahir)->translatedFormat("d F Y") }}</div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-sm-4">Jenis Kelamin</div>
                                    <div class="col-sm-1 d-none d-sm-inline">:</div>
                                    <div class="col-sm text-capitalize">{{ $data->pasien->jenis_kelamin }}</div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-sm-4">NIK</div>
                                    <div class="col-sm-1 d-none d-sm-inline">:</div>
                                    <div class="col-sm">{{ $data->pasien->nik }}</div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-sm-4">No. HP</div>
                                    <div class="col-sm-1 d-none d-sm-inline">:</div>
                                    <div class="col-sm">{{ $data->pasien->no_hp }}</div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-sm-4">Alamat</div>
                                    <div class="col-sm-1 d-none d-sm-inline">:</div>
                                    <div class="col-sm">{{ $data->pasien->alamat }}</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row mb-1">
                                    <div class="col-sm-4">No. RM</div>
                                    <div class="col-sm-1 d-none d-sm-inline">:</div>
                                    <div class="col-sm">{{ $data->no_rm }}</div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-sm-4">Layanan</div>
                                    <div class="col-sm-1 d-none d-sm-inline">:</div>
                                    <div class="col-sm">{{ $data->serviceType->service_type_name }}</div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-sm-4">Dokter</div>
                                    <div class="col-sm-1 d-none d-sm-inline">:</div>
                                    <div class="col-sm">{{ $data->dokter->user->name }}</div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-sm-4">Tanggal Periksa</div>
                                    <div class="col-sm-1 d-none d-sm-inline">:</div>
                                    <div class="col-sm">{{ Carbon\Carbon::parse($data->tanggal_periksa)->translatedFormat('d F Y') }}</div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-sm-4">Keluhan</div>
                                    <div class="col-sm-1 d-none d-sm-inline">:</div>
                                    <div class="col-sm">{{ $data->keluhan }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Foto Sebelum Pemeriksaan</label>
                                    <table class="table table-sm" id="fotoSebelum">
                                        <tr>
                                            <form action="/diagnosis/{{$data->id}}/upload/foto/sebelum" method="POST" enctype="multipart/form-data">
                                            @csrf
                                                <td>
                                                    <input type="file" name="foto_sebelum_periksa" accept="image/*" class="form-control-file @error('foto_sebelum_periksa') is-invalid @enderror"/>
                                                    @error('foto_sebelum_periksa')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="text" name="keterangan_sebelum" class="form-control @error('keterangan_sebelum') is-invalid @enderror" placeholder="Keterangan Foto"/>
                                                    @error('keterangan_sebelum')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td width="50px" class="text-right"><button type="submit" class="btn btn-success"><i class="fa fa-plus"></i></button></td> 
                                            </form>
                                        </tr>
                                        @foreach ($data->imageBefore as $image)
                                            <tr>
                                                <td colspan="2">
                                                    <a href="/rekam-medis/foto/sebelum/{{Crypt::encrypt($image->id)}}" target="_blank" class="btn btn-info"><i class="fa fa-eye"></i> Lihat {{$image->keterangan}}</a>
                                                </td>
                                                <td width="50px" class="text-right">
                                                    <form action="/diagnosis/hapus/foto/sebelum/{{Crypt::encrypt($image->id)}}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Foto Sesudah Pemeriksaan</label>
                                    <table class="table table-sm">  
                                        <tr>
                                            <form action="/diagnosis/{{$data->id}}/upload/foto/sesudah" method="POST" enctype="multipart/form-data">
                                            @csrf
                                                <td>
                                                    <input type="file" name="foto_sesudah_periksa" accept="image/*" class="form-control-file @error('foto_sesudah_periksa') is-invalid @enderror"/>
                                                    @error('foto_sesudah_periksa')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="text" name="keterangan_sesudah" class="form-control @error('keterangan_sesudah') is-invalid @enderror" placeholder="Keterangan Foto"/>
                                                    @error('keterangan_sesudah')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td width="50px" class="text-right"><button type="submit" class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                                            </form>
                                        </tr>
                                        @foreach ($data->imageAfter as $image)
                                            <tr>
                                                <td colspan="2">
                                                    <a href="/rekam-medis/foto/sesudah/{{Crypt::encrypt($image->id)}}" target="_blank" class="btn btn-info"><i class="fa fa-eye"></i> Lihat {{$image->keterangan}}</a>
                                                </td>
                                                <td width="50px" class="text-right">
                                                    <form action="/diagnosis/hapus/foto/sebelum/{{Crypt::encrypt($image->id)}}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Foto Lab</label>
                                    <table class="table table-sm" id="fotoLab">  
                                        <tr>
                                            <form action="/diagnosis/{{$data->id}}/upload/foto/lab" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <td>
                                                    <input type="file" name="foto_lab" accept="image/*" class="form-control-file @error('foto_lab') is-invalid @enderror"/>
                                                    @error('foto_lab')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="text" name="keterangan_lab" class="form-control @error('keterangan_lab') is-invalid @enderror" placeholder="Keterangan Foto"/>
                                                    @error('keterangan_lab')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td width="50px" class="text-right"><button type="submit" class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                                            </form>
                                        </tr>
                                        @foreach ($data->imageLab as $image)
                                            <tr>
                                                <td colspan="2">
                                                    <a href="/rekam-medis/foto/lab/{{Crypt::encrypt($image->id)}}" target="_blank" class="btn btn-info"><i class="fa fa-eye"></i> Lihat {{$image->keterangan}}</a>
                                                </td>
                                                <td width="50px" class="text-right">
                                                    <form action="/diagnosis/hapus/foto/sebelum/{{Crypt::encrypt($image->id)}}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Foto Radiologi</label>
                                    <table class="table table-sm" id="fotoRadiologi">  
                                        <tr>
                                            <form action="/diagnosis/{{$data->id}}/upload/foto/radiologi" method="POST" enctype="multipart/form-data">
                                            @csrf
                                                <td>
                                                    <input type="file" name="foto_radiologi" accept="image/*" class="form-control-file  @error('foto_radiologi') is-invalid @enderror"/>
                                                    @error('foto_radiologi')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="text" name="keterangan_radiologi" class="form-control @error('keterangan_radiologi') is-invalid @enderror" placeholder="Keterangan Foto"/>
                                                    @error('keterangan_radiologi')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td width="50px" class="text-right"><button type="submit" class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                                            </form>
                                        </tr>
                                        @foreach ($data->imageRadiology as $image)
                                            <tr>
                                                <td colspan="2">
                                                    <a href="/rekam-medis/foto/radiologi/{{Crypt::encrypt($image->id)}}" target="_blank" class="btn btn-info"><i class="fa fa-eye"></i> Lihat {{$image->keterangan}}</a>
                                                </td>
                                                <td width="50px" class="text-right">
                                                    <form action="/diagnosis/hapus/foto/sebelum/{{Crypt::encrypt($image->id)}}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                        <form action="{{route('diagnosis.doneCreate')}}" method="POST">
                        @csrf
                            <button type="submit" class="btn btn-primary">Selesai</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection