<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use File;
use Auth;
use Image;
class profileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        return "Cache is cleared";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'avatar' => 'required|image|max:500',
        ]);

        $files=$request->file('avatar');
        if($files=$request->file('avatar')){
            $exitfile =storage_path('/app/public/users/' .Auth::id().'/'.Auth::user()->image);
            if(File::exists($exitfile)){ 
                File::delete($exitfile);
                $image = Image::make($files);
                $image->resize(null, 627, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image->save(storage_path('/app/public/users/' .Auth::id().'/'. $files->getClientOriginalName()),60);
            }else{
            $folder = storage_path('/app/public/users/' . Auth::id().'/');
            if (!File::exists($folder)) {
                File::makeDirectory($folder, 0775, true, true);
                $location = storage_path('/app/public/users/' . Auth::id());

                $image = Image::make($files);
                $image->resize(null, 627, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image->save(storage_path('/app/public/users/' . Auth::id().'/'. $files->getClientOriginalName()),60);
                
            }
        }
      }
      if($files=$request->file('avatar')){
          $user = User::find(Auth::id());
          $user->image = $request->file('avatar')->getClientOriginalName();
          $user->save();
      }
      return redirect()->back()->with('image','Profile Photo Updated Successfully!');
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
        $validated = $request->validate([
            'newPassword' => 'required|min:5',
            'currentPassword' => 'required|max:255',
        ]);

        $hashedPassword = Auth::user()->password;
 
        if (Hash::check($request->currentPassword , $hashedPassword )) {
  
          if (! Hash::check($request->newPassword , $hashedPassword)) {
  
               $users = User::find(Auth::user()->id);
               $passBcrypt = Hash::make($request->newPassword);
               User::where( 'id' , Auth::user()->id)->update( array( 'password' =>$passBcrypt));
               return redirect()->back()->with('success','Password updated successfully');
             }
  
             else{
                   return redirect()->back()->with('success','New password can not be the old password!');
                 }
  
            }
  
           else{
                return redirect()->back()->with('success','Current password doesnt matched!');
            }

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
