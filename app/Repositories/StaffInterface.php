<?php

namespace App\Repositories;

interface StaffInterface
{
    public function createStaff(array $data);

    public function addStaffToUserTable(array $data);
    
    public function addStaffIdToUserRole(array $data);

    public function checkIfStaffExists($fullname,$phone);

    public function getAllStaff();
    
    public function getAllStaffList();

    public function editStaff($id);

    public function deleteStaff($id);

    public function getStates();

    public function getLga();

    public function getRole();
   
}