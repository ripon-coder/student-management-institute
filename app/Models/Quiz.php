<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use App\Models\User;

class Quiz extends Model
{
    //
    protected $dates = ['created_at'];
	protected $primaryKey = 'quizid';

    public function questions()
    {
    	return $this->hasMany(Question::class);
    }
}

