<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Quiz;

class Question extends Model
{
    //
    protected $dates = ['created_at'];
	protected $primaryKey = 'questionid';
    public function quiz()
    {
    	return $this->belongsTo(Quiz::class);
    }
}
