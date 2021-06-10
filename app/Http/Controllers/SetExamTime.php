<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExamTime;
use App\Models\AcademicYear;
use App\Models\AcademicSession;
use App\Models\Semester;
use App\Repositories\AcademicSessionInterface;
use App\Repositories\AcademicYearInterface;
use App\Repositories\SemesterInterface;
use App\Repositories\TimeInterface;
use DB;

class SetExamTime extends Controller
{
    
    private $semesterRepository;
    private $sessionRepository;
    private $yearRepository;
    private $timeRepository;
    
    public function __construct(TimeInterface $timeRepository, SemesterInterface $semesterRepository, AcademicSessionInterface $sessionRepository, AcademicYearInterface $yearRepository)
    {
        $this->middleware('auth');
        $this->semesterRepository = $semesterRepository;
        $this->sessionRepository = $sessionRepository;
        $this->yearRepository = $yearRepository;
        $this->timeRepository = $timeRepository;
    }

    public function setTime()
    {

        $data['sessionx']='';
        $data['termx']='';
        $data['yearx']='';
       
        
       
        $data['session'] = $this->sessionRepository->all();
        $data['term'] = $this->semesterRepository->all();
        $data['year'] = $this->yearRepository->all();
    
        $data['times'] = $this->timeRepository->all();

        return view('Questions.setTime',$data);
    }

    public function saveTime(Request $request)
    {
        $this->validate( $request, [
           
            'session' => 'required',
            'term' => 'required|string',
            'year' => 'required',
            
           ]);
        

        $data['sessionx'] = $request->session;
        $data['termx']  = $request->term;
        $data['yearx']  = $request->year;

        $data['session'] = $this->sessionRepository->all();
        $data['term'] = $this->semesterRepository->all();
        $data['year'] = $this->yearRepository->all();
        
        if(DB::table('exam_times')->where('session',$request->session)->where('term',$request->term)->where('year',$request->year)
        ->exists()){
            
            return back()->with('error_message','Time already set');

        }else {
            DB::table('exam_times')->delete();
            $data['questions'] = $this->timeRepository->create(['session'=>$request->session,'term'=>$request->term,'year'=>$request->year]);
        
         }
        $data['times'] = $this->timeRepository->all();

        return view('Questions.setTime',$data);
    }

    public function getCurrentSession()
    {
        return DB::table('exam_times')->first();
    }
}
