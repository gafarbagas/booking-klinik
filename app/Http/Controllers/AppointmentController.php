<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\ServiceType;
use App\Models\Statuses;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;

class AppointmentController extends Controller
{
    public function index()
    {
        $doctor = Doctor::all();
        $dateNow = Carbon::now()->format('Y-m-d');
        $appointments = Appointment::where('tanggal_periksa','>=',$dateNow)->where('id_patient',Auth::user()->pasien->first()->id)->orderBy('tanggal_periksa','ASC')->orderBy('waktu','ASC')->get();
        $pastAppointments = Appointment::where('tanggal_periksa','<',$dateNow)->where('id_patient',Auth::user()->pasien->first()->id)->orderBy('tanggal_periksa','DESC')->orderBy('waktu','DESC')->get();
        return view ('pages.appointment.patient.index', compact('appointments','pastAppointments','doctor'));
    }

    public function indexHariIni(Request $request)
    {
        $search = $request->search;
        $dateNow = Carbon::now()->format('Y-m-d');
        $appointments = Appointment::join('patients', 'appointments.id_patient', 'patients.id')
            ->join('users','patients.id_user', 'users.id')
            ->join('service_types', 'appointments.id_service_type','service_types.id')
            ->select('*','appointments.id as id_appointment')
            ->where(function($query) use ($search)
            {
                $query->where('appointments.no_janji','LIKE','%'.$search.'%');
                $query->orwhere('users.name', 'LIKE', '%'.$search. '%');
                $query->orwhere('patients.nik', 'LIKE', '%'.$search. '%');
                $query->orwhere('service_types.service_type_name', 'LIKE', '%'.$search. '%');
                $query->orwhere('appointments.status', 'LIKE', '%'.$search. '%');
            })
            ->where('tanggal_periksa','=',$dateNow)
            ->whereIn('status',['diterima','menunggu','selesai'])
            ->orderBy('waktu','ASC')
            ->paginate(15);
        return view ('pages.appointment.admin.index.hari-ini', compact('appointments'));
    }

    public function indexEsok(Request $request)
    {
        $search = $request->search;
        $dateNow = Carbon::now()->format('Y-m-d');
        $appointments = Appointment::join('patients', 'appointments.id_patient', 'patients.id')
            ->join('users','patients.id_user', 'users.id')
            ->join('service_types', 'appointments.id_service_type','service_types.id')
            ->select('*','appointments.id as id_appointment')
            ->where(function($query) use ($search)
            {
                $query->where('appointments.no_janji','LIKE','%'.$search.'%');
                $query->orwhere('appointments.tanggal_periksa', 'LIKE', '%'.$search.'%');
                $query->orwhere('users.name', 'LIKE', '%'.$search. '%');
                $query->orwhere('patients.nik', 'LIKE', '%'.$search. '%');
                $query->orwhere('service_types.service_type_name', 'LIKE', '%'.$search. '%');
                $query->orwhere('appointments.status', 'LIKE', '%'.$search. '%');
            })
            ->where('tanggal_periksa','>',$dateNow)
            ->whereIn('status',['diterima','menunggu','selesai'])
            ->orderBy('tanggal_periksa','ASC')
            ->orderBy('waktu','ASC')
            ->paginate(15);
        return view ('pages.appointment.admin.index.esok', compact('appointments'));
    }

    public function indexLampau(Request $request)
    {
        $search = $request->search;
        $dateNow = Carbon::now()->format('Y-m-d');
        $appointments = Appointment::join('patients', 'appointments.id_patient', 'patients.id')
            ->join('users','patients.id_user', 'users.id')
            ->join('service_types', 'appointments.id_service_type','service_types.id')
            ->select('*','appointments.id as id_appointment')
            ->where(function($query) use ($search)
            {
                $query->where('appointments.no_janji','LIKE','%'.$search.'%');
                $query->orwhere('appointments.tanggal_periksa', 'LIKE', '%'.$search.'%');
                $query->orwhere('users.name', 'LIKE', '%'.$search. '%');
                $query->orwhere('patients.nik', 'LIKE', '%'.$search. '%');
                $query->orwhere('service_types.service_type_name', 'LIKE', '%'.$search. '%');
                $query->orwhere('appointments.status', 'LIKE', '%'.$search. '%');
            })
            ->where('tanggal_periksa','<',$dateNow)
            ->whereIn('status',['diterima','menunggu','selesai'])
            ->orderBy('tanggal_periksa','DESC')
            ->orderBy('waktu','DESC')
            ->paginate(15);
        return view ('pages.appointment.admin.index.lampau', compact('appointments'));
    }

    public function ubahStatus(Request $request, $id)
    {
        $appointment = Appointment::find($id);
        $appointment->status = $request->status;
        $appointment->save();
        Alert::success('', 'Status berhasil diubah');
        return back();
    }

