<?php

namespace App\Repositories;

use App\Models\ExamTime;
use Illuminate\Support\Collection;

interface TimeInterface
{
    public function all():Collection;
    public function edit($id);
    public function delete($id);
}