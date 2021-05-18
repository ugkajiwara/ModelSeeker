<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use  App\Models\Calendar;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $loginUserId = Auth::user()->id;
        
        $calendars = DB::table('calendars')
        ->where('user_id','=',$loginUserId)
        ->select('id','user_id','menu_id','year','month','day','time','is_reserved')
        ->orderBy('time', 'asc')
        ->get();

        $menus = DB::table('menus')
        ->where('user_id','=',$loginUserId)
        ->select('id','menu_name','minutes','charge','requirements')
        ->orderBy('created_at', 'desc')
        ->get();

        return view('calendar.index', compact('calendars','menus'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $loginUserId = Auth::user()->id;
        //
        $menus = DB::table('menus')
        ->where('user_id','=',$loginUserId)
        ->select('id','menu_name','minutes','charge','requirements','is_deleted')
        ->orderBy('created_at', 'desc')
        ->get();
        return view('calendar.create',compact('menus'));
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
        $calendar = new Calendar;

        $calendar->user_id = $request->input('user_id');
        $calendar->year = $request->input('year');
        $calendar->month = $request->input('month');
        $calendar->day = $request->input('day');
        $calendar->time = $request->input('time');

        $calendar->menu_id = implode(",",$request->input('menu_id'));

        // dd($calendar->menu_id);

        $calendar->save();

        $y = isset($_GET['y'])? htmlspecialchars($_GET['y'], ENT_QUOTES, 'utf-8') : '';
        $m = isset($_GET['m'])? htmlspecialchars($_GET['m'], ENT_QUOTES, 'utf-8') : '';
        $d = isset($_GET['d'])? htmlspecialchars($_GET['d'], ENT_QUOTES, 'utf-8') : '';

        return redirect('calendar/index?y='.$y.'&&m='.$m.'&&d='.$d);
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
        $calendar = Calendar::find($id);

        return view('calendar.show', compact('calendar'));
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