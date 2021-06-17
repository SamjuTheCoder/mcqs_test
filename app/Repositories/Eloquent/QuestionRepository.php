<?php

namespace App\Repositories\Eloquent;

use App\Repositories\QuestionRepositoryInterface;
use Illuminate\Support\Collection;
use App\Models\Question;
use DB;
//use Your Model

/**
 * Class BrandRepository.
 */
class QuestionRepository extends BaseRepository implements QuestionRepositoryInterface
{
    protected $tempModel;
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
    public function all($id): collection
    {
        return $this->model
        ->where('questions.examID',$id)
        ->leftjoin('create_exams','questions.examID','=','create_exams.id')
        ->select('*','questions.id as qid')
        ->get();
    }

    public function singleQuestion($id)
    {
        return $this->model->where('examID',$id)
        ->inRandomOrder()
        ->get();
    }
    
    public function nextQuestion($id,$exam)
    {
        return $this->model->where('id','>',$id)
        ->where('examID',$exam)
        ->limit(1)
        ->inRandomOrder()
        ->get();
    }

    public function count($id)
    {
        return $this->model->where('examID',$id)->count();
    }

    public function deleteQuestion($id)
    {   
        return $this->model->find($id)->delete();
    }

    

}
