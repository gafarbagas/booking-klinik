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
                        <form action="/janji" method="POST">
                            @csrf
                            <h5 class="h5 font-weight-bold">Data Pasien</h5>
                            <div class="form-group row">
                                <label for="cari_pasien"  class="col-sm-2 col-form-label">Cari Pasien</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control @error('cari_pasien') is-invalid @enderror" name="cari_pasien" id="cari_pasien" placeholder="Cari NIK Pasien" value="{{ old('cari_pasien') }}" autocomplete="off">
                                        <div class="input-group-append">
                                            <span class="btn btn-secondary" onclick="caripasien()"><i class="fa fa-search"></i></span>
                                        </div>
                                        @error('cari_pasien')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name"  class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-5">
                                    <input class="form-control" type="text" name="nama" value="{{old('name')}}" id="name" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jenis_kelamin"  class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-5">
                                    <input class="form-control" type="text" name="jenis_kelamin" value="{{old('jenis_kelamin')}}" id="jenis_kelamin" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tanggal_lahir"  class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-3">
                                    <input class="form-control" type="text" name="tanggal_lahir" value="{{old('tanggal_lahir')}}" id="tanggal_lahir" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alamat"  class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm">
                                    <textarea name="alamat" id="alamat" cols="30" rows="2" class="form-control" disabled>{{old('alamat')}}</textarea>
                                </div>
                            </div>
                            <h5 class="h5 font-weight-bold mt-4 mb-3">Waktu Kunjungan</h5>
                            <div class="form-group row">
                                <label for="namaLayanan"  class="col-sm-2 col-form-label">Pilih Layanan</label>
                                <div class="col-sm-4">
                                    <select name="namaLayanan" id="namaLayanan" class="form-control @error('namaLayanan') is-invalid @enderror">
                                        <option selected disabled>Pilih Layanan</option>
                                        @foreach ($serviceTypes as $serviceType)
                                            <option value="{{ $serviceType->service_type_name }}">{{ $serviceType->service_type_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('namaLayanan')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="namaDokter"  class="col-sm-2 col-form-label">Nama Dokter</label>
                                <div class="col-sm-4">
                                    <select name="namaDokter" id="namaDokter" class="form-control @error('namaDokter') is-invalid @enderror">
                                        <option selected disabled></option>
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
                                <div class="col-sm-3 mb-3">
                                    <input class="form-control @error('tanggalKunjungan') is-invalid @enderror" type="date" name="tanggalKunjungan" id="tanggalKunjungan" value="{{ old('tanggalKunjungan') }}">
                                    @error('tanggalKunjungan')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-sm-2 mb-3">
                                    <input class="form-control @error('waktu') is-invalid @enderror" type="time" name="waktu" id="waktu" value="{{ old('waktu') }}">
                                    @error('waktu')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-sm mb-3">
                                    <div class="row">
                                        <div class="col-sm-4">Dermatology</div>
                                        <div class="d-none d-sm-inline">:</div>
                                        <div class="col-sm">09:00-13:00 dan 19:00-21:00</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">Cosmetic Medic</div>
                                        <div class="d-none d-sm-inline">:</div>
                                        <div class="col-sm">08:00-21:00</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">Obgyn & Fertility</div>
                                        <div class="d-none d-sm-inline">:</div>
                                        <div class="col-sm">19:00-21:00</div>
                                    </div>
                                </div>
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

                            <input type="hidden" id="id_pasien" name="id_pasien">

                            <button class="btn btn-primary" type="submit">Tambah</button>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="namaLayanan"]').on('change', function() {
            var layanan = $(this).val();
            if(layanan) {
                $.ajax({
                    url: '/promise/ajax/'+layanan,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        if(data.success === false){
                            $('select[name="namaDokter"]').empty();
                            $('select[name="namaDokter"]').append('<option value="-">-</option>');
                        }else{
                            $('select[name="namaDokter"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="namaDokter"]').append('<option value="'+ value +'">'+ value +'</option>');
                            });
                        }
                    }
                });
            }else{
                $('select[name="namaDokter"]').empty();
            }
        });
    });
</script>
<script type="text/javascript">
    var routeCariPasien = "/caripasien/autocomplete";
    $('#cari_pasien').typeahead({
        source: function (query, process) {
            return $.get(routeCariPasien, {
                query: query
            }, function (data) {
                var newData = [];
                $.each(data, function(){
                    newData.push(this.item_name);
                });
                return process(data);
            });
        }
    });
</script>
<script type="text/javascript">
    function caripasien() {
        var cari_pasien = $("#cari_pasien").val();
        $.ajax({
            url : '/caripasien/autofill',
            data : 'cari_pasien='+cari_pasien,
        }).success(function (data) {
            if(data.success==false){
                Swal.fire('Gagal','Data Pasien Tidak Ditemukan','error')
            }else{
                var json = data,
                obj = JSON.parse(json);
                $("#name").val(obj.nama);
                $("#jenis_kelamin").val(obj.jenis_kelamin);
                $("#tanggal_lahir").val(obj.tanggal_lahir);
                $("#alamat").val(obj.alamat);
                $("#id_pasien").val(obj.id_pasien);
            }
        });
    }
</script>
@endsection
