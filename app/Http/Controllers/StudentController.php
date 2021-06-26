<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\QuestionRepositoryInterface;
use App\Repositories\AnswerRepositoryInterface;
use App\Repositories\ModuleRoleRepositoryInterface;
use App\Repositories\AssignModuleRepositoryInterface;
use App\Repositories\TakeExamRepositoryInterface;
use App\Repositories\StudentExamTimeInterface;
use App\Repositories\CreateExamInterface;
use App\Repositories\TempQuestionInterface;
use App\Repositories\SubjectsInterface;
use App\Repositories\ReusableInterface;
use App\Http\Controllers\SetExamTime;
use App\Models\TempQuestion;
use DB;
use Auth;
use Session;

class StudentController extends Controller
{
    
    private $questionRepository;
    private $answerRepository;
    private $moduleroleRepository;
    private $assignmoduleRepository;
    private $takeexamRepository;
    private $studentexamtime;
    private $createexamsRepository;
    private $tempQuestion;
    private $subjectsRepo;
    private $reusableRepository;

   

    public function __construct(ReusableInterface $reusableRepository,SubjectsInterface $subjectRepo,TempQuestionInterface $tempQuestion, CreateExamInterface $createexamsRepository, StudentExamTimeInterface $studentexamtime, TakeExamRepositoryInterface $takeexamRepository, AssignModuleRepositoryInterface $assignmoduleRepository, ModuleRoleRepositoryInterface $moduleroleRepository, QuestionRepositoryInterface $questionRepository,AnswerRepositoryInterface $answerRepository)
    {
        $this->middleware('auth');

        $this->answerRepository = $answerRepository;
        $this->questionRepository = $questionRepository;
        $this->moduleroleRepository = $moduleroleRepository;
        $this->assignmoduleRepository = $assignmoduleRepository;
        $this->takeexamRepository = $takeexamRepository;
        $this->studentexamtime = $studentexamtime;
        $this->createexamsRepository = $createexamsRepository;
        $this->tempQuestion = $tempQuestion;
        $this->subjectRepo = $subjectRepo;
        $this->reusableRepository = $reusableRepository;

    }

    public function examSubject()
    {
        
        $studentClass = Auth::user()->class;
        $data['examinfo'] = $this->takeexamRepository->examTaken(Auth::user()->class);
        $data['userRole'] = $this->reusableRepository->getUserRole(Auth::user()->id);

        return view('Student.preInformation',$data);
    }

    public function examInstruction($id)
    {
        
        $data['userRole'] = $this->reusableRepository->getUserRole(Auth::user()->id);
        $data['title'] = $this->createexamsRepository->gettitle(base64_decode($id));
        $data['question'] = [];

        $userID = Auth::user()->studentID;
        $data['readme'] = $this->createexamsRepository->getInstruction(base64_decode($id));
       
        if($data['readme']==null)
        {
            return back();
        }
  
        Session::put('session',$data['readme']->session);
        Session::put('class',$data['readme']->class);
        Session::put('term',$data['readme']->term);
        Session::put('year',$data['readme']->year);
        Session::put('subject',$data['readme']->subjectID);

        $data['count_question'] = $this->questionRepository->count($data['readme']->eid);
        $data['question'] = $this->questionRepository->singleQuestion($data['readme']->eid);
        
        foreach($data['question'] as $questions)
        {
            $this->tempQuestion->create([
                'examID'=>$questions->examID,
                'questionID'=>$questions->id,
                'studentID'=>Auth::user()->id,
                'question'=>$questions->question,
            ],$questions->examID, $questions->id, Auth::user()->id,$questions->question);
      
        }

        Session::put('count',$data['count_question']);
        Session::put('question_type',$data['title']->question_type);
        Session::put('examID',$questions->examID);
        
        $data['exam_status'] = $this->takeexamRepository->isExamSubmitted($data['readme']->eid,Auth::user()->id);

        return view('Student.examInstruction',$data);
    }

