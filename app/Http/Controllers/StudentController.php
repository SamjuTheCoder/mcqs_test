<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Module;
use App\Models\ModuleRole;
use App\Repositories\QuestionRepositoryInterface;
use App\Repositories\AnswerRepositoryInterface;
use App\Repositories\ModuleRoleRepositoryInterface;
use App\Repositories\AssignModuleRepositoryInterface;
use App\Repositories\TakeExamRepositoryInterface;
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

    public function takeExam()
    {
        //dd('kk');
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
