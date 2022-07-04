@extends('layouts.dashboard')

@section('title', 'Ubah Surat Rujukan')

@section('style')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Ubah Surat Rujukan</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <form action="/surat/rujukan/{{$data->id}}" method="POST">
                        @csrf
                        @method('PATCH')
                            <div class="form-group row">
                                <label for="name"  class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-5">
                                    <input class="form-control" type="text" name="nama" value="{{$data->pasien->user->name}}" id="name" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jenis_kelamin"  class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-5">
                                    <input class="form-control" type="text" name="jenis_kelamin" value="{{$data->pasien->jenis_kelamin}}" id="jenis_kelamin" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tanggal_lahir"  class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-3">
                                    <input class="form-control" type="text" name="tanggal_lahir" value="{{$data->pasien->tanggal_lahir}}" id="tanggal_lahir" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alamat"  class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm">
                                    <textarea name="alamat" id="alamat" cols="30" rows="2" class="form-control" disabled>{{$data->pasien->alamat}}</textarea>
                                </div>
                            </div>
                            @if (Auth::user()->level == 'admin')
                                <div class="form-group row">
                                    <label for="id_doctor"  class="col-sm-3 col-form-label">Pilih Dokter</label>
                                    <div class="col-sm-4">
                                        <select name="id_doctor" id="id_doctor" class="form-control @error('id_doctor') is-invalid @enderror">
                                            <option selected disabled>Pilih Dokter</option>
                                            @foreach ($doctors as $doctor)
                                                <option value="{{ $doctor->id }}" {{"$doctor->id" == "$data->id_doctor" ? 'selected' :'' }}>{{ $doctor->user->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_doctor')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            @elseif(Auth::user()->level == 'doctor')
                                <input type="hidden" value="{{$data->id_doctor}}" name="id_doctor">
                            @endif
                            <div class="form-group row">
                                <label for="tujuan_dokter"  class="col-sm-3 col-form-label">Dikirim Kepada</label>
                                <div class="col-sm">
                                    <input type="text" class="form-control @error('tujuan_dokter') is-invalid @enderror" name="tujuan_dokter" id="tujuan_dokter" placeholder="Nama Dokter" value="{{ $data->tujuan_dokter }}">
                                    @error('tujuan_dokter')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tujuan_lokasi"  class="col-sm-3 col-form-label">Dikirim Ke</label>
                                <div class="col-sm">
                                    <input type="text" class="form-control @error('tujuan_lokasi') is-invalid @enderror" name="tujuan_lokasi" id="tujuan_lokasi" placeholder="Nama Lokasi" value="{{ $data->tujuan_lokasi }}">
                                    @error('tujuan_lokasi')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="keluhan"  class="col-sm-3 col-form-label">Keluhan</label>
                                <div class="col-sm">
                                    <textarea type="text" class="form-control @error('keluhan') is-invalid @enderror" name="keluhan" id="keluhan" placeholder="Keluhan">{{$data->keluhan }}</textarea>
                                    @error('keluhan')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="diagnosis_sementara"  class="col-sm-3 col-form-label">Diagnosa Sementara</label>
                                <div class="col-sm">
                                    <textarea type="text" class="form-control @error('diagnosis_sementara') is-invalid @enderror" name="diagnosis_sementara" id="diagnosis_sementara" placeholder="Diagnosa Sementara">{{ $data->diagnosis_sementara }}</textarea>
                                    @error('diagnosis_sementara')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tindakan"  class="col-sm-3 col-form-label">Tindakan Yang Telah Diberikan</label>
                                <div class="col-sm">
                                    <textarea type="text" class="form-control @error('tindakan') is-invalid @enderror" name="tindakan" id="tindakan" placeholder="Tindakan Yang Telah Diberikan">{{ $data->tindakan }}</textarea>
                                    @error('tindakan')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="catatan"  class="col-sm-3 col-form-label">Catatan</label>
                                <div class="col-sm">
                                    <textarea type="text" class="form-control @error('catatan') is-invalid @enderror" name="catatan" id="catatan" placeholder="Catatan">{{ $data->catatan }}</textarea>
                                    @error('catatan')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <input type="hidden" id="id_pasien" value="{{$data->id_patient}}" name="id_pasien">

                            <button class="btn btn-primary" type="submit">Simpan</button>

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
    var route = "/caripasien/autocomplete/";
    $('#cari_pasien').typeahead({
        source: function (query, process) {
            return $.get(route, {
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
            var json = data,
            obj = JSON.parse(json);
            $("#name").val(obj.nama);
            $("#jenis_kelamin").val(obj.jenis_kelamin);
            $("#tanggal_lahir").val(obj.tanggal_lahir);
            $("#alamat").val(obj.alamat);
            $("#id_pasien").val(obj.id_pasien);
        });
    }
</script>
@endsection
