<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class studentModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'fathername',
        'mothername',
        'course_id',
        'address',
        'mobile',
        'batch_id',
        'fbname',
        'dateofbirth',
        'gender',
        'reference_id',
        'education',
        'note',
        'reminder_time',
        'totalAmount',
        'payAmount',
        'discount_amount',
        'status',
        'hwpay',
        'created_at'
    ];

public function getCreatedAtAttribute($timestamp) {
        return Carbon::parse($timestamp)->format('d-m-Y');
    }
public function getReminderTimeAttribute($timestamp) {
     return is_null($timestamp) ? null : Carbon::parse($timestamp)->format('Y-m-d');
  }
 public function referenced(){
    return $this->belongsTo(User::class,'reference_id');
 }
 public function batch(){
    return $this->belongsTo(batchModel::class,'batch_id');
 }
 public function course(){
    return $this->belongsTo(courseModel::class,'course_id');
 }
 public function payment(){
   return $this->hasMany(paymentModel::class,'student_id')->orderBy('id','DESC');
}
public function invoice(){
   return $this->hasOne(invoiceModel::class,'student_id');
}
}
