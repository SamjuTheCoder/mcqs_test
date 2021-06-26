<?php

namespace App\Repositories;

use App\Models\StudentClass;
use Illuminate\Support\Collection;

interface ClassInterface
{
    public function all();

    public function edit($id);

    public function delete($id);

    public function getStaffRole($id);

    public function getTeacherClass($id);
}
