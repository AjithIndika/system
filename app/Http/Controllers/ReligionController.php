<?php

namespace App\Http\Controllers;

use App\Models\Religion;
use App\Http\Requests\StoreReligionRequest;
use App\Http\Requests\UpdateReligionRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\FrontHomeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;
Use Alert;

class ReligionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $data['title'] = 'Religion';
        $data['religions']= DB::table('religions')->select('*')->get();
        $data['template'] = 'religion/index';
        return view('template/template', compact('data'));
    }


    public function create(Request $request)
    {

        $request->validate([
            'religion_name' => ['required', 'string', 'max:255','unique:religions'],
             ]);

             $data=array('religion_name'=>$request->religion_name,);
             DB::table('religions')->insert($data);
             return redirect('/religion')->with('success','&nbsp;&nbsp; Save Sucess Full');
    }




    public function edit(Request $request)
    {

        $request->validate([
            'religion_name' => ['required', 'string', 'max:255'],
             ]);

             $data=array('religion_name'=>$request->religion_name,);
            // DB::table('religions')->insert($data);
            DB::table('religions')->where('religion_id', $request->religion_id)->update($data);
             return redirect('/religion')->with('success','&nbsp;&nbsp; Save Sucess Full');
    }


 public function religionsAll(){
    $data['title'] = 'Religion Report';
    $data['religions']= DB::table('religions')->orderBy('religion_name','asc')->select('*')->get();
    $data['Organitizon']= DB::table('subsidiaries')->orderBy('subsidiaries_name','asc')->select('*')->get();
    $data['template'] = 'religion/religionReport';
    return view('template/template', compact('data'));
 }
 public static function religeinCount($religion_id){
   echo  DB::table('profiles')->where('religion_id', '=',$religion_id)
   ->where('profile_status','=','Active')
   ->count();
 }

 public function religionscount(Request $request){
    $data['title'] = 'Religion Report';
    $data['profiles']=  DB::table('profiles')
    ->select('*')
    ->join('job_join_history','job_join_history.profile_id','=','profiles.profile_id')
    ->join('job_working','job_working.profile_id','=','profiles.profile_id')
    ->join('subsidiaries','subsidiaries.subsidiaries_id','=','job_working.profile_job_work_sbu')
    ->join('designations','designations.designations_id','=','job_working.profile_job_work_designation')
    ->join('departments','departments.department_id','=','job_working.profile_job_work_department')
    ->join('job_descriptions','job_descriptions.job_descriptions_id','=','job_working.profile_job_work_jd')
    ->join('office_locations','office_locations.office_locations_id','=','job_working.profile_job_work_office_location')
    ->join('religions','religions.religion_id','=','profiles.religion_id')
    ->where('profiles.religion_id','=',$request->religion_id)
    ->where('profiles.profile_status','=','Active')
    ->get();

    $data['religions']=  DB::table('religions')
                        ->where('religion_id','=',$request->religion_id)
                        ->pluck('religion_name')
                        ->first();
    $data['template'] = 'religion/religionUses';
    return view('template/template', compact('data'));

 }

 public static function organdorganaz($religion_id,$profile_job_work_sbu){
    echo  DB::table('profiles')
    ->join('job_working','job_working.profile_id','=','profiles.profile_id')
    ->where('profiles.religion_id', '=',$religion_id)
    ->where('profiles.profile_status','=','Active')
    ->where('job_working.profile_job_work_status','=','Active')
    ->where('job_working.profile_job_work_sbu','=',$profile_job_work_sbu)
    ->count();
 }

 public static function organdorganazprofile($religion_id,$profile_job_work_sbu){
   $data= DB::table('profiles')
    ->join('job_join_history','job_join_history.profile_id','=','profiles.profile_id')
    ->join('job_working','job_working.profile_id','=','profiles.profile_id')
    ->join('subsidiaries','subsidiaries.subsidiaries_id','=','job_working.profile_job_work_sbu')
    ->join('designations','designations.designations_id','=','job_working.profile_job_work_designation')
    ->join('departments','departments.department_id','=','job_working.profile_job_work_department')
    ->join('job_descriptions','job_descriptions.job_descriptions_id','=','job_working.profile_job_work_jd')
    ->join('office_locations','office_locations.office_locations_id','=','job_working.profile_job_work_office_location')
    ->join('religions','religions.religion_id','=','profiles.religion_id')
    ->where('profiles.religion_id', '=',$religion_id)
    ->where('profiles.profile_status','=','Active')
    ->where('job_working.profile_job_work_status','=','Active')
    ->where('job_working.profile_job_work_sbu','=',$profile_job_work_sbu)
    ->get();

    $cou=1;
    foreach( $data as $row){

        echo '<li style="list-style: none;"><a href="/view-profile/'.$row->profile_sug.'" target="_blank"> '.$cou++.'.'. $row->profile_Full_name.'</a></li>';

    }
 }


 public static function count($religion_id){
    echo   DB::table('profiles')->select('*')
  //  ->join('job_join_history','job_join_history.profile_id','=','profiles.profile_id')
       ->where('religion_id',$religion_id)
       ->where('profile_status', 'Active')
       ->count();
   }





}
