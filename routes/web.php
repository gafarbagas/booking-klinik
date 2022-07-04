<?php

use App\Http\Middleware\Admin;
use App\Http\Middleware\AdminAndPatient;
use App\Http\Middleware\DoctorAndAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CertificateRestController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromiseController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ReferralLetterController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang-kami', [HomepageController::class, 'indexTentang']);
Route::get('/tim-doctor', [HomepageController::class, 'indexDoctor']);
Route::post('/daftar-akun', [RegisterController::class, 'store']);
Route::get('/daftar-akun', [RegisterController::class, 'index'])->name('daftar-akun');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['middleware' => DoctorAndAdmin::class], function () {
        Route::get('/caripasien/autocomplete', [SearchController::class, 'autoCompletePasien']);
        Route::get('/caripasien/autofill', [SearchController::class, 'autofillPasien']);

        Route::patch('/surat/keterangan-istirahat/{id}', [CertificateRestController::class, 'update']);
        Route::post('/surat/keterangan-istirahat', [CertificateRestController::class, 'store']);
        Route::get('/surat/keterangan-istirahat/{id}/ubah', [CertificateRestController::class, 'edit']);
        Route::get('/surat/keterangan-istirahat/{id}/cetak', [CertificateRestController::class, 'print']);
        Route::get('/surat/keterangan-istirahat/{id}/detail', [CertificateRestController::class, 'show'])->name('detail.keterangan-istirahat');
        Route::get('/surat/keterangan-istirahat/tambah', [CertificateRestController::class, 'create'])->name('tambah.keterangan-istirahat');
        Route::get('/surat/keterangan-istirahat', [CertificateRestController::class, 'index'])->name('keterangan-istirahat');

        Route::patch('/surat/rujukan/{id}', [ReferralLetterController::class, 'update']);
        Route::post('/surat/rujukan', [ReferralLetterController::class, 'store']);
        Route::get('/surat/rujukan/{id}/ubah', [ReferralLetterController::class, 'edit']);
        Route::get('/surat/rujukan/{id}/cetak', [ReferralLetterController::class, 'print']);
        Route::get('/surat/rujukan/{id}/detail', [ReferralLetterController::class, 'show'])->name('detail.rujukan');
        Route::get('/surat/rujukan/tambah', [ReferralLetterController::class, 'create'])->name('tambah.rujukan');
        Route::get('/surat/rujukan', [ReferralLetterController::class, 'index'])->name('rujukan');

        Route::get('/rekam-medis/foto/{keterangan}/{id}', [MedicalRecordController::class, 'foto']);
        Route::get('/rekam-medis/{id}/detail', [MedicalRecordController::class, 'detail'])->name('rekam-medis.detail');
        Route::get('/rekam-medis/{id}', [MedicalRecordController::class, 'indexPatient']);
        Route::get('/rekam-medis', [MedicalRecordController::class, 'index'])->name('rekam-medis');

        Route::delete('/diagnosis/hapus/foto/{keterangan}/{id}', [DiagnosisController::class, 'deleteFoto']);
        Route::post('/diagnosis/{id}/upload/foto/{keterangan}', [DiagnosisController::class, 'uploadFoto']);
        Route::post('/diagnosis/{id}/ubah/resep', [DiagnosisController::class, 'updateResep']);
        Route::post('/diagnosis/{id}/ubah', [DiagnosisController::class, 'update']);
        Route::post('/diagnosis/{id}/buat', [DiagnosisController::class, 'store']);
        Route::post('/diagnosis-selesai-update/{id}', [DiagnosisController::class, 'doneUpdate'])->name('diagnosis.doneUpdate');
        Route::post('/diagnosis-selesai-create', [DiagnosisController::class, 'doneCreate'])->name('diagnosis.doneCreate');
        Route::get('/diagnosis/hapus/resep/{resep}', [DiagnosisController::class, 'deleteResep']);
        Route::get('/diagnosis/{id}/ubah/foto', [DiagnosisController::class, 'editFoto']);
        Route::get('/diagnosis/{id}/ubah/resep', [DiagnosisController::class, 'editResep']);
        Route::get('/diagnosis/{id}/ubah', [DiagnosisController::class, 'edit']);
        Route::get('/diagnosis/{id}/buat/foto', [DiagnosisController::class, 'createFoto'])->name('diagnosis.createFoto');
        Route::get('/diagnosis/{id}/buat', [DiagnosisController::class, 'create']);
        Route::get('/diagnosis', [DiagnosisController::class, 'index'])->name('diagnosis');
    });

    Route::group(['middleware' => AdminAndPatient::class], function () {
        Route::post('/janji/store', [AppointmentController::class, 'storePatient']);
        Route::post('/janji', [AppointmentController::class, 'store']);
        Route::get('/janji/tambah/{id}', [AppointmentController::class, 'create'])->name('tambahJanji');
        Route::get('/janji', [AppointmentController::class, 'index']);
        Route::get('/promise/ajax/{test}',[PromiseController::class, 'getDoctor']);
    });

    Route::group(['middleware' => Admin::class], function()
    {
        Route::post('/janji/admin/ubahstatus/{id}', [AppointmentController::class, 'ubahStatus']);
        Route::get('/janji/admin/tambah', [AppointmentController::class, 'createByAdmin']);
        Route::get('/janji/admin/hari-ini', [AppointmentController::class, 'indexHariIni'])->name('indexHariIni');
        Route::get('/janji/admin/yang-akan-datang', [AppointmentController::class, 'indexEsok'])->name('indexEsok');
        Route::get('/janji/admin/lampau', [AppointmentController::class, 'indexLampau'])->name('indexLampau');

        Route::patch('/pasien/{pasien}', [PatientController::class, 'update']);
        Route::post('/pasien', [PatientController::class, 'store']);
        Route::post('/pasien/{pasien}/ubahkatasandi', [PatientController::class, 'postkatasandi']);
        Route::get('/pasien/{pasien}/ubahkatasandi', [PatientController::class, 'ubahkatasandi']);
        Route::get('/pasien/{pasien}/ubah', [PatientController::class, 'edit'])->name('pasienubah');
        Route::get('/pasien/tambah', [PatientController::class, 'create'])->name('pasientambah');
        Route::get('/pasien', [PatientController::class, 'index'])->name('pasien');
        Route::get('/pasien/{id}/hapus',[PatientController::class, 'destroy']);

        Route::post('/dokter', [DoctorController::class, 'store']);
        Route::get('/dokter', [DoctorController::class, 'index'])->name('dokter');
        Route::get('/dokter/{dokter}/ubah', [DoctorController::class, 'edit'])->name('ubahDokter');
        Route::get('/dokter/tambah', [DoctorController::class, 'create'])->name('tambahDokter');
        Route::get('/dokter/{id}/hapus',[DoctorController::class, 'destroy']);
        Route::patch('/dokter/{dokter}', [DoctorController::class, 'update']);
        Route::post('/dokter/{dokter}/ubahKataSandi', [DoctorController::class, 'UpdateKataSandi']);
        Route::get('/dokter/{dokter}/ubahKataSandi', [DoctorController::class, 'editKataSandi']);
    });

    Route::post('/profil/password', [ProfileController::class, 'password']);
    Route::post('/profil/dataakun', [ProfileController::class, 'dataakun']);
    Route::get('/profil', [ProfileController::class, 'index'])->name('profil');
});
