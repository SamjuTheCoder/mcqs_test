<?php

namespace App\Repositories\Eloquent;

use App\Repositories\TakeExamRepositoryInterface;
use Illuminate\Support\Collection;
use App\Models\TakeExam;
use DB;

//use Your Model

/**
 * Class BrandRepository.
 */
class TakeExamRepository extends BaseRepository implements TakeExamRepositoryInterface
{
    /**
     * @return string
     *  Return the model
     */
    public function __construct(TakeExam $model)
    {
        //return YourModel::class;
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function all($id,$status,$confirm)
    {
        return $this->model->where('userID',$id)->where('status',$status)->where('isConfirmed',$confirm)->leftjoin('answers','take_exams.answerID','=','answers.id')->leftjoin('questions','take_exams.questionID','=','questions.id')->get();
    }  

    public function allExam()
    {
        return $this->model
        ->leftjoin('users','take_exams.userID','=','users.id')
        ->leftjoin('answers','take_exams.answerID','=','answers.id')
        ->leftjoin('questions','take_exams.questionID','=','questions.id')
        ->get();
    }  

    public function count()
    {
        return $this->model->count();
    }

    public function deleteAnswer($id)
    {
        return $this->model->find($id)->delete();
    }

    public function updateStatus($examID,$userID)
    {
        return $this->model->where('examID',$examID)->where('userID',$userID)->update(['status'=>1]);
    }

    public function previewScore($examID,$id)
    {
        return $this->model
        ->where('take_exams.examID',$examID)
        ->where('take_exams.userID',$id)
        ->where('take_exams.status',1)
        ->where('create_exams.active_status',1)
        ->leftjoin('users','take_exams.userID','=','users.id')
        ->leftjoin('answers','take_exams.answerID','=','answers.id')
        ->leftjoin('questions','take_exams.questionID','=','questions.id')
        ->leftjoin('create_exams','create_exams.id','=','questions.examID')
        ->leftjoin('exam_types','create_exams.examtype','=','exam_types.id')
        ->get();
    }

    public function examTaken($id)
    {
        return DB::table('create_exams')
        ->where('create_exams.class',$id)
        ->where('create_exams.active_status',1)
        ->leftjoin('subjects','create_exams.subject','=','subjects.id')
        ->leftjoin('exam_types','create_exams.examtype','=','exam_types.id')
        ->select('*','subjects.subject as subject', 'create_exams.subject as subjectID','create_exams.id as examID')
        ->get();
    }  

    public function pastpapers($id,$userID)
    {
        return DB::table('create_exams')
        ->where('create_exams.class',$id)
        ->where('create_exams.active_status',0)
        ->where('take_exams.userID',$userID)
        ->where('take_exams.status',1)
        ->leftjoin('subjects','create_exams.subject','=','subjects.id')
        ->leftjoin('exam_types','create_exams.examtype','=','exam_types.id')
        ->leftjoin('questions','create_exams.id','=','questions.examID')
        ->leftjoin('take_exams','questions.id','=','take_exams.questionID')
        ->select('*','subjects.subject as subject', 'create_exams.subject as subjectID')
        ->groupby('questions.examID')
        ->get();
    }

    public function viewpastpapers($id,$session,$subject,$term,$type,$class)
    {
        return $this->model
        ->where('take_exams.userID',$id)
        ->where('take_exams.status',1)
        ->where('create_exams.active_status',0)
        ->where('create_exams.session',$session)
        ->where('create_exams.subject',$subject)
        ->where('create_exams.term',$term)
        ->where('create_exams.examtype',$type)
        ->where('create_exams.class',$class)
        ->leftjoin('users','take_exams.userID','=','users.id')
        ->leftjoin('answers','take_exams.answerID','=','answers.id')
        ->leftjoin('questions','take_exams.questionID','=','questions.id')
        ->leftjoin('create_exams','create_exams.id','=','questions.examID')
        ->leftjoin('exam_types','create_exams.examtype','=','exam_types.id')
        ->get();
    }

    public function studentAnswersExists($userID,$question)
    {
        return $this->model
        ->where('userID',$userID)
        ->where('questionID',$question)
        //->where('answerID',$answer)
        ->exists(); 
    }

    public function getAnswersByQuestionID($id)
    {
        return DB::table('answers')
        ->where('question_id',$id)
        ->get();
    }

    public function isExamSubmitted($examID,$userID)
    {
        if( $this->model
        ->where('examID',$examID)
        ->where('userID',$userID)
        ->where('status',1)
        ->exists()) {

            return $this->model
            ->where('examID',$examID)
            ->where('userID',$userID)
            ->where('status',1)
            ->first();
        }
        else {

            return null;
        }
    }

    public function updatePreviousButton(array $data, $questionID)
    {
        return $this->model
        ->where('questionID',$questionID)
        ->update($data);
    }


    
}
