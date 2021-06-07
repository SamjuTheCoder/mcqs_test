<?php

namespace App\Repositories\Eloquent;

use App\Repositories\AcademicSessionInterface;
use Illuminate\Support\Collection;
use App\Models\AcademicSession;

//use Your Model

/**
 * Class BrandRepository.
 */
class AcademicSessionRepository extends BaseRepository implements AcademicSessionInterface
{
    /**
     * @return string
     *  Return the model
     */
    public function __construct(AcademicSession $model)
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
