<?php

namespace App\Repositories;

use App\Models\Staff;
use App\Models\Gender;
use App\Models\State;
use App\Models\Lga;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;
use App\Repositories\StaffInterface;
use Illuminate\Support\Collection;
use DB;

class StaffRepository implements StaffInterface
{
    protected $model;
    protected $model_gender;
    protected $model_state;
    protected $model_lga;
    protected $model_user;
    protected $model_userrole;
    protected $model_role;

    public function __construct()
    {
        $this->model = new Staff;
        $this->model_gender = new Gender;
        $this->model_state = new State;
        $this->model_lga = new Lga;
        $this->model_user = new User;
        $this->model_userrole = new UserRole;
        $this->model_role = new Role;
    }
    public function createStaff(array $data)
    {
        return $this->model->create($data)->id;
    }

    public function addStaffToUserTable(array $data)
    {
        return $this->model_user->create($data)->id;
    }

    public function addStaffIdToUserRole(array $data)
    {
        return $this->model_userrole->create($data);
    }

    public function checkIfStaffExists($fullname,$phone)
    {
        return $this->model
        ->where('fullname',$fullname)
        ->orwhere('phone',$phone)
        ->exists();
    }

    public function getAllStaff()
    {
        return $this->model
        ->leftjoin('states','staff.state','=','states.id')
        ->leftjoin('lgas','staff.lga','=','lgas.id')
        ->paginate(10);
    }

    public function getAllStaffList()
    {
        return $this->model->get();
    }

    public function editStaff($id)
    {

    }

    public function deleteStaff($id)
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

    public function getRole()
    {
        return $this->model_role->get();
    }
    
}