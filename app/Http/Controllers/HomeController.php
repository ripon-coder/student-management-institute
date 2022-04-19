<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\courseModel;
use App\Models\studentModel;
use App\Models\batchModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.home');
    }

    public function scholarshipForm(){
        $references = User::select('id','name')->where('cro_show',1)->where('status',1)->get();
        $course =   courseModel::where('status',1)->get();
        $batch =    batchModel::where('status',1)->get();
        return view('home.scholarshipForm',compact('references','course','batch'));
        }


    public function formstore(Request $request){
        $request->validate([
            'name'=>'required|max:255',
            'fatherName'=>'required|max:255',
            'motherName'=>'required|max:255',
            'mobileNumber'=>'required|max:255',
            'dateBirth'=>'required|max:255',
            'gender'=>'required|max:255|not_in:0',
            'presentAddress'=>'required|max:1000',
            'facebookName'=>'nullable|max:255',
            'educationalQualification'=>'required|max:255||not_in:0',
            'reference'=>'required|max:255|not_in:0',
            'batch'=>'required|max:255|exists:batch_models,batchno,status,1',
            'method'=>'required|max:255|not_in:0',
            'course'=>'required|max:255|not_in:0',
        ]);
        $ref = User::findOrFail($request->reference);
        if($ref->on_off ===1){

        $student = new studentModel();
        $student->name = $request->name;
        $student->fathername = $request->fatherName;
        $student->mothername = $request->motherName;

        $student->course_id = $request->course;

        $student->address = $request->presentAddress;
        $student->mobile = $request->mobileNumber;
        $batchdata = batchModel::where('batchno',$request->batch)->first();
        $student->batch_id = $batchdata->id;
        $student->fbname = $request->facebookName;
        $student->dateofbirth = $request->dateBirth;
        $student->gender = $request->gender;
        $student->reference_id = $request->reference;
        $student->education = $request->educationalQualification;
        $student->hwpay = $request->method;
        $course = courseModel::findOrFail($request->course);
        $student->totalAmount = $course->discount_price;
        $student->save();

        Session::put('student',$student);
        
        
        // SMS SEND
        
        $name =$student->name;
        $registration = $student->id;
        $message = "Candle IT Institute!\nঅভিনন্দন $name !\nআপনি স্কলারশিপটি পেয়েছেন।\nআপনার রেজিষ্ট্রেশন নাম্বার:$registration";
        $url = "http://gsms.pw/smsapi";
        $data = [
          "api_key" => "C200039561c6fd02e3c777.55704589",
          "type" => "text",
          "contacts" => $student->mobile,
          "senderid" => "8809601004598",
          "msg" => $message,
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
            return redirect()->route('congratulations');
        }else{
            Session::put('refmobile',$ref->mobile);
            return redirect()->route('error');
        }

    }
    public function congratulations(){
        return view('home.congratulations');
    }
    public function error(){
        return view('home.error');
    }
    public function stFeedback(){
        return view('home.student_feed_back.feedback');
    }
    public function review(){
        return view('home.review.review');
    }
    public function ourteam(){
        return view('home.ourteam.ourteam');
    }
    public function blogs(){
        return view('home.blogs.blogs');
    }
    public function courses(){
        return view('home.courses.courses');
    }
}
