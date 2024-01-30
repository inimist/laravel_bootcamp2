<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuizSlot extends Model
{

    use SoftDeletes;
    
    protected $fillable = [
        'slot',
        'quiz_id',
        'question_id'
    ];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
