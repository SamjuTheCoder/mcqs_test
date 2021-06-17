<?php
namespace App\Repositories;

use App\Models\Question;
use App\Models\TempQuestion;
use Illuminate\Support\Collection;

interface QuestionRepositoryInterface
{
   public function all($id): Collection;

   public function count($id);

   public function singleQuestion($id);

   public function nextQuestion($id,$exam);

   public function deleteQuestion($id);

}