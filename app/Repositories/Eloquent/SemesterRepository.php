<?php

namespace App\Repositories\Eloquent;

use App\Repositories\SemesterInterface;
use Illuminate\Support\Collection;
use App\Models\Semester;

//use Your Model

/**
 * Class BrandRepository.
 */
class SemesterRepository extends BaseRepository implements SemesterInterface
{
    /**
     * @return string
     *  Return the model
     */
    public function __construct(Semester $model)
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
        //->leftjoin('exam_types','questions.examtype','=','exam_types.id')
        //->select('*','questions.id as qid')
        ->get();
    }

    public function delete($id)
    {   
        return $this->model->find($id)->delete();
    }

    public function edit($id)
    {
        return $this->model->find($id)->first();
    }
}
