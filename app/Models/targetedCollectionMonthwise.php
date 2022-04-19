<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class targetedCollectionMonthwise extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'requiredAmount',
        'targetmonth',
    ];
}
