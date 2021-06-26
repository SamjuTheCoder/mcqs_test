<?php

namespace App\Repositories;

interface ParentInterface
{
    public function createParent(array $data);

    public function addParentToUserTable(array $data);
    
    public function addParentIdToUserRole(array $data);

    public function checkIfParentExists($fullname,$phone);

    public function getAllParents();
    
    public function getAllParentsList();

    public function editParent($id);

    public function deleteParent($id);

    public function getStates();

    public function getLga();
   
}