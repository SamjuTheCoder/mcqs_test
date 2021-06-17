<?php

namespace App\Repositories\Eloquent;

use App\Repositories\CreateExamInterface;
use Illuminate\Support\Collection;
use App\Models\CreateExam;
use Auth;
use DB;

//use Your Model

/**
 * Class BrandRepository.
 */
class CreateExamRepository extends BaseRepository implements CreateExamInterface
{
    /**
     * @return string
     *  Return the model
     */
    public function __construct(CreateExam $model)
    {
        //return YourModel::class;
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function all(): collection
    {
        return $this->model
        ->leftjoin('exam_types','create_exams.examtype','=','exam_types.id')
        ->leftjoin('student_classes','create_exams.class','=','student_classes.id')
        ->leftjoin('subjects','create_exams.subject','=','subjects.id')
        ->select('*','create_exams.id as qid')
        ->get();
    }

    public function gettime($id)
    {
        return $this->model->where('id',$id)->first();
    }

    public function edit($id)
    {
        return $this->model->find($id)->first();
    }


    public function delete($id)
    {   
        return $this->model->find($id)->delete();
    }

    public function examSubject($class,$active_status)
    {      
        return $this->model
        ->leftjoin('student_classes','create_exams.class','=','student_classes.id')
        ->leftjoin('subjects','create_exams.subject','=','subjects.id')
        ->where('create_exams.class',$class)
        ->where('create_exams.active_status',$active_status)
        ->select('*','create_exams.id as sid')
        ->get();
    }

    public function getInstruction($id)
    {
        $getClass = Auth::user()->class;
        $currentSession = DB::table('exam_times')->first();
       
        $istrue = DB::table('create_exams')
        ->where('session',$currentSession->session)
        ->where('term',$currentSession->term)
        ->where('year',$currentSession->year)
        ->where('class',$getClass)
        ->where('subject',$id)
        ->where('active_status',1)
        ->exists();

        if($istrue)
        {
            return $this->model
            ->where('session',$currentSession->session)
            ->where('term',$currentSession->term)
            ->where('year',$currentSession->year)
            ->where('class',$getClass)
            ->where('create_exams.subject',$id)
            ->where('active_status',1)
            ->leftjoin('subjects','create_exams.subject','=','subjects.id')
            ->select('*','create_exams.id as eid')
            ->first();
        }
        else
        {
            return null;
        }
    }
}
