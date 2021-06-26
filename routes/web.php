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

//create exams
Route::get('/create-exams', [App\Http\Controllers\CreateExamController::class, 'viewExams'])->name('viewExams');
Route::post('/create-exams', [App\Http\Controllers\CreateExamController::class, 'saveExams'])->name('saveExams');
Route::get('/delete-exams/{id}', [App\Http\Controllers\CreateExamController::class, 'deleteExams'])->name('deleteExams');
Route::get('/get-subject', [App\Http\Controllers\CreateExamController::class, 'loadSubects'])->name('loadSubects'); //ajax
Route::get('/activate-exam/{id}', [App\Http\Controllers\CreateExamController::class, 'activateExam'])->name('activateExam'); //ajax
Route::get('/deactivate-exam/{id}', [App\Http\Controllers\CreateExamController::class, 'deactivateExam'])->name('deactivateExam'); //ajax


//add questions
Route::get('/add-questions/{id}', [App\Http\Controllers\AdminController::class, 'addQuestions'])->name('addQuestions');
Route::post('/add-questions', [App\Http\Controllers\AdminController::class, 'saveQuestions'])->name('saveQuestions');
Route::get('/delete-questions/{id}', [App\Http\Controllers\AdminController::class, 'deleteQuestions'])->name('deleteQuestions');
Route::get('/view-questions/{id}', [App\Http\Controllers\AdminController::class, 'viewQuestions'])->name('viewQuestions');

//add answers
Route::get('/add-answers', [App\Http\Controllers\AdminController::class, 'viewAnswers'])->name('viewAnswer');
Route::post('/add-answers', [App\Http\Controllers\AdminController::class, 'saveAnswers'])->name('saveAnswer');
Route::get('/delete-answers/{id}', [App\Http\Controllers\AdminController::class, 'deleteAnswers'])->name('deleteAnswer');

//add options
Route::get('/add-options/{id}', [App\Http\Controllers\AdminController::class, 'addOptions'])->name('addOptions');


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
Route::get('/exam-subjects', [App\Http\Controllers\StudentController::class, 'examSubject'])->name('examSubject');
Route::get('/proceed/{id}', [App\Http\Controllers\StudentController::class, 'examInstruction'])->name('examInstruction');
Route::get('/take-exam', [App\Http\Controllers\StudentController::class, 'takeExam'])->name('takeExam');
Route::get('/take-examx', [App\Http\Controllers\StudentController::class, 'saveExam'])->name('saveExam');
Route::post('/update_quiz_time', [App\Http\Controllers\StudentController::class, 'updateTime'])->name('updateTime');

Route::get('/pre-view', [App\Http\Controllers\StudentController::class, 'displayScores'])->name('preView');
Route::get('/past-exams', [App\Http\Controllers\StudentController::class, 'pastExams'])->name('pastExams');
Route::get('/view-past-exams/{id}/{id2}/{id3}/{id4}/{id5}', [App\Http\Controllers\StudentController::class, 'viewpastExams'])->name('viewpastExams');

//set time
Route::get('/set-time', [App\Http\Controllers\SetExamTime::class, 'setTime'])->name('setTime');
Route::post('/set-time', [App\Http\Controllers\SetExamTime::class, 'saveTime'])->name('saveTime');

//create students
Route::get('/add-student', [App\Http\Controllers\CreateStudentController::class, 'addStudent'])->name('addStudent');
Route::post('/add-student', [App\Http\Controllers\CreateStudentController::class, 'saveStudent'])->name('saveStudent');

//create students
Route::get('/add-parent', [App\Http\Controllers\ParentController::class, 'addParent'])->name('addParent');
Route::post('/add-parent', [App\Http\Controllers\ParentController::class, 'saveParent'])->name('saveParent');
Route::get('/get-lga', [App\Http\Controllers\ParentController::class, 'getLga'])->name('getLga'); //ajax
Route::get('/get-parent', [App\Http\Controllers\ParentController::class, 'getParent'])->name('getParent'); //ajax

//assign subject to class
Route::get('/assign-subject-class', [App\Http\Controllers\SubjectClassController::class, 'classSubject'])->name('classSubject');
Route::get('/load-subject-class/{id}', [App\Http\Controllers\SubjectClassController::class, 'loadClassSubject'])->name('loadClassSubject');

Route::post('/assign-subject-class', [App\Http\Controllers\SubjectClassController::class, 'assignSubject'])->name('assignSubject');

//add staff
Route::get('/add-staff', [App\Http\Controllers\StaffController::class, 'addStaff'])->name('addStaff');
Route::post('/add-staff', [App\Http\Controllers\StaffController::class, 'saveStaff'])->name('saveStaff');
Route::get('/get-lga', [App\Http\Controllers\StaffController::class, 'getLga'])->name('getLga'); //ajax
//Route::get('/get-staff', [App\Http\Controllers\ParentController::class, 'getParent'])->name('getParent'); //ajax

//assign teacher to class
Route::get('/assign-teacher-class', [App\Http\Controllers\TeacherClassController::class, 'classTeacher'])->name('classTeacher');
Route::get('/load-teacher-class/{id}', [App\Http\Controllers\TeacherClassController::class, 'loadClassTeacher'])->name('loadClassTeacher');

Route::post('/assign-teacher-class', [App\Http\Controllers\TeacherClassController::class, 'assignTeacher'])->name('assignTeacher');

});