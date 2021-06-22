<?php

namespace App\Repositories\Eloquent;

use App\Repositories\TempQuestionInterface;
use Illuminate\Support\Collection;
use App\Models\TempQuestion;
use DB;
//use Your Model

/**
 * Class BrandRepository.
 */
class TempQuestionRepository implements TempQuestionInterface
{
    protected $model;
   
    public function __construct(TempQuestion $tempModel)
    {
        $this->model = $tempModel;
    }

    public function create(array $data, $examID,$questionID,$userID,$question)
    {
        
        $istrue = DB::table('temp_questions')
        ->where('examID',$examID)
        ->where('questionID',$questionID)
        ->where('studentID',$userID)
        ->where('question',$question)
        ->exists();

        if(!$istrue)
        {
            return $this->model->create($data);
        }
    }

    public function single($id)
    {
        return $this->model
        ->where('examID',$id)
        ->where('isAnswered',0)
        ->first();
    }
    
    public function next($id)
    {
        return $this->model
        ->where('id','>',$id)
        ->where('isAnswered',0)
        ->first();
    }

    public function previous($id)
    {
        return $this->model
        ->where('id','<',$id)
        ->where('isAnswered',1)
        ->first();
    }

    public function delete($examID,$studenID)
    {
        return $this->model
        ->where('examID',$examID)
        ->where('studentID','=',$studenID)
        ->delete();   
    }

    public function updateTempQuestion($examID, $studentID, $id)
    {
        return $this->model
        ->where('examID','=',$examID)
        ->where('studentID','=',$studentID)
        ->where('questionID','=',$id)
        ->update(['isAnswered'=>1]);
    }

    public function deleteStudentTime($examID,$studenID)
    {
        DB::table('student_exam_times')
        ->where('examID',$examID)
        ->where('studentID','=',$studenID)
        ->delete();   
    }

}
