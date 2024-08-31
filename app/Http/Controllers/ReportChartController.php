<?php

namespace App\Http\Controllers;
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



class ReportChartController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }



    public function index()
    {

 $data['data'] = DB::table('job_working')->select('*')
 //->join('profiles','profiles.profile_id','=','job_working.profile_id')
 //->join('job_descriptions','job_descriptions.job_descriptions_id','=','job_working.profile_job_work_jd')
 ->where('job_working.profile_job_work_status','=','Active')
 ->get();


        $data['title'] = 'Profile';
        $data['profile']= DB::table('profiles')->select('*')->get();
        $data['template'] = 'org/index';
        return view('template/template', compact('data'));
    }



    public static function reportmanagername($profile_job_work_head_of_sbu){
        echo DB::table('profiles')->where('profile_id','=',$profile_job_work_head_of_sbu)->value('profile_Full_name');
    }


    public static function profileName($profile_id){
        echo DB::table('profiles')->where('profile_id','=',$profile_id)->value('profile_Full_name');
    }


    public static function profiljd($profiljd){
        echo DB::table('job_descriptions')->where('job_descriptions_id','=',$profiljd)->value('job_descriptions_name');
    }

    public static function profilim($profile_id,$profile_job_work_sbu){

        if(!empty(DB::table('profiles')->where('profile_id','=',$profile_id)->value('profile_image'))){
        echo '/profile-image/'.DB::table('profiles')->where('profile_id','=',$profile_id)->value('profile_image');
        }
        else{

            echo '/sbu_logo/'. DB::table('subsidiaries')->where('subsidiaries_id','=',$profile_job_work_sbu)->value('subsidiaries_logo');

        }
    }

}


