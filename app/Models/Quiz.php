<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quiz extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name',
        'description',
        'minpassquestions',
        'showpassfail'
    ];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    
    public function quizSlots()
    {
        return $this->hasMany(QuizSlot::class);
    }
}
