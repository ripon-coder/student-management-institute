<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Expense extends Model
{
    use HasFactory;
    protected $fillable = [
        'userId',
        'title',
        'expensetype',
        'amount',
        'created_at',
    ];

    public function getCreatedAtAttribute($timestamp) {
        return Carbon::parse($timestamp)->format('Y-m-d');
    }

    public function user(){
        return $this->belongsTo(User::class,'userId');
     }
}
