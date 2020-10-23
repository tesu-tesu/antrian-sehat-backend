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
        $this->middleware('roleUser:Admin')->except(['show']);
        $this->middleware('roleUser:Admin,Super Admin,Pasien')->only(['show']);
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

        return response()->json([
            'success' => true,
            'message' => 'New Schedule has successfully created',
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
        return response()->json($schedule, 200);
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

        $updated = Schedule::where('id', $schedule->id)
        ->update([
            'day' => $request->day,
            'time_open' => $request->time_open,
            'time_close' => $request->time_close,
            'polyclinic_id' => $request->polyclinic
        ]);

        if ($updated) {
            return response()->json([
                'success' => true,
                'message' => 'Schedule data updated succesfully'
            ],200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Schedule data cannot be updated'
            ],500);
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
        $data = Schedule::find($schedule->id);

        if ($data->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Schedule successfully deleted'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Schedule cannot be deleted'
            ], 500);
        }
    }

    public function showSchedule(PolyMaster $polymaster){
        $schedule = Polyclinic::with(['health_agency' => function($q){
            $q->select('id', 'name')->get();
        },'schedules'])
        ->where('poly_master_id', $polymaster->id)->get();

        return response()->json($schedule, 200);
    }
}
