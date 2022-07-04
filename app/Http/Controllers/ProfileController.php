<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Auth;
use Alert;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth = Auth::user();
        $user = User::where('id', $auth->id)->first();
        if($user->level == "admin"){
            return view('pages.profile.index', compact('user'));
        }elseif($user->level == "doctor"){
            $dokter = Doctor::where('id_user',$user->id)->first();
            return view('pages.profile.index', compact('user','dokter'));
        }elseif($user->level == "patient"){
            $pasien = Patient::where('id_user',$user->id)->first();
            return view('pages.profile.index', compact('user','pasien'));
        }
    }

    public function dataakun(Request $request)
    {
        $user = Auth::user();
        $id = $user->id;

        $rules = [
            'name' => 'required|max:255',
            'email' => "required|max:255|unique:users,email,$id",
        ];

        $customMessage = [
            'required' => 'Silahkan Masukan :attribute',
            'unique' => ':attribute Telah Digunakan'
        ];

        $attributeName = [
            'name' => 'Nama',
            'email' => 'E-Mail',
        ];

        $this->validate($request, $rules, $customMessage, $attributeName);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        Alert::success('','Data akun berhasil diubah');
        return redirect('/profil');
    }

    public function password(Request $request)
    {
        $user = Auth::user();
        $rules = [
            'password' => 'required|max:255',
            'newpassword' => 'required|max:255',
            'confirmpassword' => 'required|max:255',
        ];

        $customMessage = [
            'required' => 'Silahkan masukan :attribute',
        ];

        $attributeName = [
            'password' => 'Password',
            'newpassword' => 'Password Baru',
            'confirmpassword' => 'Konfirmasi Password Baru',
        ];

        $this->validate($request, $rules, $customMessage, $attributeName);

        if (!(Hash::check($request->get('password'), Auth::user()->password))) {
            Alert::toast('Password tidak cocok','error');
            return redirect('/profil');
        }elseif ($request->password == $request->newpassword) {
            Alert::toast('Password baru tidak boleh sama','error');
            return redirect('/profil');
        }elseif ($request->newpassword !== $request->confirmpassword) {
            Alert::toast('Konfirmasi password baru salah','error');
            return redirect('/profil');
        }elseif ($request->newpassword == $request->confirmpassword) {
            $user->update([
                'password' => Hash::make($request->newpassword),
            ]);
            Alert::success('','Password berhasil diubah');
            return redirect('/profil');
        }
    }
}
