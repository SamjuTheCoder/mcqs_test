<?php

namespace App\Repositories\Eloquent;

use App\Repositories\AnswerRepositoryInterface;
use Illuminate\Support\Collection;
use App\Models\Answer;
use DB;

//use Your Model

/**
 * Class BrandRepository.
 */
class AnswerRepository extends BaseRepository implements AnswerRepositoryInterface
{
    /**
     * @return string
     *  Return the model
     */
    public function __construct(Answer $model)
    {
        //return YourModel::class;
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function all($id)
    {
        return $this->model->leftjoin('questions','answers.question_id','=','questions.id')
        ->where('question_id',$id)
        ->select('*','answers.id as aid')
        ->paginate(6);
    }

    public function allQuestion()
    {
        return $this->model->leftjoin('questions','answers.question_id','=','questions.id')->paginate(4);
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
