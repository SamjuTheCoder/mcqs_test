<?php
namespace App\Repositories;

use App\Models\ModuleRole;
use Illuminate\Support\Collection;

interface AssignModuleRepositoryInterface
{
   public function all();

   public function count();

   public function deleteRole($id);
}