<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOffbordTaskRequest;
use App\Http\Requests\UpdateOffbordTaskRequest;
use App\Models\OffbordTask;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\FrontHomeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;
use Mail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\AllowanceController;


class OffbordTaskController extends Controller
{
   

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function newoffbord(Request $request){

       

        $request->validate([
            'offbord_tasks_job_working_profile_id' => ['required', 'string', 'max:255'],
            'offbord_tasks_profile_id' => ['required', 'string', 'max:255'],
            'offbord_tasks_requst' => ['required', 'string', 'max:255'],                

             ]);


 
             $data=array(
                "offbord_tasks_job_working_profile_id"=>$request->offbord_tasks_job_working_profile_id, 
                "offbord_tasks_date"=>$request->resignation_approval_date,               
                "offbord_tasks_profile_id"=>$request->offbord_tasks_profile_id,
                "offbord_tasks_requst"=>$request->offbord_tasks_requst,
                "offbord_tasks_crate_date"=>date('Y-m-d H:i:s'),
                "offbord_tasks_by"=>Auth::user()->name,
             );
             DB::table('offbord_tasks')->insert($data);
            return redirect('/view-profile/'.$request->profile_sug.'')->with('success','&nbsp;&nbsp; Register on Oiff-board notification success full');
    }

public static function removeoffbord(Request $request){
    OffbordTask::where('offbord_tasks_id',$request->offbord_tasks_id)->delete();
   return redirect('/view-profile/'.$request->profile_sug.'')->with('success','&nbsp;&nbsp; On board remove notification success full');


}
}
