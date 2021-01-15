<?php

namespace App\Http\Controllers;

use App\User;
use App\WaitingList;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('roleUser:Admin|Super Admin')->only(['show']);
        $this->middleware('roleUser:Super Admin')->only(['getAdminUser']);
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

    public function getCurrent()
    {
        if (auth()->user()->role == 'Admin') // atau  FacadesAuth::id()
            $user = User::with('health_agency')->find(auth()->user()->id);
        else if (auth()->user()->role == 'Pasien') {
            $user = User::find(auth()->user()->id);
            $user->totalWaitingList = WaitingList::where('user_id', auth()->user()->id)
                ->count();
        } else {
            $user = User::find(auth()->user()->id);
        }

        if ($user->profile_img)
            $user->imagePath = $this->getImagePath($user->profile_img);

        if ($user)
            return response()->json([
                'success' => true,
                'message' => 'Data user selected',
                'data' => $user
            ], 200);
        else
            abort(404);
    }

    public function getRoleAdmin()
    {
        $admins = User::where('role', "Admin")->with('health_agency')->get();

        if ($admins)
            return response()->json([
                'success' => true,
                'message' => 'Data user admin selected',
                'data' => $admins
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:3,150',
            'email' => 'required|string|email|unique:users|max:100',
            'password' => 'required|string|min:6',
            'phone' => 'required|numeric|digits_between:8,13',
            'role' => 'required|string',
            'residence_number' => 'nullable|numeric|unique:users|digits:16',
            'health_agency' => 'nullable|numeric'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
            'residence_number' => $request->residence_number,
            'health_agency_id' => $request->health_agency,
            'password' => bcrypt($request->password)
        ]);

        if ($user)
            return response()->json([
                'success' => true,
                'message' => 'User was successfully created',
                'data' => $user
            ], 200);
        else
            return response()->json([
                'success' => false,
                'message' => 'User was failed created',
                'data' => $user
            ], 500);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user = User::where('id', $user->id)->with('health_agency')->first();

        return response()->json([
            'success' => true,
            'message' => 'Data is selected',
            'data' => $user
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:3,150',
            'email' => 'required|string|email|unique:users,email,' . $user->id . '|max:100',
            'phone' => 'required|min:8|max:14',
            'role' => 'required|string',
            'residence_number' => 'nullable|numeric|unique:users,residence_number,' . $user->id . '|digits:16',
            'health_agency' => 'nullable|numeric'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $updated = User::where('id', $user->id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'role' => $request->role,
                'residence_number' => $request->residence_number,
                'health_agency_id' => $request->health_agency
            ]);

        $newUser = User::where('id', $user->id)->with('health_agency')->first();

        if ($updated)
            return response()->json([
                'success' => true,
                'message' => 'User data updated successfully!',
                'data' => $newUser
            ], 200);
        else
            return response()->json([
                'success' => false,
                'message' => 'User data can not be updated'
            ], 500);
    }

    public function changePassword(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'current' => ['required', new MatchOldPassword()],
            'new' => ['required', 'string', 'max:255'],
            'confirm' => ['same:new'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $updated = User::where('id', $user->id)
            ->update([
                'password' => bcrypt($request->new)
            ]);

        if ($updated)
            return response()->json([
                'success' => true,
                'message' => 'Password data updated successfully!'
            ], 200);
        else
            return response()->json([
                'success' => false,
                'message' => 'Password data can not be updated'
            ], 500);
    }

    public function changeImage(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2000',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $uploadFile = $request->file('image');
        if ($uploadFile != null) {
            File::delete(storage_path('app/public/img/users/') . $user->profile_img);
            $path = $uploadFile->store('public/img/users');
        } else {
            $path = $user->profile_img;
        }

        $fileName = explode('/', $path);
        $updated = User::where('id', $user->id)
            ->update([
                'profile_img' => end($fileName)
            ]);

        if ($updated)
            return response()->json([
                'success' => true,
                'message' => 'Profile image has updated successfully!'
            ], 200);
        else
            return response()->json([
                'success' => false,
                'message' => 'Profile image can not be updated'
            ], 500);
    }

    private function getImagePath($filename)
    {
        $path = storage_path('app/public/img/users/' . $filename);

        if (!File::exists($path)) {
            return response()->json([
                'success' => false,
                'message' => 'Data is empty!',
            ], 200);
        }
        $stringPath = Storage::url('public/img/users/' . $filename);

        return $stringPath;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user)
    {
        if ($user->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'User has successfully deleted'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User can not be deleted'
            ], 500);
        }
    }

    public function getResidenceNumber()
    {
        $user = FacadesAuth::user()->residence_number;

        if ($user)
            return response()->json([
                'success' => true,
                'message' => 'Success get the residence number',
                'data' => $user,
            ], 200);
        else
            return response()->json([
                'success' => false,
                'message' => 'Data is empty!',
            ], 200);
    }

    public function getBookedResidenceNumber()
    {
        $residenceNumbers = WaitingList::select('residence_number')
            ->where('user_id', FacadesAuth::id())
            ->distinct()
            ->get();

        $residenceNumberArray = array();
        foreach ($residenceNumbers as &$item) {
            array_push($residenceNumberArray, $item->residence_number);
        }

        if ($residenceNumbers)
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mendapat NIK yang pernah didaftar',
                'data' => $residenceNumberArray,
            ], 200);
        else
            return response()->json([
                'success' => false,
                'message' => 'Data is empty!',
            ], 200);
    }
}
