<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TeacherClassInterface;
use App\Repositories\ReusableInterface;
use Auth;

class TeacherClassController extends Controller
{
    private $subjectclassRepository;
    private $reusableRepository;

    public function __construct(ReusableInterface $reusableRepository,TeacherClassInterface $teacherclassRepository)
    {
        $this->teacherclassRepository = $teacherclassRepository;
        $this->reusableRepository = $reusableRepository;
    }

    public function classTeacher()
    {
        $data['classx'] = '';
        $data['teacherx'] = '';

        $data['class'] = $this->teacherclassRepository->getAllClass();
        $data['teacher'] = $this->teacherclassRepository->getAllTeacher(3);

        $data['teacherclass'] = $this->teacherclassRepository->getAllTeacherClass();
        $data['userRole'] = $this->reusableRepository->getUserRole(Auth::user()->id);

        return view('Teacher.teacherclass', $data);
    }

    public function assignTeacher(Request $request)
    {

        $data['class'] = $this->teacherclassRepository->getAllClass();
        $data['teacher'] = $this->teacherclassRepository->getAllTeacher(3);
        
        $data['classx'] = $request->class;
        $data['teacherx'] = $request->teacher;

        $this->validate($request, [
            'class' => 'required',
            'teacher' => 'required',
        ]);

        if($this->teacherclassRepository->checkIfRecordExists($request->class, $request->teacher)) {
            return back()->with('error_message','Record Exists');
        }

        $this->teacherclassRepository->assignTeacherToClass([
            'class' => $request->class,
            'teacher' => $request->teacher,
        ]);

        $data['teacherclass'] = $this->teacherclassRepository->loadAllTeacherClass($request->teacher);
        $data['userRole'] = $this->reusableRepository->getUserRole(Auth::user()->id);

        return view('Teacher.teacherclass', $data);
    }

    public function loadClassTeacher(Request $request, $id)
    {
        $data['classx'] = '';
        $data['teacherx'] = $id;

        $data['class'] = $this->teacherclassRepository->getAllClass();
        $data['teacher'] = $this->teacherclassRepository->getAllTeacher(3);

        $data['teacherclass'] = $this->teacherclassRepository->loadAllTeacherClass($id);
        $data['userRole'] = $this->reusableRepository->getUserRole(Auth::user()->id);

        return view('Teacher.teacherclass', $data);
    }
}
