<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Diagnosis;
use App\Models\ImageAfter;
use App\Models\ImageBefore;
use App\Models\ImageLab;
use App\Models\ImageRadiology;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class MedicalRecordController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        if(Auth::user()->level == 'doctor'){
            $userID = Auth::user()->id;
            $dokter = Doctor::where('id_user', $userID)->first();
            $records = DB::table("diagnoses")
                ->join('patients','patients.id','=','diagnoses.id_patient')
                ->join('users','users.id','=','patients.id_user')
                ->select('users.name','patients.nik','patients.id')
                ->where(function($query) use ($search)
                {
                    $query->orwhere('users.name', 'LIKE', '%'.$search.'%');
                    $query->orwhere('patients.nik', 'LIKE', '%'.$search.'%');
                })
                ->where('id_doctor',$dokter->id)
                ->distinct('users.name')
                ->paginate(15);
            $records->withPath('rekam-medis');
            $records->appends($request->all());
        }
        elseif(Auth::user()->level == 'admin'){
            $records = DB::table("diagnoses")
                ->join('patients','patients.id','=','diagnoses.id_patient')
                ->join('users','users.id','=','patients.id_user')
                ->select('users.name','patients.nik','patients.id')
                ->where(function($query) use ($search)
                {
                    $query->orwhere('users.name', 'LIKE', '%'.$search.'%');
                    $query->orwhere('patients.nik', 'LIKE', '%'.$search.'%');
                })
                ->distinct('users.name')
                ->paginate(15);
            $records->withPath('rekam-medis');
            $records->appends($request->all());
        }

        if ($records == []){
            $records = [];
            return view('pages.medical-record.index', compact('records'));
        }else{
            return view('pages.medical-record.index', compact('records'));
        }
    }

    public function indexPatient(Request $request, $id)
    {
        $idEncrypt = Crypt::decrypt($id);
        $patient = Patient::where('id',$idEncrypt)->first();
        $search = $request->search;
        if(Auth::user()->level == 'doctor'){
            $userID = Auth::user()->id;
            $dokter = Doctor::where('id_user', $userID)->first();
            $records = Diagnosis::join('service_types', 'diagnoses.id_service_type','service_types.id')
                ->select('*','diagnoses.id as id_diagnoses')
                ->where(function($query) use ($search)
                {
                    $query->where('diagnoses.no_rm','LIKE','%'.$search.'%');
                    $query->orwhere('diagnoses.tanggal', 'LIKE', '%'.$search.'%');
                    $query->orwhere('service_types.service_type_name', 'LIKE', '%'.$search. '%');
                })
                ->where('id_patient',$patient->id)
                ->where('id_doctor', $dokter->id)
                ->orderBy('id_diagnoses','ASC')
                ->paginate(15);
            $records->withPath('rekam-medis/'.$id);
            $records->appends($request->all());
        }elseif(Auth::user()->level == 'admin'){
            $records = Diagnosis::join('doctors', 'diagnoses.id_doctor', 'doctors.id')
                ->join('users','doctors.id_user', 'users.id')
                ->join('service_types', 'diagnoses.id_service_type','service_types.id')
                ->select('*','diagnoses.id as id_diagnoses')
                ->where(function($query) use ($search)
                {
                    $query->where('diagnoses.no_rm','LIKE','%'.$search.'%');
                    $query->orwhere('diagnoses.tanggal', 'LIKE', '%'.$search.'%');
                    $query->orwhere('users.name', 'LIKE', '%'.$search. '%');
                    $query->orwhere('service_types.service_type_name', 'LIKE', '%'.$search. '%');
                })
                ->where('id_patient',$patient->id)
                ->orderBy('id_diagnoses','ASC')
                ->paginate(15);
            $records->withPath('rekam-medis/'.$id);
            $records->appends($request->all());
        }
        if ($records == []){
            $records = [];
            return view('pages.medical-record.index-patient', compact('patient','records'));
        }else{
            return view('pages.medical-record.index-patient', compact('patient','records'));
        }
    }

    public function detail($id)
    {
        $id = Crypt::decrypt($id);
        $data = Diagnosis::find($id);
        return view('pages.medical-record.detail', compact('data'));
    }

    public function foto($keterangan, $id)
    {
        $id = Crypt::decrypt($id);
        if($keterangan == 'sebelum'){
            $imageBefore = ImageBefore::find($id);
            $image = $imageBefore->path;
        }elseif($keterangan == 'sesudah'){
            $imageAfter = ImageAfter::find($id);
            $image = $imageAfter->path;
        }elseif($keterangan == 'lab'){
            $imageLab = ImageLab::find($id);
            $image = $imageLab->path;
        }elseif($keterangan == 'radiologi'){
            $imageRadiology = ImageRadiology::find($id);
            $image = $imageRadiology->path;
        }
        return response()->file($image);
    }
}
