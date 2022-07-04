<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Diagnosis;
use App\Models\ImageAfter;
use App\Models\ImageBefore;
use App\Models\ImageLab;
use App\Models\ImageRadiology;
use App\Models\Prescription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class DiagnosisController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        if(Auth::user()->level == 'admin'){
            $datas = Appointment::join('patients', 'appointments.id_patient', 'patients.id')
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
                ->where('status','diterima')
                ->where('status_diagnosis','belum diagnosis')
                ->orderBy('id_appointment','ASC')
                ->paginate(15);
        }elseif(Auth::user()->level == 'doctor'){
            $userID = Auth::user()->id;
            $dokter = Doctor::where('id_user', $userID)->first();
            $datas = Appointment::join('patients', 'appointments.id_patient', 'patients.id')
                ->join('users','patients.id_user', 'users.id')
                ->join('service_types', 'appointments.id_service_type','service_types.id')
                ->select('*','appointments.id as id_appointment')
                ->where(function($query) use ($search)
                {
                    $query->where('appointments.no_janji','LIKE','%'.$search.'%');
                    $query->orwhere('appointments.tanggal_periksa', 'LIKE', '%'.$search.'%');
                    $query->orwhere('users.name', 'LIKE', '%'.$search. '%');
                    $query->orwhere('service_types.service_type_name', 'LIKE', '%'.$search. '%');
                    $query->orwhere('appointments.status', 'LIKE', '%'.$search. '%');
                })
                ->where('status','diterima')
                ->where('status_diagnosis','belum diagnosis')
                ->where('id_doctor',$dokter->id)
                ->orderBy('id_appointment','ASC')
                ->paginate(15);
        }
        $datas->withPath('diagnosis');
        $datas->appends($request->all());
        return view('pages.diagnosis.index',compact('datas'));
    }

    public function create($id)
    {
        $id = Crypt::decrypt($id);
        $data = Appointment::find($id);
        return view('pages.diagnosis.create',compact('data'));
    }

    public function store(Request $request, $id)
    {
        $rules = [
            'hasil_pemeriksaan' => 'required|max:255',
            'diagnosis' => 'required|max:255',
            'tindakan' => 'required|max:255',
            'rencana' => 'required|max:255',
        ];

        $customMessage = [
            'required' => ':attribute wajib diisi',
        ];
        
        $attributeName = [
            'hasil_pemeriksaan' => 'Hasil pemeriksaan',
            'diagnosis' => 'Diagnosis',
            'tindakan' => 'Tindakan',
            'rencana' => 'Rencana',
        ];

        $this->validate($request, $rules, $customMessage, $attributeName);

        if($request->nama_obat != [NULL]){
            $rules = [
                'nama_obat.*' => 'required|max:255',
                'dosis.*' => 'required|max:255',
            ];
    
            $customMessage = [
                'required' => ':attribute wajib diisi',
            ];
            
            $attributeName = [
                'nama_obat.*' => 'Nama Obat',
                'dosis.*' => 'Dosis',
            ];
            $this->validate($request, $rules, $customMessage, $attributeName);
        }

        $appointment = Appointment::find($id);
        $date = Carbon::now()->format('dmY');
        $noRM = "RM-".$appointment->id_service_type.$date.$appointment->id;
        
        $diagnosis = Diagnosis::create([
            'no_rm' => $noRM,
            'id_doctor' => $appointment->id_doctor,
            'id_patient' => $appointment->id_patient,
            'id_service_type' => $appointment->id_service_type,
            'hasil_pemeriksaan' => $request->hasil_pemeriksaan,
            'diagnosis' => $request->diagnosis,
            'tindakan' => $request->tindakan,
            'rencana' => $request->rencana,
            'keluhan' => $appointment->keluhan,
            'tanggal' => $appointment->tanggal_periksa,
        ]);

        if($request->nama_obat != [NULL]){
            foreach ($request->nama_obat as $key => $value) {
                Prescription::create([
                    'id_diagnoses' => $diagnosis->id,
                    'nama_obat' => $request->nama_obat[$key],
                    'dosis' => $request->dosis[$key],
                ]);
            }
        }

        $appointment->status = "selesai";
        $appointment->status_diagnosis = "sudah diagnosis";
        $appointment->save();

        Alert::success('Diagnosis berhasil disimpan','Silahkan lanjutkan unggah foto');
        return redirect()->route('diagnosis.createFoto',Crypt::encrypt($diagnosis->id));
    }

    public function createFoto($id)
    {
        $id = Crypt::decrypt($id);
        $data = Diagnosis::find($id);
        return view('pages.diagnosis.createfoto',compact('data'));
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $data = Diagnosis::find($id);
        return view('pages.diagnosis.edit',compact('data'));
    }

    public function editFoto($id)
    {
        $id = Crypt::decrypt($id);
        $data = Diagnosis::find($id);
        return view('pages.diagnosis.editfoto',compact('data'));
    }

    public function editResep($id)
    {
        $id = Crypt::decrypt($id);
        $data = Diagnosis::find($id);
        return view('pages.diagnosis.editresep',compact('data'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'hasil_pemeriksaan' => 'required|max:255',
            'diagnosis' => 'required|max:255',
            'tindakan' => 'required|max:255',
            'rencana' => 'required|max:255',
        ];

        $customMessage = [
            'required' => ':attribute wajib diisi',
        ];
        
        $attributeName = [
            'hasil_pemeriksaan' => 'Hasil pemeriksaan',
            'diagnosis' => 'Diagnosis',
            'tindakan' => 'Tindakan',
            'rencana' => 'Rencana',
        ];

        $this->validate($request, $rules, $customMessage, $attributeName);

        $diagnosis = Diagnosis::find($id);
        
        try{
            $diagnosis->update([
                'hasil_pemeriksaan' => $request->hasil_pemeriksaan,
                'diagnosis' => $request->diagnosis,
                'tindakan' => $request->tindakan,
                'rencana' => $request->rencana,
            ]);
            $id = Crypt::encrypt($id);
            DB::commit();
            Alert::success('','Rekam medis berhasil diubah');
            return redirect()->route('rekam-medis.detail',$id);
        }catch(Throwable $e){
            DB::rollback();
            Alert::error('',$e->getMessage());
            return redirect()->route('rekam-medis.detail',$id);
        }
    }

    public function uploadFoto(Request $request, $id, $keterangan)
    {
        $diagnosis = Diagnosis::find($id);

        try{
            if($keterangan == 'sebelum'){
                $rules = [
                    'foto_sebelum_periksa' => 'required|image',
                    'keterangan_sebelum' => 'required|max:255',
                ];
        
                $customMessage = [
                    'required' => ':attribute wajib diisi',
                ];
                
                $attributeName = [
                    'foto_sebelum_periksa' => 'Foto',
                    'keterangan_sebelum' => 'Keterangan',
                ];
        
                $this->validate($request, $rules, $customMessage, $attributeName);

                $uploadFolder = 'foto_sebelum_pemeriksaan';
                $image_uploaded_path = $request->foto_sebelum_periksa->store($uploadFolder, 'public');
                $image_link = "storage/".$uploadFolder."/".basename($image_uploaded_path);
                ImageBefore::create([
                    'id_diagnoses' => $diagnosis->id,
                    'path' => $image_link,
                    'keterangan' => $request->keterangan_sebelum,
                ]);
            }elseif($keterangan == 'sesudah'){
                $rules = [
                    'foto_sesudah_periksa' => 'required|image',
                    'keterangan_sesudah' => 'required|max:255',
                ];
        
                $customMessage = [
                    'required' => ':attribute wajib diisi',
                ];
                
                $attributeName = [
                    'foto_sesudah_periksa' => 'Foto',
                    'keterangan_sesudah' => 'Keterangan',
                ];
        
                $this->validate($request, $rules, $customMessage, $attributeName);

                $uploadFolder = 'foto_sesudah_pemeriksaan';
                $image_uploaded_path = $request->foto_sesudah_periksa->store($uploadFolder, 'public');
                $image_link = "storage/".$uploadFolder."/".basename($image_uploaded_path);
                ImageAfter::create([
                    'id_diagnoses' => $diagnosis->id,
                    'path' => $image_link,
                    'keterangan' => $request->keterangan_sesudah,
                ]);
            }elseif($keterangan == 'lab'){
                $rules = [
                    'foto_lab' => 'required|image',
                    'keterangan_lab' => 'required|max:255',
                ];
        
                $customMessage = [
                    'required' => ':attribute wajib diisi',
                ];
                
                $attributeName = [
                    'foto_lab' => 'Foto',
                    'keterangan_lab' => 'Keterangan',
                ];
        
                $this->validate($request, $rules, $customMessage, $attributeName);

                $uploadFolder = 'foto_lab';
                $image_uploaded_path = $request->foto_lab->store($uploadFolder, 'public');
                $image_link = "storage/".$uploadFolder."/".basename($image_uploaded_path);
                ImageLab::create([
                    'id_diagnoses' => $diagnosis->id,
                    'path' => $image_link,
                    'keterangan' => $request->keterangan_lab,
                ]);
            }elseif($keterangan == 'radiologi'){
                $rules = [
                    'foto_radiologi' => 'required|image',
                    'keterangan_radiologi' => 'required|max:255',
                ];
        
                $customMessage = [
                    'required' => ':attribute wajib diisi',
                ];
                
                $attributeName = [
                    'foto_radiologi' => 'Foto',
                    'keterangan_radiologi' => 'Keterangan',
                ];
        
                $this->validate($request, $rules, $customMessage, $attributeName);

                $uploadFolder = 'foto_radiologi';
                $image_uploaded_path = $request->foto_radiologi->store($uploadFolder, 'public');
                $image_link = "storage/".$uploadFolder."/".basename($image_uploaded_path);
                ImageRadiology::create([
                    'id_diagnoses' => $diagnosis->id,
                    'path' => $image_link,
                    'keterangan' => $request->keterangan_radiologi,
                ]);
            }
            DB::commit();
            Alert::success('','Foto berhasil ditambah');
            return back();
        }catch(Throwable $e){
            DB::rollback();
            Alert::error('',$e->getMessage());
            return back();
        }
    }

    public function updateResep(Request $request, $id)
    {
        $rules = [
            'nama_obat.*' => 'required|max:255',
            'dosis.*' => 'required|max:255',
        ];

        $customMessage = [
            'required' => ':attribute wajib diisi',
        ];
        
        $attributeName = [
            'nama_obat.*' => 'Nama Obat',
            'dosis.*' => 'Dosis',
        ];
        $this->validate($request, $rules, $customMessage, $attributeName);

        $diagnosis = Diagnosis::find($id);
        $diagnosis->prescription()->delete();

        foreach($request->nama_obat as $key => $item){
            $diagnosis->prescription()->create([
                'id_diagnoses' => $diagnosis->id,
                'nama_obat' => $request->nama_obat[$key],
                'dosis' => $request->dosis[$key],
            ]);
        }

        $idEncrypt = Crypt::encrypt($diagnosis->id);

        Alert::success('','Resep berhasil diubah');
        return redirect()->route('rekam-medis.detail',$idEncrypt);
    }

    public function deleteFoto($keterangan, $id)
    {
        $id = Crypt::decrypt($id);
        if($keterangan == 'sebelum'){
            $imageBefore = ImageBefore::find($id);
            $image = $imageBefore->path;
            $imageBefore = ImageBefore::destroy($id);
        }elseif($keterangan == 'sesudah'){
            $imageAfter = ImageAfter::find($id);
            $image = $imageAfter->path;
            $imageAfter = ImageAfter::destroy($id);
        }elseif($keterangan == 'lab'){
            $imageLab = ImageLab::find($id);
            $image = $imageLab->path;
            $imageLab = ImageLab::destroy($id);
        }elseif($keterangan == 'radiologi'){
            $imageRadiology = ImageRadiology::find($id);
            $image = $imageRadiology->path;
            ImageRadiology::destroy($id);
        }

        if(is_file($image))
        {
            unlink($image);
        }
        else
        {
            Alert::toast('Error','error');
        }
        return back();
    }
    
    public function deleteResep($id)
    {
        $id = Crypt::decrypt($id);
        Prescription::destroy($id);
        return back();
    }

    public function doneCreate()
    {
        Alert::success('Data telah disimpan','Lihat rekam medis untuk lebih detail');
        return redirect()->route('diagnosis');
    }

    public function doneUpdate($id)
    {
        return redirect()->route('rekam-medis.detail',$id);
    }
}