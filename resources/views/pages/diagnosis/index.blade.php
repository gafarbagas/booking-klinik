@extends('layouts.dashboard')

@section('title', 'Diagnosis')

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
                        <form action="{{route('diagnosis')}}" method="GET">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control" placeholder="Cari data">
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
                                        <th>Nama Pasien</th>
                                        <th>NIK</th>
                                        <th>Layanan</th>
                                        <th width=30px>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($datas as $key => $data)
                                        <tr>
                                            <td>{{ $datas->firstItem() + $key }}.</td>
                                            <td>{{ $data->no_janji}}</td>
                                            <td>{{ Carbon\Carbon::parse($data->tanggal_periksa)->translatedFormat(' d F Y')}}</td>
                                            <td>{{ $data->pasien->user->name}}</td>
                                            <td>{{ $data->pasien->nik}}</td>
                                            <td>{{ $data->serviceType->service_type_name}}</td>
                                            <td><a href="/diagnosis/{{Crypt::encrypt($data->id_appointment)}}/buat" class="btn btn-sm btn-primary shadow-sm mb-1"><i class="fa fa-plus"></i> Buat Diagnosis</a></td>
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
@endsection
