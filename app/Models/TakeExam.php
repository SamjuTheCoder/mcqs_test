<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TakeExam extends Model
{
    use HasFactory;

    protected $fillable = [
        'userID',
        'examID',
        'class',
        'session',
        'term',
        'year',
        'subject',
        'questionID',
        'answerID',
        'subjective_answer',
        'essay_answer',
        'status',
        'isConfirmed',
        'picture',
        'status',
        'isConfirmed',
        
    ];

}
