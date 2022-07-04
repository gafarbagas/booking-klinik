@extends('layouts.dashboard')

@section('title', 'Pasien')
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
                    <h1>Pasien</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('pasientambah')}}" class="btn btn-danger btn-sm mb-1">
                        <i class="fas fa-plus"></i>
                        <span class="text">Tambah</span>
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{route('pasien')}}" method="GET">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Cari data pasien">
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
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    <th>Jenis Kelamin</th>
                                    <th>No. HP</th>
                                    <th width=100px>Aksi</th>

                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($patients as $key => $patient)
                                    <tr>
                                        <td>{{ $patients->firstItem() + $key }}.</td>
                                        <td>{{ $patient->name}}</td>
                                        <td>{{ $patient->nik }}</td>
                                        <td class="text-capitalize">{{ $patient->jenis_kelamin }}</td>
                                        <td>{{ $patient->no_hp }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-secondary shadow-sm mb-1" data-toggle="modal" data-target="#detail{{$patient->id}}">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                            @if(Auth::user()->level == 'admin')
                                                <a href="/pasien/{{Crypt::encrypt($patient->id)}}/ubah" class="btn btn-sm btn-info shadow-sm mb-1"><i class="fa fa-pencil-alt"></i></a>
                                                <a href="/pasien/{{\Crypt::encrypt($patient->id)}}/hapus" class="btn btn-sm btn-danger mb-1 delete-confirm"><i class="fa fa-trash"></i></a>
                                            @endif
                                        </td>
                                    </tr>

                                    <!-- Modal -->
                                    <div class="modal fade" id="detail{{$patient->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Detail data</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row mb-2">
                                                        <label class="col-sm-4">Nama</label>
                                                        <div class="col-sm">{{ $patient->name }}</div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label class="col-sm-4">Jenis Kelamin</label>
                                                        <div class="col-sm text-capitalize">{{ $patient->jenis_kelamin }}</div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label class="col-sm-4">NIK</label>
                                                        <div class="col-sm">{{ $patient->nik }}</div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label class="col-sm-4">Tanggal Lahir</label>
                                                        <div class="col-sm">{{ Carbon\carbon::parse($patient->tanggal_lahir)->translatedFormat("d F Y") }}</div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label class="col-sm-4">Email</label>
                                                        <div class="col-sm">{{ $patient->email }}</div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label class="col-sm-4">No. HP</label>
                                                        <div class="col-sm">{{ $patient->no_hp }}</div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label class="col-sm-4">Alamat</label>
                                                        <div class="col-sm">{{ $patient->alamat }}</div>
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
                        Menampilkan {!! $patients->firstItem() !!}
                        sampai  {!! $patients->lastItem() !!}
                        dari {!! $patients->total() !!} data
                    </div>
                    <div style="float:right">
                        {!! $patients->links() !!}
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
                "searching": false,
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
