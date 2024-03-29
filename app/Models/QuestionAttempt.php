<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionAttempt extends Model
{
    use SoftDeletes;


    protected $fillable = [
        'quiz_attempt_id',
        'question_id',
        'questionsummary',
        'rightanswer',
        'responsesummary'
    ];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    
    public function QuizAttempt()
    {
        return $this->belongsTo(QuizAttempt::class);
    }

    public function Question()
    {
        return $this->belongsTo(Question::class,'question_id');
    }

    // public function Questions()
    // {
    //     return $this->hasOne(QuizAttempt::class, 'quiz_attempt_id');
    // }
}
