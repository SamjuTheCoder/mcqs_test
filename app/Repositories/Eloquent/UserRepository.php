<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Collection;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

   /**
    * UserRepository constructor.
    *
    * @param User $model
    */
   public function __construct(User $model)
   {
       parent::__construct($model);
   }

   /**
    * @return Collection
    */
   public function all(): Collection
   {
       return $this->model->where('user_type',0)->all();    
   }

   public function count()
   {
       return $this->model->where('user_type',0)->count();
   }

   public function deleteUser($id)
   {
    return $this->model->find($id)->delete(); 
   }
}