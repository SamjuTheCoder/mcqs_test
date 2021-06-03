<?php
namespace App\Repositories;

use App\Models\TakeExam;
use Illuminate\Support\Collection;

interface TakeExamRepositoryInterface
{
   public function all($id);

   public function allExam();

   public function count();

   public function deleteAnswer($id);
}