<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BatchExport;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\batchModel;
use App\Models\studentModel;
use App\Models\courseModel;
class batchcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

         $batchs = Cache::remember('batch_models', 120, function () {
            return batchModel::withCount(['student as fullPaid'=>function($query){
                $query->whereColumn('payAmount','>=','totalAmount');
            },'student as duePaid' => function ($query){
                $query->whereColumn('totalAmount','>','payAmount')->where('payAmount','>',0);
            },'student as unpaid' => function ($query){
                $query->where('payAmount','<=',0);
            }
            ])->orderBy('id','DESC')->paginate(20);
        });


        return view('batch.index',compact('batchs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('batch.create');
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
            'batchNumber' =>'required|max:255|unique:batch_models,batchno',
            'courseName' =>'required|max:255',
            'classOnWeek' =>'required|max:255',
            'duration' =>'required|max:255',
            'startDate' =>'required|max:255',
            'endDate' =>'required|max:255',
            'classTime' =>'required|max:255',
            'expectedStudent' =>'required|max:255',
            'mentor' =>'required|max:255',
            'visibility' =>'required|max:255',
            'classOnDay' =>'required|max:255',
        ]);

        $mentorProfile = User::find($request->mentor);
        $batch = new batchModel();
        $batch->batchno = $request->batchNumber;
        $batch->course_id = $request->courseName;
        $batch->classOnWeek = $request->classOnWeek;
        $batch->duration = $request->duration;
        $batch->startdate = $request->startDate;
        $batch->enddate = $request->endDate;
        $batch->classtime = $request->classTime;
        $batch->expectedStudent = $request->expectedStudent;
        $batch->mentor_id  = $request->mentor;
        $batch->mentor_name = $mentorProfile->name;
        if($request->visibility == 'On'){
            $batch->status = 1;
        }else{
            $batch->status = 0;
        }
       
        $batch->classOnDay = $request->classOnDay;
        $batch->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $batch = batchModel::findOrFail($id);
        return view('batch.show',compact('batch'));
    }

    public function fullypaidBatch($id){
        $batchinfo = batchModel::findOrFail($id);
        $students = studentModel::where('batch_id',$id)->whereColumn('payAmount','>=','totalAmount')->paginate(30);
        return view('batch.batchByStudent',compact('students','batchinfo'));
    }

    public function duepaidBatch($id){
        $batchinfo = batchModel::findOrFail($id);
        $students = studentModel::where('batch_id',$id)->whereColumn('totalAmount','>','payAmount')->where('payAmount','>',0)->paginate(30);
        return view('batch.batchByStudent',compact('students','batchinfo'));
    }

    public function unpaidBatch($id){
        $batchinfo = batchModel::findOrFail($id);
        $students = studentModel::where('batch_id',$id)->where('payAmount','<=',0)->paginate(30);
        return view('batch.batchByStudent',compact('students','batchinfo'));
    }

    public function get_student_by_batch($id){

        $students =  studentModel::whereHas('payment')->withSum('payment','amount')->with(['batch','course','referenced'])->where('batch_id',$id)->get();

        return response($students, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $batch = batchModel::findOrFail($id);
        return view('batch.edit',compact('batch'));
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
        //
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

    public function getMentor(){
        return response()->json([
 
            'Mentors' => User::get(),

  
         ], Response::HTTP_OK);
    }

    public function getCourse(){
        return response()->json([
            'courses' => courseModel::where('status',1)->get(),
         ], Response::HTTP_OK);
    }

    public function getBatch($id){
        return response()->json([
            'batch' => batchModel::find($id),
         ], Response::HTTP_OK);
    }



    public function updateBatch(Request $request,$id){
        $request->validate([
            'batchNumber' =>'required|max:255',
            'courseName' =>'required|max:255',
            'classOnWeek' =>'required|max:255',
            'duration' =>'required|max:255',
            'startDate' =>'required|max:255',
            'endDate' =>'required|max:255',
            'classTime' =>'required|max:255',
            'expectedStudent' =>'required|max:255',
            'mentor' =>'required|max:255',
            'visibility' =>'required|max:255',
            'classOnDay' =>'required|max:255',
        ]);
        $mentorProfile = User::find($request->mentor);
        $batch = batchModel::find($id);
        $batch->batchno = $request->batchNumber;
        $batch->course_id = $request->courseName;
        $batch->classOnWeek = $request->classOnWeek;
        $batch->duration = $request->duration;
        $batch->startdate = $request->startDate;
        $batch->enddate = $request->endDate;
        $batch->classtime = $request->classTime;
        $batch->expectedStudent = $request->expectedStudent;
        $batch->mentor_id  = $request->mentor;
        $batch->mentor_name = $mentorProfile->name;
        if($request->visibility == 'On'){
            $batch->status = 1;
        }else{
            $batch->status = 0;
        }
        $batch->classOnDay = $request->classOnDay;
        $batch->save();
    }
    public function get_all_Batch(){
        $batch = batchModel::get();
        return response($batch, 200);
    }

    public function get_all_Batchfilter($studentid){
        $student = studentModel::find($studentid);
        $batch = batchModel::where('course_id',$student->course_id)->where('status',1)->get();
        return response($batch, 200);

    }
    
    public function fullypaidExport($id){
        $batch = batchModel::findOrFail($id);
        return Excel::download(new BatchExport($id), 'Batch_'.$batch->batchno.'.xlsx');
    }




}
