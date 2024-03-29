<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title',
        'description',
        'question_type_id',
        'creator_id'
    ];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function quizSlots()
    {
        return $this->hasMany(QuizSlot::class);
    }

    public function questionAnswers()
    {
        return $this->hasOne(QuestionAnswer::class, 'question_id');
    }

    public function questionAttempt()
    {
        return $this->hasOne(QuestionAttempt::class, 'question_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function questionType()
    {
        return $this->belongsTo(QuestionType::class, 'question_type_id');
    }
}
