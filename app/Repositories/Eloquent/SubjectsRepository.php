<?php

namespace App\Repositories\Eloquent;

use App\Repositories\SubjectsInterface;
use App\Models\Subject;
use DB;

class SubjectsRepository implements SubjectsInterface
{
    protected $model;

    public function __construct(Subject $subjects)
    {
        $this->model = $subjects;
    }

    public function getsubject($id)
    {
        return $this->model->where('id',$id)->first();
    }
}