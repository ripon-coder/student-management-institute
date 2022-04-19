<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\studentModel;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StafReport;
use DB;
class StaffsReport extends Controller
{
    public function index(){
        $data = User::withCount(['student as totaladmission' => function($query){
            $query->where('payAmount','>',1);

        },'student as thismonthAdmission' =>function($query){
            $query->whereYear('created_at', date('Y'))
                  ->where('payAmount','>',1)
                  ->whereMonth('created_at', date('m'));

        },'student as thismonthForm' =>function($query){
            $query->whereYear('created_at', date('Y'))
                  ->whereMonth('created_at', date('m'));

        },'student as todayAdmission' =>function($query){
            $query->whereYear('created_at', date('Y'))
                  ->where('payAmount','>',1)
                  ->whereDate('created_at', now());

        },'student as todayForm' =>function($query){
            $query->whereYear('created_at', date('Y'))
                   ->whereDate('created_at', now());
        }
    
        ])->withSum(['student' => function($query){
                $query->whereYear('created_at', date('Y'))
                      ->whereMonth('created_at', date('m'));

            }],'payAmount'
            )
            ->role('CRO')
            ->paginate(30);
       return view('staffReport.index',compact('data')); 
    }

    public function staffReportDetails($id){
          $user = User::find($id);
           $data = studentModel::where('reference_id',$id)
                                     ->whereYear('created_at', date('Y'))
                                     ->whereMonth('created_at', date('m'))
                                     ->select(
                                        DB::raw('DATE(created_at) as date'),
                                        DB::raw("COUNT(payAmount) as form"),
                                        DB::raw("SUM(CASE WHEN payAmount >= '1' THEN 1 ELSE 0 END) AS admission"),
                                        DB::raw("SUM(payAmount) as collection"),
                                        )
                                        ->orderBy('date')
                                        ->groupBy('date')
                                        ->get();
                                        

        return view('staffReport.staffReportDetails',compact('data','user'));

    }
}
