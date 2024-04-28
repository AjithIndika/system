<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FrontHomeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;
use Mail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\AllowanceController;
use Carbon;
use App\Mail\ResignationNotification;
use App\Mail\ResignationApproveHr;
use App\Mail\ResignationHrApprovel; // aprovel notification send to HR
use App\Mail\Resignationnotapproved;
use Illuminate\Support\Facades\Hash;
use App\Mail\EmailManage;
use App\Mail\PasswordSend;


class Outsiderejester extends Controller
{


public function newprofile(){


    $data['title'] = 'Tikating User';
    $sbuHead= DB::table('profiles')->select('*')
    ->where('profile_head_of_departmrnt_this_account','=','on')->where('profile_status','Active')->orderBy('profile_Full_name', 'asc')->get();
    $data['title'] = 'New Profile';
    $data['religions']= DB::table('religions')->select('*')->orderBy('religion_name', 'asc')->get();
    $data['profile']= DB::table('profiles')->select('*')->orderBy('profile_Full_name', 'asc')->get();
    $data['subsidiaries']= DB::table('subsidiaries')->select('*')->orderBy('subsidiaries_name', 'asc')->get();//sbu
    $data['designations']= DB::table('designations')->select('*')->orderBy('designations_name', 'asc')->get();// desgnation
    $data['departments']= DB::table('departments')->select('*')->orderBy('department_name', 'asc')->get();// department
    $data['job_descriptions']= DB::table('job_descriptions')->select('*')->orderBy('job_descriptions_name', 'asc')->get();// Job Discription
    $data['office_locations']= DB::table('office_locations')->select('*')->orderBy('office_locations_name', 'asc')->get();// office_locations
    $data['sbu_head']=$sbuHead;
    return view('users/ticket-user-rejester', compact('data'));

}


public function saveprofile(Request $request)
    {

       if(!empty(DB::table('profiles')->orderBy('profile_number', 'desc')->value('profile_number'))){
           $pnumber=str_pad(DB::table('profiles')->orderBy('profile_number', 'desc')->value('profile_number')+1, 8, '0', STR_PAD_LEFT);
        }
              else {
                $pnumber=str_pad(1, 8, '0', STR_PAD_LEFT);
         }




       $request->validate([
            'profile_Full_name' => ['required', 'string', 'max:255','unique:profiles'],
            'profile_first_name' => ['required', 'string', 'max:255','unique:profiles'],
            'profile_last_name' => ['required', 'string', 'max:255','unique:profiles'],
            'profile_bith_day' => ['required', 'string', 'max:255'],
            'profile_nic' => ['required', 'string', 'max:255'],
            'profile_living_province' => ['required', 'string', 'max:255'],
            'profile_marital_status' => ['required', 'string', 'max:255'],
            'profile_gender' => ['required', 'string', 'max:255'],
            'profile_permant_address' => ['required', 'string', 'max:255'],
            'profile_current_address' => ['required', 'string', 'max:255'],
            'profile_mobile_number' => ['required', 'string', 'max:255'],
            'profile_email' => ['email'],
            'religion_id'=>['required', 'string', 'max:255'],
            'profile_emergency_contact_person_name' => ['required', 'string', 'max:255'],
            'profile_relationship' =>['required', 'string', 'max:255'],
            'profile_emergency_mobile_number' => ['required','digits:10'],
            'profile_job_join_mobile' => ['digits:10'],
            'profile_job_join_email' => ['email'],
            'email'=> ['unique:users'],
             ]);



          // profile table
             $data=array(
                'profile_number'=>$pnumber,
                'profile_sug'=>str_slug($request->profile_Full_name),
                'profile_Full_name'=>$request->profile_Full_name,
                'profile_first_name'=>$request->profile_first_name,
                'profile_last_name'=>$request->profile_last_name,
                'profile_bith_day'=>$request->profile_bith_day,
                'profile_gender'=>$request->profile_gender,
                'profile_nic'=>$request->profile_nic,
                'profile_living_province'=>$request->profile_living_province,
                'profile_marital_status'=>$request->profile_marital_status,
                'profile_permant_address'=>$request->profile_permant_address,
                'profile_current_address'=>$request->profile_current_address,
                'profile_mobile_number'=>$request->profile_mobile_number,
                'profile_emergency_contact_person_name'=>$request->profile_emergency_contact_person_name,
                'profile_relationship'=>$request->profile_relationship,
                'profile_emergency_mobile_number'=>$request->profile_emergency_mobile_number,
                'profile_email'=>$request->profile_email,
                'religion_id'=>$request->religion_id,
                'profile_status'=>'Active',
                'reasons_for_request_to_change'=>'New Account',
                'profile_crate_by'=>'',
                'profile_crate_date'=>date('Y-m-d H:i:s'),
             );
             DB::table('profiles')->insert($data); //profile
             $profile_id=DB::getPdo()->lastInsertId();




             $joinjobs=array(
                'profile_id'=>$profile_id,
                'profile_job_join_epf_number'=>$request->profile_job_join_epf_number,
                'profile_job_join_date'=>$request->profile_job_join_date,
                'profile_job_join_sbu'=>$request->profile_job_join_sbu,
                'profile_job_join_department'=>$request->profile_job_join_department,
                'profile_job_join_designation'=>$request->profile_job_join_designation,
                'profile_job_join_jd'=>$request->profile_job_join_jd,
                'profile_job_join_office_location'=>$request->profile_job_join_office_location,
                'profile_job_join_head_of_sbu'=>$request->profile_job_join_head_of_sbu,
                'profile_job_join_email'=>$request->profile_job_join_email,
                'profile_job_join_employee_index_numbe'=>$request->profile_job_join_epf_number,
                'profile_job_join_mobile'=>$request->profile_job_join_mobile,
                'job_join_profile_crate_by'=>'',
                'job_join_profile_crate_date'=>date('Y-m-d H:i:s'),
             );
             DB::table('job_join_history')->insert($joinjobs); //join job id
             $job_join_profile_id=DB::getPdo()->lastInsertId(); //joinjob id


             $working =array(
                'profile_job_join_profile_id'=>$job_join_profile_id,
                'profile_id'=>$profile_id,
                'profile_job_work_epf_number'=>$request->profile_job_join_epf_number,
                'profile_job_work_join_date'=>$request->profile_job_join_date,
                'profile_job_work_sbu'=>$request->profile_job_join_sbu,
                'profile_job_work_department'=>$request->profile_job_join_department,
                'profile_job_work_designation'=>$request->profile_job_join_designation,
                'profile_job_work_email'=>$request->profile_job_join_email,
                'profile_job_work_mobile'=>$request->profile_job_join_mobile,
                'profile_job_work_jd'=>$request->profile_job_join_jd,
                'profile_job_work_head_of_sbu'=>$request->profile_job_join_head_of_sbu,
                'profile_job_work_employee_index_number'=>$request->profile_job_join_epf_number,
                'profile_job_work_office_location'=>$request->profile_job_join_office_location,
                'profile_job_work_status'=>'Active',
                'profile_job_work_status_reson'=>'New Recruitment',
                'job_work_profile_crate_by'=>'',
                'job_work_profile_crate_date'=>date('Y-m-d H:i:s'),
             );
              DB::table('job_working')->insert($working); //now working



              //login user crate





        $randome_pass= Str::random(10);



        $data=array(
           'name'=>$request->profile_first_name,
           'email'=>$request->profile_job_join_email,
           'profile_id'=>$profile_id,
           'hr'=>'',
           'hrAdmin'=>'',
           'profileUser'=>'on',
           'pcUser'=>'on',
           'pcAdmin'=>'',
           'sbuPcAdmin'=>'',
           'leveApprovalUser'=>'',
           'reportView'=>'',
           'sbuhead'=>'',
           'password'=>Hash::make($randome_pass),
           'user_crate_by'=>'Self',
           'user_update_by'=>'Self',
           'updated_at'=>date('Y-m-d H:i:s'),
           'created_at'=>date('Y-m-d H:i:s'),
           );
          DB::table('users')->insert($data);


          ////
          $subsidiaries_logo=  DB::table('subsidiaries')
          ->where('subsidiaries_id',$request->profile_job_join_sbu)
          ->value('subsidiaries_logo');


       //   dd($subsidiaries_logo);


                   //email send
                   $mailData = [
                   'appname'=>config('app.name'),
                   'base_url'=>config('app.url'),
                   'title' => 'Your Login Details For ASSET HR',
                   'logo'=>$subsidiaries_logo,
                   'username'=>$request->profile_job_join_email,
                   'password'=>$randome_pass,];

      //  Mail::to($request->email)->send(new PasswordSend($mailData));
         Mail::mailer('hr')->to($request->profile_job_join_email)->send(new PasswordSend($mailData));

         $profileupdate=array("profile_head_of_departmrnt_this_account"=>$request->profile_job_join_head_of_sbu);
         DB::table('profiles')->where('profile_id', $profile_id)->update($profileupdate);

        return redirect('/newuser')->with('success', $request->profile_first_name.'&nbsp;&nbsp; Please check your emails; we have already sent your login details.');

    }



}
