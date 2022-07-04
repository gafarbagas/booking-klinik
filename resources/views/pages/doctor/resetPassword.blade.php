@extends('layouts.dashboard')

@section('title', 'Ubah Dokter')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Ubah Kata Sandi Akun Dokter</h1>
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
                                <form action="/dokter/{{$doctor->id}}/ubahKataSandi" method="POST">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="newPassword" class="col-sm-3 col-form-label">Password Baru</label>
                                        <div class="col-sm">
                                            <input type="password" class="form-control @error('newPassword') is-invalid @enderror" name="newPassword" id="newPassword" placeholder="Password Baru">
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