    public function takeExam(Request $request)
    {
        $data['count_question'] = Session::get('count');
        $data['count_questionx'] = Session::get('count');
        $data['question_type'] = Session::get('question_type');

        $data['time'] = $this->createexamsRepository->gettime(base64_decode($request->equestion));
        $data['getQuiz_time']= $data['time']->hour.':'.$data['time']->mins.':00';

        $data['isexists'] = $this->studentexamtime->ifexists(Session::get('examID'),Auth::user()->id);

        if($data['isexists']){

            $data['myTime'] = $this->studentexamtime->find(Session::get('examID'),Auth::user()->id);

            $data['hour'] = $data['myTime']->hour;
            $data['mins'] = $data['myTime']->mins;
            $data['getQuizTime']= $data['myTime']->stop_current_time;

            $timeExists = $this->studentexamtime->check(Session::get('examID'),Auth::user()->id,$data['hour'],$data['mins']);

            if(!$timeExists){
                $this->studentexamtime->create([
                    'examID'=>Session::get('examID'),
                    'studentID'=>Auth::user()->id,
                    'hour'=>$data['time']->hour,
                    'mins'=>$data['time']->mins,
                    'questions_count'=>$data['count_question'],
                    'stop_current_time'=>$data['getQuiz_time']
                ]);
            }
        }
        else
        {
            $this->studentexamtime->create([
                'examID'=>Session::get('examID'),
                'studentID'=>Auth::user()->id,
                'hour'=>$data['time']->hour, 
                'mins'=>$data['time']->mins,
                'questions_count'=>$data['count_question'],
                'stop_current_time'=>$data['getQuiz_time']
            ]);
            
            $data['myTime'] = $this->studentexamtime->find(Session::get('examID'), Auth::user()->id);

            $data['hour'] = $data['myTime']->hour;
            $data['mins'] = $data['myTime']->mins;
            $data['getQuizTime']= $data['myTime']->stop_current_time;
        }

        $data['exists'] = '';
        $data['question'] = $this->tempQuestion->single(base64_decode($request->equestion));
        Session::put('exam_id',$request->equestion);
        $data['userRole'] = $this->reusableRepository->getUserRole(Auth::user()->id);

        return view('Student.takeExam',$data);
    }

    public function saveExam(Request $request)
    {   
        $data['getCorrectAnswer']= [];
        $nextButton = $request->input('next');
        $previousButton = $request->input('previous');
        $submitButton = $request->input('submit');

        $data['count_questionx'] = Session::get('count');
        $data['question_type'] = Session::get('question_type');
        
        $get_exam_id = Session::get('exam_id');
        

        if($nextButton=='next')
        {
            //dd(base64_decode($request->question));
            $img = $request->image;
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
        
            $image_base64 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '',$image_parts[1]));
            $fileName = uniqid() . '.png';
        
            file_put_contents(public_path('exam/pictures')."/".$fileName, $image_base64);

            $getCount = $this->studentexamtime->find(Session::get('examID'),Auth::user()->id);
            $data['count_question'] =  $getCount->questions_count;
            $data['getCorrectAnswer'] =  $this->takeexamRepository->getAnswersByQuestionID(base64_decode($request->questionID));     

            if($this->takeexamRepository->studentAnswersExists(Auth::user()->id, base64_decode($request->questionID))) {
                
                 
                if($data['question_type']==1) { //subjective question
                    
                    foreach($data['getCorrectAnswer'] as $answers)
                    {
                        if(strstr(strtolower($answers->answer),strtolower($request->answer)))
                        {
                            $this->takeexamRepository->updatePreviousButton([
                                'userID'=>Auth::user()->id,
                                'examID'=>base64_decode($get_exam_id),
                                'class'=>Auth::user()->class,
                                'session'=>Session::get('session'),
                                'term'=>Session::get('term'),
                                'year'=>Session::get('year'),
                                'subject'=>Session::get('subject'),
                                'questionID'=>base64_decode($request->questionID),
                                'answerID'=>$answers->id,
                                'subjective_answer'=>$request->answer,
                                'picture'=>$fileName
                            ], base64_decode($request->questionID));
                        }
                    }
                }
                elseif($data['question_type']==2) { //essay question 
                    
                    $this->takeexamRepository->updatePreviousButton([
                        'userID'=>Auth::user()->id,
                        'examID'=>base64_decode($get_exam_id),
                        'class'=>Auth::user()->class,
                        'session'=>Session::get('session'),
                        'term'=>Session::get('term'),
                        'year'=>Session::get('year'),
                        'subject'=>Session::get('subject'),
                        'questionID'=>base64_decode($request->questionID),
                        'answerID'=>$answers->id,
                        'subjective_answer'=>$request->answer,
                        'picture'=>$fileName
                    ], base64_decode($request->questionID));
                }
                elseif($data['question_type']==3) { //multiple choice
                    $this->takeexamRepository->updatePreviousButton([
                        'userID'=>Auth::user()->id,
                        'examID'=>base64_decode($get_exam_id),
                        'class'=>Auth::user()->class,
                        'session'=>Session::get('session'),
                        'term'=>Session::get('term'),
                        'year'=>Session::get('year'),
                        'subject'=>Session::get('subject'),
                        'questionID'=>base64_decode($request->questionID),
                        'answerID'=>$request->id,
                        'subjective_answer'=>$request->answer,
                        'picture'=>$fileName
                    ], base64_decode($request->questionID));
                }
            }
            
