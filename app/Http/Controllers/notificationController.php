<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class notificationController extends Controller
{
    //
    public function index()
    {
        $loginUserId = Auth::user()->id;

        $reservations = DB::table('reservations')
        ->where('user_id','=',$loginUserId)
        ->select('calendar_id','name','created_at')
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return view('notification.index', compact('reservations'));
    }
}
