<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use App\Repositories\QuestionRepositoryInterface;
use App\Repositories\AnswerRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\ReusableInterface;
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
    private $reusableRepository;

    public function __construct(ReusableInterface $reusableRepository, QuestionRepositoryInterface $questionRepository, AnswerRepositoryInterface $answerRepository, UserRepositoryInterface $userRepository)
    {
        //$this->middleware('auth');
        $this->questionRepository = $questionRepository;
        $this->answerRepository = $answerRepository;
        $this->userRepository = $userRepository;
        $this->reusableRepository = $reusableRepository;
    }

    
    
    public function index()
    {
        $data['questions'] = '';
        $data['answers'] = '';
        //$data['count_questions'] = $this->questionRepository->count();
        $data['count_answer'] = $this->answerRepository->count();
        $data['count_user'] = $this->userRepository->count();

        $data['userRole'] = $this->reusableRepository->getUserRole(Auth::user()->id);

        return view('home',$data);
    }

    
}
