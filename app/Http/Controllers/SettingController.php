<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Http\Requests\StoreUser;

class SettingController extends Controller
{
    //
    public function index()
    {

        $loginUserId = Auth::user()->id;

        $user = DB::table('users')
        ->find($loginUserId,['id','name','gender','email','salon_name','salon_address','salon_tel']);
        

        return view('setting.index',compact('user'));
    }

    public function how_to_use()
    {
        return view('setting.how_to_use');
    }

    public function faq()
    {
        return view('setting.faq');
    }

    public function contact()
    {
        return view('setting.contact');
    }

    public function terms()
    {
        return view('setting.terms');
    }

    public function privacy_policy()
    {
        return view('setting.privacy_policy');
    }

    public function edit() 
    {
        $loginUserId = Auth::user()->id;

        $user = DB::table('users')
        ->find($loginUserId,['id','name','gender','email','password','salon_name','salon_address','salon_tel']);
        
        return view('setting.edit',compact('user'));
    }


    public function update(StoreUser $request)
    {
        //
        $user = User::find(Auth::user()->id);

        $user->name = $request->input('name');
        $user->gender = $request->input('gender');
        $user->email = $request->input('email');
        $user->salon_name = $request->input('salon_name');
        $user->salon_tel = $request->input('salon_tel');
        $user->salon_address = $request->input('salon_address');

        // dd($user);
        $user->save();

        return redirect('setting/index');


    }

}
