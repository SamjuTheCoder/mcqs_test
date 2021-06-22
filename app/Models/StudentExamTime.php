<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentExamTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'examID',
        'studentID',
        'hour',
        'mins',
        'questions_count',
        'stop_current_time',
    ];
}
