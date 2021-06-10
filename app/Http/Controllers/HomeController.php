<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use App\Repositories\QuestionRepositoryInterface;
use App\Repositories\AnswerRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use DB;
use Auth;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $questionRepository;
    private $answerRepository;
    private $userRepository;

    public function __construct(QuestionRepositoryInterface $questionRepository, AnswerRepositoryInterface $answerRepository, UserRepositoryInterface $userRepository)
    {
        //$this->middleware('auth');
        $this->questionRepository = $questionRepository;
        $this->answerRepository = $answerRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index()
    {
        $data['questions'] = '';
        $data['answers'] = '';
        $data['count_questions'] = $this->questionRepository->count();
        $data['count_answer'] = $this->answerRepository->count();
        $data['count_user'] = $this->userRepository->count();

        return view('home',$data);
    }

    
}
