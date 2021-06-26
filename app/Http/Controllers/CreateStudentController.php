<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CreateStudentInterface;
use App\Models\Student;
use App\Repositories\ReusableInterface;
use Auth;

class CreateStudentController extends Controller
{
    private $createstudentRepository;
    private $reusableRepository;
    
    public function __construct(ReusableInterface $reusableRepository,CreateStudentInterface $createstudentRepository)
    {
        $this->middleware('auth');
        $this->createstudentRepository = $createstudentRepository;
        $this->reusableRepository = $reusableRepository;
    }

    public function addStudent()
    {
        $data['sexx'] = "";
        $data['classx'] = "";
        $data['parentx'] = '';
        $data['housex'] = '';
        $data['parent'] = $this->createstudentRepository->getAllParents();
        $data['sex'] = $this->createstudentRepository->getGender();
        $data['class'] = $this->createstudentRepository->getAllClasses();
        $data['getStudents'] = $this->createstudentRepository->getAllStudents();
        $data['getHouse'] = $this->createstudentRepository->getAllHouse();
        $data['userRole'] = $this->reusableRepository->getUserRole(Auth::user()->id);

        return view('Student.addStudent',$data);
    }

    public function saveStudent(Request $request)
    {

        $data['parent'] = $this->createstudentRepository->getAllParents();
        $data['sex'] = $this->createstudentRepository->getGender();
        $data['class'] = $this->createstudentRepository->getAllClasses();
        $data['getStudents'] = $this->createstudentRepository->getAllStudents();
        $data['getHouse'] = $this->createstudentRepository->getAllHouse();

        $data['sexx'] = $request->sex;
        $data['classx'] = $request->class;
        $data['parentx'] = $request->parent;
        $data['housex'] = $request->house;

        if($this->createstudentRepository->checkIfStudentExists($request->registration_number))
        {
            return back()->with('error_message','Record exists');
        }

        $this->validate( $request,[
            'fullname'=>'required|string',
            'registration_number'=>'required|unique:students',
            'sex'=>'required',
            'class'=>'required',
            'parent'=>'required|string',

        ]);

        $getID = $this->createstudentRepository->createStudent([
            'fullname'=>$request->fullname,
            'registration_number'=>$request->registration_number,
            'sex'=>$request->sex,
            'class'=>$request->class,
            'house'=>$request->house,
            'parent'=>$request->parent,

        ]);

        $userID = $this->createstudentRepository->addStudentToUserTable([
            'studentID'=>$getID,
            'name'=>$request->fullname,
            'class'=>$request->class,
            'username'=>$request->registration_number,
            'password'=>bcrypt(12345),
        ]);

        $this->createstudentRepository->addStudentIdToUserRole(['userID'=>$userID,'roleID'=>2]);
        $data['getStudents'] = $this->createstudentRepository->getAllStudents();
        $data['userRole'] = $this->reusableRepository->getUserRole(Auth::user()->id);

        return view('Student.addStudent',$data);
    }
}
