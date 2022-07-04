@extends('auth.layouts.login')
@section('Title','Registrasi Akun Pasien')
@section('BawahNavbar')

<section class="mt-5 pt-5 mb-5">
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-md-10 col-xl-8 mx-auto mt-5">
                <div class="card shadow" style="background-color: rgba(243, 154, 66, 0.22)">
                    <div class="card-body">
                        <div class="form-group mb-5">
                            <h3 class="text-center"><strong>Daftar</strong></h3>
                        </div>
                        <form method="POST" action="/daftar-akun">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input type="text"class="form-control bg-transparent border-top-0 border-right-0 border-left-0 @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" name="name">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="jenis_kelamin">Jenis Kelamin</label>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-check form-check-inline @error('jenis_kelamin') is-invalid @enderror">
                                                    <input class="form-check-input @error('jenis_kelamin') is-invalid @enderror" type="radio" name="jenis_kelamin" value="laki-laki" id="laki-laki" @if (old('jenis_kelamin') == 'laki-laki') {{ 'checked' }}@endif>
                                                    <label class="form-check-label" for="laki-laki">
                                                        Laki-Laki
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline @error('jenis_kelamin') is-invalid @enderror">
                                                    <input class="form-check-input ml-3  @error('jenis_kelamin') is-invalid @enderror" type="radio" name="jenis_kelamin" value="perempuan" id="perempuan" @if (old('jenis_kelamin') == 'perempuan') {{ 'checked' }}@endif>
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
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                        <input type="date" class="form-control bg-transparent border-top-0 border-right-0 border-left-0 @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}" name="tanggal_lahir">
                                        @error('tanggal_lahir')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="nik">NIK</label>
                                        <input type="text" class="form-control bg-transparent border-top-0 border-right-0 border-left-0 @error('nik') is-invalid @enderror" id="nik" value="{{ old('nik') }}" name="nik">
                                        @error('nik')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="no_hp">No. Hp</label>
                                        <input type="text" class="form-control bg-transparent border-top-0 border-right-0 border-left-0 @error('no_hp') is-invalid @enderror" id="no_hp" value="{{ old('no_hp') }}" name="no_hp">
                                        @error('no_hp')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <textarea rows="1" id="alamat" name="alamat" class="form-control border-top-0 border-left-0 border-right-0 bg-transparent px-0 @error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>
                                        @error('alamat')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control bg-transparent border-top-0 border-right-0 border-left-0 @error('email') is-invalid @enderror"" id="email" value="{{ old('email') }}" name="email">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control bg-transparent border-top-0 border-right-0 border-left-0 @error('password') is-invalid @enderror" id="password" value="{{ old('password') }}" name="password">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center mt-5">
                                <button type="submit" class="btn btn-danger">Daftar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
