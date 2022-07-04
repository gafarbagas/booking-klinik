@extends('layouts.dashboard')

@section('title', 'Janji Yang Akan Datang')

@section('style')
    <link rel="stylesheet" href="{{asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Janji Yang Akan Datang</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('indexEsok')}}" method="GET">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Cari no. surat, nama pasien, nik">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-secondary"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm text-black nowrap" width="100%" cellspacing="0" id="projecttable">
                            <thead class="thead">
                                <tr>
                                    <th width=25px>No.</th>
                                    <th>No. Janji</th>
                                    <th>Tanggal Janji</th>
                                    <th>Jam Janji</th>
                                    <th>Nama Pasien</th>
                                    <th>NIK</th>
                                    <th>Layanan</th>
                                    <th>Status</th>
                                    <th width=30px>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($appointments as $key => $appointment)
                                    <tr>
                                        <td class="text-center">{{ $appointments->firstItem() + $key }}.</td>
                                        <td>{{ $appointment->no_janji}}</td>
                                        <td>{{ Carbon\Carbon::parse($appointment->tanggal_periksa)->translatedFormat(' d F Y')}}</td>
                                        <td>{{ Carbon\Carbon::parse($appointment->waktu)->format('H:i')}}</td>
                                        <td>{{ $appointment->pasien->user->name}}</td>
                                        <td>{{ $appointment->pasien->nik}}</td>
                                        <td>{{ $appointment->serviceType->service_type_name}}</td>
                                        <td class="text-capitalize">{{ $appointment->status }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-secondary shadow-sm mb-1" data-toggle="modal" data-target="#detail{{$appointment->id_appointment}}">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="detail{{$appointment->id_appointment}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Detail data</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="row mb-2">
                                                                <label class="col-sm-4">Nama</label>
                                                                <div class="col-sm">{{ $appointment->pasien->user->name }}</div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <label class="col-sm-4">Jenis Kelamin</label>
                                                                <div class="col-sm text-capitalize">{{ $appointment->pasien->jenis_kelamin }}</div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <label class="col-sm-4">NIK</label>
                                                                <div class="col-sm">{{ $appointment->pasien->nik }}</div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <label class="col-sm-4">Tanggal Lahir</label>
                                                                <div class="col-sm">{{ Carbon\carbon::parse($appointment->pasien->tanggal_lahir)->translatedFormat("d F Y") }}</div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <label class="col-sm-4">No. HP</label>
                                                                <div class="col-sm">{{ $appointment->pasien->no_hp }}</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="row mb-2">
                                                                <label class="col-sm-4">No. Janji</label>
                                                                <div class="col-sm">{{ $appointment->no_janji }}</div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <label class="col-sm-4">Layanan</label>
                                                                <div class="col-sm">{{ $appointment->serviceType->service_type_name }}</div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <label class="col-sm-4">Tanggal Janji</label>
                                                                <div class="col-sm">{{ Carbon\Carbon::parse($appointment->tanggal_periksa)->translatedFormat('d F Y') }}</div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <label class="col-sm-4">Jam Janji</label>
                                                                <div class="col-sm">{{ Carbon\Carbon::parse($appointment->waktu)->format('H:i') }}</div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <label class="col-sm-4">Dokter</label>
                                                                <div class="col-sm">{{ $appointment->dokter->user->name }}</div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <label class="col-sm-4">Keluhan</label>
                                                                <div class="col-sm">{{ $appointment->keluhan }}</div>
                                                            </div>
                                                            @if ($appointment->status == "menunggu")
                                                            <form action="/janji/admin/ubahstatus/{{$appointment->id_appointment}}" method="POST">
                                                            @csrf
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Status</label>
                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <select name="status" class="form-control @error('status') is-invalid @enderror">
                                                                                <option value="menunggu" {{"menunggu" == "$appointment->status" ? 'selected' :'' }} disabled>Menunggu</option>
                                                                                <option value="diterima" {{"diterima" == "$appointment->status" ? 'selected' :'' }} >Diterima</option>
                                                                                <option value="ditolak" {{"ditolak" == "$appointment->status" ? 'selected' :'' }} >Ditolak</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                            <button class="btn btn-primary" type="submit">Ubah</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </form>
                                                            @else
                                                                <div class="row mb-2">
                                                                    <label class="col-sm-4">Status</label>
                                                                    <div class="col-sm">{{ $appointment->status }}</div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            </tbody>

                        </table>
                    </div>
                    <div style="float:left">
                        Menampilkan {!! $appointments->firstItem() !!}
                        sampai  {!! $appointments->lastItem() !!}
                        dari {!! $appointments->total() !!} data

                    </div>
                    <div style="float:right">
                        {!! $appointments->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
    <script src="{{asset('lte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('lte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        $(document).ready(function (){
            $('#projecttable').DataTable({
                "paging":   false,
                "info":     false,
                "searching":false,
                "language": {
                    "sEmptyTable":   "Tidak ada data",
                }
            });
        });
    </script>

    <script>
        $('.delete-confirm').on('click', function (event) {
            event.preventDefault();
            const url = $(this).attr('href');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Harap periksa kembali. Data yang akan dihapus tidak akan bisa kembali!",
                icon: 'warning',
                reverseButtons: true,
                showCancelButton: true,
                confirmButtonColor: '#888888',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
                else if ( result.dismiss === Swal.DismissReason.cancel){
                    // Swal.fire('Dibatalkan','Data Anda Tersimpan Aman','error');
                }
            });
        });
    </script>
@endsection
