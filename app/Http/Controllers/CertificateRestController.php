<?php

namespace App\Http\Controllers;

use App\Models\CertificateRest;
use App\Models\Doctor;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class CertificateRestController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        if(Auth::user()->level == 'admin'){
            $datas = CertificateRest::join('patients', 'certificate_rests.id_patient', 'patients.id')
                ->join('users','patients.id_user', 'users.id')
                ->select('*','certificate_rests.id as id_certificate_rests')
                ->where(function($query) use ($search)
                {
                    $query->where('certificate_rests.no_surat','LIKE','%'.$search.'%');
                    $query->orwhere('users.name', 'LIKE', '%'.$search. '%');
                    $query->orwhere('patients.nik', 'LIKE', '%'.$search. '%');
                })
                ->orderBy('id_certificate_rests','Desc')
                ->paginate(15);
            $datas->withPath('surat/keterangan-istirahat');
            $datas->appends($request->all());
        }elseif(Auth::user()->level == 'doctor'){
            $doctorId = Auth::user()->dokter->first()->id;
            $datas = CertificateRest::join('patients', 'certificate_rests.id_patient', 'patients.id')
                ->join('users','patients.id_user', 'users.id')
                ->select('*','certificate_rests.id as id_certificate_rests')
                ->where(function($query) use ($search)
                {
                    $query->where('certificate_rests.no_surat','LIKE','%'.$search.'%');
                    $query->orwhere('users.name', 'LIKE', '%'.$search. '%');
                    $query->orwhere('patients.nik', 'LIKE', '%'.$search. '%');
                })
                ->where('id_doctor',$doctorId)
                ->orderBy('id_certificate_rests','Desc')
                ->paginate(15);
            $datas->withPath('surat/keterangan-istirahat');
            $datas->appends($request->all());
        }
        return view('pages.certificate-rest.index', compact('datas'));
    }

    public function create()
    {
        $doctors = Doctor::all();
        return view('pages.certificate-rest.create', compact('doctors'));
    }

    public function store(Request $request)
    {
        $rules = [
            'no_surat' => 'required',
            'id_pasien' => 'required',
            'id_doctor' => 'required',
            'keterangan' => 'required|max:255',
            'alasan' => 'required|max:255',
            'tanggal_mulai_izin' => 'required|date',
            'tanggal_selesai_izin' => 'required|date',
            'tanggal_surat' => 'required|date',
        ];

        $customMessage = [
            'required' => 'Silahkan masukan :attribute',
        ];

        $attributeName = [
            'no_surat' => 'No. Surat',
            'id_doctor' => 'Dokter',
            'keterangan' => 'Keterangan',
            'alasan' => 'Alasan',
            'tanggal_mulai_izin' => 'Tanggal Mulai Izin',
            'tanggal_selesai_izin' => 'Tanggal Selesai Izin',
            'tanggal_surat' => 'Tanggal Surat',
        ];

        $this->validate($request, $rules, $customMessage, $attributeName);

        $surat = CertificateRest::create([
            'id_patient' => $request->id_pasien,
            'id_doctor' => $request->id_doctor,
            'no_surat' => $request->no_surat,
            'keterangan' => $request->keterangan,
            'alasan' => $request->alasan,
            'tanggal_mulai_izin' => $request->tanggal_mulai_izin,
            'tanggal_selesai_izin' => $request->tanggal_selesai_izin,
            'tanggal_surat' => $request->tanggal_surat,
        ]);
        $id = Crypt::encrypt($surat->id);
        Alert::success('','Surat keterangan istirahat berhasil dibuat');
        return redirect()->route('detail.keterangan-istirahat',$id);
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $data = CertificateRest::find($id);
        $doctors = Doctor::all();
        return view('pages.certificate-rest.edit', compact('data','doctors'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'no_surat' => 'required',
            'id_pasien' => 'required',
            'id_doctor' => 'required',
            'keterangan' => 'required|max:255',
            'alasan' => 'required|max:255',
            'tanggal_mulai_izin' => 'required|date',
            'tanggal_selesai_izin' => 'required|date',
            'tanggal_surat' => 'required|date',
        ];

        $customMessage = [
            'required' => 'Silahkan masukan :attribute',
        ];

        $attributeName = [
            'no_surat' => 'No. Surat',
            'id_doctor' => 'Dokter',
            'keterangan' => 'Keterangan',
            'alasan' => 'Alasan',
            'tanggal_mulai_izin' => 'Tanggal Mulai Izin',
            'tanggal_selesai_izin' => 'Tanggal Selesai Izin',
            'tanggal_surat' => 'Tanggal Surat',
        ];

        $this->validate($request, $rules, $customMessage, $attributeName);

        $surat = CertificateRest::find($id);

        $surat->update([
            'id_patient' => $request->id_pasien,
            'id_doctor' => $request->id_doctor,
            'no_surat' => $request->no_surat,
            'keterangan' => $request->keterangan,
            'alasan' => $request->alasan,
            'tanggal_mulai_izin' => $request->tanggal_mulai_izin,
            'tanggal_selesai_izin' => $request->tanggal_selesai_izin,
            'tanggal_surat' => $request->tanggal_surat,
        ]);
        Alert::success('','Surat keterangan istirahat berhasil diubah');
        $id = Crypt::encrypt($surat->id);
        return redirect()->route('detail.keterangan-istirahat',$id);
    }

    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $data = CertificateRest::find($id);
        $umur = Carbon::parse($data->pasien->tanggal_lahir)->diff(Carbon::now())->y;
        $tanggalMulai = Carbon::parse($data->tanggal_mulai_izin)->translatedFormat('d F Y');
        $tanggalSelesai = Carbon::parse($data->tanggal_selesai_izin)->translatedFormat('d F Y');
        $tanggalSurat = Carbon::parse($data->tanggal_surat)->translatedFormat('d F Y');
        $mulai = Carbon::createFromDate($data->tanggal_mulai_izin);
        $selesai = Carbon::createFromDate($data->tanggal_selesai_izin);
        $hari = $mulai->diffInDays($selesai) + 1;
        return view('pages.certificate-rest.detail', compact('data','umur','tanggalMulai','tanggalSelesai','hari','tanggalSurat'));
    }

    public function print($id)
    {
        $id = Crypt::decrypt($id);
        $data = CertificateRest::find($id);
        $umur = Carbon::parse($data->pasien->tanggal_lahir)->diff(Carbon::now())->y;
        $tanggalMulai = Carbon::parse($data->tanggal_mulai_izin)->translatedFormat('d F Y');
        $tanggalSelesai = Carbon::parse($data->tanggal_selesai_izin)->translatedFormat('d F Y');
        $tanggalSurat = Carbon::parse($data->tanggal_surat)->translatedFormat('d F Y');
        $mulai = Carbon::createFromDate($data->tanggal_mulai_izin);
        $selesai = Carbon::createFromDate($data->tanggal_selesai_izin);
        $hari = $mulai->diffInDays($selesai) + 1;
        $pdf = PDF::loadView('pages.certificate-rest.pdf', compact('data','umur','tanggalMulai','tanggalSelesai','hari','tanggalSurat'));
        $pdf->setPaper('A4');
        return $pdf->stream($data->no_surat.".pdf");
    }
}
