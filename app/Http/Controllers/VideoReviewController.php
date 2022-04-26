<?php

namespace App\Http\Controllers;

use App\Models\videoReview;
use Illuminate\Http\Request;
use Image;
use File;
class VideoReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videoreview = videoReview::orderBy('id','DESC')->paginate(30);
        return view('pages.review.index',compact('videoreview'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.review.create');
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
            'image' =>'nullable|image|max:1000',
            'youtube' =>'required|max:255|url',
        ]);

        $videoreview = new videoReview();
        $videoreview->title = $request->title;
        $videoreview->link = $request->youtube;
        if ($request->hasFile('image')) {
         $file = $request->image;
         $thumb = substr(uniqid(rand(), true), 8, 8) . '.' . $file->getClientOriginalExtension();
         $image = Image::make($file);
         $image->fit(765, 419);
         $image->save(storage_path('/app/public/review/'.$thumb));
         
         $videoreview->thumbnail = $thumb;
     }
     $videoreview->save();
     return redirect()->route('video-review.index')->with('success','Review Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\videoReview  $videoReview
     * @return \Illuminate\Http\Response
     */
    public function show(videoReview $videoReview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\videoReview  $videoReview
     * @return \Illuminate\Http\Response
     */
    public function edit(videoReview $videoReview)
    {
        return view('pages.review.edit',compact('videoReview'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\videoReview  $videoReview
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, videoReview $videoReview)
    {
        $request->validate([
            'title' =>'required|max:255',
            'image' =>'nullable|image|max:1000',
            'youtube' =>'required|max:255|url',
        ]);

        //return $request->title;
        $videoReview->title = $request->title;

        if ($request->hasFile('image')) {
            $file = $request->image;
            $exitfile = storage_path('/app/public/review/' . $videoReview->thumbnail);
            if(File::exists($exitfile)){ 
                File::delete($exitfile);
                $thumb = substr(uniqid(rand(), true), 8, 8) . '.' . $file->getClientOriginalExtension();
                $image = Image::make($file);
                $image->fit(765, 419);
                $image->save(storage_path('/app/public/review/'.$thumb));
                $videoReview->thumbnail = $thumb;
            }else{
                $thumb = substr(uniqid(rand(), true), 8, 8) . '.' . $file->getClientOriginalExtension();
                $image = Image::make($file);
                $image->fit(765, 419);
                $image->save(storage_path('/app/public/review/'.$thumb));
                $videoReview->thumbnail = $thumb;
            }
        }
        $videoReview->save();
        return redirect()->route('video-review.index')->with('success','Review Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\videoReview  $videoReview
     * @return \Illuminate\Http\Response
     */
    public function destroy(videoReview $videoReview)
    {
        if(isset($videoReview->thumbnail)){
            $exitfile = storage_path('/app/public/review/' . $videoReview->thumbnail);
            if(File::exists($exitfile)){ 
                File::delete($exitfile);
            }
        }
        $videoReview->delete();
        return redirect()->route('video-review.index')->with('success','Review Deleted Successfully!');
    }
}
