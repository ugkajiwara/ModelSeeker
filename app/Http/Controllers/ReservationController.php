<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $y = isset($_GET['y'])? htmlspecialchars($_GET['y'], ENT_QUOTES, 'utf-8') : '';
        $m = isset($_GET['m'])? htmlspecialchars($_GET['m'], ENT_QUOTES, 'utf-8') : '';
        $d = isset($_GET['d'])? htmlspecialchars($_GET['d'], ENT_QUOTES, 'utf-8') : '';
        $userIdFromUrl = isset($_GET['user_id'])? htmlspecialchars($_GET['user_id'], ENT_QUOTES, 'utf-8') : '';
        // $displayFromUserId = Auth::user()->id;
        
        $calendars = DB::table('calendars')
        ->where('user_id','=',$userIdFromUrl)
        ->where('year','=',$y)
        ->where('month','=',$m)
        ->where('day','=',$d)
        ->where('is_reserved','=',0)
        ->select('id','user_id','menu_id','time','is_reserved')
        ->orderBy('time', 'asc')
        ->get();

        $menus = DB::table('menus')
        ->where('user_id','=',$userIdFromUrl)
        ->select('id','menu_name','minutes','charge','requirements')
        ->orderBy('created_at', 'desc')
        ->get();

        $user = DB::table('users')
        ->find($userIdFromUrl);

        return view('reservation.index', compact('calendars','menus','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $userIdFromUrl = isset($_GET['user_id'])? htmlspecialchars($_GET['user_id'], ENT_QUOTES, 'utf-8') : '';
        $calendarIdFromUrl = isset($_GET['calendar_id'])? htmlspecialchars($_GET['calendar_id'], ENT_QUOTES, 'utf-8') : '';
        $menuIdFromUrl = isset($_GET['menu_id'])? htmlspecialchars($_GET['menu_id'], ENT_QUOTES, 'utf-8') : '';

        $calendar = DB::table('calendars')
        ->find($calendarIdFromUrl,['id','user_id','menu_id','year','month','day','time','is_reserved']);

        $menu = DB::table('menus')
        ->find($menuIdFromUrl,['id','menu_name','minutes','charge','requirements']);

        $user = DB::table('users')
        ->find($userIdFromUrl,['id','name','salon_name','salon_address','salon_tel']);

        return view('reservation.create',  compact('calendar','menu','user'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function confirm(Request $request)
    {
        //
        $user_id = $request->user_id;
        $menu_id = $request->menu_id;
        $calendar_id = $request->calendar_id;

        $user = DB::table('users')
        ->find($user_id,['id','name','salon_name','salon_address','salon_tel']);

        $menu = DB::table('menus')
        ->find($menu_id,['id','menu_name','minutes','charge','requirements']);

        $calendar = DB::table('calendars')
        ->find($calendar_id,['id','user_id','menu_id','year','month','day','time','is_reserved']);
        

        $inputs = $request->all();

        return view('reservation.confirm', compact('inputs', 'user', 'menu', 'calendar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
        $reservation = new Reservation;
        
        $reservation->user_id = $request->input('user_id');
        $reservation->menu_id = $request->input('menu_id');
        $reservation->calendar_id = $request->input('calendar_id');
        $reservation->name = $request->input('name');
        $reservation->gender = $request->input('gender');
        $reservation->email = $request->input('email');
        $reservation->tel = $request->input('tel');

        
        
        
        $user_id = $reservation->user_id;
        $menu_id = $reservation->menu_id;
        $calendar_id = $reservation->calendar_id;
        
        $user = DB::table('users')
        ->find($user_id,['id','name','salon_name','salon_address','salon_tel']);
        
        $menu = DB::table('menus')
        ->find($menu_id,['id','menu_name','minutes','charge','requirements']);
        
        $selectedCalendar = DB::table('calendars')
        ->find($calendar_id,['id','user_id','menu_id','year','month','day','time','is_reserved']);
        if($selectedCalendar->is_reserved == 0 ){
             $reservation->save();

             $calendar = Calendar::find($calendar_id);
             $calendar->is_reserved = 1;
             $calendar->save();
        }else{
             echo "エラーが発生しました。画面を閉じてやり直してください。";
             exit;
        }

        return view('reservation/thanks', compact('reservation', 'user', 'menu', 'selectedCalendar'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function thanks()
    {
        return view('reservation.thanks');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
