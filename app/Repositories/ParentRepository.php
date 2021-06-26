<?php

namespace App\Repositories;

use App\Models\StudentParent;
use App\Models\Gender;
use App\Models\State;
use App\Models\Lga;
use App\Models\User;
use App\Models\UserRole;
use App\Repositories\ParentInterface;
use Illuminate\Support\Collection;
use DB;

class ParentRepository implements ParentInterface
{
    protected $model;
    protected $model_gender;
    protected $model_state;
    protected $model_lga;
    protected $model_user;
    protected $model_userrole;

    public function __construct()
    {
        $this->model = new StudentParent;
        $this->model_gender = new Gender;
        $this->model_state = new State;
        $this->model_lga = new Lga;
        $this->model_user = new User;
        $this->model_userrole = new UserRole;
    }
    public function createParent(array $data)
    {
        return $this->model->create($data)->id;
    }

    public function addParentToUserTable(array $data)
    {
        return $this->model_user->create($data)->id;
    }

    public function addParentIdToUserRole(array $data)
    {
        return $this->model_userrole->create($data);
    }

    public function checkIfParentExists($fullname,$phone)
    {
        return $this->model
        ->where('fullname',$fullname)
        ->orwhere('phone',$phone)
        ->exists();
    }

    public function getAllParents()
    {
        return $this->model
        ->leftjoin('states','student_parents.state','=','states.id')
        ->leftjoin('lgas','student_parents.lga','=','lgas.id')
        ->paginate(10);
    }

    public function getAllParentsList()
    {
        return $this->model->get();
    }

    public function editParent($id)
    {

    }

    public function deleteParent($id)
    {

    }

    public function getStates()
    {
        return $this->model_state->get();
    }

    public function getLga()
    {
        return $this->model_lga->get();
    }

    public function getSingleLga($id)
    {
        return $this->model_lga
        ->where('stateID',$id)
        ->get();
    }
    
}