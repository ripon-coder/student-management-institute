<?php

namespace App\Http\Controllers;

use App\Models\studentFeedback;
use Illuminate\Http\Request;
use Image;
use File;

class StudentFeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studentFeedback = studentFeedback::orderBy('id','DESC')->paginate(30);
        return view('pages.feedback.index',compact('studentFeedback'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.feedback.create');
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
            'image' =>'required|image|max:1000',
        ]);
       $feedback = new studentFeedback();
       $feedback->title = $request->title;

       if ($request->hasFile('image')) {
        $file = $request->image;
        $thumb = substr(uniqid(rand(), true), 8, 8) . '.' . $file->getClientOriginalExtension();
        $image = Image::make($file);
        $image->resize(null, 627, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image->save(storage_path('/app/public/feedback/'.$thumb));
        
        $feedback->image = $thumb;
    }
    $feedback->save();
    return redirect()->route('feedback.index')->with('success','Student-Feedback Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\studentFeedback  $studentFeedback
     * @return \Illuminate\Http\Response
     */
    public function show(studentFeedback $studentFeedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\studentFeedback  $studentFeedback
     * @return \Illuminate\Http\Response
     */
    public function edit(studentFeedback $studentFeedback,$id)
    {
        $feedback = $studentFeedback->find($id);
        return view('pages.feedback.edit',compact('feedback'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\studentFeedback  $studentFeedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, studentFeedback $studentFeedback,$id)
    {
        $request->validate([
            'title' =>'required|max:255',
            'image' =>'nullable|image|max:1000',
        ]);

        $feedback = $studentFeedback->findOrFail($id);
        $feedback->title = $request->title;

        if ($request->hasFile('image')) {
            $file = $request->image;
            $exitfile = storage_path('/app/public/feedback/' . $feedback->image);
            if(File::exists($exitfile)){ 
                File::delete($exitfile);
                $thumb = substr(uniqid(rand(), true), 8, 8) . '.' . $file->getClientOriginalExtension();
                $image = Image::make($file);
                $image->resize(null, 627, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image->save(storage_path('/app/public/feedback/'.$thumb));
                $feedback->image = $thumb;
            }else{
                $thumb = substr(uniqid(rand(), true), 8, 8) . '.' . $file->getClientOriginalExtension();
                $image = Image::make($file);
                $image->resize(null, 627, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image->save(storage_path('/app/public/feedback/'.$thumb));
                $feedback->image = $thumb;
            }
        }
        $feedback->save();
        return redirect()->route('feedback.index')->with('success','Feedback Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\studentFeedback  $studentFeedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(studentFeedback $studentFeedback,$id)
    {
        $feedback = $studentFeedback->findOrFail($id);
        if(isset($feedback->image)){
            $exitfile = storage_path('/app/public/feedback/' . $feedback->image);
            if(File::exists($exitfile)){ 
                File::delete($exitfile);
            }
        }
        $feedback->delete();
        return redirect()->route('feedback.index')->with('success','Feedback Deleted Successfully!');
    }
}
