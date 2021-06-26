<?php

namespace App\Repositories;

interface SubjectClassInterface
{
    public function assignSubjectToClass(array $data);

    public function editSubjectToClass($id);

    public function deleteSubjectToClass($id);

    public function getAllSubjectClass();

    public function loadAllSubjectClass($id);

    public function getAllSubject();

    public function getAllClass();

    public function checkIfRecordExists($class, $subject);

   
}