<?php
namespace App\Repositories;

use App\Models\ExamType;
use Illuminate\Support\Collection;

interface ExamtypeRepositoryInterface
{
   public function all();

   public function count();

   public function deleteQuestion($id);
}