<?php

namespace App\Repositories\Eloquent;

use App\Repositories\QuestionRepositoryInterface;
use Illuminate\Support\Collection;
use App\Models\Question;

//use Your Model

/**
 * Class BrandRepository.
 */
class QuestionRepository extends BaseRepository implements QuestionRepositoryInterface
{
    /**
     * @return string
     *  Return the model
     */
    public function __construct(Question $model)
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
        ->leftjoin('exam_types','questions.examtype','=','exam_types.id')
        ->leftjoin('student_classes','questions.class','=','student_classes.id')
        ->select('*','questions.id as qid')
        ->get();
    }

    public function singleQuestion()
    {
        return $this->model->limit(1)->inRandomOrder()->get();
    }

    public function nextQuestion($id)
    {
        return $this->model->where('id',$id)->limit(1)->inRandomOrder()->get();
    }

    public function count()
    {
        return $this->model->count();
    }

    public function deleteQuestion($id)
    {   
        return $this->model->find($id)->delete();
    }
}
