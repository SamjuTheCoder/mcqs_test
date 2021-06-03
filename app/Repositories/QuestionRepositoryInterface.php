<?php
namespace App\Repositories;

use App\Models\Question;
use Illuminate\Support\Collection;

interface QuestionRepositoryInterface
{
   public function all(): Collection;

   public function count();

   public function deleteQuestion($id);
}