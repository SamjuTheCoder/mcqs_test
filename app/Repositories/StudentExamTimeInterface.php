<?php

namespace App\Repositories;
use App\Models\StudentExamTime;

interface StudentExamTimeInterface
{

    public function create(array $data);

    public function update(array $data,$id);

    public function ifexists($id);

    public function find($id);

    public function check($id,$h,$m);

    public function delete($id);

    public function updatetime(array $data, $id);
}