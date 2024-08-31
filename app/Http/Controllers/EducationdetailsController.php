<?php

namespace App\Http\Controllers;

use App\Models\Educationdetails;
use App\Http\Requests\StoreEducationdetailsRequest;
use App\Http\Requests\UpdateEducationdetailsRequest;
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

class EducationdetailsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function education(Request $request)
    {
        $request->validate([
            'education_center' => ['required', 'string', 'max:255'],
            'title_of_education' => ['required', 'string', 'max:255'],
            'time_period_start' => ['required', 'string', 'max:255'],
            'time_period_end' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
             ]);


             $data=array(
           'education_profile_id' =>$request->education_profile_id,
            'education_center' =>$request->education_center,
            'title_of_education'=>$request->title_of_education,
            'time_period_start' =>$request->time_period_start,
            'time_period_start' =>$request->time_period_start,
            'time_period_end' => $request->time_period_end,
            'description' => $request->description,
            'education_by'=>Auth::user()->name,
            'education_day'=>date('Y-m-d H:i:s'),
             );
             DB::table('educationdetails')->insert($data);
             return redirect('/view-profile'.'/'.$request->profile_sug)->with('success','&nbsp;&nbsp; Education added!');
    }



    public static function educationeview($education_profile_id){


    $workexpireance= DB::table('educationdetails')
                    ->select('*')
                    ->where('education_profile_id',$education_profile_id)
                    ->orderBy('time_period_start', 'DESC')
                    ->get();


                //  dd($education_profile_id);
    foreach($workexpireance as $row){
        echo '<div class="timeline">
        <span class="timeline-icon"></span>
        <span class="year">'.Carbon::parse($row->time_period_start)->format('Y').'</span>
        <div class="timeline-content">
            <h3 class="title">'.$row->title_of_education.'</h3>
            <h4>'.$row->education_center.'</h4>
            <p class="description">
            '.html_entity_decode($row->description).'
            </p>
        </div>
    </div>';



    }
    }



public static function  deleteducation(Request $request){

    DB::table('educationdetails')->where('education_center_id', $request->education_center_id)->delete();
    return redirect('/view-profile'.'/'.$request->profile_sug)->with('success','&nbsp;&nbsp; Delete success Full !');


}

}
