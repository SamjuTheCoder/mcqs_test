<?php

namespace App\Repositories;

use App\Models\StudentClass;
use Illuminate\Support\Collection;

interface ClassInterface
{
    public function all(): Collection;

    public function edit($id);

    public function delete($id);
}
