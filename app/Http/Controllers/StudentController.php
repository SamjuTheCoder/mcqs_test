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
    private $createtime;
    private $tempquestion;

   

    public function __construct(TempQuestionInterface $tempquestion, CreateExamInterface $createtime, StudentExamTimeInterface $studentexamtime, TakeExamRepositoryInterface $takeexamRepository, AssignModuleRepositoryInterface $assignmoduleRepository, ModuleRoleRepositoryInterface $moduleroleRepository, QuestionRepositoryInterface $questionRepository,AnswerRepositoryInterface $answerRepository)
    {
        $this->middleware('auth');

        $this->answerRepository = $answerRepository;
        $this->questionRepository = $questionRepository;
        $this->moduleroleRepository = $moduleroleRepository;
        $this->assignmoduleRepository = $assignmoduleRepository;
        $this->takeexamRepository = $takeexamRepository;
        $this->studentexamtime = $studentexamtime;
        $this->createtime = $createtime;
        $this->tempquestion = $tempquestion;

    }

    public function examSubject()
    {
        
        $studentClass = Auth::user()->class;
        $data['getClass'] = $this->createtime->examSubject($studentClass,1);

        return view('Student.preInformation',$data);
    }

    public function examInstruction($id)
    {
        $data['istrue'] = $this->takeexamRepository->examTaken(Auth::user()->id);
        dd($data['istrue']);
        $this->tempquestion->delete(Auth::user()->id);

        $data['question'] = [];

        $userID = Auth::user()->studentID;
        $data['readme'] = $this->createtime->getInstruction(base64_decode($id));
        $data['count_question'] = $this->questionRepository->count($data['readme']->eid);
        $data['question'] = $this->questionRepository->singleQuestion($data['readme']->eid);
        
        foreach($data['question'] as $questions)
        {
            $this->tempquestion->create([
                'examID'=>$questions->examID,
                'questionID'=>$questions->id,
                'studentID'=>Auth::user()->id,
                'question'=>$questions->question,
            ],$questions->examID, $questions->id, Auth::user()->id,$questions->question);
      
        }

        Session::put('count',$data['count_question']);
        //Session::put('count',$data['count_question']);
       
        return view('Student.examInstruction',$data);
    }

    public function takeExam(Request $request)
    {
        $data['count_question'] = Session::get('count');
        $data['count_questionx'] = Session::get('count');
        //dd( $data['count_question']);
        $data['time'] = $this->createtime->gettime(base64_decode($request->equestion));
        $data['getQuiz_time']= $data['time']->hour.':'.$data['time']->mins.':00';

        $data['isexists'] = $this->studentexamtime->ifexists(Auth::user()->id);

        if($data['isexists']){

            $data['myTime'] = $this->studentexamtime->find(Auth::user()->id);

            $data['hour'] = $data['myTime']->hour;
            $data['mins'] = $data['myTime']->mins;
            $data['getQuizTime']= $data['myTime']->stop_current_time;

            $timeExists = $this->studentexamtime->check(Auth::user()->id,$data['hour'],$data['mins']);

            if(!$timeExists){
                $this->studentexamtime->create([
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
                'studentID'=>Auth::user()->id,
                'hour'=>$data['time']->hour, 
                'mins'=>$data['time']->mins,
                'questions_count'=>$data['count_question'],
                'stop_current_time'=>$data['getQuiz_time']
            ]);
            
            $data['myTime'] = $this->studentexamtime->find(Auth::user()->id);

            $data['hour'] = $data['myTime']->hour;
            $data['mins'] = $data['myTime']->mins;
            $data['getQuizTime']= $data['myTime']->stop_current_time;
        }
        $data['exists'] = '';
        
        $data['question'] = $this->tempquestion->single(base64_decode($request->equestion));
        //dd($data['question']);
        Session::put('exam_id',$request->equestion);
       

        return view('Student.takeExam',$data);
    }

    public function saveExam(Request $request)
    {   
        $nextButton = $request->input('next');
        $previousButton = $request->input('previous');
        $submitButton = $request->input('submit');

        $data['count_questionx'] = Session::get('count');

        if($nextButton=='next')
        {

            $img = $request->image;
            $folderPath = "upload/";
            //dd($img);
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
        
            $image_base64 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '',$image_parts[1]));
            $fileName = uniqid() . '.png';
        
            file_put_contents(public_path('exam/pictures')."/".$fileName, $image_base64);

            $get_exam_id = Session::get('exam_id');
            $getCount = $this->studentexamtime->find(Auth::user()->id);
            $data['count_question'] =  $getCount->questions_count;
  
            $data['exists'] = DB::table('take_exams')
            ->where('userID',Auth::user()->id)
            ->where('questionID',base64_decode($request->question))
            ->exists(); 

            if($data['exists']) {
                return back();
            }else{
            
            $this->takeexamRepository->create([
                'userID'=>Auth::user()->id,
                'questionID'=>base64_decode($request->questionID),
                'answerID'=>base64_decode($request->answer),
                'picture'=>$fileName
            ]);

            $data['question'] = $this->tempquestion->next(base64_decode($request->question)+1);
            $this->studentexamtime->update(['questions_count'=>$data['count_question']-1], Auth::user()->id);
                    
            }
            
            $data['myTime'] = $this->studentexamtime->find(Auth::user()->id);

            $data['hour'] = $data['myTime']->hour;
            $data['mins'] = $data['myTime']->mins;
            $data['getQuizTime']= $data['myTime']->stop_current_time;
        }
        elseif($previousButton=='previous')
        {

            $get_exam_id = Session::get('exam_id');
            $getCount = $this->studentexamtime->find(Auth::user()->id);
            $data['count_question'] =  $getCount->questions_count;

            $data['question'] = $this->tempquestion->previous(base64_decode($request->question)-1);
            $data['myTime'] = $this->studentexamtime->find(Auth::user()->id);

            $data['hour'] = $data['myTime']->hour;
            $data['mins'] = $data['myTime']->mins;
            $data['getQuizTime']= $data['myTime']->stop_current_time;

        }
        elseif($submitButton=='Submit')
        {
            $img = $request->image;
            $folderPath = "upload/";
            //dd($img);
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
        
            $image_base64 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '',$image_parts[1]));
            $fileName = uniqid() . '.png';

            file_put_contents(public_path('exam/pictures')."/".$fileName, $image_base64);

            $get_exam_id = Session::get('exam_id');
            $getCount = $this->studentexamtime->find(Auth::user()->id);
            $data['count_question'] =  $getCount->questions_count;

            $data['exists'] = DB::table('take_exams')
            ->where('userID',Auth::user()->id)
            ->where('questionID',base64_decode($request->question))
            ->exists(); 

            if($data['exists']) {
                return back();
            }else{
                
            //insert student answers
            $this->takeexamRepository->create([
                'userID'=>Auth::user()->id, 
                'questionID'=>base64_decode($request->questionID), 
                'answerID'=>base64_decode($request->answer),
                'picture'=>$fileName
            ]);
            
            $this->takeexamRepository->updateStatus(['status'=>1], Auth::user()->id); //update status after submit
            
            $this->studentexamtime->update(['questions_count'=>$data['count_question']-1], Auth::user()->id); //update question counter
            $this->tempquestion->delete(Auth::user()->id); //delete record from temp questions        
            }

            return redirect()->route('preView');
            
        }
           
        return view('Student.takeExam',$data);
            
    }

    //constantly updating exam time using ajax
    public function updateTime(Request $request)
    {
        $this->studentexamtime->update([
            'stop_current_time'=>$request->getTime
        ], Auth::user()->id); 
    }

    public function displayScores()
    {
        $data['scores'] = $this->takeexamRepository->previewScore(Auth::user()->id);

        return view('Student.preview',$data);
    }


    
}
