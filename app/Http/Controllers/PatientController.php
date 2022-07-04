<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Patient;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $patients = DB::table('patients')
            ->join('users', 'patients.id_user', '=', 'users.id')
            ->where('name','LIKE','%'.$search.'%')
            ->orWhere('nik','LIKE','%'.$search.'%')
            ->orWhere('jenis_kelamin', 'LIKE', '%'.$search.'%')
            ->orWhere('no_hp', 'LIKE', '%'.$search.'%')
            ->orderBy('patients.id', 'asc')
            ->paginate(15);
        $patients->withPath('pasien');
        $patients->appends($request->all());
        return view('pages.patient.index', compact('patients'));
    }

    public function create()
    {
        return view('pages.patient.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:users,email',
            'password' => 'required|max:255',
            'jenis_kelamin' => 'required|max:255',
            'tanggal_lahir' => 'required|max:255',
            'nik' => 'required|max:255|unique:patients,nik',
            'no_hp' => 'required|max:255',
            'alamat' => 'required|max:255',
        ];


        $customMessage = [
            'required' => 'Silahkan masukan :attribute',
            'unique' => ':attribute telah digunakan'
        ];

        $attributeName = [
            'name' => 'Nama',
            'email' => 'Email',
            'password' => 'Password',
            'jenis_kelamin' => 'Jenis Kelamin',
            'tanggal_lahir' => 'Tanggal Lahir',
            'nik' => 'NIK',
            'no_hp' => 'No. HP',
            'alamat' => 'Alamat',
        ];

        $this->validate($request, $rules, $customMessage, $attributeName);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'level' => "patient",
        ]);

        Patient::create([
            'id_user' => $user->id,
            'jenis_kelamin' => $request['jenis_kelamin'],
            'tanggal_lahir' => $request['tanggal_lahir'],
            'nik' => $request['nik'],
            'alamat' => $request['alamat'],
            'no_hp' => $request['no_hp'],
        ]);
        Alert::success('', 'Pasien berhasil terdaftar');
        return redirect()->route('pasien');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $idPasien = Crypt::decrypt($id);
        $patient = Patient::where('id_user', $idPasien)->first();
        return view('pages.patient.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, Patient $pasien)
    {
        $idPasien = $pasien->id;
        $idUserPasien = $pasien->id_user;
        $user = User::where('id',$idUserPasien)->first();
        $userID = $user->id;
        // return $request->all();

        $rules = [
            'name' => 'required|max:255',
            'jenis_kelamin' => 'required|max:255',
            'nik' => "required|max:255|unique:patients,nik,$idPasien",
            'tanggal_lahir' => 'required|date',
            'no_hp' => 'required|max:255',
            'alamat' => 'required|max:1000',
            'email'=> "required|max:255|unique:users,email,$userID",
        ];

        $customMessage = [
            'required' => 'Silahkan Masukan :attribute',
            'unique' => ':attribute Telah Digunakan'
        ];

        $attributeName = [
            'name' => 'Nama',
            'email' => 'Email',
            'jenis_kelamin' => 'Jenis Kelamin',
            'tanggal_lahir' => 'Tanggal Lahir',
            'nik' => 'NIK',
            'no_hp' => 'No. HP',
            'alamat' => 'Alamat',
        ];

        $this->validate($request, $rules, $customMessage, $attributeName);

        Patient::where('id', $idPasien)
            ->update([
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
                'nik' => $request->nik,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
            ]);
        User::where('id',$userID)
            ->update([
                'name' => $request->name,
                'email' => $request->email
            ]);
        Alert::success('','Data pasien berhasil diubah');
        return redirect('/pasien');
    }

    public function ubahkatasandi($id)
    {
        $patientID = Crypt::decrypt($id);
        $patient = Patient::find($patientID);
        return view('pages.patient.resetpassword', compact('patient'));
    }

    public function postkatasandi(Request $request, $id)
    {
        $patient = Patient::where('id',$id)->first();
        $user = User::find($patient->id_user);
        $request->validate([
            'newpassword' => 'required|max:255',
        ]);
        $user->password = Hash::make($request->newpassword);
        $user->save();
        Alert::success('','Password pasien berhasil diubah');
        return redirect('/pasien');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        $idPasien = Crypt::decrypt($id);
        $pasien = Patient::where('id_user', $idPasien)->first();
        $user = User::where('id', $idPasien);
        $appointment = Appointment::where('id_patient', $pasien->id)->first();
        if($appointment != []){
            Alert::error('Data tidak dapat dihapus','Data sudah digunakan untuk keperluan sistem');
            return redirect()->route('pasien');
        }else{
            $pasien->delete();
            $user->delete();
            Alert::success('','Data pasien berhasil dihapus');
            return redirect()->route('pasien');
        }
    }
}
