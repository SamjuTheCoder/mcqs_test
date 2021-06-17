<?php

namespace App\Repositories\Eloquent;

use App\Repositories\TakeExamRepositoryInterface;
use Illuminate\Support\Collection;
use App\Models\TakeExam;
use DB;

//use Your Model

/**
 * Class BrandRepository.
 */
class TakeExamRepository extends BaseRepository implements TakeExamRepositoryInterface
{
    /**
     * @return string
     *  Return the model
     */
    public function __construct(TakeExam $model)
    {
        //return YourModel::class;
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function all($id,$status,$confirm)
    {
        return $this->model->where('userID',$id)->where('status',$status)->where('isConfirmed',$confirm)->leftjoin('answers','take_exams.answerID','=','answers.id')->leftjoin('questions','take_exams.questionID','=','questions.id')->get();
    }  

    public function allExam()
    {
        return $this->model
        ->leftjoin('users','take_exams.userID','=','users.id')
        ->leftjoin('answers','take_exams.answerID','=','answers.id')
        ->leftjoin('questions','take_exams.questionID','=','questions.id')
        ->get();
    }  

    public function count()
    {
        return $this->model->count();
    }

    public function deleteAnswer($id)
    {
        return $this->model->find($id)->delete();
    }

    public function updateStatus(array $data, $id)
    {
        return $this->model->where('userID',$id)->update($data);
    }

    public function previewScore($id)
    {
        return $this->model
        ->where('userID',$id)
        ->leftjoin('users','take_exams.userID','=','users.id')
        ->leftjoin('answers','take_exams.answerID','=','answers.id')
        ->leftjoin('questions','take_exams.questionID','=','questions.id')
        ->get();
    }

    public function examTaken($id)
    {
        return $this->model
        ->where('userID',$id)
        ->where('status',1)
        ->leftjoin('users','take_exams.userID','=','users.id')
        ->leftjoin('answers','take_exams.answerID','=','answers.id')
        ->leftjoin('questions','take_exams.questionID','=','questions.id')
        ->leftjoin('create_exams','create_exams.id','=','questions.examID')
        ->exists();
    }
}
