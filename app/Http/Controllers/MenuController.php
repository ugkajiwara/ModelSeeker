<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreMenu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $menus = Menu::all();
        $loginUserId = Auth::user()->id;

        $menus = DB::table('menus')
        ->where('user_id','=',$loginUserId)
        ->select('id','menu_name','minutes','charge','requirements','is_deleted')
        ->orderBy('created_at', 'desc')
        ->get();
        // dd($menus);

        return view('menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMenu $request)
    {
        //
        $menu = new Menu;

        
        $menu->user_id = $request->input('user_id');
        $menu->menu_name = $request->input('menu_name');
        $menu->minutes = $request->input('minutes');
        $menu->charge = $request->input('charge');
        $menu->requirements = $request->input('requirements');


        $menu->save();

        return redirect('menu/index');

        // dd($menu_name);
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
        $menu = Menu::find($id);
        $loginUserId = Auth::user()->id;
        $selectedMenuId = $menu->user_id;
        $deletedMenuValidator = $menu->is_deleted;

        if($loginUserId == $selectedMenuId && $deletedMenuValidator == 0 ){
            return view('menu.show', compact('menu'));
        }else{
            return redirect('menu/index');
        }


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
        $menu = Menu::find($id);

        return view('menu.edit', compact('menu'));
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
        $menu = Menu::find($id);

        $menu->menu_name = $request->input('menu_name');
        $menu->minutes = $request->input('minutes');
        $menu->charge = $request->input('charge');
        $menu->requirements = $request->input('requirements');


        $menu->save();

        return redirect('menu/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        $menu = Menu::find($id);
        $menu->is_deleted = 1;
        $menu->save();


        return redirect('menu/index');

    }
}
