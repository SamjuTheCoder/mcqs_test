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
use DB;

class AdminController extends Controller
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

    public function __construct(ClassInterface $classRepository, SemesterInterface $semesterRepository, AcademicSessionInterface $sessionRepository, AcademicYearInterface $yearRepository, ExamtypeRepositoryInterface $examtypeRepository, UserRepositoryInterface $userRepository, TakeExamRepositoryInterface $takeexamRepository,AssignModuleRepositoryInterface $assignmoduleRepository, ModuleRoleRepositoryInterface $moduleroleRepository, QuestionRepositoryInterface $questionRepository,AnswerRepositoryInterface $answerRepository)
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
    }

    public function viewQuestions()
    {
        $data['sessionx']='';
        $data['termx']='';
        $data['yearx']='';
        $data['examtypex']='';
        $data['classx']='';

        $data['questions'] = $this->questionRepository->all();

        $data['examtype'] = $this->examtypeRepository->all();
        $data['session'] = $this->sessionRepository->all();
        $data['term'] = $this->semesterRepository->all();
        $data['year'] = $this->yearRepository->all();
        $data['class'] = $this->classRepository->all();

        return view('Questions.addQuestions',$data);
    }

    //add questions
    public function saveQuestions(Request $request)
    {
        $this->validate( $request, [
            'class' => 'required',
            'session' => 'required',
            'term' => 'required|string',
            'year' => 'required',
            'question' => 'required|string',
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
        
        if(DB::table('questions')->where('class',$request->class)->where('session',$request->session)->where('term',$request->term)->where('year',$request->year)
        ->where('examtype',$request->examtype)->where('question',$request->question)->exists()){
            return back()->with('error_message','Question already exists');
        }else {
        $data['questions'] = $this->questionRepository->create(['class'=>$request->class,'session'=>$request->session,'term'=>$request->term,'year'=>$request->year,'examtype'=>$request->examtype,'question'=>$request->question,'score'=>$request->score]);
        }
        $data['questions'] = $this->questionRepository->all();
        //return back()->with('success','Question addedd successfully!');
        return view('Questions.addQuestions',$data);
    }

    public function deleteQuestions($id)
    {   
        //dd($id);
        if(DB::table('answers')->where('question_id',base64_decode($id))->exists()){
            return back()->with('error_message','Questions already in used');
        }else{
            $data['questions'] = $this->questionRepository->deleteQuestion(base64_decode($id));
        }
            return back()->with('success','Question deleted successfully!');
    }
    
    //answers 
    public function viewAnswers()
    {
        $data['questionx']='';
        //$data['answer']=null;
        $data['question'] = $this->questionRepository->all();
        $data['answer'] = $this->answerRepository->all();
        //dd($data['question']);
        return view('Answers.addAnswers',$data);
    }

    public function saveAnswers(Request $request)
    {
        $data['questionx'] = $request->question;
        $data['question'] = $this->questionRepository->all();

        if(DB::table('answers')->where('answer',$request->answer)->where('question_id',$request->question)->exists()){
            return back()->with('error_message','Record already exists');
        }else {
        $data['questions'] = $this->answerRepository->create(['question_id'=>$request->question,'answer'=>$request->answer,'correct_answer'=>$request->correct_answer]);
        }

        $data['answer'] = $this->answerRepository->all();

        return view('Answers.addAnswers',$data);
    }

    public function deleteAnswers($id)
    {   
        if(DB::table('take_exams')->where('answerID',base64_decode($id))->exists()){
            return back()->with('error_message','Questions already in used');
        }else{
        $data['questions'] = $this->answerRepository->deleteAnswer(base64_decode($id));
        }
        return back()->with('success','Answer deleted successfully!');
    }

    public function moduleRole()
    {
        $data['module'] = $this->moduleroleRepository->all();

        return view('Modules.addRoute',$data);
    }

    public function savemoduleRole(Request $request)
    {
        $this->validate($request, [
            'module_name'=> 'required',
            'route'=> 'required',
        ]);
        $this->moduleroleRepository->create(['moduleName'=>$request->module_name,'route'=>$request->route]);
        return back()->with('success','Module added successfully!');
    }

    public function deleteRoute($id)
    {   
        $this->moduleroleRepository->deleteRoute(base64_decode($id));

        return back()->with('success','Route deleted successfully!');
    }

    //assign module
    public function assignmoduleRole()
    {
        $data['rolex'] = '';
        $data['modulex'] = '';

        $data['role'] = DB::table('roles')->get();
        $data['modules'] = $this->moduleroleRepository->all();

        $data['module'] = $this->assignmoduleRepository->all();

        return view('Modules.assignModule',$data);
    }

    public function saveassignmoduleRole(Request $request)
    {
        $this->validate($request, [
            'role'=> 'required',
            'module_name'=> 'required',
        ]);
        
        $data['rolex'] = $request->role;
        $data['modulex'] = $request->module_name;

        $this->assignmoduleRepository->create(['roleID'=>$request->role,'moduleID'=>$request->module_name]);
        
        return back()->with('success','Module assign successfully!');
    }

    public function deleteassignRoute($id)
    {   
        $this->assignmoduleRepository->deleteRole(base64_decode($id));

        return back()->with('success','Deleted successfully!');
    }

    //assign user role
    public function assignuserRole()
    {
        $data['rolex'] = '';
        $data['userx'] = '';

        $data['role'] = DB::table('roles')->get();
        $data['user'] = DB::table('users')->get();

        $data['user_role'] = DB::table('user_roles')
        ->leftjoin('roles','user_roles.roleID','=','roles.id')
        ->leftjoin('users','user_roles.userID','=','users.id')
        ->select('*','user_roles.id as uid')
        ->paginate('5');

        return view('Modules.assignUserRole',$data);
    }

    public function saveassignuserRole(Request $request)
    {
        $this->validate($request, [
            'role'=> 'required',
            'user'=> 'required',
        ]);
        
        $data['rolex'] = $request->role;
        $data['userx'] = $request->user;

        $save  = new UserRole;
        $save->roleID = $request->role;
        $save->userID = $request->user;
        $save->save();

        return back()->with('success','Module assign successfully!');
    }

    public function deleteuserRole($id)
    {   
        DB::table('user_roles')->where('id',base64_decode($id))->delete();

        return back()->with('success','Deleted successfully!');
    }

    public function allExam()
    {
        $data['myAnswers'] = $this->takeexamRepository->allExam();

        return view('Student.allAnswers',$data);
    }
}
