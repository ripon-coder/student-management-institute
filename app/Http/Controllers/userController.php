<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $AllUser = User::with('roles')->orderBy('id','DESC')->paginate(20);
        return view('users.index',compact('AllUser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $AllRole = Role::get();
        return view('users.create',compact('AllRole'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required|max:255',
            'mobile' =>'required|max:255',
            'address' =>'nullable|max:1500',
            'facebook' =>'nullable|max:255',
            'email' =>'required|max:255|email|unique:users,email',
            'password' =>'required|min:5|max:255',
            'role' =>'required|not_in:0'
        ]);
       $user = new User();
       $user->name = $request->name;
       $user->mobile = $request->mobile;
       $user->address = $request->address;
       $user->facebook = $request->facebook;
       $user->email = $request->email;
       $user->password = Hash::make($request->password);
       $user->cro_show = $request->croShow;
       $user->save();
       $user->assignRole($request->role);
       return redirect()->route('users.index')->with('success','User Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $user = User::with('roles')->where('id',$id)->first();
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $AllRole = Role::get();
        return view('users.edit',compact('AllRole','user'));
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
        $request->validate([
            'name' =>'required|max:255',
            'mobile' =>'required|max:255',
            'address' =>'nullable|max:1500',
            'facebook' =>'nullable|max:255',
            'password' =>'nullable|min:5|max:255',
            'role' =>'required|not_in:0'
        ]);
       $user = User::findOrFail($id);
       $user->syncRoles([$request->role]);
       $user->name = $request->name;
       $user->mobile = $request->mobile;
       $user->address = $request->address;
       $user->facebook = $request->facebook;
       if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        if ($request->has('status')) {
            $user->status = $request->status;
        }
       if($request->croShow == 1){
        $user->cro_show = 1;
       }else{
        $user->cro_show = 0;
       }
       $user->save();

       return redirect()->route('users.index')->with('success','User Updated Successfully!');
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
    
    public function loginbyadmin($id){
        Auth::loginUsingId($id);
        return redirect()->route('dashboard');
    }

    public function banned(){
        return view('users.banned');
    }
}
