<?php
namespace App\Repositories\Eloquent;

use App\Models\StudentClass;
use App\Models\Staff;
use App\Models\TeacherClass;
use App\Repositories\ClassInterface;
use Illuminate\Support\Collection;

class ClassRepository extends BaseRepository implements ClassInterface
{
    protected $model;
    protected $modelStaff;
    protected $modelTeacherClass;

    public function __construct()
    {
        $this->model = new StudentClass;
        $this->modelStaff = new Staff;
        $this->modelTeacherClass = new TeacherClass;
    }

    public function all()
    {
        return $this->model->get();
    }

    public function delete($id)
    {   
        return $this->model->find($id)->delete();
    }

    public function edit($id)
    {
        return $this->model->find($id)->first();
    }

    public function getStaffRole($id)
    {
        return $this->modelStaff
        ->where('id',$id)
        ->first();
    }

    public function getTeacherClass($id)
    {
        return $this->modelTeacherClass
        ->where('teacher',$id)
        ->leftjoin('student_classes','teacher_classes.class','=','student_classes.id')
        ->get();
    }
}