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
use App\Repositories\Eloquent\SubjectsRepository;
use App\Repositories\SubjectsInterface;
use App\Repositories\CreateStudentRepository;
use App\Repositories\CreateStudentInterface;
use App\Repositories\ParentRepository;
use App\Repositories\ParentInterface;
use App\Repositories\SubjectClassRepository;
use App\Repositories\SubjectClassInterface;
use App\Repositories\StaffRepository;
use App\Repositories\StaffInterface;
use App\Repositories\TeacherClassRepository;
use App\Repositories\TeacherClassInterface;
use App\Repositories\ReusableRepository;
use App\Repositories\ReusableInterface;

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
        $this->app->bind(SubjectsInterface::class, SubjectsRepository::class);
        $this->app->bind(CreateStudentInterface::class, CreateStudentRepository::class);
        $this->app->bind(ParentInterface::class,  ParentRepository::class);
        $this->app->bind(SubjectClassInterface::class,  SubjectClassRepository::class);
        $this->app->bind(StaffInterface::class,  StaffRepository::class);
        $this->app->bind(TeacherClassInterface::class,  TeacherClassRepository::class);
        $this->app->bind(ReusableInterface::class,  ReusableRepository::class);
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
