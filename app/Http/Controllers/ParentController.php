<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ParentInterface;
use App\Repositories\ReusableInterface;
use Auth;

class ParentController extends Controller
{
    
    private $parentRepository;
    private $reusableRepository;
   
    public function __construct(ReusableInterface $reusableRepository,ParentInterface $parentRepository)
    {
        $this->middleware('auth');
        $this->parentRepository = $parentRepository;
        $this->reusableRepository = $reusableRepository;
    }

    public function addParent()
    {
        $data['statesx'] = '';
        $data['message'] = '';
        $data['states'] = $this->parentRepository->getStates();
        $data['parents'] = $this->parentRepository->getAllParents();
        $data['userRole'] = $this->reusableRepository->getUserRole(Auth::user()->id);

        return view('Parents.addParent',$data);
    }

    public function getLga(Request $request)
    {
        $data = $this->parentRepository->getSingleLga($request->get('state_id'));

        return response()->json($data);
    }

    public function getParent()
    {
        $data = $this->parentRepository->getAllParentsList();

        return response()->json($data);
    }

    public function saveParent(Request $request)
    {
        $data['statesx'] = '';
        $data['message'] = 'Successfully saved!';
        $data['states'] = $this->parentRepository->getStates();

        if($this->parentRepository->checkIfParentExists($request->fullname,$request->phone))
        {
            return back()->with('error_message','Record exists');
        }

        $this->validate($request,[
            'fullname'=>'required|string',
            'email'=>'required|email|unique:student_parents',
            'phone'=>'required|numeric|unique:student_parents',
            'state'=>'required',
            'lga'=>'required',
            'address'=>'required|string',
        ]);

        $id = $this->parentRepository->createParent([
            
            'fullname'=>$request->fullname,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'state'=>$request->state,
            'lga'=>$request->lga,
            'address'=>$request->address,
        
        ]);

        $userID = $this->parentRepository->addParentToUserTable([

            'studentID'=>$id,
            'name'=>$request->fullname,
            'email'=>$request->email,
            'username'=>$request->email,
            'password'=>bcrypt($request->phone),
        ]);

        $this->parentRepository->addParentIdToUserRole(['userID'=>$userID,'roleID'=>5]);

        $data['parents'] = $this->parentRepository->getAllParents();
        $data['userRole'] = $this->reusableRepository->getUserRole(Auth::user()->id);

        return view('Parents.addParent',$data);
    }
}
