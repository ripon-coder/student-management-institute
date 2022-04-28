<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\studentModel;
use App\Models\paymentModel;
use App\Models\Expense;
use Carbon\Carbon;
use DB;
class overviewController extends Controller
{
    public function overview(){
        $data = array();
        $data['todayCollection'] = paymentModel::whereDate('created_at','=', date('Y-m-d'))->sum('amount');
        $data['monthlyCollection'] = paymentModel::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at',  Carbon::now()->month)->sum('amount');
        $data['totalCollection'] = paymentModel::sum('amount');
        $data['monthlyExpense'] = Expense::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at',  Carbon::now()->month)->sum('amount');
        $data['totalDiscount'] = studentModel::sum('discount_amount');

        $total = studentModel::where('payAmount','>=',1)->sum('totalAmount');
        $duease = studentModel::where('payAmount','>=',1)->sum('payAmount');
        $data['duePayment'] = $total - $duease;

        $data['totalExpense'] = Expense::sum('amount');

        return view('accounts.overview.overview',compact('data'));
    }
    public function monthstatement(){
         $year = Date('Y');
        $monthname = ['January','February','March','April','May','June','July','August','September','October','November','December'];
        $maindata = []; 
        for($i=1; $i <=12 ; $i++) {
          $data = [];
           array_push($data,Expense::whereYear('created_at', $year)->whereMonth('created_at', $i)->sum('amount'));
           array_push($data,paymentModel::whereYear('created_at', $year)->whereMonth('created_at', $i)->sum('amount'));
           array_push($maindata,$data);
        }
        return view('accounts.overview.monthlyStatement',compact('maindata','monthname'));

    }
}
