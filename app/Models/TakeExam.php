<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TakeExam extends Model
{
    use HasFactory;

    protected $fillable = [
        'userID',
        'questionID',
        'answerID',
        'status',
        'isConfirmed',
        'picture',
        'status',
        'isConfirmed',
        
    ];

}
