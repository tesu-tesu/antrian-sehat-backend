<?php

namespace App\Http\Controllers;

use App\Polyclinic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PolyclinicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'poly_master_id' => 'required|numeric',
            'health_agency_id' => 'required|numeric',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $polyclinic = Polyclinic::create([
            'poly_master_id' => $request->poly_master_id,
            'health_agency_id' => $request->health_agency_id,
        ]);

        if($polyclinic)
            return response()->json([
                'success' => true,
                'message' => 'Add data successfully!',
                'polyclinic' => $polyclinic,
            ], 200);
        else
            return response()->json([
                'success' => false,
                'message' => 'Add data failed!',
                'polyclinic' => $polyclinic,
            ], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Polyclinic  $polyclinic
     * @return \Illuminate\Http\Response
     */
    public function show(Polyclinic $polyclinic)
    {
        return response()->json($polyclinic, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Polyclinic  $polyclinic
     * @return \Illuminate\Http\Response
     */
    public function edit(Polyclinic $polyclinic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Polyclinic  $polyclinic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Polyclinic $polyclinic)
    {
        $validator = Validator::make($request->all(), [
            'poly_master_id' => 'required|numeric',
            'health_agency_id' => 'required|numeric',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $isUpdate = Polyclinic::where('id', $polyclinic->id)->first()
            ->update([
            'poly_master_id' => $request->poly_master_id,
            'health_agency_id' => $request->health_agency_id,
            ]);

        $polyclinic = Polyclinic::where('id', $polyclinic->id)->first();

        if($isUpdate)
            return response()->json([
                'success' => true,
                'message' => 'Update data successfully!',
                'polyclinic' => $polyclinic,
            ], 200);
        else
            return response()->json([
                'success' => false,
                'message' => 'Update data failed!',
                'polyclinic' => $polyclinic,
            ], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Polyclinic  $polyclinic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Polyclinic $polyclinic)
    {
        if ($polyclinic->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Delete data successfully!',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Delete data failed!',
            ], 500);
        }
    }
}
