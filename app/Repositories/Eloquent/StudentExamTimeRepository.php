<?php

namespace App\Repositories\Eloquent;

use App\Repositories\StudentExamTimeInterface;
use Illuminate\Support\Collection;
use App\Models\StudentExamTime;
use DB;

class StudentExamTimeRepository implements StudentExamTimeInterface
{
    protected $model;

    public function __construct(StudentExamTime $studenttime)
    {
        $this->model = $studenttime;
    }
    
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function updateCount(array $data, $id, $examID)
    {
        return $this->model
        ->where('studentID',$id)
        ->where('examID',$examID)
        ->update($data);
    }

    public function ifexists($examID,$id)
    {
       return $this->model
       ->where('examID',$examID)
       ->where('studentID',$id)->exists();
    }

    public function find($examID, $id)
    {
        if( $this->model->where('examID',$examID)->where('studentID',$id)->exists() )
        {
            return  $this->model
            ->where('examID',$examID)
            ->where('studentID',$id)->first();
        }
        else {
            return 'Record does not exists';
        }
    }

    public function check($examID,$id,$h,$m)
    {
        return $this->model
        ->where('examID',$examID)
        ->where('studentID',$id)->where('hour',$h)
        ->where('mins',$m)
        ->exists();
    }

    public function delete($id)
    {
        return $this->model
        ->where('studentID',$id)
        ->delete();
    }

    public function updateTime(array $data, $id,$examID)
    {
        return $this->model
        ->where('studentID',$id)
        ->where('examID',$examID)
        ->update($data);
    }

}