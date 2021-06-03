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
    public function all($id)
    {
        return $this->model->where('userID',$id)->leftjoin('answers','take_exams.answerID','=','answers.id')->leftjoin('questions','take_exams.questionID','=','questions.id')->get();
    }  

    public function allExam()
    {
        return $this->model->leftjoin('users','take_exams.userID','=','users.id')->leftjoin('answers','take_exams.answerID','=','answers.id')->leftjoin('questions','take_exams.questionID','=','questions.id')->get();
    }  

    public function count()
    {
        return $this->model->count();
    }

    public function deleteAnswer($id)
    {
        return $this->model->find($id)->delete();
    }
}
