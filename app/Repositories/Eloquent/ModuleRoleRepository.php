<?php

namespace App\Repositories\Eloquent;

use App\Repositories\ModuleRoleRepositoryInterface;
use Illuminate\Support\Collection;
use App\Models\Module;
use DB;

//use Your Model

/**
 * Class BrandRepository.
 */
class ModuleRoleRepository extends BaseRepository implements ModuleRoleRepositoryInterface
{
    /**
     * @return string
     *  Return the model
     */
    public function __construct(Module $model)
    {
        //return YourModel::class;
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function all()
    {
        return $this->model->paginate(6);
    }

    public function count()
    {
        return $this->model->count();
    }

    public function deleteRoute($id)
    {
        return $this->model->find($id)->delete();
    }
}
