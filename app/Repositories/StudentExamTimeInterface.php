<?php

namespace App\Repositories;
use App\Models\StudentExamTime;

interface StudentExamTimeInterface
{

    public function create(array $data);

    public function updateCount(array $data,$id,$examID);

    public function ifexists($examID,$id);

    public function find($examID, $id);

    public function check($examID,$id,$h,$m);

    public function delete($id);

    public function updateTime(array $data, $id,$examID);
}