            $data['update'] = $this->tempQuestion->updateTempQuestion(base64_decode($get_exam_id), Auth::user()->id, base64_decode($request->questionID));
            
            if($data['question_type']==1) { //subjective question
                
                foreach($data['getCorrectAnswer'] as $answers)
                {
                    if(strstr(strtolower($answers->answer),strtolower($request->answer)))
                    {
                        $this->takeexamRepository->create([
                            'userID'=>Auth::user()->id,
                            'examID'=>base64_decode($get_exam_id),
                            'class'=>Auth::user()->class,
                            'session'=>Session::get('session'),
                            'term'=>Session::get('term'),
                            'year'=>Session::get('year'),
                            'subject'=>Session::get('subject'),
                            'questionID'=>base64_decode($request->questionID),
                            'answerID'=>$answers->id,
                            'subjective_answer'=>$request->answer,
                            'picture'=>$fileName
                        ]);
                    }
                }
            }
            elseif($data['question_type']==2) { //essay question 
                
                $this->takeexamRepository->create([
                    'userID'=>Auth::user()->id,
                    'examID'=>base64_decode($get_exam_id),
                    'class'=>Auth::user()->class,
                    'session'=>Session::get('session'),
                    'term'=>Session::get('term'),
                    'year'=>Session::get('year'),
                    'subject'=>Session::get('subject'),
                    'questionID'=>base64_decode($request->questionID),
                    //'answerID'=>$answers->id,
                    'essay_answer'=>$request->answer,
                    'picture'=>$fileName
                ]);
            }
            elseif($data['question_type']==3) { //multiple choice
                $this->takeexamRepository->create([
                    'userID'=>Auth::user()->id,
                    'examID'=>base64_decode($get_exam_id),
                    'class'=>Auth::user()->class,
                    'session'=>Session::get('session'),
                    'term'=>Session::get('term'),
                    'year'=>Session::get('year'),
                    'subject'=>Session::get('subject'),
                    'questionID'=>base64_decode($request->questionID),
                    'answerID'=>base64_decode($request->answer),
                    //'subjective_answer'=>$request->answer,
                    'picture'=>$fileName
                ]);
            }

            $data['question'] = $this->tempQuestion->next(base64_decode($request->question));
            $this->studentexamtime->updateCount(['questions_count'=>$data['count_question']-1], Auth::user()->id, Session::get('examID'));
                    
            $data['myTime'] = $this->studentexamtime->find(Session::get('examID'),Auth::user()->id);

