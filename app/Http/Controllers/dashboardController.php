<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Builder;
use App\Models\studentModel;
use App\Models\User;
use App\Models\paymentModel;
use App\Models\targetedCollectionMonthwise;
use App\Models\Announce;
use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;
use Spatie\Activitylog\Models\Activity;
use Carbon\Carbon;
use Auth;
use PDF;
use DB;
class dashboardController extends Controller
{
    public function index(){
        $data = [];

          $data['ranking'] = User::whereHas('student',function(Builder $q){
                $q->whereYear('created_at', Carbon::now()->year)
                  ->whereMonth('created_at', Carbon::now()->month);
        })->withCount(['student as formCount' => function ($query) {
            $query->whereYear('created_at', Carbon::now()->year)
                    ->whereMonth('created_at', Carbon::now()->month);
      }])->withCount(['student' => function ($query) {
             $query->whereYear('created_at', Carbon::now()->year)
                    ->whereMonth('created_at', Carbon::now()->month)
                    ->where('payAmount','>=', 1);
        }])
        ->where('cro_show',1)
        ->where('status',1)
        ->limit(4)
        ->orderBy('student_count','DESC')
        ->get();

        $data['announce'] = Announce::where('status',1)->get();

        // Admin
        if(Auth::user()->hasRole('Admin') == true){
        $data['todayCollection'] = paymentModel::whereDate('created_at','=', date('Y-m-d'))->sum('amount');
         $data['monthlyCollection'] = paymentModel::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at',  Carbon::now()->month)->sum('amount');
        // 

        $data['targetedCollection'] = targetedCollectionMonthwise::whereYear('targetmonth', Carbon::now()->year)->whereMonth('targetmonth', Carbon::now()->month)->first();
        if(isset($data['targetedCollection'])){
        $monthNum = Carbon::parse($data['targetedCollection']->targetmonth)->format('m');
        $data['required'] = $data['targetedCollection']->requiredAmount / Carbon::now()->month($monthNum)->daysInMonth;
        $data['average'] = $data['monthlyCollection']/Carbon::now()->format('d');
        }

        // 
        $data['amountTotal'] = studentModel::where('payAmount','>=',1)->sum('totalAmount');
        $data['duePayment'] = studentModel::where('payAmount','>=',1)->sum('payAmount');

        $data['todayAdmission'] = studentModel::whereDate('created_at', date('Y-m-d'))->where('payAmount','>=',1)->count();
        $data['todayForm'] = studentModel::whereDate('created_at', date('Y-m-d'))->count();

        $data['monthlyAdmission'] = studentModel::whereYear('created_at', Carbon::now()->year)->where('payAmount','>=',1)->whereMonth('created_at', Carbon::now()->month)->count();
        $data['monthlyForm'] = studentModel::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at',  Carbon::now()->month)->count();

        $data['reminderAdmin'] = studentModel::whereDate('reminder_time','=',date('Y-m-d'))->get();


        }
        // CRO
        if(Auth::user()->hasRole('CRO') == true){

        $data['todayAdmission'] = studentModel::where('payAmount','>=',1)->whereDate('created_at', date('Y-m-d'))->where('reference_id',Auth::id())->count();
        $data['todayForm'] = studentModel::whereDate('created_at', date('Y-m-d'))->where('reference_id',Auth::id())->count();
        $data['monthlyAdmission'] = studentModel::where('payAmount','>=',1)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->where('reference_id',Auth::id())->count();
        $data['totalAdmission'] = studentModel::where('payAmount','>=',1)->where('reference_id',Auth::id())->count();
        $data['pendingAdmission'] = studentModel::where('payAmount','=',0)->where('reference_id',Auth::id())->count();
        $data['monthlyCollection'] = paymentModel::where('user_id',Auth::id())->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->sum('amount');


        $data['reminderCro'] = studentModel::whereDate('reminder_time','=',date('Y-m-d'))->where('reference_id',Auth::id())->get();

        }

        return view('dashboard.index',compact('data'));
    }

    public function invoiceCreate($id){
        $student = studentModel::find($id);
        return view('pdf.invoice',compact('student'));
        $pdf = PDF::loadView('pdf.invoice',compact('student'));
        return $pdf->stream($student->name.'_'.$student->created_at.'.pdf');
    }

    public function crochart(){
        $data = studentModel::select(
            DB::raw("(COUNT(*)) as formCount"),
            DB::raw("(SUM(CASE WHEN payAmount > '1' THEN 1 ELSE 0 END)) as admissionCount"),
            DB::raw("DAY(created_at) as month_name"),
        )
        ->where('reference_id',Auth::id())
        ->whereMonth('created_at', date('m'))
        ->whereYear('created_at', date('Y'))
        ->groupBy('month_name')
        ->orderBy('month_name', 'asc')
        ->get();
        
        return response($data, 200);
    }

    public function allstudentchart(){
        $data = studentModel::select(
            DB::raw("(COUNT(*)) as formCount"),
            DB::raw("(SUM(CASE WHEN payAmount > '1' THEN 1 ELSE 0 END)) as admissionCount"),
            DB::raw("DAY(created_at) as month_name"),
        )
        ->whereMonth('created_at', date('m'))
        ->whereYear('created_at', date('Y'))
        ->groupBy('month_name')
        ->orderBy('month_name', 'asc')
        ->get();
        
        return response($data, 200);
    }

    public function logactivity(){

        $activity =  Activity::orderBy('id','DESC')->paginate(50);
        return view('users.activity',compact('activity'));
    }

    public function invoiceCreateImg(){
        return $lastActivity = Activity::all();
    }
}
