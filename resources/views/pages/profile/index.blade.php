@extends('layouts.dashboard')

@section('title', 'Profil')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profil</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-5">
                    <div class="card border-danger">
                        <div class="card-body">
                            <div class="row mb-2">
                                <label class="col-sm-4">Nama</label>
                                <div class="col-sm">{{ $user->name }}</div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-sm-4">Email</label>
                                <div class="col-sm">{{ $user->email }}</div>
                            </div>
                            @if (Auth::user()->level == "doctor")
                                <div class="row mb-2">
                                    <label class="col-sm-4">Spesialist</label>
                                    <div class="col-sm">{{ $dokter->specialist }}</div>
                                </div>
                            @elseif (Auth::user()->level == "patient")
                                <div class="row mb-2">
                                    <label class="col-sm-4">Jenis Kelamin</label>
                                    <div class="col-sm">{{ $pasien->jenis_kelamin }}</div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-sm-4">NIK</label>
                                    <div class="col-sm">{{ $pasien->nik }}</div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-sm-4">Tanggal Lahir</label>
                                    <div class="col-sm">{{ Carbon\Carbon::parse($pasien->tanggal_lahir)->translatedFormat("d F Y") }}</div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-sm-4">No. HP</label>
                                    <div class="col-sm">{{ $pasien->no_hp }}</div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-sm-4">Alamat</label>
                                    <div class="col-sm text-capitalize">{{ $pasien->alamat }}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <p><b>Ubah Data Akun</b></p>
                            <form action="/profil/dataakun" method="POST">
                            @csrf
                                <div class="form-group row">
                                    <label for="name"  class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Nama" value="{{ $user->name }}">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email"  class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm">
                                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" value="{{ $user->email }}">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row text-center">
                                    <div class="col-sm">
                                        <button class="btn btn-secondary mb-1" type="submit">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <p><b>Ubah Password</b></p>
                            <form action="/profil/password" method="POST">
                            @csrf
                                <div class="form-group row">
                                    <label for="password"  class="col-sm-4 col-form-label">Password Sekarang</label>
                                    <div class="col-sm">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" value="{{old('password')}}" placeholder="Password Sekarang">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="newpassword"  class="col-sm-4 col-form-label">Password Baru</label>
                                    <div class="col-sm">
                                        <input type="password" class="form-control @error('newpassword') is-invalid @enderror" name="newpassword" id="newpassword" placeholder="Password Baru">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="confirmpassword"  class="col-sm-4 col-form-label">Konfirmasi Password Baru</label>
                                    <div class="col-sm">
                                        <input type="password" class="form-control @error('confirmpassword') is-invalid @enderror" name="confirmpassword" id="confirmpassword" placeholder="Konfirmasi Password Baru">
                                        @error('confirmpassword')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row text-center">
                                    <div class="col-sm">
                                        <button class="btn btn-secondary mb-1" type="submit">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
<script>
$('#card-list a').on('click', function (e) {
    e.preventDefault()
    $(this).tab('show')
})
</script>

@endsection