<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class courseModel extends Model
{
    use HasFactory,LogsActivity;
    protected $fillable = [
        'title',
        'price',
        'discount_price',
        'discount',
        'status',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['title']);
        // Chain fluent methods for configuration options
    }
}
