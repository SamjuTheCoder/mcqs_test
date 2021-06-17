<?php

namespace App\Providers;
use App\Repositories\QuestionRepositoryInterface; 
use App\Repositories\AnswerRepositoryInterface;
use App\Repositories\EloquentRepositoryInterface; 
use App\Repositories\UserRepositoryInterface; 
use App\Repositories\Eloquent\QuestionRepository; 
use App\Repositories\Eloquent\AnswerRepository; 
use App\Repositories\Eloquent\UserRepository; 
use App\Repositories\Eloquent\BaseRepository; 
use App\Repositories\ModuleRoleRepositoryInterface; 
use App\Repositories\Eloquent\ModuleRoleRepository; 
use App\Repositories\AssignModuleRepositoryInterface; 
use App\Repositories\Eloquent\AssignModuleRepository; 
use App\Repositories\TakeExamRepositoryInterface; 
use App\Repositories\Eloquent\TakeExamRepository; 
use App\Repositories\ExamtypeRepositoryInterface; 
use App\Repositories\Eloquent\ExamtypeRepository; 

use App\Repositories\SemesterInterface; 
use App\Repositories\Eloquent\SemesterRepository; 
use App\Repositories\AcademicSessionInterface; 
use App\Repositories\Eloquent\AcademicSessionRepository; 
use App\Repositories\AcademicYearInterface; 
use App\Repositories\Eloquent\AcademicYearRepository; 
use App\Repositories\ClassInterface; 
use App\Repositories\Eloquent\ClassRepository; 
use App\Repositories\TimeInterface; 
use App\Repositories\Eloquent\TimeRepository; 
use App\Repositories\Eloquent\CreateExamRepository;
use App\Repositories\CreateExamInterface;
use App\Repositories\Eloquent\StudentExamTimeRepository;
use App\Repositories\StudentExamTimeInterface;
use App\Repositories\Eloquent\TempQuestionRepository;
use App\Repositories\TempQuestionInterface;

use Illuminate\Support\ServiceProvider; 

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(QuestionRepositoryInterface::class, QuestionRepository::class);
        $this->app->bind(AnswerRepositoryInterface::class, AnswerRepository::class);
        $this->app->bind(ModuleRoleRepositoryInterface::class, ModuleRoleRepository::class);
        $this->app->bind(AssignModuleRepositoryInterface::class, AssignModuleRepository::class);
        $this->app->bind(TakeExamRepositoryInterface::class, TakeExamRepository::class);
        $this->app->bind(ExamtypeRepositoryInterface::class, ExamtypeRepository::class);
        $this->app->bind(SemesterInterface::class, SemesterRepository::class);
        $this->app->bind(AcademicSessionInterface::class, AcademicSessionRepository::class);
        $this->app->bind(AcademicYearInterface::class, AcademicYearRepository::class);
        $this->app->bind(ClassInterface::class, ClassRepository::class);
        $this->app->bind(TimeInterface::class, TimeRepository::class);
        $this->app->bind(CreateExamInterface::class, CreateExamRepository::class);
        $this->app->bind(StudentExamTimeInterface::class, StudentExamTimeRepository::class);
        $this->app->bind(TempQuestionInterface::class, TempQuestionRepository::class);
        
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
