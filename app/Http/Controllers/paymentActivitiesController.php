<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\paymentModel;

class paymentActivitiesController extends Controller
{
    public function index(){
         $paymentmodels = paymentModel::with(['reference' => function ($query) {
            $query->select('id','name');
        }])->with(['student' => function ($query) {
            $query->select('id','name');
        }])->with('student.course')->orderBy('id','DESC')->paginate(50);
        return view('accounts.paymentActivity.index',compact('paymentmodels'));
    }

    public function dateSearch(Request $request){
        $date =  date('Y/m/d',strtotime($request->date));
         $paymentmodels = paymentModel::whereDate('created_at',$date)->with(['reference' => function ($query) {
            $query->select('id','name');
        }])->with(['student' => function ($query) {
            $query->select('id','name');
        }])->with('student.course')->orderBy('id','DESC')->paginate(50)->withQueryString();
        return view('accounts.paymentActivity.datewiseSearch',compact('paymentmodels','date'));
    }

    public function monthSearch(Request $request){
        $month =  date('m',strtotime($request->month));
        $year =  date('Y',strtotime($request->month));
        $paymentmodels = paymentModel::whereYear('created_at',$year)->whereMonth('created_at',$month)->with(['reference' => function ($query) {
            $query->select('id','name');
        }])->with(['student' => function ($query) {
            $query->select('id','name');
        }])->with('student.course')->orderBy('id','DESC')->paginate(50)->withQueryString();
        return view('accounts.paymentActivity.monthwiseSearch',compact('paymentmodels','month','year'));
    }
}
