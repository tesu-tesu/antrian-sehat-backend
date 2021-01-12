<?php

namespace App\Http\Controllers;

use App\Schedule;
use Carbon\Carbon;
use App\HealthAgency;
use App\Polyclinic;
use App\PolyMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PolyclinicController extends Controller
{
    public function __construct()
    {
        $this->middleware('roleUser:Admin')->only(['store', 'update', 'destroy']);
    }
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

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $polyclinic = Polyclinic::create([
            'poly_master_id' => $request->poly_master_id,
            'health_agency_id' => $request->health_agency_id,
        ]);

        if ($polyclinic)
            return response()->json([
                'success' => true,
                'message' => 'Add data successfully!',
                'data' => $polyclinic,
            ], 200);
        else
            return response()->json([
                'success' => false,
                'message' => 'Add data failed!',
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
        //
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

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $isUpdate = Polyclinic::where('id', $polyclinic->id)->first()
            ->update([
                'poly_master_id' => $request->poly_master_id,
                'health_agency_id' => $request->health_agency_id,
            ]);

        $newPolyclinic = Polyclinic::where('id', $polyclinic->id)->first();

        if ($isUpdate)
            return response()->json([
                'success' => true,
                'message' => 'Update data successfully!',
                'data' => $newPolyclinic,
            ], 200);
        else
            return response()->json([
                'success' => false,
                'message' => 'Update data failed!',
                'data' => $newPolyclinic,
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
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Delete data failed!',
            ], 500);
        }
    }
}
