<?php

namespace App\Http\Controllers;

use App\Models\WorkExperience;
use App\Http\Requests\StoreWorkExperienceRequest;
use App\Http\Requests\UpdateWorkExperienceRequest;
use App\Models\Profile;
use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Validator;
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
use Carbon\Carbon;

class WorkExperienceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function workexperience(Request $request)
    {
        $request->validate([
            'work_experiences_organization_name' => ['required', 'string', 'max:255'],
            'work_experiences_joined_date' => ['required', 'string', 'max:255'],
            'work_experiences_resigned_date' => ['required', 'string', 'max:255'],
            'work_experiences_worked_as' => ['required', 'string', 'max:255'],
            'work_experiences_job_description' => ['required', 'string'],
             ]);


             $data=array(
            'work_experiences_organization_name' =>$request->work_experiences_organization_name,
            'work_experiences_profile_id' =>$request->work_experiences_profile_id,
            'work_experiences_joined_date' =>$request->work_experiences_joined_date,
            'work_experiences_resigned_date' => $request->work_experiences_resigned_date,
            'work_experiences_worked_as' =>$request->work_experiences_worked_as,
            'work_experiences_job_description' => $request->work_experiences_job_description,
            'work_experiences_issued_by'=>Auth::user()->name,
            'work_experiences_issued_day'=>date('Y-m-d H:i:s'),
             );
             DB::table('work_experiences')->insert($data);
             return redirect('/view-profile'.'/'.$request->profile_sug)->with('success','&nbsp;&nbsp; Work experience added!');
    }



    public static function workexperienceview($work_experiences_profile_id){


    $workexpireance= DB::table('work_experiences')
                    ->select('*')
                    ->where('work_experiences_profile_id','=',$work_experiences_profile_id)
                    ->orderBy('work_experiences_joined_date', 'DESC')->get();
    foreach($workexpireance as $row){
        echo '<div class="timeline">
        <div class="timeline-icon"><i class="fa fa-user"></i></div>
        <span class="year">'.Carbon::parse($row->work_experiences_joined_date)->format('Y').'</span>
        <div class="timeline-content">
            <h5 class="title">'.$row->work_experiences_worked_as.' /'.$row->work_experiences_organization_name.'</h5>
            <p class="description">
               '.html_entity_decode($row->work_experiences_job_description).'
            </p>
        </div>
    </div>';
    }
    }



public static function  deletexperience(Request $request){

    DB::table('work_experiences')->where('work_experiences_id', $request->work_experiences_id)->delete();
    return redirect('/view-profile'.'/'.$request->profile_sug)->with('success','&nbsp;&nbsp; Delete success Full !');


}


}
