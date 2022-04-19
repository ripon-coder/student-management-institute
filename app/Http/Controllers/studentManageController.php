<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;
use App\Exports\StudentExport;
use Illuminate\Http\Request;
use App\Models\studentModel;
use App\Models\invoiceModel;
use App\Models\paymentModel;
use App\Models\courseModel;
use App\Models\batchModel;
use App\Models\User;
use Carbon\Carbon;
Use Alert;
use Auth;
use DB;
class studentManageController extends Controller
{

    public function studentExport(){
        return Excel::download(new StudentExport, 'StudentExport.xlsx');
    }
    // CRO
    public function noteadd(Request $request, $id){
        $student = studentModel::findOrFail($id);
        $student ->note = $request->note;
        if ($request->filled('reminderTime')) {
             $student ->reminder_time =  date('Y-m-d H:i:s',strtotime($request->reminderTime));
        }else{
            $student ->reminder_time = NULL;
        }
        $student->save();
        return redirect()->back()->with('success','Note Added Successfully!');
    }
    public function studentmanage(){
        $students = studentModel::with(['batch','course','batch.user'])->where('reference_id',Auth::id())->orderBy('id','DESC')->paginate(30);
        $duepayment = studentModel::with(['batch','course'])->where('reference_id',Auth::id())->whereColumn('totalAmount','>','payAmount')->where('payAmount','>',0)->orderBy('id','DESC')->get();
        return view('studentManage.cro.index',compact('students','duepayment'));
    }
    public function studentmanageadmin(){
        $students = studentModel::with(['batch','course','batch.user'])->orderBy('id','DESC')->paginate(30);
        $duepayment = studentModel::with(['batch','course'])->whereColumn('totalAmount','>','payAmount')->where('payAmount','>',0)->orderBy('id','DESC')->get();
        return view('studentManage.admin.index',compact('students','duepayment'));
    }

    public function paymentpage($id){
        $student = studentModel::findOrFail($id);
        return view('studentManage.payment',compact('student'));
    }


    public function today_student_by_cro_fullypaid(){
        $students = studentModel::with(['batch','course'])->where('reference_id',Auth::id())->whereColumn('payAmount','>=','totalAmount')->orderBy('id','DESC')->paginate(30);
        return response($students, 200);
    }
    public function today_student_by_cro_duepayment(){
        $students = studentModel::with(['batch','course'])->where('reference_id',Auth::id())->whereColumn('totalAmount','>','payAmount')->where('payAmount','>',0)->orderBy('id','DESC')->paginate(30);
        return response($students, 200);
    }

    public function today_student_by_cro_unpaid(){
        $students = studentModel::with(['batch','course'])->where('reference_id',Auth::id())->where('payAmount','<=',0)->orderBy('id','DESC')->paginate(30);
        return response($students, 200);
    }

    public function studentSearch(Request $request){
        $students = studentModel::query();

        if ($request->filled('registration_number')) {
            $students->where('id',$request->registration_number);
        }
        if($request->filled('mobile_number')){
            $students->where('mobile', 'LIKE', "%{$request->mobile_number}%");
        }

        if($request->filled('student_name')){
            $students->where('name', 'LIKE', "%{$request->student_name}%");
        }
        $students = $students->paginate(30);

        return view('studentManage.admin.search',compact('students'));
    }

    public function studentSearchcro(Request $request){
        $students = studentModel::where('reference_id',Auth::id());

        if ($request->filled('registration_number')) {
            $students->where('id',$request->registration_number);
        }
        if($request->filled('mobile_number')){
            $students->where('mobile', 'LIKE', "%{$request->mobile_number}%");
        }

        if($request->filled('student_name')){
            $students->where('name', 'LIKE', "%{$request->student_name}%");
        }
        $students = $students->paginate(30);

        return view('studentManage.cro.search',compact('students'))->with(['data'=>$request->all()]);
    }

    public function studentedit($id){
        if(studentModel::where('id',$id)->exists()){
        $student = studentModel::where('reference_id',Auth::id())->where('id',$id)->first();
        $courses = courseModel::where('status',1)->get();
        $batchs =  batchModel::where('status',1)->where('course_id',$student->course_id)->get();
        $reference =  User::where('cro_show',1)->where('status',1)->get();
        return view('studentManage.edit',compact('student','courses','batchs','reference'));
        }else{
            abort(404);
        }
    }
    public function studenteditadmin($id){
        $student = studentModel::findOrFail($id);
        $courses = courseModel::where('status',1)->get();
        $batchs =  batchModel::where('status',1)->where('course_id',$student->course_id)->get();
        $reference =  User::where('cro_show',1)->where('status',1)->get();
        return view('studentManage.edit',compact('student','courses','batchs','reference'));
    }
    
