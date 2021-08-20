<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response;

class AbsensiController extends Controller
{
    //
    public function checkIn(Request $request, $id){
        try{
            
            $absensi = Absensi::create([
                'absen_in' =>now(),
                'absen_out' =>now(),
                'kary_id' => $id
            ]);

            $response = [
                'message' => 'Check-in berhasil'
            ];

            return response()->json($response, Response::HTTP_CREATED);

        } catch(QueryException $e){
            
            return response()->json([
                'message' => "Failed : " .$e->errorInfo
            ]);

        }
    }

    public function checkOut(Request $request, $id){
        try{

            $absensi = Absensi::where('kary_id', $id)
                            ->whereDate('created_at', '=', Carbon::today()->toDateString())
                            ->update([
                                'absen_out' =>now()
                            ]);
            
            $response = [
                'message' => 'Check-out berhasil'
            ];

            return response()->json($response, Response::HTTP_OK);

        } catch(QueryException $e){
            
            return response()->json([
                'message' => "Failed : " .$e->errorInfo
            ]);

        }
    }

    public function show($id)
    {
        //Cek Karyawan Spesifik
        $absensi = Absensi::where('kary_id', $id)->firstOrFail();
        $response = [
            'message' => 'Detail Absensi Karyawan',
            'data' => $absensi
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function index()
    {
        //Show all karyawan "nama, user, password" data.
        $absensi = Absensi::orderBy('kary_id', 'ASC')->get();
        $response = [
            'message' => 'List Absensi Karyawan',
            'data' => $absensi
        ];

        return response()->json($response, Response::HTTP_OK);
    }
}
