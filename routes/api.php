<?php

use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\CutiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/karyawan',[KaryawanController::class, 'index']);
Route::post('/karyawan',[KaryawanController::class, 'store']);
Route::get('/karyawan/{id}',[KaryawanController::class, 'show']);
Route::put('/karyawan/{id}',[KaryawanController::class, 'update']);
Route::delete('/karyawan/{id}',[KaryawanController::class, 'destroy']);

Route::post('/absensi/in/{id}',[AbsensiController::class, 'checkIn']);
Route::put('/absensi/out/{id}',[AbsensiController::class, 'checkOut']);
Route::get('/absensi/{id}',[AbsensiController::class, 'show']);
Route::get('/absensi',[AbsensiController::class, 'index']);

Route::get('/cuti',[CutiController::class, 'index']);
Route::post('/cuti/create/{id}',[CutiController::class, 'store']);
Route::put('/cuti/accept/{id}',[CutiController::class, 'accept']);
Route::put('/cuti/decline/{id}',[CutiController::class, 'decline']);