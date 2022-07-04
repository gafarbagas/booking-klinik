<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function indexTentang()
    {
        return view('tentangKami');
    }

    public function indexDoctor()
    {
        return view('pages.timDokter');
    }
}
