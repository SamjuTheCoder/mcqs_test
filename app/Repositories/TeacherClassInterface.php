<?php

namespace App\Repositories;

interface TeacherClassInterface
{
    public function assignTeacherToClass(array $data);

    public function editTeacherToClass($id);

    public function deleteTeacherToClass($id);

    public function getAllTeacherClass();

    public function loadAllTeacherClass($id);

    public function getAllTeacher($id);

    public function getAllClass();

    public function checkIfRecordExists($class, $teacher);

   
}