<?php

namespace App\Repositories\Eloquent;

use App\Repositories\ExamtypeRepositoryInterface;
use Illuminate\Support\Collection;
use App\Models\ExamType;
use App\Models\Question;

//use Your Model

/**
 * Class BrandRepository.
 */
class ExamtypeRepository extends BaseRepository implements ExamtypeRepositoryInterface
{
    /**
     * @return string
     *  Return the model
     */
    public function __construct(ExamType $model)
    {
        //return YourModel::class;
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function all()
    {
        return $this->model->all();
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
