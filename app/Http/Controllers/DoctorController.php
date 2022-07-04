<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use App\Models\Service;
use App\Models\ServiceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $doctor = Doctor::orderBy('id','DESC')->get();
        return view ('pages.doctor.index', compact('doctor'));
    }

    public function create()
    {
        $serviceTypes = ServiceType::all();
        return view('pages.doctor.create',compact('serviceTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:users,email',
            'password' => 'required|max:255',
            'jenis_layanan.*' => 'required|max:255',
        ];


        $customMessage = [
            'required' => 'Silahkan masukan :attribute',
            'unique' => ':attribute telah digunakan'
        ];

        $attributeName = [
            'name' => 'Nama',
            'email' => 'Email',
            'password' => 'Password',
        ];

        $this->validate($request, $rules, $customMessage, $attributeName);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'level' => "doctor",
        ]);

        $dokter = Doctor::create([
            'id_user' => $user->id,
        ]);

        $dokter->serviceType()->sync($request->jenis_layanan);

        Alert::success('', 'Doctor berhasil ditambahkan');
        return redirect()->route('dokter');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $doctorId = Crypt::decrypt($id);
        $doctor = Doctor::find($doctorId);
        $serviceTypes = ServiceType::all();
        return view('pages.doctor.edit', compact('doctor','serviceTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     */
    public function update(Request $request, Doctor $dokter)
    {
        $doctorId = $dokter->id;
        $doctorUserId = $dokter->id_user;
        $user = User::where('id',$doctorUserId)->first();
        $userId = $user->id;

        $rules = [
            'name' => 'required|max:255',
            'email'=> "required|max:255|unique:users,email,$userId",
        ];

        $customMessage = [
            'required' => 'Silahkan Masukan :attribute',
            'unique' => ':attribute Telah Digunakan'
        ];

        $attributeName = [
            'name' => 'Nama',
            'email' => 'Email',
        ];

        $this->validate($request, $rules, $customMessage, $attributeName);

        User::where('id',$userId)
            ->update([
                'name' => $request->name,
                'email' => $request->email
            ]);

        $dokter->serviceType()->sync($request->jenis_layanan);

        Alert::success('','Data Dokter berhasil diubah');
        return redirect('/dokter');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        $doctorId = Crypt::decrypt($id);
        $doctor = Doctor::find($doctorId);
        $user = User::where('id', $doctor->id_user)->first();
        $doctor->delete();
        $user->delete();

        Alert::success('','Data Dokter berhasil dihapus');
        return redirect()->route('dokter');
    }

    public function editKataSandi($id)
    {
        $doctorId = Crypt::decrypt($id);
        $doctor = Doctor::find($doctorId);
        return view('pages.doctor.resetPassword', compact('doctor'));
    }

    public function updateKataSandi(Request $request, $id)
    {
        $doctor = Doctor::where('id',$id)->first();
        $user = User::find($doctor->id_user);
        $request->validate([
            'newPassword' => 'required|max:255',
        ]);
        $user->password = Hash::make($request->newPassword);
        $user->save();
        Alert::success('','Password Dokter berhasil diubah');
        return redirect('/dokter');
    }
}
