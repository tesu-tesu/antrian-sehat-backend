<?php

namespace App\Http\Controllers;

use App\HealthAgency;
use App\PolyMaster;
use App\Polyclinic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class PolyMasterController extends Controller
{
    public function __construct() {
        $this->middleware('roleUser:Admin')->except(['index','show', 'showPolymaster']);
        $this->middleware('roleUser:Admin,Super Admin,Pasien')->only(['index','show']);
        $this->middleware('roleUser:Pasien')->only(['showPolymaster']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return PolyMaster[]|\Illuminate\Database\Eloquent\Collection|JsonResponse|Response
     */
    public function index()
    {
        $polymasters = PolyMaster::paginate(8);
        return response()->json($polymasters, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $poly_master = PolyMaster::create([
            'name' => $request->name,
        ]);

        return $poly_master ? \response()->json([
            'success' => true,
            'message' => 'Add data successfully!',
            'user' => $poly_master,
        ], 200) : response()->json([
            'success' => false,
            'message' => 'Add data failed!',
            'user' => $poly_master,
        ], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param PolyMaster $polyMaster
     * @return JsonResponse|Response
     */
    public function show(PolyMaster $polyMaster)
    {
        return response()->json($polyMaster, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param PolyMaster $polyMaster
     * @return Response
     */
    public function edit(PolyMaster $polyMaster)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param PolyMaster $polyMaster
     * @return JsonResponse
     */
    public function update(Request $request, PolyMaster $polyMaster)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $isUpdate = PolyMaster::where('id', $polyMaster->id)->first()
            ->update([
                'name' => $request->name
            ]);

        $poly_master = PolyMaster::where('id', $polyMaster->id)->first();

        if ($isUpdate)
            return response()->json([
                'success' => true,
                'message' => 'Update data successfully!',
                'user' => $poly_master,
            ], 200);
        else
            return response()->json([
                'success' => false,
                'message' => 'Update data failed!',
                'user' => $poly_master,
            ], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PolyMaster $polyMaster
     * @return JsonResponse|Response
     */
    public function destroy(PolyMaster $polyMaster)
    {
        if ($polyMaster->delete()) {
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

    public function showPolymaster(Polyclinic $polyclinic)
    {
        //get polymaster from polyclinic id
        $polyName = PolyMaster::where('id', $polyclinic->poly_master_id)->first();

        return response()->json($polyName, 200);
    }
}
