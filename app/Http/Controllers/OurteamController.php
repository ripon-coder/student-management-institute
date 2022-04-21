<?php

namespace App\Http\Controllers;

use App\Models\ourteam;
use Illuminate\Http\Request;
use File;
use Image;
class OurteamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ourteams = ourteam::orderBy('id','DESC')->paginate(30);
        return view('pages.ourTeam.index',compact('ourteams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.ourTeam.create');
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
            'image' =>'required|image|max:1000',
            'designation' =>'required|max:255'
        ]);

        $team = new ourteam();
        $team->name = $request->name;
        $team->designation = $request->designation;
        if ($request->hasFile('image')) {
            $file = $request->image;
            $thumb = substr(uniqid(rand(), true), 8, 8) . '.' . $file->getClientOriginalExtension();
            $image = Image::make($file);
            $image->crop(358, 339);
            $image->save(storage_path('/app/public/team/'.$thumb));
            
            $team->image = $thumb;
        }
        $team->save();
        return redirect()->route('admin-team.index')->with('success','Team Member Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ourteam  $ourteam
     * @return \Illuminate\Http\Response
     */
    public function show(ourteam $ourteam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ourteam  $ourteam
     * @return \Illuminate\Http\Response
     */
    public function edit(ourteam $ourteam,$id)
    {
        $team = $ourteam->findOrFail($id);
        return view('pages.ourTeam.edit',compact('team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ourteam  $ourteam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ourteam $ourteam,$id)
    {
        $request->validate([
            'name' =>'required|max:255',
            'image' =>'required|image|max:1000',
            'designation' =>'required|max:255'
        ]);

        $team = $ourteam->findOrFail($id);
        $team->name = $request->name;
        $team->designation = $request->designation;

        if ($request->hasFile('image')) {
            $file = $request->image;
            $exitfile = storage_path('/app/public/team/' . $team->image);
            if(File::exists($exitfile)){ 
                File::delete($exitfile);
                $thumb = substr(uniqid(rand(), true), 8, 8) . '.' . $file->getClientOriginalExtension();
                $image = Image::make($file);
                $image->crop(358, 339);
                $image->save(storage_path('/app/public/team/'.$thumb));

            }else{
                $thumb = substr(uniqid(rand(), true), 8, 8) . '.' . $file->getClientOriginalExtension();
                $image = Image::make($file);
                $image->crop(358, 339);
                $image->save(storage_path('/app/public/team/'.$thumb));

            }
            $team->image = $thumb;
            
        }
        $team->save();
        return redirect()->route('admin-team.index')->with('success','Team Member Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ourteam  $ourteam
     * @return \Illuminate\Http\Response
     */
    public function destroy(ourteam $ourteam,$id)
    {
        $team = $ourteam->findOrFail($id);
        if(isset($team->image)){
            $exitfile = storage_path('/app/public/team/' . $team->image);
            if(File::exists($exitfile)){ 
                File::delete($exitfile);
            }
        }

        $team->delete();
        return redirect()->route('admin-team.index')->with('success','Team Member Deleted Successfully!');
    }
}
