<?php

namespace App\Http\Controllers;


use App\Models\Cuti;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CutiController extends Controller
{
    //
    public function index()
    {
        //Show all Cuti data
        $cuti = Cuti::orderBy('cuti_in', 'DESC')->get();
        $response = [
            'message' => 'List Cuti berdasarkan Tanggal',
            'data' => $cuti
        ];

        return response()->json($response, Response::HTTP_OK);
    }
    public function accept(Request $request, $id)
    {
        try {

            $cuti = Cuti::where('kary_id', $id)
                ->update([
                    'cuti_verified' => 'disetujui'
                ]);

            $response = [
                'message' => 'Ijin disetujui'
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {

            return response()->json([
                'message' => "Failed : " . $e->errorInfo
            ]);
        }
    }
    public function decline(Request $request, $id)
    {
        try {

            $cuti = Cuti::where('kary_id', $id)
                ->update([
                    'cuti_verified' => 'ditolak'
                ]);

            $response = [
                'message' => 'Ijin ditolak'
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {

            return response()->json([
                'message' => "Failed : " . $e->errorInfo
            ]);
        }
    }
    public function store(Request $request, $id)
    {
        //create cuti data
        $validator = Validator::make($request->all(), [
            'cuti_in' => ['required'],
            'cuti_out' => ['required'],
            'cuti_type' => ['required', 'in:sakit,cuti'],
            'cuti_reason' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $cuti = Cuti::create([
                'cuti_in' => date('Y-m-d', strtotime($request['cuti_in'])),
                'cuti_out' =>  date('Y-m-d', strtotime($request['cuti_out'])),
                'cuti_verified' => 'menunggu',
                'cuti_type' => $request['cuti_type'],
                'cuti_reason' => $request['cuti_reason'],
                'kary_id' => $id
            ]);

            $response = [
                'message' => 'Cuti Created',
                'data' => $cuti
            ];

            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {

            return response()->json([
                'message' => "Failed : " . $e->errorInfo
            ]);
        }
    }
}
