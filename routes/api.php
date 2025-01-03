<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\TUController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelasMapelController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('sekolah', SekolahController::class);
Route::apiResource('mapel', MapelController::class);
Route::apiResource('kelas', KelasController::class);
Route::apiResource('siswa', SiswaController::class);
Route::apiResource('kelasMapel', KelasMapel::class);
Route::post ('/login', [AuthController::class, 'login']);
Route::post ('/logout', [AuthController::class, 'logout']);
Route::get ('/cekRole', [AuthController::class, 'cekRole']);
Route::apiResource('guru', GuruController::class);
Route::apiResource('tu', TUController::class);
Route::apiResource('nilai', NilaiController::class);
Route::get('/nilai/ratarata', [NilaiController::class, 'average']);
Route::put('/nilai/{id_member}/{id_mapel}', [NilaiController::class, 'update']);
Route::put('/tu/{nip}', [TUController::class, 'update']);
Route::put('/guru/{nip}', [GuruController::class, 'update']);
Route::put('/siswa/{nsin}', [SiswaController::class, 'update']);

Route::get('/kelas-mapel', [KelasMapelController::class, 'index']); // Menampilkan semua data atau berdasarkan query
Route::post('kelas-mapel', [KelasMapelController::class, 'store']); // Menambahkan data baru
Route::get('kelas-mapel/{id}', [KelasMapelController::class, 'show']); // Menampilkan data berdasarkan ID
Route::put('kelas-mapel/{id}', [KelasMapelController::class, 'update']); // Memperbarui data
Route::delete('kelas-mapel/{id}', [KelasMapelController::class, 'destroy']); // Menghapus data