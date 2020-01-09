<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Employee;
use App\Disaction;

class EmployeeApiController extends Controller
{
   

    public function add_employee(Request $request){
    	$employe = new Employee();
    	$name = $request->name;
    	$designation = $request->designation;
    	$location = $request->location;
    	$employeerank = $request->employeerank;
    	$spds = $request->spds;
        $organization = $request->organization;

        $employe->emp_name = $name;
        $employe->emp_designation = $designation;
        $employe->location = $location;
        $employe->rank = $employeerank;
        $employe->organization = $organization;
        $employe->spds = $spds;
        $file = $request->file('profilephoto');
        if($file){
        $name = time().$file->getClientOriginalName();
         $file->move('profile/', $name);
         $profile_photo = "profile/".$name;
        $employe->profile_photo = $profile_photo;
         }
        $employe->save();
        return response()->json([
                        
            'success' => $name.' added successfullyt',          
            
        ]);
    }

    
    public function updateEmployee(Request $request){
        $employe = Employee::find($request->id);
        $name = $request->name;
        $designation = $request->designation;
        $location = $request->location;
        $employeerank = $request->employeerank;
        $spds = $request->spds;
        $organization = $request->organization;

        $employe->emp_name = $name;
        $employe->emp_designation = $designation;
        $employe->location = $location;
        $employe->rank = $employeerank;
        $employe->organization = $organization;
        $employe->spds = $spds;
        $file = $request->file('profilephoto');
       if($file){
        $name = time().$file->getClientOriginalName();
         $file->move('profile/', $name);
         $profile_photo = "profile/".$name;
         
            $employe->profile_photo = $profile_photo;
         }
        
        $employe->update();
        $employee =  Employee::find($request->id);
        $disactions = Disaction::where('employee_id',$employe->id)->get();
        return response()->json([                        
            'success' => $name.' added successfullyt',  
            'employee' =>$employee,
            'disactions' => $disactions     
            
        ]);
    }

    public function getEmployee(Request $request){
        $employee =  Employee::find($request->id);
        $disactions = Disaction::where('employee_id',$request->id)->get();
        return response()->json([                        
            'employee' =>$employee,
            'disactions' => $disactions     
            
        ]);
    }

    public function adddisaction(Request $request){

        $disaction = new Disaction();

        $disaction->godate = date("Y-m-d", strtotime($request->godate));
        $disaction->offence = $request->offence;
        $disaction->nopunishment = $request->nopunishment;
        $disaction->punishment1 = $request->nopunishment1;
        $disaction->punishment2 = $request->nopunishment2;
        $disaction->remarks = $request->remarks;
        $disaction->employee_id = $request->employee_id;
        $disaction->save();

        $employee =  Employee::with('disactions')->find($request->employee_id);
        $disactions = Disaction::where('employee_id',$request->employee_id)->get();
        return response()->json([                        
            'employee' =>$employee,
            'disactions' => $disactions     
            
        ]);


    }
    public function getDisaction(Request $request){
        $disaction =  Disaction::find($request->id);
        return response()->json([                        
            'disaction' => $disaction    
            
        ]);

    }

    
    public function updateDisaction(Request $request){

        $disaction = Disaction::find($request->id);

        $disaction->godate = date("Y-m-d", strtotime($request->godate));
        $disaction->offence = $request->offence;
        $disaction->nopunishment = $request->nopunishment;
        $disaction->punishment1 = $request->nopunishment1;
        $disaction->punishment2 = $request->nopunishment2;
        $disaction->remarks = $request->remarks;
        $emp_id = $disaction->employee_id;
        $disaction->update();

        $employee =  Employee::with('disactions')->find($emp_id);
        $disactions = Disaction::where('employee_id',$emp_id)->get();
        return response()->json([
             'employee' => $employee,                      
            'disactions' => $disactions    
            
        ]);


    }

    public function destroyDisaction(Request $request){
        Disaction::destroy($request->id);
        return response()->json([
             'success' => 'Deleted successfully'                    
              
            
        ]);
    }
}
