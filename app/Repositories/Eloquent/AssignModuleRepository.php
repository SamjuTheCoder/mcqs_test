<?php

namespace App\Repositories\Eloquent;

use App\Repositories\AssignModuleRepositoryInterface;
use Illuminate\Support\Collection;
use App\Models\ModuleRole;
use DB;

//use Your Model

/**
 * Class BrandRepository.
 */
class AssignModuleRepository extends BaseRepository implements AssignModuleRepositoryInterface
{
    /**
     * @return string
     *  Return the model
     */
    public function __construct(ModuleRole $model)
    {
        //return YourModel::class;
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function all()
    {
        return $this->model->leftjoin('roles','module_roles.roleID','=','roles.id')->leftjoin('modules','module_roles.moduleID','=','modules.id')->paginate(6);
    }

    public function count()
    {
        return $this->model->count();
    }

    public function deleteRole($id)
    {
        return $this->model->find($id)->delete();
    }
}
