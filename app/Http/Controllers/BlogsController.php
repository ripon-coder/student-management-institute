<?php

namespace App\Http\Controllers;

use App\Models\blogs;
use Illuminate\Http\Request;
use File;
use Image;
class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = blogs::orderBy('id','DESC')->paginate(30);
        return view('pages.blogs.index',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.blogs.create');
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
            'description' =>'required'
        ]);

        $blog = new blogs();
        $blog->title = $request->title;
        $blog->description = $request->description;
        if ($request->hasFile('image')) {
            $file = $request->image;
            $thumb = substr(uniqid(rand(), true), 8, 8) . '.' . $file->getClientOriginalExtension();
            $image = Image::make($file);
            $image->resize(null, 627, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image->save(storage_path('/app/public/blogs/'.$thumb));
            
            $blog->image = $thumb;
        }
        $blog->save();
        return redirect()->route('blogs-admin.index')->with('success','Blog Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function show(blogs $blogs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function edit(blogs $blogs,$id)
    {
        $blog = $blogs->findOrFail($id);
        return view('pages.blogs.edit',compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, blogs $blogs,$id)
    {
        $request->validate([
            'title' =>'required|max:255',
            'image' =>'nullable|image|max:1000',
            'description' =>'required'
        ]);

        $blog = $blogs->findOrFail($id);
        $blog->title = $request->title;
        $blog->description = $request->description;

        if ($request->hasFile('image')) {
            $file = $request->image;
            $exitfile = storage_path('/app/public/blogs/' . $blog->image);
            if(File::exists($exitfile)){ 
                File::delete($exitfile);
                $thumb = substr(uniqid(rand(), true), 8, 8) . '.' . $file->getClientOriginalExtension();
                $image = Image::make($file);
                $image->resize(null, 627, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image->save(storage_path('/app/public/blogs/'.$thumb));

            }else{
                $thumb = substr(uniqid(rand(), true), 8, 8) . '.' . $file->getClientOriginalExtension();
                $image = Image::make($file);
                $image->resize(null, 627, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image->save(storage_path('/app/public/blogs/'.$thumb));

            }
            $blog->image = $thumb;
            
        }
        $blog->save();
        return redirect()->route('blogs-admin.index')->with('success','Blog Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function destroy(blogs $blogs,$id)
    {
        $blog = $blogs->findOrFail($id);
        if(isset($blog->image)){
            $exitfile = storage_path('/app/public/blogs/' . $blog->image);
            if(File::exists($exitfile)){ 
                File::delete($exitfile);
            }
        }

        $blog->delete();
        return redirect()->route('blogs-admin.index')->with('success','Blog Deleted Successfully!');
    }
}
