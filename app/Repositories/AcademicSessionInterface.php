<?php

namespace App\Repositories;

use App\Models\AcademicSession;
use Illuminate\Support\Collection;

interface AcademicSessionInterface
{
   public function all(): Collection;

   public function delete($id);

   public function edit($id);
   
}

