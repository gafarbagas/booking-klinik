@extends('layouts.dashboard')

@section('title', 'Ubah Surat Keterangan Istirahat')

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
                        <h1>Ubah Surat Keterangan Istirahat</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <form action="/surat/keterangan-istirahat/{{$data->id}}" method="POST">
                        @csrf
                        @method('PATCH')
                            <div class="form-group row">
                                <label for="no_surat"  class="col-sm-3 col-form-label">No. Surat</label>
                                <div class="col-sm">
                                    <input type="text" class="form-control @error('no_surat') is-invalid @enderror" name="no_surat" id="no_surat" placeholder="No. Surat" value="{{ $data->no_surat }}">
                                    @error('no_surat')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
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
                                <label for="tanggal_mulai_izin" class="col-sm-3 col-form-label">Tanggal Mulai</label>
                                <div class="col-sm-4">
                                    <input class="form-control @error('tanggal_mulai_izin') is-invalid @enderror" type="date" name="tanggal_mulai_izin" id="tanggal_mulai_izin" value="{{$data->tanggal_mulai_izin}}">
                                    @error('tanggal_mulai_izin')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tanggal_selesai_izin" class="col-sm-3 col-form-label">Tanggal Selesai</label>
                                <div class="col-sm-4">
                                    <input class="form-control @error('tanggal_selesai_izin') is-invalid @enderror" type="date" name="tanggal_selesai_izin" id="tanggal_selesai_izin" value="{{$data->tanggal_selesai_izin}}">
                                    @error('tanggal_selesai_izin')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="keterangan" class="col-sm-3 col-form-label pt-0">Keterangan</label>
                                <div class="col-sm">
                                    <div class="form-check @error('keterangan') is-invalid @enderror">
                                        <input class="form-check-input  @error('keterangan') is-invalid @enderror" type="radio" name="keterangan" value="Sedang Berobat Jalan" id="Sedang Berobat Jalan" {{"Sedang Berobat Jalan" == "$data->keterangan" ? 'checked' :'' }}>
                                        <label class="form-check-label" for="Sedang Berobat Jalan">
                                            Sedang Berobat Jalan
                                        </label>
                                    </div>
                                    <div class="form-check @error('keterangan') is-invalid @enderror">
                                        <input class="form-check-input @error('keterangan') is-invalid @enderror" type="radio" name="keterangan" value="Post Tindakan" id="Post Tindakan" {{"Post Tindakan" == "$data->keterangan" ? 'checked' :'' }}>
                                        <label class="form-check-label" for="Post Tindakan">
                                            Post Tindakan
                                        </label>
                                    </div>
                                    @error('keterangan')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="alasan" class="col-sm-3 col-form-label pt-0">Karena gangguan kesehatan</label>
                                <div class="col-sm">
                                    <div class="form-check @error('alasan') is-invalid @enderror">
                                        <input class="form-check-input  @error('alasan') is-invalid @enderror" type="radio" name="alasan" value="Perlu Istirahat / Kontrol" id="Perlu Istirahat / Kontrol" {{"Perlu Istirahat / Kontrol" == "$data->alasan" ? 'checked' :'' }}>
                                        <label class="form-check-label" for="Perlu Istirahat / Kontrol">
                                            Perlu Istirahat / Kontrol
                                        </label>
                                    </div>
                                    <div class="form-check @error('alasan') is-invalid @enderror">
                                        <input class="form-check-input @error('alasan') is-invalid @enderror" type="radio" name="alasan" value="Masih Memerlukan Istirahat" id="Masih Memerlukan Istirahat" {{"Masih Memerlukan Istirahat" == "$data->alasan" ? 'checked' :'' }}>
                                        <label class="form-check-label" for="Masih Memerlukan Istirahat">
                                            Masih Memerlukan Istirahat
                                        </label>
                                    </div>
                                    @error('alasan')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tanggal_surat" class="col-sm-3 col-form-label">Tanggal Surat</label>
                                <div class="col-sm-4">
                                    <input class="form-control @error('tanggal_surat') is-invalid @enderror" type="date" name="tanggal_surat" id="tanggal_surat" value="{{$data->tanggal_surat}}">
                                    @error('tanggal_surat')
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
