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
                    <h1>Ubah Kata Sandi Akun Pasien</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <form action="/pasien/{{$patient->id}}/ubahkatasandi" method="POST">
                            @csrf
                                <div class="form-group row">
                                    <label for="newpassword" class="col-sm-3 col-form-label">Password Baru</label>
                                    <div class="col-sm">
                                        <input type="password" class="form-control @error('newpassword') is-invalid @enderror" name="newpassword" id="newpassword" placeholder="Password Baru">
                                        <div class="invalid-feedback">
                                            Silahkan Masukan Password Baru
                                        </div>
                                    </div>
                                </div>
                                    
                                <div class="text-center">
                                    <button class="btn btn-primary" type="submit">Simpan</button>
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