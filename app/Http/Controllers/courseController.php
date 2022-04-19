<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\courseModel;
class courseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cousers = courseModel::orderBy('id','DESC')->paginate(20);
        return view('course.index',compact('cousers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('course.create');
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
            'course' =>'required|max:255',
            'amount' =>'required|integer|min:1|max:100000',
            'discountamount' =>'required|integer|min:1|max:100000',
        ]);
        $course = new courseModel();
        $course->title = $request->course;
        $course->price = $request->amount;
        $course->discount_price = $request->discountamount;
        $discount = ($request->discountamount * 100 ) / $request->amount;
        $course->discount = 100-$discount ;
        $course->save();
        return redirect()->route('course.index')->with('success','Couser Created Successfully!');
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
        $course = courseModel::findOrFail($id);
        return view('course.edit',compact('course'));
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
            'course' =>'required|max:255',
            'amount' =>'required|min:1|max:100000',
            'discountamount' =>'required|min:1|max:100000',
        ]);
        $course = courseModel::findOrFail($id);
        $course->title = $request->course;
        $course->price = $request->amount;
        $course->discount_price = $request->discountamount;
        $discount = ($request->discountamount * 100 ) / $request->amount;
        $course->discount = 100-$discount;
        $course->status = $request->status;
        $course->save();
        return redirect()->route('course.index')->with('success','Couser Updated Successfully!');
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
