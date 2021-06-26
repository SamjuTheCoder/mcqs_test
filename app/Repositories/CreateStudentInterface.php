<?php

namespace App\Repositories;

interface CreateStudentInterface
{
    public function createStudent(array $data);

    public function addStudentToUserTable(array $data);
    
    public function addStudentIdToUserRole(array $data);

    public function checkIfStudentExists($regnumber);

    public function getAllStudents();

    public function getAllParents();

    public function editStudent($id);

    public function deleteStudent($id);

    public function getGender();

    public function getAllClasses();

    public function getAllHouse();

    
}