<?php
namespace App\Repositories\Eloquent;

use App\Models\StudentClass;
use App\Repositories\ClassInterface;
use Illuminate\Support\Collection;

class ClassRepository extends BaseRepository implements ClassInterface
{
    /**
     * @return string
     *  Return the model
     */
    public function __construct(StudentClass $model)
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