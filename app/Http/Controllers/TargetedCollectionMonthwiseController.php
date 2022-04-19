<?php

namespace App\Http\Controllers;

use App\Models\targetedCollectionMonthwise;
use Illuminate\Http\Request;
Use Alert;
class TargetedCollectionMonthwiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $targated = targetedCollectionMonthwise::orderBy('id','DESC')->paginate(20);
        return view('monthlyTarget.index',compact('targated'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('monthlyTarget.create');
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
            'title' =>'required',
            'amount' =>'required',
            'month' =>'required',
        ]);
        $date = strtotime($request->month);
        $target_date = date('Y-m-d H:i:s', $date);
        if(targetedCollectionMonthwise::where('targetmonth',$target_date)->doesntExist()){
        $target = new targetedCollectionMonthwise();
        $target->title = $request->title;
        $target->requiredAmount = $request->amount;
        $target->targetmonth = $target_date;
        $target->save();
        return redirect()->route('target.index')->with('success','Created SuccessFully!');
        }else{
            Alert::error('Error!', 'This Month have already!');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\targetedCollectionMonthwise  $targetedCollectionMonthwise
     * @return \Illuminate\Http\Response
     */
    public function show(targetedCollectionMonthwise $targetedCollectionMonthwise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\targetedCollectionMonthwise  $targetedCollectionMonthwise
     * @return \Illuminate\Http\Response
     */
    public function edit(targetedCollectionMonthwise $targetedCollectionMonthwise)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\targetedCollectionMonthwise  $targetedCollectionMonthwise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, targetedCollectionMonthwise $targetedCollectionMonthwise)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\targetedCollectionMonthwise  $targetedCollectionMonthwise
     * @return \Illuminate\Http\Response
     */
    public function destroy(targetedCollectionMonthwise $targetedCollectionMonthwise)
    {
        //
    }
}
