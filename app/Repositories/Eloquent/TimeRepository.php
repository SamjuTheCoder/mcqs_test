<?php

namespace App\Repositories\Eloquent;

use App\Models\ExamTime;
use App\Repositories\TimeInterface;
use Illuminate\Support\Collection;

class TimeRepository extends BaseRepository implements TimeInterface
{
    /**
     * @return string
     *  Return the model
     */
    public function __construct(ExamTime $model)
    {
        //return YourModel::class;
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model
        ->select('*','exam_times.id as qid')
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
