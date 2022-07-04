@extends('layouts.dashboard')

@section('title', 'Ubah Diagnosis Resep Obat')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Ubah Diagnosis Resep Obat</h1>
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
                                <div class="row mb-1">
                                    <div class="col-sm-4">Nama Pasien</div>
                                    <div class="col-sm-1 d-none d-sm-inline">:</div>
                                    <div class="col-sm">{{ $data->pasien->user->name }}</div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-sm-4">Tanggal Lahir</div>
                                    <div class="col-sm-1 d-none d-sm-inline">:</div>
                                    <div class="col-sm">{{ Carbon\carbon::parse($data->pasien->tanggal_lahir)->translatedFormat("d F Y") }}</div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-sm-4">Jenis Kelamin</div>
                                    <div class="col-sm-1 d-none d-sm-inline">:</div>
                                    <div class="col-sm text-capitalize">{{ $data->pasien->jenis_kelamin }}</div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-sm-4">NIK</div>
                                    <div class="col-sm-1 d-none d-sm-inline">:</div>
                                    <div class="col-sm">{{ $data->pasien->nik }}</div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-sm-4">No. HP</div>
                                    <div class="col-sm-1 d-none d-sm-inline">:</div>
                                    <div class="col-sm">{{ $data->pasien->no_hp }}</div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-sm-4">Alamat</div>
                                    <div class="col-sm-1 d-none d-sm-inline">:</div>
                                    <div class="col-sm">{{ $data->pasien->alamat }}</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row mb-1">
                                    <div class="col-sm-4">No. RM</div>
                                    <div class="col-sm-1 d-none d-sm-inline">:</div>
                                    <div class="col-sm">{{ $data->no_rm }}</div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-sm-4">Layanan</div>
                                    <div class="col-sm-1 d-none d-sm-inline">:</div>
                                    <div class="col-sm">{{ $data->serviceType->service_type_name }}</div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-sm-4">Dokter</div>
                                    <div class="col-sm-1 d-none d-sm-inline">:</div>
                                    <div class="col-sm">{{ $data->dokter->user->name }}</div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-sm-4">Tanggal Periksa</div>
                                    <div class="col-sm-1 d-none d-sm-inline">:</div>
                                    <div class="col-sm">{{ Carbon\Carbon::parse($data->tanggal_periksa)->translatedFormat('d F Y') }}</div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-sm-4">Keluhan</div>
                                    <div class="col-sm-1 d-none d-sm-inline">:</div>
                                    <div class="col-sm">{{ $data->keluhan }}</div>
                                </div>
                            </div>
                        </div>
                        <form action="/diagnosis/{{$data->id}}/ubah/resep" method="POST" enctype="multipart/form-data">
                            @csrf
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
                                        @forelse ($data->prescription as $resep)
                                            <tr>
                                                <td><input type="text" class="form-control" name="nama_obat[]" value="{{$resep->nama_obat}}" placeholder="Nama Obat"></td>
                                                <td><input type="text" class="form-control" name="dosis[]" value="{{$resep->dosis}}" placeholder="Dosis"></td>
                                                @if ($loop->first)
                                                    <td width="50px" class="text-right"><button type="button" name="addResep" id="addResep" class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                                                @else
                                                    <td width="50px" class="text-right">
                                                        <a href="/diagnosis/hapus/resep/{{Crypt::encrypt($resep->id)}}"class="btn btn-danger"><i class="fa fa-trash"></i>
                                                        </a>
                                                    </td> 
                                                @endif
                                            </tr>
                                            @empty
                                            <tr>
                                                <td><input type="text" class="form-control" name="nama_obat[]" placeholder="Nama Obat"></td>
                                                <td><input type="text" class="form-control" name="dosis[]" placeholder="Dosis"></td>
                                                <td width="50px" class="text-right"><button type="button" name="addResep" id="addResep" class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                                            </tr>
                                            @endforelse
                                        @endif
                                </table>
                            </div>
                            <button class="btn btn-primary" type="submit">Simpan</button>
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