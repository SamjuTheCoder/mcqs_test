<?php

namespace App\Repositories;

use App\Models\Semester;
use Illuminate\Support\Collection;

interface SemesterInterface
{
    public function all():Collection;

    public function delete($id);

    public function edit($id);
}