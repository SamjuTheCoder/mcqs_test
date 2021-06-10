<?php
namespace App\Repositories;

use App\Models\Question;
use Illuminate\Support\Collection;

interface QuestionRepositoryInterface
{
   public function all($id): Collection;

   public function count();

   public function deleteQuestion($id);
}