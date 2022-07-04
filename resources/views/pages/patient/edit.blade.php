@extends('layouts.dashboard')

@section('title', 'Ubah Pasien')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ubah Pasien</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="/pasien/{{$patient->id}}" method="POST">
                    @method('patch')
                    @csrf
                        <p><b>DATA DIRI</b></p>
                        <div class="form-group row">
                            <label for="name"  class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Nama" value="{{ $patient->user->name }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-check form-check-inline @error('jenis_kelamin') is-invalid @enderror">
                                            <input class="form-check-input  @error('jenis_kelamin') is-invalid @enderror" type="radio" name="jenis_kelamin" value="laki-laki" id="laki-laki" {{"laki-laki" == "$patient->jenis_kelamin" ? 'checked' :'' }}>
                                            <label class="form-check-label" for="laki-laki">
                                                Laki-Laki
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline @error('jenis_kelamin') is-invalid @enderror">
                                            <input class="form-check-input ml-3  @error('jenis_kelamin') is-invalid @enderror" type="radio" name="jenis_kelamin" value="perempuan" id="perempuan" {{"perempuan" == "$patient->jenis_kelamin" ? 'checked' :'' }}>
                                            <label class="form-check-label" for="perempuan">
                                                Perempuan
                                            </label>
                                        </div>
                                        @error('jenis_kelamin')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nik"  class="col-sm-2 col-form-label">NIK</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" id="nik" placeholder="NIK" value="{{ $patient->nik }}">
                                @error('nik')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tanggal_lahir"  class="col-sm-2 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-3">
                                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir" value="{{ $patient->tanggal_lahir }}">
                                @error('tanggal_lahir')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="no_hp"  class="col-sm-2 col-form-label">No. HP</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" id="no_hp" placeholder="No. HP" value="{{ $patient->no_hp }}">
                                @error('no_hp')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="alamat"  class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm">
                                <textarea type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" placeholder="Alamat">{{$patient->alamat}}</textarea>
                                @error('alamat')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                            </div>
                        </div>

                        <hr>
                        <p><b>DATA AKUN</b></p>

                        <div class="form-group row">
                            <label for="email"  class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-7">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" value="{{ $patient->user->email }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password"  class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <a href="/pasien/{{Crypt::encrypt($patient->id)}}/ubahkatasandi" class="btn btn-sm btn-info shadow-sm">Ubah Password <i class="fa fa-key"></i></a>
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit">Simpan</button>

                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
