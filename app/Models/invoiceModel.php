<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoiceModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'user_id',
        'totalAmount',
        'payAmount',
    ];

    public function payment(){
        return $this->hasMany(\App\Models\paymentModel::class, 'invoice_id');
    }

    public function student(){
        return $this->belongsTo(\App\Models\studentModel::class, 'student_id');
    }
}
