<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Show all karyawan "nama, user, password" data.
        $karyawan = Karyawan::orderBy('kary_nama', 'ASC')->get();
        $response = [
            'message' => 'List Karyawan berdasarkan Nama',
            'data' => $karyawan
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //create karyawan data
        $validator = Validator::make($request->all(), [
            'kary_nama' => ['required'],
            'kary_user' => ['required'],
            'kary_pass' => ['required'],
            'kary_role' => ['required', 'in:karyawan,HRD,manager']
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try{
            $karyawan = Karyawan::create($request->all());
            $response = [
                'message' => 'Karyawan Created',
                'data' => $karyawan
            ];

            return response()->json($response, Response::HTTP_CREATED);

        } catch(QueryException $e){
            
            return response()->json([
                'message' => "Failed : " .$e->errorInfo
            ]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Cek Karyawan Spesifik
        $karyawan = Karyawan::where('kary_id', $id)->firstOrFail();
        $response = [
            'message' => 'Detail Karyawan',
            'data' => $karyawan
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Edit Karyawan
        $karyawan = Karyawan::where('kary_id', $id)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'kary_nama' => ['required'],
            'kary_user' => ['required'],
            'kary_pass' => ['required'],
            'kary_role' => ['required', 'in:karyawan,HRD,manager']
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try{
            $karyawan::where('kary_id', $id)->update($request->all());
            
            $response = [
                'message' => 'Karyawan Updated',
                'data' => $request->all()
            ];

            return response()->json($response, Response::HTTP_OK);

        } catch(QueryException $e){
            
            return response()->json([
                'message' => "Failed : " .$e->errorInfo
            ]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $karyawan = Karyawan::where('kary_id', $id)->firstOrFail();

        try{
            $karyawan::where('kary_id', $id)->delete();
            $response = [
                'message' => 'Karyawan Deleted'
            ];

            return response()->json($response, Response::HTTP_OK);

        } catch(QueryException $e){
            
            return response()->json([
                'message' => "Failed : " .$e->errorInfo
            ]);

        }
    }
}
