<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserRole;
use App\Repositories\ReusableInterface;
use Illuminate\Support\Collection;
use DB;
use Auth;

class ReusableRepository implements ReusableInterface
{
    protected $model_user;
    protected $model_userrole;

    public function __construct()
    {
        $this->model_user = new User;
        $this->model_userrole = new UserRole;
    }
    
    public function getUserRole($id)
    {
        return $this->model_userrole
        ->where('userID',$id)
        ->leftjoin('roles','user_roles.roleID','=','roles.id')
        ->first();
    }
    
}