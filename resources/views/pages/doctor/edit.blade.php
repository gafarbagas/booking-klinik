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
                        <h1>Ubah Dokter</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <form action="/dokter/{{$doctor->id}}" method="POST">
                            @method('patch')
                            @csrf
                            <p><b>DATA DIRI</b></p>
                            <div class="form-group row">
                                <label for="name"  class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Nama" value="{{ $doctor->user->name }}">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="jenis_layanan" class="col-sm-2 col-form-label">Layanan</label>
                                <div class="col-sm">
                                    @foreach ($serviceTypes as $serviceType)
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="jenis_layanan[]" value="{{$serviceType->id}}" id="jenis_layanan{{$serviceType->id}}"
                                                @foreach ($doctor->serviceType as $service)
                                                    {{$serviceType->id == $service->id ? 'checked' :'' }}
                                                @endforeach
                                                >
                                            <label for="jenis_layanan{{$serviceType->id}}" class="form-check-label">{{$serviceType->service_type_name}}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <hr>
                            <p><b>DATA AKUN</b></p>

                            <div class="form-group row">
                                <label for="email"  class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-7">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" value="{{ $doctor->user->email }}">
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
                                    <a href="/dokter/{{Crypt::encrypt($doctor->id)}}/ubahKataSandi" class="btn btn-sm btn-info shadow-sm">Ubah Password <i class="fa fa-key"></i></a>
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
