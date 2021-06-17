<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Module;
use App\Models\ModuleRole;
use App\Models\UserRole;
use App\Models\ExamType;
use App\Models\AcademicYear;
use App\Models\AcademicSession;
use App\Models\Semester;
use App\Models\CreateTime;
use App\Repositories\QuestionRepositoryInterface;
use App\Repositories\AnswerRepositoryInterface;
use App\Repositories\ModuleRoleRepositoryInterface;
use App\Repositories\AssignModuleRepositoryInterface;
use App\Repositories\TakeExamRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\ExamtypeRepositoryInterface;
use App\Repositories\AcademicSessionInterface;
use App\Repositories\AcademicYearInterface;
use App\Repositories\SemesterInterface;
use App\Repositories\ClassInterface;
use App\Repositories\CreateExamInterface;
use DB;

class CreateExamController extends Controller
{
    
    private $questionRepository;
    private $answerRepository;
    private $moduleroleRepository;
    private $assignmoduleRepository;
    private $takeexamRepository;
    private $userRepository;
    private $examtypeRepository;
    private $semesterRepository;
    private $sessionRepository;
    private $yearRepository;
    private $classRepository;
    private $createexamsRepository;

    public function __construct(CreateExamInterface $createexamsRepository, ClassInterface $classRepository, SemesterInterface $semesterRepository, AcademicSessionInterface $sessionRepository, AcademicYearInterface $yearRepository, ExamtypeRepositoryInterface $examtypeRepository, UserRepositoryInterface $userRepository, TakeExamRepositoryInterface $takeexamRepository,AssignModuleRepositoryInterface $assignmoduleRepository, ModuleRoleRepositoryInterface $moduleroleRepository, QuestionRepositoryInterface $questionRepository,AnswerRepositoryInterface $answerRepository)
    {
        $this->middleware('auth');
        $this->answerRepository = $answerRepository;
        $this->questionRepository = $questionRepository;
        $this->moduleroleRepository = $moduleroleRepository;
        $this->assignmoduleRepository = $assignmoduleRepository;
        $this->takeexamRepository = $takeexamRepository;
        $this->userRepository = $userRepository;
        $this->examtypeRepository = $examtypeRepository;
        $this->semesterRepository = $semesterRepository;
        $this->sessionRepository = $sessionRepository;
        $this->yearRepository = $yearRepository;
        $this->classRepository = $classRepository;
        $this->createexamsRepository = $createexamsRepository;
    }

    public function viewExams()
    {
        $data['sessionx']='';
        $data['termx']='';
        $data['yearx']='';
        $data['examtypex']='';
        $data['classx']='';

        $data['exams'] = $this->createexamsRepository->all();

        $data['examtype'] = $this->examtypeRepository->all();
        $data['session'] = $this->sessionRepository->all();
        $data['term'] = $this->semesterRepository->all();
        $data['year'] = $this->yearRepository->all();
        $data['class'] = $this->classRepository->all();

        return view('Questions.addExam',$data);
    }

    //processing ajax
    public function loadSubects(Request $request)
    {
      $class_id = $request->get('class_id');
    
      $data = DB::table('class_subjects')
      ->leftjoin('subjects','class_subjects.subject','=','subjects.id')
      ->where('class_subjects.class', '=',$class_id)
      ->get();
      return response()->json($data); 
    }
    //add questions
    public function saveExams(Request $request)
    {
        $this->validate( $request, [
            'class' => 'required',
            'session' => 'required',
            'term' => 'required|string',
            'year' => 'required',
            'exam' => 'required|string',
            'subject' => 'required|string',
            'examtype' => 'required',
           ]);
        

        $data['sessionx'] = $request->session;
        $data['termx']  = $request->term;
        $data['yearx']  = $request->year;
        $data['examtypex']  = $request->examtype;
        $data['classx'] =  $request->class;

        
        $data['examtype'] = $this->examtypeRepository->all();
        $data['session'] = $this->sessionRepository->all();
        $data['term'] = $this->semesterRepository->all();
        $data['year'] = $this->yearRepository->all();
        $data['class'] = $this->classRepository->all();
        
        $time = $request->quizTimeMinute;
        
        if(DB::table('create_exams')->where('examtype',$request->examtype)->where('class',$request->class)->where('subject',$request->subject)->where('session',$request->session)->where('term',$request->term)->where('examname',$request->examname)->where('time',$time)->where('instruction',$request->instruction)
        ->exists()){
            return back()->with('error_message','Question already exists');
        }else {
        $data['exams'] = $this->createexamsRepository->create(['examtype'=>$request->examtype,'class'=>$request->class,'subject'=>$request->subject,'session'=>$request->session,'term'=>$request->term,'year'=>$request->year,'examname'=>$request->exam,'mins'=>$request->quizTimeMinute,'time'=>$time,'instruction'=>$request->instruction]);
        }
        $data['exams'] = $this->createexamsRepository->all();
        //return back()->with('success','Question addedd successfully!');
        return view('Questions.addExam',$data);
    }

    public function deleteExams($id)
    {   
        //dd($id);
        if(DB::table('answers')->where('question_id',base64_decode($id))->exists()){
            return back()->with('error_message','Questions already in used');
        }else{
            $data['questions'] = $this->questionRepository->deleteQuestion(base64_decode($id));
        }
            return back()->with('success','Question deleted successfully!');
    }
    
   
}
