<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Rules\MatchOldPassword;

class UserController extends Controller
{
//    public function __construct() {
//       $this->middleware('api');
//    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
            'name' => 'required|string|between:3,150',
            'email' => 'required|string|email|unique:users|max:100',
            'password' => 'required|string|min:6',
            'phone' => 'required|numeric|digits_between:8,13',
            'role' => 'required|string',
            'residence_number' => 'nullable|numeric|unique:users|digits:16',
            'health_agency' => 'nullable|numeric'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
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

        return response()->json([
            'success' => true,
            'message' => 'new User has successfully created',
            'user' => $user
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json($user, 200);
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:3,150',
            'email' => 'required|string|email|unique:users,email,' .$user->id. '|max:100',
            'password' => 'required|string|min:6',
            'phone' => 'required|numeric|digits_between:8,13',
            'role' => 'required|string',
            'residence_number' => 'nullable|numeric|unique:users,residence_number,' .$user->id. '|digits:16',
            'health_agency' => 'nullable|numeric'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $updated = User::where('id', $user->id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'role' => $request->role,
                'residence_number' => $request->residence_number,
                'health_agency_id' => $request->health_agency,
                'password' => bcrypt($request->password)
            ]);

        if ($updated)
            return response()->json([
                'success' => true,
                'message' => 'User data updated successfully!'
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
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
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

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'User has successfully deleted'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User can not be deleted'
            ], 500);
        }
    }
}
