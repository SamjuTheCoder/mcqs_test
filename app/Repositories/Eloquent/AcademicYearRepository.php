<?php

namespace App\Repositories\Eloquent;

use App\Repositories\AcademicYearInterface;
use Illuminate\Support\Collection;
use App\Models\AcademicYear;

//use Your Model

/**
 * Class BrandRepository.
 */
class AcademicYearRepository extends BaseRepository implements AcademicYearInterface
{
    /**
     * @return string
     *  Return the model
     */
    public function __construct(AcademicYear $model)
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
