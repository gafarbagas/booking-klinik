@extends('layouts.dashboard')

@section('title', 'Tambah Dokter Baru')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tambah Dokter</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <form action="/dokter" method="POST">
                            @csrf
                            <p><b>DATA DIRI</b></p>
                            <div class="form-group row">
                                <label for="name"  class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Nama" value="{{ old('name') }}">
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
                                            <input type="checkbox" class="form-check-input" name="jenis_layanan[]" value="{{$serviceType->id}}" id="jenis_layanan{{$serviceType->id}}">
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
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"  class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-4">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password" value="{{ old('password') }}">
                                    @error('password')
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
<script type="text/javascript">
    var i = 0;
    $("#add").click(function(){
        ++i;
        $("#dynamicTable").append('<tr><td><select class="mt-3 form-control @error('jenis_layanan.*') is-invalid @enderror" name="jenis_layanan[]" id="role"><option selected disabled>Pilih Jenis Layanan</option>@foreach ($serviceTypes as $serviceType)<option value="{{ $serviceType->id }}" @if (old('jenis_layanan.*') == "$serviceType->id") {{ 'selected' }} @endif>{{$serviceType->service_type_name}}</option>@endforeach</select>@error('jenis_layanan.*')<div class="invalid-feedback">{{$message}}</div>@enderror</td><td width="50px" class="text-right"><button type="button" class="mt-3 btn btn-danger remove-tr"><i class="fa fa-trash"></i></button></td></tr>');
    });
    $(document).on('click', '.remove-tr', function(){
        $(this).parents('tr').remove();
    });

</script>
@endsection

