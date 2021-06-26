<?php

namespace App\Repositories;

use App\Models\ClassSubject;
use App\Models\StudentClass;
use App\Models\Subject;
use App\Repositories\SubjectClassInterface;
use DB;

class SubjectClassRepository implements SubjectClassInterface
{

    protected $model;
    protected $modelClass;
    protected $modelSubject;

    public function __construct()
    {
        $this->model = new ClassSubject; 
        $this->modelClass = new StudentClass;    
        $this->modelSubject = new Subject; 
    }

    public function assignSubjectToClass(array $data)
    {
        return $this->model->create($data);
    }

    public function editSubjectToClass($id)
    {

    }

    public function deleteSubjectToClass($id)
    {

    }

    public function getAllSubjectClass()
    {
        return $this->model
        ->leftjoin('subjects','class_subjects.subject','=','subjects.id')
        ->leftjoin('student_classes','class_subjects.class','=','student_classes.id')
        ->paginate(15);
    }

    public function loadAllSubjectClass($id)
    {
        return $this->model
        ->where('class_subjects.class',$id)
        ->leftjoin('subjects','class_subjects.subject','=','subjects.id')
        ->leftjoin('student_classes','class_subjects.class','=','student_classes.id')
        ->paginate(15);
    }

    public function getAllSubject()
    {
        return $this->modelSubject->get();
    }

    public function getAllClass()
    {
        return $this->modelClass->get();
    }

    public function checkIfRecordExists($class, $subject)
    {
        return $this->model
        ->where('class',$class)
        ->where('subject',$subject)
        ->exists();
    }

}