    public function studentUpdate(Request $request,$id){
        $request->validate([

            'batchid'=>'required|max:255|exists:batch_models,batchno',

        ]);
        $student = studentModel::findOrFail($id);
        $student->name = $request->name;
        $student->fathername = $request->fathername;
        $student->mothername = $request->mothername;
        if($request->course_id){
            $cour = courseModel::find($request->course_id);
            $student->totalAmount = $cour->discount_price;
        }
        $student->course_id = $request->course_id;
        $student->address = $request->address;
        $student->mobile = $request->mobile;
        $student->fbname = $request->fbname;
        $student->dateofbirth = $request->dateofbirth;
        $student->gender = $request->gender;
        if ($request->has('reference')) {
            $student->reference_id = $request->reference;
        }

        $student->save();
        if($request->batchid != NULL){
            $batchEStudentAse = studentModel::where('batch_id',$request->batchid)->count();
            $requiredStudent = batchModel::where('batchno',$request->batchid)->first();
            if($requiredStudent->expectedStudent+1 > $batchEStudentAse OR $request->batchid == NULL ){
                $student = studentModel::find($id);
                $student->batch_id = $requiredStudent->id;
                $student->save();

            }else{
                return redirect()->back()->with('msg','Batch Seat is Full!');
            }
        }else{
            $student = studentModel::find($id);
            $student->batch_id = $request->batchid;
            $student->save();
        }

        return redirect()->back()->with('success','Student Updated Successfully!');
    }


    public function invoicecreate($studentid){
        $invoice = new invoiceModel();
        $invoice->student_id = $studentid;
        $invoice->user_id = Auth::id();
        $invoice->save();
        return redirect()->back();
    }

    public function createpayment(Request $request){
        $request->validate([
            'amount' =>'required',
            'method' =>'required',
        ]);

        $student = studentModel::find($request->studentid);

        if($student->payAmount <= 0){
            $batchEStudentAse = studentModel::where('batch_id',$student->batch_id)->where('payAmount','>',1)->count();
            $requiredStudent = batchModel::find($student->batch_id);
            if($requiredStudent->expectedStudent+1 > $batchEStudentAse){
                $payment = new paymentModel();
                $payment->invoice_id = $request->invoiceid;
                if($request->studentid){
                    studentModel::whereId($request->studentid)->increment('payAmount',$request->amount);
                }
                if(paymentModel::where('student_id',$request->studentid)->doesntExist()){
                    studentModel::find($request->studentid)->update(['created_at' => Carbon::today()->toDateTimeString()]);
                }
                $payment->student_id = $request->studentid;
                $payment->user_id = Auth::id();
                $payment->amount = $request->amount;
                $payment->method = $request->method;
                $payment->note = $request->note;
                $payment->save();
                return redirect()->back();

            }else{
                Alert::error('Error!', 'Batch Seat is Full!');
                return redirect()->back();
            }
        }else{
            $payment = new paymentModel();
            $payment->invoice_id = $request->invoiceid;
            if($request->studentid){
                studentModel::whereId($request->studentid)->increment('payAmount',$request->amount);
            }
            if(paymentModel::where('student_id',$request->studentid)->doesntExist()){
                    studentModel::find($request->studentid)->update(['created_at' => Carbon::today()->toDateTimeString()]);
                }
            $payment->student_id = $request->studentid;
            $payment->user_id = Auth::id();
            $payment->amount = $request->amount;
            $payment->method = $request->method;
            $payment->note = $request->note;
            $payment->save();
            return redirect()->back();

        }
    }
    
    public function editpayment(Request $request,$id){
        $payment = paymentModel::find($id);
        studentModel::whereId($request->studentid)->decrement('payAmount',$payment->amount);
        studentModel::whereId($request->studentid)->increment('payAmount',$request->amount);

        $payment->amount = $request->amount;
        $payment->note = $request->note;
        $payment->save();
        return redirect()->back()->with('success','Update Successfully!');


    }


    public function deletepayment($id){
        $payment = paymentModel::find($id);
        studentModel::whereId($payment->student_id)->decrement('payAmount',$payment->amount);
        $payment->delete();
        return redirect()->back()->with('success','Payment Deleted Successfully!');
    }

    public function studentDelete($stid){
        studentModel::find($stid)->delete();
        return redirect()->back()->with('success','Student Deleted Successfully!');
    }
    // End API
    // CRO END

    public function downloadForm($id){
        $student = studentModel::findOrFail($id);
        return view('pdf.download_form',compact('student'));
    }

    public function discountAmountCreate(Request $request,$id){
        $student = studentModel::findOrFail($id);
        if($request->filled('discount')){
            if($student->totalAmount > $request->discount){
                $student->increment('discount_amount', $request->discount);
                $student->decrement('totalAmount', $request->discount); 
                Alert::toast('Discount Added Successfully!', 'success');
            }else{
                Alert::error('Error!', 'Discount Amount not be greater than the Course fee!');
            }
        }else{
            Alert::error('Error!', 'Discount Amount not be empty!');
        }
        return redirect()->back();
    }
    public function discountAmountDelete($id){
        $student = studentModel::findOrFail($id);
        $student->increment('totalAmount', $student->discount_amount); 
        $student->decrement('discount_amount', $student->discount_amount);
        Alert::toast('Discount Deleted Successfully!', 'success');
        return redirect()->back();
    }
}
