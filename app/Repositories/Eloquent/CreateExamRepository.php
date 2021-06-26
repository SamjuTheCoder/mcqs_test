<?php

namespace App\Repositories\Eloquent;

use App\Repositories\CreateExamInterface;
use Illuminate\Support\Collection;
use App\Models\CreateExam;
use Auth;
use DB;

//use Your Model

/**
 * Class BrandRepository.
 */
class CreateExamRepository extends BaseRepository implements CreateExamInterface
{
    /**
     * @return string
     *  Return the model
     */
    public function __construct(CreateExam $model)
    {
        //return YourModel::class;
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function all()
    {
        return $this->model
        ->leftjoin('exam_types','create_exams.examtype','=','exam_types.id')
        ->leftjoin('student_classes','create_exams.class','=','student_classes.id')
        ->leftjoin('subjects','create_exams.subject','=','subjects.id')
        ->leftjoin('question_types','create_exams.question_type','=','question_types.id')
        ->select('*','create_exams.id as qid')
        ->paginate(5);
    }

    public function getExamDetailByUser($id)
    {
        return $this->model
        ->where('userID',$id)
        ->leftjoin('exam_types','create_exams.examtype','=','exam_types.id')
        ->leftjoin('student_classes','create_exams.class','=','student_classes.id')
        ->leftjoin('subjects','create_exams.subject','=','subjects.id')
        ->leftjoin('question_types','create_exams.question_type','=','question_types.id')
        ->select('*','create_exams.id as qid')
        ->paginate(5);
    }

    public function gettime($id)
    {
        return $this->model->where('id',$id)->first();
    }

    public function edit($id)
    {
        return $this->model->find($id)->first();
    }


    public function delete($id)
    {   
        if(DB::table('questions')->where('examID',$id)->exists())
        {
            return null;

        }else {

            return $this->model->find($id)->delete();
        }
    }

    // public function examSubject($class,$active_status)
    // {      
    //     return DB::table('subjects')
    //     ->leftjoin('student_classes','create_exams.class','=','student_classes.id')
    //     ->leftjoin('subjects','create_exams.subject','=','subjects.id')
    //     ->where('create_exams.class',$class)
    //     ->where('create_exams.active_status',$active_status)
    //     ->select('*','create_exams.id as sid','subjects.id as subjectID')
    //     ->get();
    // }

    public function getexamSubject($class)
    {      
        return $this->model
        ->where('create_exams.class',$class)
        ->where('create_exams.active_status',0)
        ->leftjoin('student_classes','create_exams.class','=','student_classes.id')
        ->leftjoin('subjects','create_exams.subject','=','subjects.id')
        ->select('*','create_exams.id as sid','subjects.id as subjectID', 'create_exams.subject as subject')
        ->get();
    }

    public function getInstruction($id)
    {
        $getClass = Auth::user()->class;
        $currentSession = DB::table('exam_times')->first();
       // dd($getClass);
        if(DB::table('create_exams')
        ->where('session',$currentSession->session)
        ->where('term',$currentSession->term)
        ->where('year',$currentSession->year)
        ->where('class',$getClass)
        ->where('active_status',1)
        ->exists()){
            
            return $this->model
            ->where('session',$currentSession->session)
            ->where('term',$currentSession->term)
            ->where('year',$currentSession->year)
            ->where('class',$getClass)
            ->where('create_exams.subject',$id)
            ->where('active_status',1)
            ->leftjoin('subjects','create_exams.subject','=','subjects.id')
            ->select('*','create_exams.id as eid','subjects.id as subjectID')
            ->first();
        }
        else
        {
            return null;
        }
    }

    public function updateExam(array $data, $id)
    {
        return $this->model
            ->where('id',$id)
            ->update($data);
    }

    public function gettitle($id)
    {
        return $this->model
        ->where('create_exams.subject',$id)
        ->leftjoin('exam_types','create_exams.examtype','=','exam_types.id')
        ->leftjoin('student_classes','create_exams.class','=','student_classes.id')
        ->leftjoin('subjects','create_exams.subject','=','subjects.id')
        ->leftjoin('question_types','create_exams.question_type','=','question_types.id')
        ->first();
    }

    public function getExamTitle($id)
    {
        return $this->model
        ->where('create_exams.id',$id)
        ->leftjoin('exam_types','create_exams.examtype','=','exam_types.id')
        ->leftjoin('student_classes','create_exams.class','=','student_classes.id')
        ->leftjoin('subjects','create_exams.subject','=','subjects.id')
        ->leftjoin('question_types','create_exams.question_type','=','question_types.id')
        ->first();
    }

    public function checkIfExamRecordExists($examtype,$question_type,$class,$subject,$session,$term,$year,$examname,$time)
    {
        return $this->model
        ->where('examtype',$examtype)
        ->where('question_type',$question_type)
        ->where('class',$class)
        ->where('subject',$subject)
        ->where('session',$session)
        ->where('term',$term)
        ->where('year',$year)
        ->where('examname',$examname)
        ->where('time',$time)
        ->exists();
    } 
}
