<?php
namespace App\Repositories;

use App\Models\Module;
use Illuminate\Support\Collection;

interface ModuleRoleRepositoryInterface
{
   public function all();

   public function count();

   public function deleteRoute($id);
}