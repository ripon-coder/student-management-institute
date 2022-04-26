<?php

namespace App\Http\Controllers;

use App\Models\contactUs;
use Illuminate\Http\Request;
class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contactUs = contactUs::orderBy('id','DESC')->paginate(30);
        return view('contactUs.index',compact('contactUs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\contactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function show(contactUs $contactUs,$id)
    {
        $contact = $contactUs->find($id);
        return view('contactUs.show',compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\contactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function edit(contactUs $contactUs)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\contactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, contactUs $contactUs)
    {
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\contactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function destroy(contactUs $contactUs,$id)
    {
       $contactUs->delete($id);
       return redirect()->back()->with('success','Deleted Successfully!');
    }
}
