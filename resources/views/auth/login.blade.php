@extends('auth.layouts.login')
@section('Title', 'Login')
@section('BawahNavbar')

<section class="mt-5 pt-5">
    <div class="row">
        <div class="col-lg-6">
            <div class="container">
                <div class="px-xl-5">
                    <div class="card shadow mt-5" style="background:rgba(243, 154, 66, 0.22)">
                        <div class="card-body">
                            <h3 class="text-center mb-5"><strong>Masuk</strong></h3>

                            @if (Session::has('custom-error'))
                                <div class="alert alert-danger" role="alert">
                                    {!! Session::get('custom-error') !!}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control bg-transparent border-top-0 border-right-0 border-left-0 @error('email') is-invalid @enderror" id="email" value="{{old('email')}}" name="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control bg-transparent border-top-0 border-right-0 border-left-0 @error('password') is-invalid @enderror" id="password" name="password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-danger small">Masuk</button>
                                </div>
                            </form>
                            <div class="text-center">
                                <p class="px-4 py-2 my-4">Belum memiliki akun? <br> Silahkan <a href="{{route('register')}}">klik disini</a></p>
                                <p class="px-4 py-2 my-4"><a href="#" data-toggle="modal" data-target="#lupapassword">Lupa Password?</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 d-none d-lg-inline">
            <div class="card text-center shadow-none">
                <img src="{{  asset('img/image-25.png') }}" width="400px" height="400px" class="card-img" style="clip-path: polygon(28% 0, 100% 0, 100% 100%, 13% 50%);object-fit:cover">
                <div class="card-img-overlay rounded-0" style="background: rgba(180,30,30,0.2);clip-path: polygon(28% 0, 100% 0, 100% 100%, 13% 50%);">
                </div>
                <div class="bg-danger position-absolute" style="min-width: 539px; min-height: 404px;bottom: 0;left: 0;clip-path: polygon(23% 3%, 10% 53%, 90% 96%, 3% 57%);">
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="lupapassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Lupa password?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-center">
                    Silahkan hubungi admin untuk melakukan reset password.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
