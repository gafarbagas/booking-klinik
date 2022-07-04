<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Alert;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

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
            'no_hp' => 'No. Hp',
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
        Alert::success('', 'Anda berhasil mendaftar');
        return redirect()->route('login');
    }
}
