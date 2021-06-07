<?php

namespace App\Repositories;

use App\Models\AcademicYear;
use Illuminate\Support\Collection;

interface AcademicYearInterface
{
    public function all():Collection;

    public function delete($id);

    public function edit($id);
}
