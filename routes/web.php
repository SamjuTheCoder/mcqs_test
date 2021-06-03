<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'attemptLogin'])->name('login');

Route::group(['/middleware' => ['auth']], function ()
{
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//add questions
Route::get('/add-questions', [App\Http\Controllers\AdminController::class, 'viewQuestions'])->name('viewQuestions');
Route::post('/add-questions', [App\Http\Controllers\AdminController::class, 'saveQuestions'])->name('saveQuestions');
Route::get('/delete-questions/{id}', [App\Http\Controllers\AdminController::class, 'deleteQuestions'])->name('deleteQuestions');

//add answers
Route::get('/add-answers', [App\Http\Controllers\AdminController::class, 'viewAnswers'])->name('viewAnswer');
Route::post('/add-answers', [App\Http\Controllers\AdminController::class, 'saveAnswers'])->name('saveAnswer');
Route::get('/delete-answers/{id}', [App\Http\Controllers\AdminController::class, 'deleteAnswers'])->name('deleteAnswer');

//modules route
Route::get('/add-module', [App\Http\Controllers\AdminController::class, 'moduleRole'])->name('moduleRole');
Route::post('/add-module', [App\Http\Controllers\AdminController::class, 'savemoduleRole'])->name('savemoduleRole');
Route::get('/delete-route/{id}', [App\Http\Controllers\AdminController::class, 'deleteRoute'])->name('deleteRoute');

//assign modules role
Route::get('/assign-module', [App\Http\Controllers\AdminController::class, 'assignmoduleRole'])->name('assignmoduleRole');
Route::post('/assign-module', [App\Http\Controllers\AdminController::class, 'saveassignmoduleRole'])->name('saveassignmoduleRole');
Route::get('/delete-assign-module/{id}', [App\Http\Controllers\AdminController::class, 'deleteassignRoute'])->name('deleteassignRoute');
Route::get('/all-answers', [App\Http\Controllers\AdminController::class, 'allExam'])->name('allExam');

//assign user role
Route::get('/assign-user-role', [App\Http\Controllers\AdminController::class, 'assignuserRole'])->name('assignuserRole');
Route::post('/assign-user-role', [App\Http\Controllers\AdminController::class, 'saveassignuserRole'])->name('saveassignuserRole');
Route::get('/delete-user-role/{id}', [App\Http\Controllers\AdminController::class, 'deleteuserRole'])->name('deleteuserRole');

//take exam
Route::get('/take-exam', [App\Http\Controllers\StudentController::class, 'takeExam'])->name('takeExam');
Route::post('/take-exam', [App\Http\Controllers\StudentController::class, 'saveExam'])->name('saveExam');
Route::get('/my-exam', [App\Http\Controllers\StudentController::class, 'myExam'])->name('myExam');
});