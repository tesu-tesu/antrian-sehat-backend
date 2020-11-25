<?php

namespace App\Http\Controllers;

use App\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\PolyMaster;
use App\Polyclinic;

class ScheduleController extends Controller
{
    public function __construct() {
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
            'day' => 'required|string',
            'time_open' => 'required|string',
            'time_close' => 'required|string',
            'polyclinic' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(),400);
        }

        $schedule = Schedule::create([
            'day' => $request->day,
            'time_open' => $request->time_open,
            'time_close' => $request->time_close,
            'polyclinic_id' => $request->polyclinic
        ]);

        if($schedule)
            return response()->json([
                'success' => true,
                'message' => 'Add data successfully!',
                'data' => $schedule
            ],200);
        else
            return response()->json([
                'success' => false,
                'message' => 'Add data failed!',
            ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        $validator = Validator::make($request->all(), [
            'day' => 'required|string',
            'time_open' => 'required|string',
            'time_close' => 'required|string',
            'polyclinic' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(),400);
        }

        $isUpdate = Schedule::where('id', $schedule->id)
            ->update([
                'day' => $request->day,
                'time_open' => $request->time_open,
                'time_close' => $request->time_close,
                'polyclinic_id' => $request->polyclinic
            ]);

        $newSchedule = Schedule::where('id', $schedule->id)->first();

        if ($isUpdate) {
            return response()->json([
                'success' => true,
                'message' => 'Update data successfully!',
                'data' => $newSchedule
            ],200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Update data failed!',
                'data' => $newSchedule,
            ],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        if ($schedule->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Delete data successfully!'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Delete data failed!'
            ], 200);
        }
    }

    public function getScheduleOfPolymaster(PolyMaster $polymaster){
        $schedule = Polyclinic::with(['health_agency' => function($q){
            $q->select('id', 'name')->get();
        },'schedules'])
        ->where('poly_master_id', $polymaster->id)->get();

        if($schedule)
            return response()->json([
                'success' => true,
                'message' => 'Get data successfully!',
                'data' => $schedule
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Get data failed!',
            ]);
    }

    public function getScheduleOfPolyclinic(Polyclinic $polyclinic){
        $schedules = Schedule::where('polyclinic_id', $polyclinic->id)->get();

        if($schedules)
            return response()->json([
                'success' => true,
                'message' => 'Get data successfully!',
                'data' => $schedules
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Get data failed!',
            ]);
    }
}
