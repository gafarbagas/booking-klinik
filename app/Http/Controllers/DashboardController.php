<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\ServiceType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $serviceTypes = ServiceType::get();
        $serviceType = $serviceTypes->pluck('id', 'service_type_name');
        $waiting = Appointment::where('tanggal_periksa', '=', Carbon::now()->format('Y-m-d'))->where('status', "menunggu")->count();
        $accepted = Appointment::where('tanggal_periksa', '=', Carbon::now()->format('Y-m-d'))->where('status', "diterima")->count();
        $rejected = Appointment::where('tanggal_periksa', '=', Carbon::now()->format('Y-m-d'))->where('status', "ditolak")->count();
        $dataPatient = User::where('level','patient')->count();
        $dataDoctor = User::where('level', 'doctor')->count();
        $dataLampau = Appointment::where('tanggal_periksa', '<', Carbon::now()->format('Y-m-d'))->count();
        $dataDatang = Appointment::where('tanggal_periksa', '>', Carbon::now()->format('Y-m-d'))->count();
        $dataNow = Appointment::where('tanggal_periksa', '=', Carbon::now()->format('Y-m-d'))->count();
        if (Auth::user()->level === 'doctor') {
            $doctorId = Doctor::where('id_user', Auth::user()->id)->first();
            $appointmentDoctor = Appointment::where('id_doctor', $doctorId->id)
                ->where('tanggal_periksa', '=', Carbon::now()->format('Y-m-d'))
                ->count();
            $totalPatient = Appointment::where('id_doctor', $doctorId->id)->count();
            return view('dashboard', compact('appointmentDoctor',
                'totalPatient'
            ));
        }
        return view('dashboard', compact('serviceType',
            'waiting', 'accepted', 'rejected', 'dataPatient',
            'dataDoctor', 'dataLampau','dataDatang', 'dataNow'
        ));
    }
}
