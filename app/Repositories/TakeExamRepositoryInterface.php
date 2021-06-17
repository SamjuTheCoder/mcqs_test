<?php
namespace App\Repositories;

use App\Models\TakeExam;
use Illuminate\Support\Collection;

interface TakeExamRepositoryInterface
{
   public function all($id,$status,$confirm);

   public function allExam();

   public function count();

   public function deleteAnswer($id);

   public function updateStatus(array $data, $id);

   public function previewScore($id);

   public function examTaken($id);
}