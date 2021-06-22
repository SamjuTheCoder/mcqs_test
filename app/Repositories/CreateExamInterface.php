<?php

namespace App\Repositories;

use App\Models\CreateExam;
use Illuminate\Support\Collection;

interface CreateExamInterface
{
    public function all();
    public function gettime($id);
    public function edit($id);
    public function delete($id);
    public function examSubject($class,$active_status);
    public function getexamSubject($class);
    public function getInstruction($id);
    public function updateExam(array $data, $id);
    public function gettitle($id);
    public function getExamTitle($id);
    public function checkIfExamRecordExists($examtype,$question_type,$class,$subject,$session,$term,$year,$examname,$time);
}