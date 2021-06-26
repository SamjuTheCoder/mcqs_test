<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SubjectClassInterface;
use App\Repositories\ReusableInterface;
use Auth;

class SubjectClassController extends Controller
{
    private $subjectclassRepository;
    private $reusableRepository;

    public function __construct(ReusableInterface $reusableRepository, SubjectClassInterface $subjectclassRepository)
    {
        $this->subjectclassRepository = $subjectclassRepository;
        $this->reusableRepository = $reusableRepository;
    }

    public function classSubject()
    {
        $data['classx'] = '';
        $data['subjectx'] = '';

        $data['class'] = $this->subjectclassRepository->getAllClass();
        $data['subject'] = $this->subjectclassRepository->getAllSubject();

        $data['classsubject'] = $this->subjectclassRepository->getAllSubjectClass();
        $data['userRole'] = $this->reusableRepository->getUserRole(Auth::user()->id);

        return view('Class.subjectclass', $data);
    }

    public function assignSubject(Request $request)
    {

        $data['class'] = $this->subjectclassRepository->getAllClass();
        $data['subject'] = $this->subjectclassRepository->getAllSubject();
        
        $data['classx'] = $request->class;
        $data['subjectx'] = $request->subject;

        $this->validate($request, [
            'class' => 'required',
            'subject' => 'required',
        ]);

        if($this->subjectclassRepository->checkIfRecordExists($request->class, $request->subject)) {
            return back()->with('error_message','Record Exists');
        }

        $this->subjectclassRepository->assignSubjectToClass([
            'class' => $request->class,
            'subject' => $request->subject,
        ]);

        $data['classsubject'] = $this->subjectclassRepository->loadAllSubjectClass($request->class);
        $data['userRole'] = $this->reusableRepository->getUserRole(Auth::user()->id);

        return view('Class.subjectclass', $data);
    }

    public function loadClassSubject(Request $request, $id)
    {
        $data['classx'] = $id;
        $data['subjectx'] = '';

        $data['class'] = $this->subjectclassRepository->getAllClass();
        $data['subject'] = $this->subjectclassRepository->getAllSubject();

        $data['classsubject'] = $this->subjectclassRepository->loadAllSubjectClass($id);
        $data['userRole'] = $this->reusableRepository->getUserRole(Auth::user()->id);

        return view('Class.subjectclass', $data);
    }
}
