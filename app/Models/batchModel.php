<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class batchModel extends Model
{
    use HasFactory,LogsActivity;

    protected $fillable = [
        'batchno',
        'course_id',
        'classOnWeek',
        'duration',
        'startdate',
        'enddate',
        'classtime',
        'expectedStudent',
        'mentor_id',
        'mentor_name',
        'status',
        'classOnDay',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['batchno']);
        // Chain fluent methods for configuration options
    }

    protected $casts = [
        'classOnDay' => 'array',
        ];
    public function user(){
            return $this->belongsTo(User::class,'mentor_id');
    }
    public function course(){
        return $this->belongsTo(courseModel::class,'course_id');
    }
    public function student(){
        return $this->hasMany(studentModel::class,'batch_id');
    }

}
