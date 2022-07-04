@extends('layouts.dashboard')

@section('title', 'Janji')

@section('content')
    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Janji</h1>
                    <p>Halaman ini merupakan Janji yang telah anda buat</p>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div>
                <div class="text-right">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-terkini-tab" data-toggle="pill" href="#pills-terkini" role="tab" aria-controls="pills-terkini" aria-selected="true">Terkini</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-lampau-tab" data-toggle="pill" href="#pills-lampau" role="tab" aria-controls="pills-lampau" aria-selected="false">Lampau</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-terkini" role="tabpanel" aria-labelledby="pills-terkini-tab">
                        <div class="row">
                            @foreach ($appointments as $appointment)
                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-sm">
                                                No. Janji:<strong> {{$appointment->no_janji}}</strong>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 mb-2">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <span class="fa-stack">
                                                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                                            <i class="far fa-calendar fa-stack-1x text-white"></i>
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-9">
                                                        <strong class="d-block"> {{ Carbon\Carbon::parse($appointment->tanggal_periksa)->translatedFormat('d F Y') }} </strong>
                                                        <small class="d-none d-sm-block">Tanggal</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 mb-2">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <span class="fa-stack">
                                                            <i class="fas fa-circle fa-stack-2x text-success"></i>
                                                            <i class="fas fa-briefcase-medical fa-stack-1x text-white"></i>
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-9">
                                                        <strong class="d-block"> {{$appointment->serviceType->service_type_name}} </strong>
                                                        <small class="d-none d-sm-block">Layanan</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 mb-2">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <span class="fa-stack">
                                                            <i class="fa fa-circle fa-stack-2x text-secondary"></i>
                                                            <i class="far fa-clock fa-stack-1x text-white"></i>
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-9">
                                                        <strong class="d-block"> {{ Carbon\Carbon::parse($appointment->waktu)->format('H:i') }} </strong>
                                                        <small class="d-none d-sm-block">Waktu</small>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($appointment->status == 'menunggu')
                                                <div class="col-sm-6 mb-2">
                                                    <div class="row">
                                                        <div class="col-xs-3">
                                                            <span class="fa-stack">
                                                                <i class="fa fa-circle fa-stack-2x text-secondary"></i>
                                                                <i class="fa fa-spinner fa-stack-1x text-white"></i>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-9">
                                                            <strong class="d-block text-capitalize"> {{ $appointment->status }} </strong>
                                                            <small class="d-none d-sm-block">Status</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($appointment->status == 'diterima')
                                                <div class="col-sm-6 mb-2">
                                                    <div class="row">
                                                        <div class="col-xs-3">
                                                            <span class="fa-stack">
                                                                <i class="fa fa-circle fa-stack-2x text-success"></i>
                                                                <i class="fa fa-check fa-stack-1x text-white"></i>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-9">
                                                            <strong class="d-block text-capitalize"> {{ $appointment->status }} </strong>
                                                            <small class="d-none d-sm-block">Status</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($appointment->status == 'selesai')
                                                <div class="col-sm-6 mb-2">
                                                    <div class="row">
                                                        <div class="col-xs-3">
                                                            <span class="fa-stack">
                                                                <i class="fa fa-circle fa-stack-2x text-success"></i>
                                                                <i class="fa fa-check fa-stack-1x text-white"></i>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-9">
                                                            <strong class="d-block text-capitalize"> {{ $appointment->status }} </strong>
                                                            <small class="d-none d-sm-block">Status</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($appointment->status == 'ditolak')
                                                <div class="col-sm-6 mb-2">
                                                    <div class="row">
                                                        <div class="col-xs-3">
                                                            <span class="fa-stack">
                                                                <i class="fa fa-circle fa-stack-2x text-danger"></i>
                                                                <i class="fa fa-times fa-stack-1x text-white"></i>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-9">
                                                            <strong class="d-block text-capitalize"> {{ $appointment->status }} </strong>
                                                            <small class="d-none d-sm-block">Status</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#detail{{$appointment->id}}"><i class="fa fa-eye"></i> Lihat Detail</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="detail{{$appointment->id}}" tabindex="-1" role="dialog">
                                <div class="modal-dialog modal-centered modal-md" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Detail Janji</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row mb-2">
                                                <label class="col-sm-4">Status</label>
                                                @if ($appointment->status == 'menunggu')
                                                    <div class="col-sm" ><span class="text-capitalize badge badge-secondary">{{ $appointment->status }}</span></div>
                                                @elseif ($appointment->status == 'diterima')
                                                    <div class="col-sm" ><span class="text-capitalize badge badge-success">{{ $appointment->status }}</span></div>
                                                @elseif ($appointment->status == 'selesai')
                                                    <div class="col-sm" ><span class="text-capitalize badge badge-success">{{ $appointment->status }}</span></div>
                                                @elseif ($appointment->status == 'ditolak')
                                                    <div class="col-sm" ><span class="text-capitalize badge badge-danger">{{ $appointment->status }}</span></div>
                                                @endif
                                            </div>
                                            <div class="row mb-2">
                                                <label class="col-sm-4">Nama</label>
                                                <div class="col-sm">{{ $appointment->pasien->user->name }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <label class="col-sm-4">Tanggal Lahir</label>
                                                <div class="col-sm">{{ Carbon\Carbon::parse($appointment->pasien->tanggal_lahir)->translatedFormat('d F Y') }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <label class="col-sm-4">NIK</label>
                                                <div class="col-sm">{{ $appointment->pasien->nik }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <label class="col-sm-4">Alamat</label>
                                                <div class="col-sm">{{ $appointment->pasien->alamat }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <label class="col-sm-4">Layanan</label>
                                                <div class="col-sm">{{ $appointment->serviceType->service_type_name }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <label class="col-sm-4">Dokter</label>
                                                <div class="col-sm">{{ $appointment->dokter->user->name }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <label class="col-sm-4">Tanggal</label>
                                                <div class="col-sm">{{ Carbon\Carbon::parse($appointment->tanggal_periksa)->translatedFormat('d F Y') }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <label class="col-sm-4">Waktu Janji</label>
                                                <div class="col-sm">{{ Carbon\Carbon::parse($appointment->waktu)->format('H:i') }}</div>
                                            </div>
                                            <div class="row ">
                                                <label class="col-sm-4">Keluhan</label>
                                                <div class="col-sm">{{ $appointment->keluhan }}</div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pills-lampau" role="tabpanel" aria-labelledby="pills-lampau-tab">
                        <div class="row">
                            @foreach ($pastAppointments as $pastAppointment)
                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-sm">
                                                No. Janji:<strong> {{$pastAppointment->no_janji}}</strong>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6 mb-2">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <span class="fa-stack">
                                                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                                            <i class="far fa-calendar fa-stack-1x text-white"></i>
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-9">
                                                        <strong class="d-block"> {{ Carbon\Carbon::parse($pastAppointment->tanggal_periksa)->translatedFormat('d F Y') }} </strong>
                                                        <small class="d-none d-sm-block">Tanggal</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 mb-2">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <span class="fa-stack">
                                                            <i class="fas fa-circle fa-stack-2x text-success"></i>
                                                            <i class="fas fa-briefcase-medical fa-stack-1x text-white"></i>
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-9">
                                                        <strong class="d-block"> {{$pastAppointment->serviceType->service_type_name}} </strong>
                                                        <small class="d-none d-sm-block">Layanan</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 mb-2">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <span class="fa-stack">
                                                            <i class="fa fa-circle fa-stack-2x text-secondary"></i>
                                                            <i class="far fa-clock fa-stack-1x text-white"></i>
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-9">
                                                        <strong class="d-block"> {{ Carbon\Carbon::parse($pastAppointment->waktu)->format('H:i') }} </strong>
                                                        <small class="d-none d-sm-block">Waktu</small>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($pastAppointment->status == 'menunggu')
                                                <div class="col-sm-6 mb-2">
                                                    <div class="row">
                                                        <div class="col-xs-3">
                                                            <span class="fa-stack">
                                                                <i class="fa fa-circle fa-stack-2x text-secondary"></i>
                                                                <i class="fa fa-spinner fa-stack-1x text-white"></i>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-9">
                                                            <strong class="d-block text-capitalize"> {{ $pastAppointment->status }} </strong>
                                                            <small class="d-none d-sm-block">Status</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($pastAppointment->status == 'diterima')
                                                <div class="col-sm-6 mb-2">
                                                    <div class="row">
                                                        <div class="col-xs-3">
                                                            <span class="fa-stack">
                                                                <i class="fa fa-circle fa-stack-2x text-success"></i>
                                                                <i class="fa fa-check fa-stack-1x text-white"></i>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-9">
                                                            <strong class="d-block text-capitalize"> {{ $pastAppointment->status }} </strong>
                                                            <small class="d-none d-sm-block">Status</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($pastAppointment->status == 'selesai')
                                                <div class="col-sm-6 mb-2">
                                                    <div class="row">
                                                        <div class="col-xs-3">
                                                            <span class="fa-stack">
                                                                <i class="fa fa-circle fa-stack-2x text-success"></i>
                                                                <i class="fa fa-check fa-stack-1x text-white"></i>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-9">
                                                            <strong class="d-block text-capitalize"> {{ $pastAppointment->status }} </strong>
                                                            <small class="d-none d-sm-block">Status</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($pastAppointment->status == 'ditolak')
                                                <div class="col-sm-6 mb-2">
                                                    <div class="row">
                                                        <div class="col-xs-3">
                                                            <span class="fa-stack">
                                                                <i class="fa fa-circle fa-stack-2x text-danger"></i>
                                                                <i class="fa fa-times fa-stack-1x text-white"></i>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-9">
                                                            <strong class="d-block text-capitalize"> {{ $pastAppointment->status }} </strong>
                                                            <small class="d-none d-sm-block">Status</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#detail{{$pastAppointment->id}}"><i class="fa fa-eye"></i> Lihat Detail</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="detail{{$pastAppointment->id}}" tabindex="-1" role="dialog">
                                <div class="modal-dialog modal-centered modal-md" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Detail Janji</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row mb-2">
                                                <label class="col-sm-4">Status</label>
                                                @if ($pastAppointment->status == 'menunggu')
                                                    <div class="col-sm" ><span class="text-capitalize badge badge-secondary">{{ $pastAppointment->status }}</span></div>
                                                @elseif ($pastAppointment->status == 'diterima')
                                                    <div class="col-sm" ><span class="text-capitalize badge badge-success">{{ $pastAppointment->status }}</span></div>
                                                @elseif ($pastAppointment->status == 'selesai')
                                                    <div class="col-sm" ><span class="text-capitalize badge badge-success">{{ $pastAppointment->status }}</span></div>
                                                @elseif ($pastAppointment->status == 'ditolak')
                                                    <div class="col-sm" ><span class="text-capitalize badge badge-danger">{{ $pastAppointment->status }}</span></div>
                                                @endif
                                            </div>
                                            <div class="row mb-2">
                                                <label class="col-sm-4">Nama</label>
                                                <div class="col-sm">{{ $pastAppointment->pasien->user->name }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <label class="col-sm-4">Tanggal Lahir</label>
                                                <div class="col-sm">{{ Carbon\Carbon::parse($pastAppointment->pasien->tanggal_lahir)->translatedFormat('d F Y') }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <label class="col-sm-4">NIK</label>
                                                <div class="col-sm">{{ $pastAppointment->pasien->nik }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <label class="col-sm-4">Alamat</label>
                                                <div class="col-sm">{{ $pastAppointment->pasien->alamat }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <label class="col-sm-4">Layanan</label>
                                                <div class="col-sm">{{ $pastAppointment->serviceType->service_type_name }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <label class="col-sm-4">Dokter</label>
                                                <div class="col-sm">{{ $pastAppointment->dokter->user->name }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <label class="col-sm-4">Tanggal</label>
                                                <div class="col-sm">{{ Carbon\Carbon::parse($pastAppointment->tanggal_periksa)->translatedFormat('d F Y') }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <label class="col-sm-4">Waktu Janji</label>
                                                <div class="col-sm">{{ Carbon\Carbon::parse($pastAppointment->waktu)->format('H:i') }}</div>
                                            </div>
                                            <div class="row ">
                                                <label class="col-sm-4">Keluhan</label>
                                                <div class="col-sm">{{ $pastAppointment->keluhan }}</div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="specialist"]').on('change', function() {
                var specialist = $(this).val();
                console.log(specialist);
                if(specialist) {
                    $.ajax({
                        url: '/promise/ajax/'+specialist,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            if(data.success === false){
                                $('select[name="namaDokter"]').empty();
                                $('select[name="namaDokter"]').append('<option value="-">-</option>');
                            }else{
                                $('select[name="namaDokter"]').empty();
                                $.each(data, function(key, value) {
                                    $('select[name="namaDokter"]').append('<option value="'+ value +'">'+ value +'</option>');
                                });
                            }
                        }
                    });
                }else{
                    $('select[name="namaDokter"]').empty();
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
