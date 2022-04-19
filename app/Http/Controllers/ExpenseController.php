<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::select('id','name')->where('status',1)->orderBy('name','ASC')->get();
        $expense = Expense::with(['user'=> function($query){
            $query->select('id','name');
        }])->orderBy('id','DESC')->paginate(20);
        return view('accounts.expense.index',compact('expense','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::select('id','name')->where('status',1)->orderBy('name','ASC')->get();
        return view('accounts.expense.create',compact('users'));
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
            'title'=>'required',
            'expenseType'=>'required|max:255||not_in:0',
            'toUser'=>'required|max:255||not_in:0',
            'amount'=>'required',
        ]);



        $expense = new Expense();
        $expense->userId = $request->toUser;
        $expense->title = $request->title;
        $expense->expensetype = $request->expenseType;
        $expense->amount = $request->amount;
        if($request->filled('customdate')){
            $expense->created_at = $request->customdate;
        }
        $expense->save();
        return redirect()->route('expense.index')->with('success','Expense Added Successfully!');
        
    }

    public function datewiseSearch(Request $request){
        $date  =NULL;
        $expens = Expense::query();

        if($request->filled('date')){
            $date =  date('Y/m/d',strtotime($request->date));
            $expens->whereDate('created_at',$date);
        }
       
        if($request->filled('expenseType')){
            $expens->where('expensetype',$request->expenseType);
        }
        if($request->filled('toUser')){
            $expens->where('userId',$request->toUser);
        }
        $expens->with(['user' => function ($query) {
            $query->select('id','name');
        }]);

        $expense = $expens->orderBy('id','DESC')->paginate(30)->withQueryString();

        return view('accounts.expense.datewiseSearch',compact('expense','date'));
    }

    public function monthwiseSearch(Request $request){
        $month  ='';
        $year  ='';
        $expens = Expense::query();

        if($request->filled('month')){
            $month =  date('m',strtotime($request->month));
            $year =  date('Y',strtotime($request->month));
            $expens->whereYear('created_at',$year)->whereMonth('created_at',$month);
        }
        if($request->filled('expenseType')){
            $expens->where('expensetype',$request->expenseType);
           
        }
        if($request->filled('toUser')){
            $expens->where('userId',$request->toUser);

        }

        $expens->with(['user' => function ($query) {
            $query->select('id','name');
        }]);

        $expense = $expens->orderBy('id','DESC')->paginate(30)->withQueryString();

        return view('accounts.expense.monthwiseSearch',compact('expense','month','year'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        $users = User::select('id','name')->where('status',1)->get();
        return view('accounts.expense.edit',compact('expense','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'title'=>'required',
            'toUser'=>'required|max:255||not_in:0',
            'amount'=>'required',
        ]);
        $expense->userId = $request->toUser;
       $expense->title = $request->title;
       if($request->expenseType !=0){
        $expense->expensetype =$request->expenseType ;
       }
       $expense->amount = $request->amount;
       $expense->created_at = $request->customdate;
       $expense->save();
       return redirect()->route('expense.index')->with('success','Expense Update Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expense.index')->with('success','Expense Deleted Successfully!');
    }
}
