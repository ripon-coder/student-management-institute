<?php

namespace App\Http\Controllers;

use App\Models\Announce;
use Illuminate\Http\Request;

class AnnounceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $announce = Announce::orderBy('id','DESC')->paginate(30);
        return view('announce.index',compact('announce'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('announce.create');
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
            'title' =>'required|max:255',
            'description' =>'required'
        ]);

        $announce = new Announce();
        $announce->title = $request->title;
        $announce->announce = $request->description;
        $announce->status = $request->status;
        $announce->save();
        return redirect()->route('announce.index')->with('success','Announce Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Announce  $announce
     * @return \Illuminate\Http\Response
     */
    public function show(Announce $announce)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Announce  $announce
     * @return \Illuminate\Http\Response
     */
    public function edit(Announce $announce)
    {
        return view('announce.edit',compact('announce'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Announce  $announce
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Announce $announce)
    {
        $request->validate([
            'title' =>'required|max:255',
            'description' =>'required'
        ]);
        $announce->title = $request->title;
        $announce->announce = $request->description;
        $announce->status = $request->status;
        $announce->save();
        return redirect()->route('announce.index')->with('success','Announce Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Announce  $announce
     * @return \Illuminate\Http\Response
     */
    public function destroy(Announce $announce)
    {
        $announce->delete();
        return redirect()->route('announce.index')->with('success','Announce Deleted Successfully!');
    }
}
