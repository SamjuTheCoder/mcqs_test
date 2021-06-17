<?php

namespace App\Repositories;

use App\Models\CreateExam;
use Illuminate\Support\Collection;

interface CreateExamInterface
{
    public function all():Collection;
    public function gettime($id);
    public function edit($id);
    public function delete($id);
    public function examSubject($class,$active_status);
    public function getInstruction($id);

}