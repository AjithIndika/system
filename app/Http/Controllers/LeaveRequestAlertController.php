<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeaveRequestAlertRequest;
use App\Http\Requests\UpdateLeaveRequestAlertRequest;
use App\Models\LeaveRequestAlert;
use Illuminate\Http\Request;
use App\Http\Controllers\FrontHomeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;
Use Alert;

class LeaveRequestAlertController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function leaveRequestAlert(){

        $data['title'] = 'Leave Request Alert Setup';
        $data['template'] = 'leave/leaveRequst';
        $data['subsidiaries'] =  DB::table('subsidiaries')
                                ->select('*')
                                ->orderBy('subsidiaries_name', 'ASC')
                                ->where('assetsubsidiarie','Yes')
                                ->get();
      

                            
       

        return view('/template/template', compact('data'));
    }

    public function cratenew(Request $request){

        //dd($request);

        $request->validate([
            'leave_request_alerts_user_work_id' => ['required', 'string'],
         ]);

         $data=array(
            'leave_request_alerts_organization'=>$request->leave_request_alerts_organization,
            'leave_request_alerts_user_work_id'=>$request->leave_request_alerts_user_work_id,
         );

         DB::table('leave_request_alerts')->insert($data);
         return redirect('/leaveRequestAlert')->with('success','&nbsp;&nbsp; Save Sucess Full');

    }


    public static function leaveallertsbuwice($subsidiaries_id){

        $workprofile=  DB::table('job_working')->select('*')
        ->join('profiles','profiles.profile_id','=','job_working.profile_id')
        ->join('subsidiaries','subsidiaries.subsidiaries_id','=','job_working.profile_job_work_sbu')           
        ->where('job_working.profile_job_work_status','Active')
        ->where('job_working.profile_job_work_sbu', $subsidiaries_id)
        ->orderBy('job_working.job_working_profile_id', 'ASC')        
        ->get();

        foreach($workprofile as $workprofile){
            echo '<option value='.$workprofile->job_working_profile_id.'>'.$workprofile->profile_first_name.' '.$workprofile->profile_last_name.'</option>';

        }


    }


    


public function removealeert(Request $request){
    //dd($request);

    $request->validate([
        'leave_request_alerts_id' => ['required', 'integer'],
    ]);

    DB::table('leave_request_alerts')->where('leave_request_alerts_id', $request->leave_request_alerts_id)->delete();
    return redirect('/leaveRequestAlert')->with('success','&nbsp;&nbsp; Allert stop  Sucess Full');
}



}
