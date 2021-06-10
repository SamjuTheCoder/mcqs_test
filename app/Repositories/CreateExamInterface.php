<?php

namespace App\Repositories;

use App\Models\CreateExam;
use Illuminate\Support\Collection;

interface CreateExamInterface
{
    public function all():Collection;
    public function edit($id);
    public function delete($id);

}