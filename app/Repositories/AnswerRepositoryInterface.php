<?php
namespace App\Repositories;

use App\Models\Answer;
use Illuminate\Support\Collection;

interface AnswerRepositoryInterface
{
   public function all($id);

   public function allQuestion();

   public function count();

   public function deleteAnswer($id);
}