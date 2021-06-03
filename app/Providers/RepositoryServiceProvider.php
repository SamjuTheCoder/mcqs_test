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
