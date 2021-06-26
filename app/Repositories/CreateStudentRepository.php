<?php

namespace App\Repositories;

use App\Models\Student;
use App\Models\Gender;
use App\Models\StudentClass;
use App\Models\User;
use App\Models\UserRole;
use App\Models\StudentParent;
use App\Models\StudentHouse;
use App\Repositories\CreateStudentInterface;
use Illuminate\Support\Collection;
use DB;

class CreateStudentRepository implements CreateStudentInterface
{
    protected $model;
    protected $model_gender;
    protected $model_class;
    protected $model_user;
    protected $model_userrole;
    protected $model_parent;
    protected $model_house;

    public function __construct()
    {
        $this->model = new Student;
        $this->model_gender = new Gender;
        $this->model_class = new StudentClass;
        $this->model_user = new User;
        $this->model_userrole = new UserRole;
        $this->model_parent = new StudentParent;
        $this->model_house = new StudentHouse;
    }
    
    public function createStudent(array $data)
    {
        return $this->model->create($data)->id;
    }

    public function addStudentToUserTable(array $data)
    {
        return $this->model_user->create($data)->id;
    }
    
    public function addStudentIdToUserRole(array $data)
    {
        return $this->model_userrole->create($data);
    }

    public function checkIfStudentExists($regnumber)
    {
        return $this->model
        ->where('registration_number',$regnumber)
        ->exists();
    }

    public function getAllParents()
    {
        return $this->model_parent->get();
    }
    public function getAllStudents()
    {
        return $this->model
        ->leftjoin('student_parents','students.parent','=','student_parents.id')
        ->leftjoin('student_classes','students.class','=','student_classes.id')
        ->leftjoin('student_houses','students.house','=','student_houses.id')
        ->leftjoin('genders','students.sex','=','genders.id')
        ->select('*','student_parents.fullname as parentName','students.fullname as studentName')
        ->paginate(10);
    }

    public function editStudent($id)
    {

    }

    public function deleteStudent($id)
    {

    }

    public function getGender()
    {
        return $this->model_gender->get();
    }

    public function getAllClasses()
    {
        return $this->model_class->get();
    }

    public function getAllHouse()
    {
        return $this->model_house->get();
    }

    
}