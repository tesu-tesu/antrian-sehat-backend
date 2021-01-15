<?php

namespace App\Http\Controllers;

use App\HealthAgency;
use App\PolyMaster;
use App\Polyclinic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PolyMasterController extends Controller
{
    public function __construct()
    {
        $this->middleware('roleUser:Super Admin')->only(['store', 'update', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return PolyMaster[]|\Illuminate\Database\Eloquent\Collection|JsonResponse|Response
     */
    public function index()
    {
        $polymasters = PolyMaster::paginate(8);

        if ($polymasters)
            return response()->json([
                'success' => true,
                'message' => 'Get data success',
                'data' => $polymasters,
            ], 200);
        else
            return response()->json([
                'success' => false,
                'message' => 'Data is empty!',
            ], 200);
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
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 422);
        }
        //Checking File
        $uploadFile = $request->file('image');
        if ($uploadFile) {
            $path = $uploadFile->store('public/img/health_agencies');
        } else {
            $path = null;
        }

        $poly_master = PolyMaster::create([
            'name' => $request->name,
            'image' => $path,
        ]);

        return $poly_master ? response()->json([
            'success' => true,
            'message' => 'Add data successfully!',
            'data' => $poly_master,
        ], 200) : response()->json([
            'success' => false,
            'message' => 'Add data failed!',
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
        //
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
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 422);
        }

        //Checking File
        $uploadFile = $request->file('image');
        if ($uploadFile != null) {
            File::delete(storage_path('app/public/img/polymasters/') . $polyMaster->image);
            $path = $uploadFile->store('public/img/polymasters');
            $fileName = explode('/', $path);
            $fileName = end($fileName);
        } else {
            $fileName = $polyMaster->image;
        }

        $isUpdate = PolyMaster::where('id', $polyMaster->id)
            ->update([
                'name' => $request->name,
                'image' => $fileName
            ]);

        $poly_master = PolyMaster::where('id', $polyMaster->id)->first();

        if ($isUpdate)
            return response()->json([
                'success' => true,
                'message' => 'Update data successfully!',
                'data' => $poly_master,
            ], 200);
        else
            return response()->json([
                'success' => false,
                'message' => 'Update data failed!',
                'data' => $poly_master,
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

    public function getPolymasterOfPolyclinic(Polyclinic $polyclinic)
    {
        $polyName = PolyMaster::where('id', $polyclinic->poly_master_id)->first();

        if ($polyName)
            return response()->json([
                'success' => true,
                'message' => 'Get data successfully!',
                'data' => $polyName
            ], 200);
        else
            return response()->json([
                'success' => false,
                'message' => 'Data is empty!',
            ], 200);
    }

    public function getAllPolyMaster()
    {
        $polymasters = PolyMaster::all();

        if ($polymasters)
            return response()->json([
                'success' => true,
                'message' => 'Get data success',
                'data' => $polymasters,
            ], 200);
        else
            return response()->json([
                'success' => false,
                'message' => 'Data is empty!',
            ], 200);
    }
}
