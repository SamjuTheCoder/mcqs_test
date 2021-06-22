<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreateExam extends Model
{
    use HasFactory;

    protected $fillable = [
        'examtype',
        'question_type',
        'class',
        'subject',
        'session',
        'term',
        'year',
        'examname',
        'hour',
        'mins',
        'time',
        'instruction',
        'active_status',
    ];

}
