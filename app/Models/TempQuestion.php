<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'examID',
        'questionID',
        'studentID',
        'question',
        'score',
    ];

}