            $data['hour'] = $data['myTime']->hour;
            $data['mins'] = $data['myTime']->mins;
            $data['getQuizTime']= $data['myTime']->stop_current_time;

        }
        elseif($previousButton=='previous')
        {
            //dd(base64_decode($request->question));
            $get_exam_id = Session::get('exam_id');
            $getCount = $this->studentexamtime->find(Auth::user()->id);
            $data['count_question'] =  $getCount->questions_count;

            $data['question'] = $this->tempQuestion->previous(base64_decode($request->question));
            $data['myTime'] = $this->studentexamtime->find(Auth::user()->id);

            $data['hour'] = $data['myTime']->hour;
            $data['mins'] = $data['myTime']->mins;
            $data['getQuizTime']= $data['myTime']->stop_current_time;

        }
        elseif($submitButton=='Submit')
        {
            $img = $request->image;
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
        
            $image_base64 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '',$image_parts[1]));
            $fileName = uniqid() . '.png';

            file_put_contents(public_path('exam/pictures')."/".$fileName, $image_base64);

            $get_exam_id = Session::get('exam_id');
            $getCount = $this->studentexamtime->find(Session::get('examID'), Auth::user()->id);
            $data['count_question'] =  $getCount->questions_count;
            
            if($this->takeexamRepository->studentAnswersExists(Auth::user()->id, base64_decode($request->questionID))) {
                return back();
            }
            $data['getCorrectAnswer'] =  $this->takeexamRepository->getAnswersByQuestionID(base64_decode($request->questionID));          

            if($data['question_type']==1) { //subjective question
                
                foreach($data['getCorrectAnswer'] as $answers)
                {
                    if(strstr(strtolower($answers->answer),strtolower($request->answer)))
                    {
                        $this->takeexamRepository->create([
                            'userID'=>Auth::user()->id,
                            'examID'=>base64_decode($get_exam_id),
                            'class'=>Auth::user()->class,
                            'session'=>Session::get('session'),
                            'term'=>Session::get('term'),
                            'year'=>Session::get('year'),
                            'subject'=>Session::get('subject'),
                            'questionID'=>base64_decode($request->questionID),
                            'answerID'=>$answers->id,
                            'subjective_answer'=>$request->answer,
                            'picture'=>$fileName
                        ]);
                    }
                }
            }
            elseif($data['question_type']==2) { //essay question 
                
                $this->takeexamRepository->create([
                    'userID'=>Auth::user()->id,
                    'examID'=>base64_decode($get_exam_id),
                    'class'=>Auth::user()->class,
                    'session'=>Session::get('session'),
                    'term'=>Session::get('term'),
                    'year'=>Session::get('year'),
                    'subject'=>Session::get('subject'),
                    'questionID'=>base64_decode($request->questionID),
                    //'answerID'=>$answers->id,
                    'essay_answer'=>$request->answer,
                    'picture'=>$fileName
                ]);
            }
            elseif($data['question_type']==3) { //multiple choice
                $this->takeexamRepository->create([
                    'userID'=>Auth::user()->id,
                    'examID'=>base64_decode($get_exam_id),
                    'class'=>Auth::user()->class,
                    'session'=>Session::get('session'),
                    'term'=>Session::get('term'),
                    'year'=>Session::get('year'),
                    'subject'=>Session::get('subject'),
                    'questionID'=>base64_decode($request->questionID),
                    'answerID'=>$request->answer,
                    //'subjective_answer'=>$request->answer,
                    'picture'=>$fileName
                ]);
            }

            $this->studentexamtime->updateCount(['questions_count'=>$data['count_question']-1],Auth::user()->id, Session::get('examID'));
            $data['myTime'] = $this->studentexamtime->find(Session::get('examID'),Auth::user()->id);

            $data['hour'] = $data['myTime']->hour;
            $data['mins'] = $data['myTime']->mins;
            $data['getQuizTime']= $data['myTime']->stop_current_time;
            $this->tempQuestion->delete(base64_decode($get_exam_id),Auth::user()->id); //delete record from temp questions    
            //$this->tempQuestion->deleteStudentTime(base64_decode($get_exam_id),Auth::user()->id); //delete record from student time       
            $this->takeexamRepository->updateStatus(base64_decode($get_exam_id),Auth::user()->id); //update status   
            
            Session::forget('session');
            Session::forget('class');
            Session::forget('term');
            Session::forget('year');
            Session::forget('subject');
            Session::forget('examID');

            return redirect()->route('preView');
            
        }

        $data['userRole'] = $this->reusableRepository->getUserRole(Auth::user()->id);

        return view('Student.takeExam',$data);
            
    }

    //constantly updating exam time using ajax
    public function updateTime(Request $request)
    {
        $this->studentexamtime->updateTime([
            'stop_current_time'=>$request->getTime
        ], Auth::user()->id, Session::get('examID')); 
    }

    public function displayScores()
    {
        $data['current_subject'] = null;
        $data['scores'] = $this->takeexamRepository->previewScore(base64_decode(Session::get('exam_id')),Auth::user()->id);
        $data['userRole'] = $this->reusableRepository->getUserRole(Auth::user()->id);

        return view('Student.preview',$data);
    }

    public function pastExams()
    {
        $studentClass = Auth::user()->class;
        
        $data['examinfo'] = $this->takeexamRepository->pastpapers($studentClass, Auth::user()->id);
        $data['userRole'] = $this->reusableRepository->getUserRole(Auth::user()->id);

        return view('Student.pastExams',$data);
    }

    public function viewpastExams($session,$subject,$term,$type,$class)
    {
       // dd($subject);
        $data['current_subject'] = $this->subjectRepo->getsubject($subject);
        $data['scores'] = $this->takeexamRepository->viewpastpapers(Auth::user()->id,$session,$subject,$term,$type,$class);
        $data['userRole'] = $this->reusableRepository->getUserRole(Auth::user()->id);
        
        return view('Student.preview',$data);
    }

    
}