    public function create($id)
    {
        $id = Crypt::decrypt($id);
        $serviceTypes = ServiceType::where('id', $id)->first();
        $doctors = DB::table('services')
            ->join('service_types', 'services.id_service_type', '=', 'service_types.id')
            ->join('doctors', 'services.id_doctor', '=', 'doctors.id')
            ->join('users', 'doctors.id_user', '=', 'users.id')
            ->where('id_service_type', $serviceTypes->id)
            ->get();
        return view('pages.appointment.patient.create', compact('serviceTypes', 'doctors'));
    }

    public function createByAdmin()
    {
        $serviceTypes = ServiceType::all();
        return view('pages.appointment.admin.create', compact('serviceTypes'));
    }

    public function storePatient(Request $request)
    {
        $rules = [
            'namaLayanan' => 'required',
            'namaDokter' => 'required',
            'tanggalKunjungan' => 'required',
            'waktu' => 'required',
            'keluhan' => 'required',
        ];

        $customMessage = [
            'required' => 'Silahkan masukan :attribute',
            'unique' => ':attribute telah digunakan'
        ];

        $attributeName = [
            'namaDokter' => 'Nama Dokter',
            'keluhan' => 'Keluhan',
            'waktu' => 'Waktu',
            'tanggalKunjungan' => 'Tanggal Kunjungan',
        ];

        $this->validate($request, $rules, $customMessage, $attributeName);

        $timeNow = Carbon::now()->format('H:i');
        $dateNow = Carbon::now()->format('Y-m-d');
        $hari = Carbon::parse($request->tanggalKunjungan)->translatedFormat('l');

        if($hari == 'Minggu'){
            Alert::error('','Hari minggu tutup');
            return back()->withInput($request->input());
        }else{
            if($request['namaLayanan'] == 'Dermatology'){
                if ($request->waktu >= '09:00' && $request->waktu <= '13:00'){
                    if($request->tanggalKunjungan == $dateNow){
                        if($request->waktu > $timeNow){
                            $waktu = $request->waktu;
                        }else{
                            Alert::error('Jam sudah terlalui','Sekarang pukul '.$timeNow);
                            return back()->withInput($request->input());
                        }
                    }else{
                        $waktu = $request->waktu;
                    }
                }elseif ($request->waktu >= '19:00' && $request->waktu <= '21:00'){
                    if($request->tanggalKunjungan == $dateNow){
                        if($request->waktu > $timeNow){
                            $waktu = $request->waktu;
                        }else{
                            Alert::error('Jam sudah terlalui','Sekarang pukul '.$timeNow);
                            return back()->withInput($request->input());
                        }
                    }else{
                        $waktu = $request->waktu;
                    }
                }else{
                    Alert::error('Jam tidak sesuai','Perhatikan jam layanan Dermatology');
                    return back()->withInput($request->input());
                }
            }elseif($request['namaLayanan'] == 'Cosmetic Medic'){
                if ($request->waktu >= '08:00' && $request->waktu <= '21:00'){
                    if($request->tanggalKunjungan == $dateNow){
                        if($request->waktu > $timeNow){
                            $waktu = $request->waktu;
                        }else{
                            Alert::error('Jam sudah terlalui','Sekarang pukul '.$timeNow);
                            return back()->withInput($request->input());
                        }
                    }else{
                        $waktu = $request->waktu;
                    }
                }else{
                    Alert::error('Jam tidak sesuai','Perhatikan jam layanan Cosmetic Medic');
                    return back()->withInput($request->input());
                }
            }elseif($request['namaLayanan'] == 'Obgyn' || $request['namaLayanan'] == 'Fertility'){
                if ($request->waktu >= '19:00' && $request->waktu <= '21:00'){
                    if($request->tanggalKunjungan == $dateNow){
                        if($request->waktu > $timeNow){
                            $waktu = $request->waktu;
                        }else{
                            Alert::error('Jam sudah terlalui','Sekarang pukul '.$timeNow);
                            return back()->withInput($request->input());
                        }
                    }else{
                        $waktu = $request->waktu;
                    }
                }else{
                    Alert::error('Jam tidak sesuai','Perhatikan jam layanan Obgyn dan Fertility');
                    return back()->withInput($request->input());
                }
            }
        }

        $user = User::where('id', $request->namaDokter)->first();
        $doctorId = Doctor::where('id_user', $user->id)->first()->id;
        $now = Carbon::now()->format('dmY');
        $serviceType = ServiceType::where('service_type_name', $request['namaLayanan'])->first();
        $serviceTypeId = $serviceType->id;
        $pasienId = auth()->user()->pasien->first()->id;
        $appointments = Appointment::get();
        $noJanji = 1;
        foreach ($appointments as $appointment)
        {
            $noJanji++;
        }

        $noAppointment = "NJ-".$serviceTypeId.$now.$pasienId.$noJanji;

        Appointment::create([
            'id_doctor' => $doctorId,
            'id_patient' => $pasienId,
            'id_service_type' => $serviceTypeId,
            'status' => 'menunggu',
            'no_janji' => $noAppointment,
            'tanggal_periksa' => $request->tanggalKunjungan,
            'waktu' => $waktu,
            'keluhan' => $request->keluhan,
        ]);

        Alert::success('', 'Janji berhasil dibuat');
        return redirect('/janji');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $rules = [
            'namaLayanan' => 'required',
            'namaDokter' => 'required',
            'tanggalKunjungan' => 'required',
            'keluhan' => 'required',
            'cari_pasien' => 'required',
            'waktu' => 'required'
        ];

        $customMessage = [
            'required' => 'Silahkan masukan :attribute',
            'unique' => ':attribute telah digunakan'
        ];

        $attributeName = [
            'namaDokter' => 'Nama Dokter',
            'keluhan' => 'Keluhan',
            'tanggalKunjungan' => 'Tanggal Kunjungan',
            'namaLayanan' => 'Nama Layanan',
            'cari_pasien' => 'Cari Pasien',
            'waktu' => 'Waktu'
        ];


        $this->validate($request, $rules, $customMessage, $attributeName);

        $timeNow = Carbon::now()->format('H:i');
        $dateNow = Carbon::now()->format('Y-m-d');
        $hari = Carbon::parse($request->tanggalKunjungan)->translatedFormat('l');

        if($hari == 'Minggu'){
            Alert::error('','Hari minggu tutup');
            return back()->withInput($request->input());
        }else{
            if($request['namaLayanan'] == 'Dermatology'){
                if ($request->waktu >= '09:00' && $request->waktu <= '13:00'){
                    if($request->tanggalKunjungan == $dateNow){
                        if($request->waktu > $timeNow){
                            $waktu = $request->waktu;
                        }else{
                            Alert::error('Jam sudah terlalui','Sekarang pukul '.$timeNow);
                            return back()->withInput($request->input());
                        }
                    }else{
                        $waktu = $request->waktu;
                    }
                }elseif ($request->waktu >= '19:00' && $request->waktu <= '21:00'){
                    if($request->tanggalKunjungan == $dateNow){
                        if($request->waktu > $timeNow){
                            $waktu = $request->waktu;
                        }else{
                            Alert::error('Jam sudah terlalui','Sekarang pukul '.$timeNow);
                            return back()->withInput($request->input());
                        }
                    }else{
                        $waktu = $request->waktu;
                    }
                }else{
                    Alert::error('Jam tidak sesuai','Perhatikan jam layanan Dermatology');
                    return back()->withInput($request->input());
                }
            }elseif($request['namaLayanan'] == 'Cosmetic Medic'){
                if ($request->waktu >= '08:00' && $request->waktu <= '21:00'){
                    if($request->tanggalKunjungan == $dateNow){
                        if($request->waktu > $timeNow){
                            $waktu = $request->waktu;
                        }else{
                            Alert::error('Jam sudah terlalui','Sekarang pukul '.$timeNow);
                            return back()->withInput($request->input());
                        }
                    }else{
                        $waktu = $request->waktu;
                    }
                }else{
                    Alert::error('Jam tidak sesuai','Perhatikan jam layanan Cosmetic Medic');
                    return back()->withInput($request->input());
                }
            }elseif($request['namaLayanan'] == 'Obgyn' || $request['namaLayanan'] == 'Fertility'){
                if ($request->waktu >= '19:00' && $request->waktu <= '21:00'){
                    if($request->tanggalKunjungan == $dateNow){
                        if($request->waktu > $timeNow){
                            $waktu = $request->waktu;
                        }else{
                            Alert::error('Jam sudah terlalui','Sekarang pukul '.$timeNow);
                            return back()->withInput($request->input());
                        }
                    }else{
                        $waktu = $request->waktu;
                    }
                }else{
                    Alert::error('Jam tidak sesuai','Perhatikan jam layanan Obgyn dan Fertility');
                    return back()->withInput($request->input());
                }
            }
        }

        $user = User::where('name', $request->namaDokter)->first();
        $doctorId = Doctor::where('id_user', $user->id)->first()->id;
        $now = Carbon::now()->format('dmY');
        $dateNow = Carbon::now()->toDateString();
        $serviceType = ServiceType::where('service_type_name', $request['namaLayanan'])->first();
        $serviceTypeId = $serviceType->id;
        $pasienId = $request->id_pasien;
        $appointments = Appointment::get();
        $noJanji = 1;
        foreach ($appointments as $appointment)
        {
            $noJanji++;
        }

        $noAppointment = "NJ-".$serviceTypeId.$now.$pasienId.$noJanji;

        Appointment::create([
            'id_doctor' => $doctorId,
            'id_patient' => $pasienId,
            'id_service_type' => $serviceTypeId,
            'status' => 'menunggu',
            'no_janji' => $noAppointment,
            'tanggal_periksa' => $request->tanggalKunjungan,
            'waktu' => $waktu,
            'keluhan' => $request->keluhan,
        ]);

        Alert::success('', 'Janji berhasil dibuat');
        if ($request->tanggalKunjungan == $dateNow) {
            return redirect('/janji/admin/hari-ini');
        }elseif ($request->tanggalKunjungan > $dateNow) {
            return redirect('/janji/admin/yang-akan-datang');
        }elseif ($request->tanggalKunjungan < $dateNow) {
            return redirect('/janji/admin/lampau');
        }
    }
}
