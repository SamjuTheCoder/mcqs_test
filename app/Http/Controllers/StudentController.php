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
        $data['exists'] = DB::table('questions')->exists();;
        $data['question'] = $this->questionRepository->singleQuestion();
    
        return view('Student.takeExam',$data);
    }

    public function saveExam(Request $request)
    {       
        $this->takeexamRepository->create(['userID'=>Auth::user()->id, 'questionID'=>$request->question, 'answerID'=>$request->answer]);
        $data['exists'] = DB::table('questions')->where('id',$request->question+1)->exists();
        $data['question'] = $this->questionRepository->nextQuestion($request->question+1);

        $data['myAnswers'] = $this->takeexamRepository->all(Auth::user()->id);

        return view('Student.takeExam',$data);
    }

    public function myExam()
    {
        $data['myAnswers'] = $this->takeexamRepository->all(Auth::user()->id);

        return view('Student.viewAnswers',$data);
    }

    
}
