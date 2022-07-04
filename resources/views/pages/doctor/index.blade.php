@extends('layouts.dashboard')

@section('title', 'Dokter')
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
                        <h1>Dokter</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <a href="{{route('tambahDokter')}}" class="btn btn-danger btn-sm mb-1">
                            <i class="fas fa-plus"></i>
                            <span class="text">Tambah</span>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-sm text-black nowrap" width="100%" cellspacing="0" id="projecttable">
                                <thead class="thead">
                                <tr>
                                    <th width=25px>No.</th>
                                    <th>Nama Dokter</th>
                                    <th>Specialist</th>
                                    <th width=100px>Aksi</th>
                                </tr>
                                </thead>

                                <tbody>
                                    @foreach ($doctor as $doctors)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$doctors->user->name}}</td>
                                        <td>
                                            @foreach ($doctors->serviceType as $service)
                                                {{$service->service_type_name}}{{$loop->last ? '': ', '}}
                                            @endforeach
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-secondary shadow-sm mb-1" data-toggle="modal" data-target="#detail{{$doctors->id}}">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                            <a href="/dokter/{{Crypt::encrypt($doctors->id)}}/ubah" class="btn btn-sm btn-info shadow-sm mb-1"><i class="fa fa-pencil-alt"></i></a>
                                            <a href="/dokter/{{Crypt::encrypt($doctors->id)}}/hapus" class="btn btn-sm btn-danger mb-1 delete-confirm"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="detail{{$doctors->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                        <div class="col-sm">{{ $doctors->user->name }}</div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label class="col-sm-4">Specialist</label>
                                                        <div class="col-sm">@foreach ($doctors->serviceType as $service)
                                                                {{$service->service_type_name}}{{$loop->last ? '': ', '}}
                                                            @endforeach</div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label class="col-sm-4">Email</label>
                                                        <div class="col-sm">{{ $doctors->user->email }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>

                            </table>
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
                "lengthMenu": [[5,10,25,50,-1], [5,10,25,50,"All"]],
                "language": {
                    "sEmptyTable":   "Tidak ada data",
                    "sProcessing":   "Sedang memproses...",
                    "sLengthMenu":   "Tampilkan _MENU_ data",
                    "sZeroRecords":  "Tidak ditemukan data yang sesuai",
                    "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 data",
                    "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                    "sInfoPostFix":  "",
                    "sSearch":       "Cari:",
                    "sUrl":          "",
                    "oPaginate": {
                        "sFirst":    "Pertama",
                        "sPrevious": "<",
                        "sNext":     ">",
                        "sLast":     "Terakhir"
                    }
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
