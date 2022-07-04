@extends('layouts.dashboard')

@section('title', 'Diagnosis')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Diagnosis</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <div class="row">
                                    <label class="col-sm-4">Nama Pasien</label>
                                    <div class="col-sm-1 d-none d-sm-inline">:</div>
                                    <div class="col-sm">{{ $data->pasien->user->name }}</div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-4">Tanggal Lahir</label>
                                    <div class="col-sm-1 d-none d-sm-inline">:</div>
                                    <div class="col-sm">{{ Carbon\carbon::parse($data->pasien->tanggal_lahir)->translatedFormat("d F Y") }}</div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-4">Jenis Kelamin</label>
                                    <div class="col-sm-1 d-none d-sm-inline">:</div>
                                    <div class="col-sm text-capitalize">{{ $data->pasien->jenis_kelamin }}</div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-4">NIK</label>
                                    <div class="col-sm-1 d-none d-sm-inline">:</div>
                                    <div class="col-sm">{{ $data->pasien->nik }}</div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-4">No. HP</label>
                                    <div class="col-sm-1 d-none d-sm-inline">:</div>
                                    <div class="col-sm">{{ $data->pasien->no_hp }}</div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-4">Alamat</label>
                                    <div class="col-sm-1 d-none d-sm-inline">:</div>
                                    <div class="col-sm">{{ $data->pasien->alamat }}</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <label class="col-sm-4">No. Janji</label>
                                    <div class="col-sm-1 d-none d-sm-inline">:</div>
                                    <div class="col-sm">{{ $data->no_janji }}</div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-4">Layanan</label>
                                    <div class="col-sm-1 d-none d-sm-inline">:</div>
                                    <div class="col-sm">{{ $data->serviceType->service_type_name }}</div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-4">Dokter</label>
                                    <div class="col-sm-1 d-none d-sm-inline">:</div>
                                    <div class="col-sm">{{ $data->dokter->user->name }}</div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-4">Tanggal Periksa</label>
                                    <div class="col-sm-1 d-none d-sm-inline">:</div>
                                    <div class="col-sm">{{ Carbon\Carbon::parse($data->tanggal_periksa)->translatedFormat('d F Y') }}</div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-4">Keluhan</label>
                                    <div class="col-sm-1 d-none d-sm-inline">:</div>
                                    <div class="col-sm">{{ $data->keluhan }}</div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <form action="/diagnosis/{{$data->id}}/buat" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="hasil_pemeriksaan"  class="col-form-label">Hasil Pemeriksaan</label>
                                <input type="text" class="form-control @error('hasil_pemeriksaan') is-invalid @enderror" name="hasil_pemeriksaan" id="hasil_pemeriksaan" placeholder="Hasil Pemeriksaan" value="{{ old('hasil_pemeriksaan') }}">
                                @error('hasil_pemeriksaan')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="diagnosis"  class="col-form-label">Diagnosis</label>
                                <input type="text" class="form-control @error('diagnosis') is-invalid @enderror" name="diagnosis" id="diagnosis" placeholder="Diagnosis" value="{{ old('diagnosis') }}">
                                @error('diagnosis')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tindakan"  class="col-form-label">Tindakan</label>
                                <input type="text" class="form-control @error('tindakan') is-invalid @enderror" name="tindakan" id="tindakan" placeholder="Tindakan" value="{{ old('tindakan') }}">
                                @error('tindakan')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="rencana"  class="col-form-label">Rencana</label>
                                <input type="text" class="form-control @error('rencana') is-invalid @enderror" name="rencana" id="rencana" placeholder="Rencana" value="{{ old('rencana') }}">
                                @error('rencana')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label class="col-form-label">Resep Obat</label>
                                <table class="table" id="resep">
                                    @if (old('nama_obat',[]))
                                        @foreach (old('nama_obat',[]) as $key => $item)
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control @error('nama_obat.*') is-invalid @enderror" name="nama_obat[]" value="{{$item}}" placeholder="Nama Obat">
                                                @error('nama_obat.*')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('dosis.*') is-invalid @enderror" name="dosis[]" value="{{old('dosis')[$key]}}" placeholder="Dosis">
                                                @error('dosis.*')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                            @if ($loop->first)
                                                <td width="50px" class="text-right"><button type="button" name="addResep" id="addResep" class="btn btn-success"><i class="fa fa-plus"></i></button></td> 
                                            @else
                                                <td width="50px" class="text-right"><button type="button" class="btn btn-danger remove-tr-resep"><i class="fa fa-trash"></i></button></td> 
                                            @endif
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control @error('nama_obat') is-invalid @enderror" name="nama_obat[]" placeholder="Nama Obat">
                                                @error('nama_obat.*')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('dosis') is-invalid @enderror" name="dosis[]" placeholder="Dosis">
                                                @error('dosis.*')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                            <td width="50px" class="text-right"><button type="button" name="addResep" id="addResep" class="btn btn-success"><i class="fa fa-plus"></i></button></td> 
                                        </tr>
                                    @endif
                                </table>
                            </div>
                            <button class="btn btn-primary" type="submit">Simpan dan lanjutkan unggah foto <i class="fa fa-arrow-right"></i></button>
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
    $("#addResep").click(function(){
        ++i;
        $("#resep").append('<tr><td><input type="text" class="form-control" name="nama_obat[]" placeholder="Nama Obat"></td><td><input type="text" class="form-control" name="dosis[]" placeholder="Dosis"></td><td width="50px" class="text-right"><button type="button" class="btn btn-danger remove-tr-resep"><i class="fa fa-trash"></i></button></td></tr>');
    });
    $(document).on('click', '.remove-tr-resep', function(){
        $(this).parents('tr').remove();
    });
</script>
@endsection