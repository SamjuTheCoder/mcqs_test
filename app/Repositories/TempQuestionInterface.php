<?php
namespace App\Repositories;

use App\Models\TempQuestion;
use Illuminate\Support\Collection;

interface TempQuestionInterface
{
   public function create(array $data,$examID,$questionID,$userID,$question);
   public function single($id);
   public function next($id);
   public function previous($id);
   public function delete($examID,$studenID);
   public function updateTempQuestion($examID, $studentID, $id);
   public function deleteStudentTime($examID,$studenID);


}