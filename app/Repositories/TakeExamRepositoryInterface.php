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

   public function updateStatus($examID,$userID);

   public function previewScore($examID,$userID);

   public function examTaken($id);

   public function pastpapers($id,$userID);
   
   public function viewpastpapers($id,$session,$subject,$term,$type,$class);

   public function studentAnswersExists($userID,$question);
   
   public function getAnswersByQuestionID($id);

   public function isExamSubmitted($examID,$userID);

   public function updatePreviousButton(array $data, $questionID);

}