<?php

namespace App\Repositories\Eloquent;

use App\Repositories\CreateExamInterface;
use Illuminate\Support\Collection;
use App\Models\CreateExam;

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

    public function edit($id)
    {
        return $this->model->find($id)->first();
    }


    public function delete($id)
    {   
        return $this->model->find($id)->delete();
    }
}
