@extends('layouts.dashboard')

@section('title', 'Surat Keterangan Istirahat')

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
                    <h1>Surat Keterangan Istirahat</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('tambah.keterangan-istirahat')}}" class="btn btn-danger btn-sm mb-1">
                        <i class="fas fa-plus"></i>
                        <span class="text">Tambah</span>
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{route('keterangan-istirahat')}}" method="GET">
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
                                    <th>No. Surat</th>
                                    <th>Nama Pasien</th>
                                    <th>NIK</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    @if (Auth::user()->level == 'admin')
                                        <th>Dokter</th>
                                    @endif
                                    <th width=30px>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($datas as $key => $data)
                                    <tr>
                                        <td>{{ $datas->firstItem() + $key }}.</td>
                                        <td>{{ $data->no_surat}}</td>
                                        <td>{{ $data->pasien->user->name}}</td>
                                        <td>{{ $data->pasien->nik}}</td>
                                        <td>{{ Carbon\Carbon::parse($data->tanggal_mulai_izin)->translatedFormat(' d F Y')}}</td>
                                        <td>{{ Carbon\Carbon::parse($data->tanggal_selesai_izin)->translatedFormat(' d F Y')}}</td>
                                        @if (Auth::user()->level == 'admin')
                                            <td>{{ $data->dokter->user->name}}</td>
                                        @endif
                                        <td>
                                            <a href="/surat/keterangan-istirahat/{{Crypt::encrypt($data->id_certificate_rests)}}/detail" class="btn btn-sm btn-secondary"><i class="fa fa-eye"></i></a>
                                            <a href="/surat/keterangan-istirahat/{{Crypt::encrypt($data->id_certificate_rests)}}/ubah" class="btn btn-sm btn-info"><i class="fa fa-pencil-alt"></i></a>
                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>

                        </table>
                    </div>
                    <div style="float:left">
                        Menampilkan {!! $datas->firstItem() !!}
                        sampai  {!! $datas->lastItem() !!}
                        dari {!! $datas->total() !!} data

                    </div>
                    <div style="float:right">
                        {!! $datas->links() !!}
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
