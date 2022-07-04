<?php

namespace App\Http\Controllers;

use App\Models\ReferralLetter;
use App\Models\Doctor;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class ReferralLetterController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        if(Auth::user()->level == 'admin'){
            $datas = ReferralLetter::join('patients', 'referral_letters.id_patient', 'patients.id')
                ->join('users','patients.id_user', 'users.id')
                ->select('*','referral_letters.id as id_referral_letters')
                ->where(function($query) use ($search)
                {
                    $query->orwhere('users.name', 'LIKE', '%'.$search. '%');
                    $query->orwhere('patients.nik', 'LIKE', '%'.$search. '%');
                })
                ->orderBy('id_referral_letters','Desc')
                ->paginate(15);
            $datas->withPath('surat/rujukan');
            $datas->appends($request->all());
        }elseif(Auth::user()->level == 'doctor'){
            $userId = Auth::user()->id;
            $doctor = Doctor::where('id_user', $userId)->first();
            $doctorId = $doctor->id;
            $datas = ReferralLetter::join('patients', 'referral_letters.id_patient', 'patients.id')
                ->join('users','patients.id_user', 'users.id')
                ->select('*','referral_letters.id as id_referral_letters')
                ->where(function($query) use ($search)
                {
                    $query->orwhere('users.name', 'LIKE', '%'.$search. '%');
                    $query->orwhere('patients.nik', 'LIKE', '%'.$search. '%');
                })
                ->where('id_doctor',$doctorId)
                ->orderBy('id_referral_letters','Desc')
                ->paginate(15);
            $datas->withPath('surat/rujukan');
            $datas->appends($request->all());
        }
        return view('pages.referral-letter.index', compact('datas'));
    }

    public function create()
    {
        $doctors = Doctor::all();
        return view('pages..referral-letter.create', compact('doctors'));
    }

    public function store(Request $request)
    {
        $rules = [
            'id_pasien' => 'required',
            'id_doctor' => 'required',
            'tujuan_dokter' => 'required',
            'tujuan_lokasi' => 'required',
            'keluhan' => 'required',
            'diagnosis_sementara' => 'required',
            'tindakan' => 'required',
        ];

        $customMessage = [
            'required' => 'Silahkan masukan :attribute',
        ];

        $attributeName = [
            'id_doctor' => 'dokter',
            'tujuan_dokter' => 'dikirim kepada',
            'tujuan_lokasi' => 'dikirim ke',
            'keluhan' => 'keluhan',
            'diagnosis_sementara' => 'diagnosa sementara',
            'tindakan' => 'tindakan',
        ];

        $this->validate($request, $rules, $customMessage, $attributeName);

        $surat = ReferralLetter::create([
            'id_patient' => $request->id_pasien,
            'id_doctor' => $request->id_doctor,
            'tujuan_dokter' => $request->tujuan_dokter,
            'tujuan_lokasi' => $request->tujuan_lokasi,
            'keluhan' => $request->keluhan,
            'diagnosis_sementara' => $request->diagnosis_sementara,
            'tindakan' => $request->tindakan,
            'catatan' => $request->catatan,
        ]);
        $id = Crypt::encrypt($surat->id);
        Alert::success('','Surat keterangan istirahat berhasil dibuat');
        return redirect()->route('detail.rujukan',$id);
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $data = ReferralLetter::find($id);
        $doctors = Doctor::all();
        return view('pages.referral-letter.edit', compact('data','doctors'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'id_pasien' => 'required',
            'id_doctor' => 'required',
            'tujuan_dokter' => 'required',
            'tujuan_lokasi' => 'required',
            'keluhan' => 'required',
            'diagnosis_sementara' => 'required',
            'tindakan' => 'required',
            'catatan' => 'required',
        ];

        $customMessage = [
            'required' => 'Silahkan masukan :attribute',
        ];

        $attributeName = [
            'id_doctor' => 'dokter',
            'tujuan_dokter' => 'dikirim kepada',
            'tujuan_lokasi' => 'dikirim ke',
            'keluhan' => 'keluhan',
            'diagnosis_sementara' => 'diagnosa sementara',
            'tindakan' => 'tindakan',
            'catatan' => 'catatan',
        ];
        $this->validate($request, $rules, $customMessage, $attributeName);

        $surat = ReferralLetter::find($id);

        $surat->update([
            'id_patient' => $request->id_pasien,
            'id_doctor' => $request->id_doctor,
            'tujuan_dokter' => $request->tujuan_dokter,
            'tujuan_lokasi' => $request->tujuan_lokasi,
            'keluhan' => $request->keluhan,
            'diagnosis_sementara' => $request->diagnosis_sementara,
            'tindakan' => $request->tindakan,
            'catatan' => $request->catatan,
        ]);
        Alert::success('','Surat keterangan istirahat berhasil diubah');
        $id = Crypt::encrypt($surat->id);
        return redirect()->route('detail.rujukan',$id);
    }

    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $data = ReferralLetter::find($id);
        $umur = Carbon::parse($data->pasien->tanggal_lahir)->diff(Carbon::now())->y;
        return view('pages.referral-letter.detail', compact('data','umur'));
    }

    public function print($id)
    {
        $id = Crypt::decrypt($id);
        $data = ReferralLetter::find($id);
        $umur = Carbon::parse($data->pasien->tanggal_lahir)->diff(Carbon::now())->y;
        $pdf = PDF::loadView('pages.referral-letter.pdf', compact('data','umur'));
        $pdf->setPaper('A4');
        return $pdf->stream("Rujukan-".$data->id.".pdf");
    }
}
