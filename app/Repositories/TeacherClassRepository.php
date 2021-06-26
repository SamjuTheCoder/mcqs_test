<?php

namespace App\Repositories;

use App\Models\TeacherClass;
use App\Models\StudentClass;
use App\Models\Staff;
use App\Repositories\TeacherClassInterface;
use DB;

class TeacherClassRepository implements TeacherClassInterface
{

    protected $model;
    protected $modelClass;
    protected $modelTeacher;

    public function __construct()
    {
        $this->model = new TeacherClass; 
        $this->modelClass = new StudentClass;    
        $this->modelTeacher = new Staff; 
    }

    public function assignTeacherToClass(array $data)
    {
        return $this->model->create($data);
    }

    public function editTeacherToClass($id)
    {

    }

    public function deleteTeacherToClass($id)
    {

    }

    public function getAllTeacherClass()
    {
        return $this->model
        ->leftjoin('staff','teacher_classes.teacher','=','staff.id')
        ->leftjoin('student_classes','teacher_classes.class','=','student_classes.id')
        ->paginate(15);
    }

    public function loadAllTeacherClass($id)
    {
        return $this->model
        ->where('teacher_classes.teacher',$id)
        ->leftjoin('staff','teacher_classes.teacher','=','staff.id')
        ->leftjoin('student_classes','teacher_classes.class','=','student_classes.id')
        ->paginate(15);
    }

    public function getAllTeacher($id)
    {
        return $this->modelTeacher
        ->where('role',$id)
        ->get();
    }

    public function getAllClass()
    {
        return $this->modelClass->get();
    }

    public function checkIfRecordExists($class, $teacher)
    {
        return $this->model
        ->where('class',$class)
        ->where('teacher',$teacher)
        ->exists();
    }

}