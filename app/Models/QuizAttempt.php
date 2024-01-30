<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuizAttempt extends Model
{
    use SoftDeletes;

    protected $fillable = ['quiz_id', 'user_id', 'attempt', 'currentpage', 'preview', 'archived', 'timestart', 'timefinished'];
    
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function QuestionAttempt()
    {
        return $this->hasMany(QuestionAttempt::class, 'quiz_attempt_id');
    }
}
