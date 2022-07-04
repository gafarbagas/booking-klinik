@extends('layouts.dashboard')

@section('title', 'Tambah Surat Keterangan Istirahat')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tambah Surat Keterangan Istirahat</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <form action="/surat/keterangan-istirahat" method="POST">
                        @csrf
                            <div class="form-group row">
                                <label for="no_surat"  class="col-sm-3 col-form-label">No. Surat</label>
                                <div class="col-sm">
                                    <input type="text" class="form-control @error('no_surat') is-invalid @enderror" name="no_surat" id="no_surat" placeholder="No. Surat" value="{{ old('no_surat') }}">
                                    @error('no_surat')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="cari_pasien"  class="col-sm-3 col-form-label">Cari Pasien</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control @error('cari_pasien') is-invalid @enderror" name="cari_pasien" id="cari_pasien" placeholder="Cari Pasien" value="{{ old('cari_pasien') }}" autocomplete="off">
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
                                <label for="name"  class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-5">
                                    <input class="form-control" type="text" name="nama" value="{{old('name')}}" id="name" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jenis_kelamin"  class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-5">
                                    <input class="form-control" type="text" name="jenis_kelamin" value="{{old('jenis_kelamin')}}" id="jenis_kelamin" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tanggal_lahir"  class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-3">
                                    <input class="form-control" type="text" name="tanggal_lahir" value="{{old('tanggal_lahir')}}" id="tanggal_lahir" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alamat"  class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm">
                                    <textarea name="alamat" id="alamat" cols="30" rows="2" class="form-control" disabled>{{old('alamat')}}</textarea>
                                </div>
                            </div>
                            @if (Auth::user()->level == 'admin')
                                <div class="form-group row">
                                    <label for="id_doctor"  class="col-sm-3 col-form-label">Dokter Yang Menandatangani</label>
                                    <div class="col-sm-4">
                                        <select name="id_doctor" id="id_doctor" class="form-control @error('id_doctor') is-invalid @enderror">
                                            <option selected disabled>Pilih Dokter</option>
                                            @foreach ($doctors as $doctor)
                                                <option value="{{ $doctor->id }}" @if (old('id_doctor') == "$doctor->id") {{ 'selected' }} @endif>{{ $doctor->user->name }}</option>
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
                                <input type="hidden" name="id_doctor" value="{{Auth::user()->dokter->first()->id}}">
                            @endif
                            <div class="form-group row">
                                <label for="tanggal_mulai_izin" class="col-sm-3 col-form-label">Tanggal Mulai</label>
                                <div class="col-sm-4">
                                    <input class="form-control @error('tanggal_mulai_izin') is-invalid @enderror" type="date" name="tanggal_mulai_izin" id="tanggal_mulai_izin" value="{{old('tanggal_mulai_izin')}}">
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
                                    <input class="form-control @error('tanggal_selesai_izin') is-invalid @enderror" type="date" name="tanggal_selesai_izin" id="tanggal_selesai_izin" value="{{old('tanggal_selesai_izin')}}">
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
                                        <input class="form-check-input  @error('keterangan') is-invalid @enderror" type="radio" name="keterangan" value="Sedang Berobat Jalan" id="Sedang Berobat Jalan" @if (old('keterangan') == 'Sedang Berobat Jalan') {{ 'checked' }}@endif>
                                        <label class="form-check-label" for="Sedang Berobat Jalan">
                                            Sedang Berobat Jalan
                                        </label>
                                    </div>
                                    <div class="form-check @error('keterangan') is-invalid @enderror">
                                        <input class="form-check-input @error('keterangan') is-invalid @enderror" type="radio" name="keterangan" value="Post Tindakan" id="Post Tindakan" @if (old('keterangan') == 'Post Tindakan') {{ 'checked' }}@endif>
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
                                        <input class="form-check-input  @error('alasan') is-invalid @enderror" type="radio" name="alasan" value="Perlu Istirahat / Kontrol" id="Perlu Istirahat / Kontrol" @if (old('alasan') == 'Perlu Istirahat / Kontrol') {{ 'checked' }}@endif>
                                        <label class="form-check-label" for="Perlu Istirahat / Kontrol">
                                            Perlu Istirahat / Kontrol
                                        </label>
                                    </div>
                                    <div class="form-check @error('alasan') is-invalid @enderror">
                                        <input class="form-check-input @error('alasan') is-invalid @enderror" type="radio" name="alasan" value="Masih Memerlukan Istirahat" id="Masih Memerlukan Istirahat" @if (old('alasan') == 'Masih Memerlukan Istirahat') {{ 'checked' }}@endif>
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
                                    <input class="form-control @error('tanggal_surat') is-invalid @enderror" type="date" name="tanggal_surat" id="tanggal_surat" value="{{old('tanggal_surat')}}">
                                    @error('tanggal_surat')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <input type="hidden" id="id_pasien" name="id_pasien">

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
