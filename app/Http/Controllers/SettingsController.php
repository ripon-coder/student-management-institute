<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
class SettingsController extends Controller
{
    public function index(){
        return view('settings.index');
    }

    public function updatesettings(Request $request){
        if($request->filled('formoff')){
            User::find(Auth::id())->update(['on_off' => 0]);
            return redirect()->back()->with('success','Update Successfully!');
        }else{
            User::find(Auth::id())->update(['on_off' => 1]);
            return redirect()->back()->with('success','Update Successfully!');
        }
    }
}
