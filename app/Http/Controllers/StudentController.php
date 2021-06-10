<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Module;
use App\Models\ModuleRole;
use App\Models\ExamTime;
use App\Repositories\QuestionRepositoryInterface;
use App\Repositories\AnswerRepositoryInterface;
use App\Repositories\ModuleRoleRepositoryInterface;
use App\Repositories\AssignModuleRepositoryInterface;
use App\Repositories\TakeExamRepositoryInterface;
use App\Http\Controllers\SetExamTime;
use DB;
use Auth;

class StudentController extends Controller
{
    
    private $questionRepository;
    private $answerRepository;
    private $moduleroleRepository;
    private $assignmoduleRepository;
    private $takeexamRepository;

   

    public function __construct(TakeExamRepositoryInterface $takeexamRepository, AssignModuleRepositoryInterface $assignmoduleRepository, ModuleRoleRepositoryInterface $moduleroleRepository, QuestionRepositoryInterface $questionRepository,AnswerRepositoryInterface $answerRepository)
    {
        $this->middleware('auth');

        $this->answerRepository = $answerRepository;
        $this->questionRepository = $questionRepository;
        $this->moduleroleRepository = $moduleroleRepository;
        $this->assignmoduleRepository = $assignmoduleRepository;
        $this->takeexamRepository = $takeexamRepository;

    }

    public function examInstruction()
    {
        $userID = Auth::user()->studentID;
        
        $getClass = DB::table('students')->where('id',$userID)->first();
        $currentSession = DB::table('exam_times')->first();
        $getClassx = DB::table('class_subjects')->where('class',$getClass->class)->first();

        $readMe = DB::table('create_exams')
        ->where('session',$currentSession->session)
        ->where('term',$currentSession->term)
        ->where('year',$currentSession->year)
        ->where('class',$getClass->class)
        ->where('active_status',1)
        ->exists();

        if($readMe)
        {
            $data['readme'] = DB::table('create_exams')
            ->where('session',$currentSession->session)
            ->where('term',$currentSession->term)
            ->where('year',$currentSession->year)
            ->where('class',$getClass->class)
            ->where('active_status',1)
            ->first();

        }
        else{

             $data['readme'] = null;
        }

        return view('Student.examInstruction',$data);
    }

    public function takeExam()
    {
        
        $data['exists'] = '';
        $data['question'] = $this->questionRepository->singleQuestion();
    
        return view('Student.takeExam',$data);
    }

    public function saveExam(Request $request)
    {   
        $data['exists'] = DB::table('take_exams')
         ->where('userID',Auth::user()->id)
         ->where('questionID',$request->question)
         //->where('answerID',$request->answer)
         ->exists(); 

        if($data['exists']) {
            return back();
        }else{
        $this->takeexamRepository->create(['userID'=>Auth::user()->id, 'questionID'=>$request->question, 'answerID'=>$request->answer]);
        
        $data['question'] = $this->questionRepository->nextQuestion($request->question+1);

        //$data['myAnswers'] = $this->takeexamRepository->all(Auth::user()->id,1,1);
        }
        return view('Student.takeExam',$data);
    }

    public function myExam()
    {
        $data['myAnswers'] = $this->takeexamRepository->all(Auth::user()->id,1,1);

        return view('Student.viewAnswers',$data);
    }

    
}
