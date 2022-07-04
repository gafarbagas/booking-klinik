<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Service;
use App\Models\ServiceType;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PromiseController extends Controller
{
    public function getDoctor($id)
    {
        $serviceType = ServiceType::where("service_type_name", $id)->first();
        $user = DB::table('services')
            ->join('service_types', 'services.id_service_type', '=', 'service_types.id')
            ->join('doctors', 'services.id_doctor', '=', 'doctors.id')
            ->join('users', 'doctors.id_user', '=', 'users.id')
            ->where('id_service_type', $serviceType->id)
            ->get();
        if($user == []){
            return response()->json([
                'success' => false,
            ]);
        } else {
            $users = $user->pluck("name","id_doctor");
            return response()->json($users);
        }
    }
}
