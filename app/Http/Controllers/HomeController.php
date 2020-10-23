<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function showNearestWaitingList() {
        $userId = Auth::id();

        $waitingList = DB::table('waiting_list_view')
                        ->where('user_id', $userId)
                        ->where('distance_number', '>=', '0')
                        ->where(function($q) {
                            $q->where('status', 'Belum Diperiksa')
                              ->orWhere('status', 'Sedang Diperiksa');
                        })->first();
                        
        if($waitingList) 
            $message = "Successfully get nearest waiting list";
        else 
            $message = "You don\'t have any nearest waiting list";    
        
            return response()->json([
            'success' => true,
            'message' => $message,
            'waiting_list' => $waitingList,
        ], 200);
    }
}
