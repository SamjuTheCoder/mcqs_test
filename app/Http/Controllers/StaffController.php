<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\StaffInterface;
use App\Repositories\ReusableInterface;
use Auth;
use DB;

class StaffController extends Controller
{
    
    private $staffRepository;
   
    public function __construct(StaffInterface $staffRepository,ReusableInterface $reusableRepository)
    {
        $this->middleware('auth');
        $this->staffRepository = $staffRepository;
        $this->reusableRepository = $reusableRepository;
    }

    public function addStaff()
    {
        $data['rolex'] = '';
        $data['statesx'] = '';
        $data['message'] = '';
        $data['states'] = $this->staffRepository->getStates();
        $data['staff'] = $this->staffRepository->getAllStaff();
        $data['role'] = $this->staffRepository->getRole();
        $data['userRole'] = $this->reusableRepository->getUserRole(Auth::user()->id);

        return view('Staff.addstaff',$data);
    }

    public function getLga(Request $request)
    {
        $data = $this->staffRepository->getSingleLga($request->get('state_id'));

        return response()->json($data);
    }

    public function getStaff()
    {
        $data = $this->staffRepository->getAllStaffList();

        return response()->json($data);
    }

    public function saveStaff(Request $request)
    {
        $data['rolex'] = '';
        $data['statesx'] = '';
        $data['message'] = 'Successfully saved!';
        $data['states'] = $this->staffRepository->getStates();

        if($this->staffRepository->checkIfStaffExists($request->fullname,$request->phone))
        {
            return back()->with('error_message','Record exists');
        }

        $this->validate($request,[
            'fullname'=>'required|string',
            'role'=>'required',
            'email'=>'required|email|unique:student_parents',
            'phone'=>'required|numeric|unique:student_parents',
            'state'=>'required',
            'lga'=>'required',
            //'address'=>'required|string',
        ]);

        $id = $this->staffRepository->createStaff([
            
            'fullname'=>$request->fullname,
            'role'=>$request->role,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'state'=>$request->state,
            'lga'=>$request->lga,
            'address'=>$request->address,
        
        ]);

        $userID = $this->staffRepository->addStaffToUserTable([

            'studentID'=>$id,
            'name'=>$request->fullname,
            'email'=>$request->email,
            'username'=>$request->email,
            'password'=>bcrypt($request->phone),
        ]);

        $this->staffRepository->addStaffIdToUserRole(['userID'=>$userID,'roleID'=>$request->role]);
        $data['userRole'] = $this->reusableRepository->getUserRole(Auth::user()->id);
        $data['role'] = $this->staffRepository->getRole();
        $data['staff'] = $this->staffRepository->getAllStaff();

        return view('Staff.addstaff',$data);
    }
}
