<?php

namespace App\Http\Controllers;

use App\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\PolyMaster;
use App\Polyclinic;

class ScheduleController extends Controller
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
            'day' => 'required|string',
            'time_open' => 'required|string',
            'time_close' => 'required|string',
            'polyclinic' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 422);
        }

        $schedule = Schedule::create([
            'day' => $request->day,
            'time_open' => $request->time_open,
            'time_close' => $request->time_close,
            'polyclinic_id' => $request->polyclinic
        ]);

        if ($schedule)
            return response()->json([
                'success' => true,
                'message' => 'Add data successfully!',
                'data' => $schedule
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
            return response()->json($validator->errors()->toJson(), 422);
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
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Update data failed!',
                'data' => $newSchedule,
            ], 500);
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
            ], 500);
        }
    }

    public function getSchedulePolyclinicOfHA($healthAgency)
    {
        $listDay = ['M', 'S', 'S', 'R', 'K', 'J', 'S'];
        $schedules = Polyclinic::with(
            'health_agency:id,name,address',
            'poly_master:id,name,image',
            'schedules'
        )->where('health_agency_id', $healthAgency)->get();

        if ($schedules != "[]") {
            foreach ($schedules as $row) {
                foreach ($row["schedules"] as $schedule) {
                    $day = Schedule::where('id', $schedule->id)->first()->day;
                    $dayId = array_search($day, DAY);
                    $dayId = ($dayId) % 7;
                    $today = Carbon::now()->dayOfWeek;
                    $add = $dayId - $today;
                    if ($add < 0) { //jika selisih negatif brrti ganti date ke mingdep
                        $add += 7;
                    }
                    $schedule["day"] = $dayId;
                    $schedule["charOfDay"] = $listDay[$dayId];
                    $schedule["date"] = (Carbon::now()->addDays($add)->toDateString());
                }
                //sorting based on index day
                $collection = collect($row["schedules"]);
                $sorted = $collection->sortBy('day');
                $row["sorted"] = $sorted->values()->all();
            }

            return response()->json([
                'success' => true,
                'message' => 'Get data success',
                'data' => $schedules,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data is empty!',
            ], 204);
        }
    }

    public function getScheduleOfPolymaster(PolyMaster $polymaster)
    {
        $schedule = Polyclinic::with(['health_agency' => function ($q) {
            $q->select('id', 'name')->get();
        }, 'schedules'])
            ->where('poly_master_id', $polymaster->id)->get();

        if ($schedule)
            return response()->json([
                'success' => true,
                'message' => 'Get data successfully!',
                'data' => $schedule
            ], 200);
        else
            abort(404);
    }
}
