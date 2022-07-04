@extends('layouts.dashboard')

@section('title', 'Rekam Medis')
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
                    <h1>Rekam Medis</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="" method="GET">
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
                                    <th width=100px>Aksi</th>

                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($records as $key => $record)
                                    <tr>
                                        <td>{{ $records->firstItem() + $key }}.</td>
                                        <td>{{ $record->name}}</td>
                                        <td>{{ $record->nik}}</td>
                                        <td>
                                            <a href="/rekam-medis/{{Crypt::encrypt($record->id)}}" class="btn btn-sm btn-secondary shadow-sm mb-1"><i class="fa fa-eye"></i> Lihat Rekam Medis</a>
                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>

                        </table>
                    </div>
                    <div style="float:left">
                        Menampilkan {!! $records->firstItem() !!}
                        sampai  {!! $records->lastItem() !!}
                        dari {!! $records->total() !!} data
                    </div>
                    <div style="float:right">
                        {!! $records->links() !!}
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
                "searching":   false,
                "language": {
                    "sEmptyTable":   "Tidak ada data",
                }
            });
        });
    </script>
@endsection
