<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class paymentModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_id',
        'student_id',
        'user_id',
        'amount',
        'method',
        'note',
    ];
    public function getCreatedAtAttribute($timestamp) {
        return Carbon::parse($timestamp)->format('d-m-Y');
    }

    public function reference(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function student(){
        return $this->belongsTo(studentModel::class,'student_id');
    }
}
