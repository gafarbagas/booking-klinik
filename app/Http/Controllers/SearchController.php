<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function autoCompletePasien(Request $request)
    {
        $query = $request->get('query');
        $filterResult = Patient::where('nik', 'LIKE', '%'. $query. '%')->get();
        $data = array ();
        foreach ($filterResult as $filter)
        {
            $data[] = $filter->nik;
        }
        return response()->json($data);
    }

    public function autofillPasien(Request $request)
    {
        $cariPasien = $request->cari_pasien;
        $patient = Patient::where('nik',$cariPasien)->first();
        if($patient != []){
            $data = array (
                'nama' => $patient->user->name,
                'tanggal_lahir' => $patient->tanggal_lahir,
                'nik' => $patient->nik,
                'jenis_kelamin' => $patient->jenis_kelamin,
                'alamat' => $patient->alamat,
                'id_pasien' => $patient->id,
            );
            return json_encode($data);
        }else{
            return response()->json([
                'success' => false,
            ]);
        }
    }
}
