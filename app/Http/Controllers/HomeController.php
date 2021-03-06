<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\courseModel;
use App\Models\studentModel;
use App\Models\batchModel;
use App\Models\studentFeedback;
use App\Models\blogs;
use App\Models\ourteam;
use App\Models\videoReview;
use App\Models\contactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Illuminate\Support\Str;
use Newsletter;

class HomeController extends Controller
{
    public function index()
    {
        $blogs = blogs::orderBy('id','DESC')->limit(3)->get();
        SEOMeta::setTitle('Online & Offline IT Training Institute in Dhaka');
        OpenGraph::setTitle('Online & Offline IT Training Institute in Dhaka');
        return view('home.home',compact('blogs'));
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
            'mobileNumber'=>'required|max:11|regex:/(01)[0-9]{9}/',
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
        $message = "Candle IT Institute!\n???????????????????????? $name !\n???????????? ????????????????????????????????? ????????????????????????\n??????????????? ???????????????????????????????????? ?????????????????????:$registration";
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
        SEOMeta::setTitle('Student Feedback');
        OpenGraph::setTitle('course');
        $feedback =studentFeedback::orderBy('id','DESC')->paginate(30);
        return view('home.student_feed_back.feedback',compact('feedback'));
    }
    public function review(){
        $videoReview = videoReview::orderBy('id','ASC')->paginate(30);
        SEOMeta::setTitle('Review');
        OpenGraph::setTitle('Revoew');
        return view('home.review.review',compact('videoReview'));
    }
    public function ourteam(){
        SEOMeta::setTitle('Our Team');
        OpenGraph::setTitle('Our Team');
        $ourteams = ourteam::orderBy('id','ASC')->paginate(30);
        return view('home.ourteam.ourteam',compact('ourteams'));
    }
    public function blogs(){
        SEOMeta::setTitle('Blogs');
        OpenGraph::setTitle('Blogs');
        $blogs = blogs::orderBy('id','DESC')->paginate(30);
        return view('home.blogs.blogs',compact('blogs'));
    }
    public function blogsinglePage($slug){
        if(blogs::where('slug',$slug)->exists()){
            $blog = blogs::where('slug',$slug)->first();
            SEOMeta::setTitle($blog->title);
            SEOMeta::setDescription(Str::limit(strip_tags($blog->description), 100));
            OpenGraph::setDescription(Str::limit(strip_tags($blog->description), 100));
            OpenGraph::setTitle($blog->title);
            OpenGraph::addImage(url('/storage/blogs/'.$blog->image), ['height' => 550, 'width' => 650]);
            return view('home.blogs.single',compact('blog'));
        }else{
            return abort(404);
        }
        
    }
    public function courses(){
        SEOMeta::setTitle('Course');
        OpenGraph::setTitle('course');
        return view('home.courses.courses');
    }

    public function emailsubmit(Request $request){
       // Newsletter::subscribe($request->email);
       Newsletter::subscribe($request->email);

    }

    public function contactus(){
        SEOMeta::setTitle('Contact-us');
        OpenGraph::setTitle('Contact-us');
        return view('home.contactUs');
    }

    public function contactSubmit(Request $request){
        $request->validate([
            'name'=>'required|max:255',
            'mobile'=>'required|max:11|regex:/(01)[0-9]{9}/',
            'message'=>'required|max:1500',
        ]);
        $contact =  new contactUs();
        $contact->name = $request->name;
        $contact->mobile = $request->mobile;
        $contact->message = $request->message;
        $contact->save();
        return redirect()->back()->with('success','Your Message Sent Successfully!');

    }

    public function aboutus(){
        SEOMeta::setTitle('About-us');
        OpenGraph::setTitle('About-us');
        return view('home.aboutus');
    }

    public function privacypolicy(){
        SEOMeta::setTitle('Privacy Policy');
        OpenGraph::setTitle('Privacy Policy');
        return view('home.privacypolicy');
    }

}
