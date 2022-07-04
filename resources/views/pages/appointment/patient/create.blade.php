@extends('layouts.dashboard')

@section('title', 'Tambah Janji')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tambah Janji</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <form action="/janji/store" method="POST">
                            @csrf
                            <h5 class="h5 font-weight-bold">Data Diri Anda</h5>
                            <div class="form-group row">
                                <label for="name"  class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm">
                                    <input class="form-control" type="text" name="nama" id="nama" value="{{auth()->user()->name}}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tanggalLahir"  class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm">
                                    <input class="form-control" type="date" name="tanggalLahir" id="tanggalLahir" value="{{auth()->user()->pasien->first()->tanggal_lahir}}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email"  class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm">
                                    <input class="form-control" type="email" name="email" id="email" value="{{auth()->user()->email}}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nik"  class="col-sm-2 col-form-label">NIK</label>
                                <div class="col-sm">
                                    <input class="form-control" type="text" name="nik" id="nik" value="{{auth()->user()->pasien->first()->nik}}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alamat"  class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm">
                                    <textarea name="alamat" id="alamat" cols="30" rows="2" class="form-control" disabled>{{auth()->user()->pasien->first()->alamat}}</textarea>
                                </div>
                            </div>
                            <h5 class="h5 font-weight-bold mt-4 mb-3">Waktu Kunjungan Anda</h5>
                            <div class="form-group row">
                                <label for="namaLayanan"  class="col-sm-2 col-form-label">Layanan</label>
                                <div class="col-sm-4">
                                    <input class="form-control" name="namaLayanan" id="namaLayanan" placeholder="Nama Layanan" value="{{ $serviceTypes->service_type_name  }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="namaDokter"  class="col-sm-2 col-form-label">Pilih Dokter</label>
                                <div class="col-sm-4">
                                    <select name="namaDokter" id="namaDokter" class="form-control @error('namaDokter') is-invalid @enderror">
                                        <option selected disabled>Pilih Dokter</option>
                                        @foreach ($doctors as $doctor)
                                            <option value="{{ $doctor->id }}" @if(old('namaDokter') == $doctor->id) selected @endif>{{ $doctor->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('namaDokter')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tanggalKunjungan" class="col-sm-2 col-form-label">Tanggal Kunjungan</label>
                                <div class="col-sm-4">
                                    <input class="form-control @error('tanggalKunjungan') is-invalid @enderror" type="date" name="tanggalKunjungan" id="tanggalKunjungan" value="{{ old('tanggalKunjungan') }}">
                                    @error('tanggalKunjungan')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-sm-2">
                                    <input class="form-control @error('waktu') is-invalid @enderror" type="time" name="waktu" id="waktu" value="{{old('waktu')}}">
                                    @error('waktu')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                @if ($serviceTypes->service_type_name == "Dermatology")
                                    <div class="col-sm col-form-label">
                                        Pilih jam antara 09:00-13:00 dan 19:00-21:00
                                    </div>
                                @elseif ($serviceTypes->service_type_name == "Cosmetic Medic")
                                    <div class="col-sm col-form-label">
                                        Pilih jam antara 08:00-21:00
                                    </div>
                                @elseif ($serviceTypes->service_type_name == "Obgyn" || $serviceTypes->service_type_name == "Fertility")
                                    <div class="col-sm col-form-label">
                                        Pilih jam antara 19:00-21:00
                                    </div>
                                @endif
                            </div>
                            <div class="form-group row">
                                <label for="keluhan"  class="col-sm-2 col-form-label">Keluhan</label>
                                <div class="col-sm">
                                    <textarea type="text" class="form-control @error('keluhan') is-invalid @enderror" name="keluhan" id="keluhan" placeholder="Keluhan">{{old('keluhan')}}</textarea>
                                    @error('keluhan')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit">Tambah</button>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
<script>
    $(function(){
        var dtToday = new Date();
        
        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();
        
        var maxDate = year + '-' + month + '-' + day;
        $('#tanggalKunjungan').attr('min', maxDate);
    });
</script>
@endsection