<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequst;
use App\Http\Requests\StoreLeaveRequstRequest;
use App\Http\Requests\UpdateLeaveRequstRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\FrontHomeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Mail;
use App\Mail\LeaveRequstSend;
use App\Mail\LeaveUpdateStatus;
use App\Mail\LeaveApprovelAllertSend;
//use Carbon\Carbon;


use App\Mail\PasswordSend;


use Image;
Use Alert;

class LeaveRequstController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {


        $data['setup_leave_view'] = DB::table('user_leave_setups')->select('*')
        ->join('enrolment_leave_setups','enrolment_leave_setups.enrolment_leave_setups_id','=','user_leave_setups.user_leave_setups_rule')
        ->join('leave_types','leave_types.leave_types_id','=','enrolment_leave_setups.enrolment_leave_types_id')
        ->where('user_leave_setups.profile_id','=',Auth::user()->profile_id)
        ->where('user_leave_setups.user_leave_setups_status','=','Active')
        ->get();


        $data['title'] = 'Leave';
        $data['template'] = 'leave/requstFrom';
        return view('template/template', compact('data'));

    }




    public static function reportingManagerList($profile_id){
        $reporting_manager =  DB::table('job_working')->select('*')
        ->join('profiles','profiles.profile_id','=','job_working.profile_job_work_head_of_sbu')
        ->where('job_working.profile_id','=',$profile_id)
        ->where('job_working.profile_job_work_status','=','Active')
        ->get();
        foreach($reporting_manager as $reporting_manager){
           echo '<option value="'.$reporting_manager->profile_id.'">'.$reporting_manager->profile_Full_name.'</option>';
        }

    }



    public function create(Request $request)
    {


        $request->validate([
            'leave_requsts_user_leave_setups_rule_id' => ['required','string'],
            'leave_requsts_start_date' => ['required','string'],
            'leave_requsts_end_date' => ['required','string'],
            'leave_requsts_need_date' => ['required','string'],
            'leave_requsts_reson' => ['string','string', 'max:255'],
            'leave_requsts_org_id'=>['required'],
             ]);

      $data=array(
        "leave_requsts_profile_id"=>Auth::user()->profile_id,
        "leave_requsts_org_id"=>$request->leave_requsts_org_id,
        "leave_requsts_user_leave_setups_rule_id"=>$request->leave_requsts_user_leave_setups_rule_id,
        "leave_requsts_start_date"=>$request->leave_requsts_start_date,
        "leave_requsts_end_date"=>$request->leave_requsts_end_date,
        "leave_requsts_need_date"=>$request->leave_requsts_need_date,
        "leave_requsts_reson"=>$request->leave_requsts_reson,
        "leave_requsts_head_profile_id"=>$request->leave_requsts_head_profile_id,
        "leave_requsts_date"=>date('Y-m-d'),
        "leave_requsts_status"=>'Pending',
      );

      DB::table('leave_requsts')->insert($data);





      $mailData = [
        "requster_name"=>DB::table('profiles')->where('profile_id','=',Auth::user()->profile_id)->value('profile_Full_name'),
        "profile_image"=>$request->profile_image,
        "leave_requsts_profile_id"=>Auth::user()->profile_id,
        "leave_requsts_user_leave_setups_rule_id"=>$request->leave_requsts_user_leave_setups_rule_id,
        "leave_requsts_start_date"=>$request->leave_requsts_start_date,
        "leave_requsts_end_date"=>$request->leave_requsts_end_date,
        "leave_requsts_need_date"=>$request->leave_requsts_need_date,
        "leave_requsts_reson"=>$request->leave_requsts_reson,
        "leave_requsts_head_profile_id"=>$request->leave_requsts_head_profile_id,
        "leave_requsts_date"=>date('Y-m-d'),
        "leave_requsts_status"=>'Pending',
        "requster_profile_Full_name"=>$request->requster_profile_Full_name,
        'appname'=>config('app.name'),
        'base_url'=>config('app.url'),
        'title' => 'Leave Request By '.DB::table('profiles')->where('profile_id','=',Auth::user()->profile_id)->value('profile_Full_name'),
         'leave_balance'=>'',

      ];



   //dd($request->leave_requsts_head_profile_id);

      $profile_job_head= DB::table('job_working')
                        ->where('profile_id','=',$request->leave_requsts_head_profile_id)
                         ->where('profile_job_work_status','=','Active')
                         ->value('profile_job_work_email');

     // dd($profile_job_head);

      $profile_sug= DB::table('job_working')->where('profile_id','=',$request->leave_requsts_head_profile_id)->value('profile_job_work_email');

      Mail::mailer('hr')->to($profile_job_head)->send(new LeaveRequstSend($mailData));
      return redirect('/home')->with('success','&nbsp;&nbsp; Leave requst send ');
    }


    public function show()
    {

      $data['leave_requsts']= DB::table('leave_requsts')->select('*')
      ->join('profiles','profiles.profile_id','=','leave_requsts.leave_requsts_profile_id')
      ->join('user_leave_setups','user_leave_setups.user_leave_setups_id','=','leave_requsts.leave_requsts_user_leave_setups_rule_id')
      ->join('enrolment_leave_setups','enrolment_leave_setups.enrolment_leave_setups_id','=','user_leave_setups.user_leave_setups_rule')
      ->join('employee_enrolment_types','employee_enrolment_types.employee_enrolment_types_id','=','enrolment_leave_setups.enrolment_employee_enrolment_types_id')
      //->join('employee_enrolment_types','employee_enrolment_types.employee_enrolment_types_id','=','enrolment_leave_setups.enrolment_employee_enrolment_types_id')
      ->join('leave_types','leave_types.leave_types_id','=','enrolment_leave_setups.enrolment_leave_types_id')
      ->where('leave_requsts.leave_requsts_status','=','Pending')
      ->where('leave_requsts.leave_requsts_head_profile_id','=',Auth::user()->profile_id)
      ->get();

      $data['setup_leave_view']= DB::table('user_leave_setups')->select('*')
      ->join('enrolment_leave_setups','enrolment_leave_setups.enrolment_leave_setups_id','=','user_leave_setups.user_leave_setups_rule')
      ->join('leave_types','leave_types.leave_types_id','=','enrolment_leave_setups.enrolment_leave_types_id')
      ->where('user_leave_setups.profile_id','=',Auth::user()->profile_id)
       ->where('user_leave_setups.user_leave_setups_status','=','Active')
      ->get();



      $data['usr_head_list']= DB::table('job_working')->select('*')
      ->join('profiles','profiles.profile_id','=','job_working.profile_job_work_head_of_sbu')
       ->where('profiles.profile_head_of_departmrnt_this_account','=','Yes')
      ->where('profiles.profile_status','=','Active')
      ->get();


       $data['title'] = 'Leave';
       $data['template'] = 'leave/index';
       return view('template/template', compact('data'));
    }


    public function edit(Request $request)
    {

        $request->validate([
            'leave_requsts_user_leave_setups_rule_id' => ['required','string'],
            'leave_requsts_start_date' => ['required','string'],
            'leave_requsts_end_date' => ['required','string'],
            'leave_requsts_need_date' => ['required','string'],
            'leave_requsts_head_reson' => ['string','string', 'max:255'],
             ]);


             $data=array(

                "leave_requsts_user_leave_setups_rule_id"=>$request->leave_requsts_user_leave_setups_rule_id,
                "leave_requsts_start_date"=>$request->leave_requsts_start_date,
                "leave_requsts_end_date"=>$request->leave_requsts_end_date,
                "leave_requsts_need_date"=>$request->leave_requsts_need_date,
               "leave_requsts_org_id"=>$request->leave_requsts_org_id,
                "leave_requsts_head_profile_id"=>$request->leave_requsts_head_profile_id,
                "leave_requsts_head_reson"=>$request->leave_requsts_head_reson,
                "leave_requsts_updatedate"=>date('Y-m-d H:i:s'),
                "leave_requsts_upda_by"=>Auth::user()->name,
                "leave_requsts_status"=>$request->leave_requsts_status,
              );

           //   dd( $data);
            //  DB::table('leave_requsts')->where('leave_requsts_id','=',$request->leave_requsts_id)->update($data);



              $mailData = [
                "requster_name"=>DB::table('profiles')->where('profile_id','=',$request->leave_requsts_profile_id)->value('profile_Full_name'),
                "profile_image"=>$request->profile_image,
                "leave_requsts_profile_id"=>$request->leave_requsts_profile_id,
                "leave_requsts_user_leave_setups_rule_id"=>$request->leave_requsts_user_leave_setups_rule_id,
                "leave_requsts_start_date"=>$request->leave_requsts_start_date,
                "leave_requsts_end_date"=>$request->leave_requsts_end_date,
                "leave_requsts_need_date"=>$request->leave_requsts_need_date,
                "leave_requsts_reson"=>$request->leave_requsts_reson,
                "leave_requsts_head_reson"=>$request->leave_requsts_head_reson,
                "leave_requsts_head_profile_id"=>$request->leave_requsts_head_profile_id,
                "leave_requsts_date"=>date('Y-m-d H:i:s'),
                "leave_requsts_status"=>$request->leave_requsts_status,
                "requster_profile_Full_name"=>$request->requster_profile_Full_name,
                "requster_profile_update"=>DB::table('profiles')->where('profile_id','=',$request->leave_requsts_head_profile_id)->value('profile_Full_name'),
                'appname'=>config('app.name'),
                //'base_url'=>config('app.url'),
                'title' => 'Leave Request By '.DB::table('profiles')->where('profile_id','=',$request->leave_requsts_profile_id)->value('profile_Full_name'),

              ];


              $email_address= DB::table('job_working')
              ->where('profile_id','=',$request->leave_requsts_profile_id)
              ->where('profile_job_work_status','=','Active')
               ->value('profile_job_work_email');

            Mail::mailer('hr')->to($email_address)->send(new LeaveUpdateStatus($mailData));


             if($request->leave_requsts_status=='Approved'){                

                $leaverequstapprovelSend=DB::table('leave_request_alerts')
                //->select('*')
                ->join('job_working','job_working.job_working_profile_id','=','leave_request_alerts.leave_request_alerts_user_work_id')
               ->where('job_working.profile_job_work_sbu','=',$request->leave_requsts_org_id)
                ->where('profile_job_work_status','=','Active')
                 ->get();

                 foreach($leaverequstapprovelSend as $allertRow){
                   Mail::mailer('hr')->to($allertRow->profile_job_work_email)->send(new LeaveApprovelAllertSend($mailData));               

               }               

             }
           return redirect('/subsidiaries-leave')->with('success','&nbsp;&nbsp; Leave '.$request->leave_requsts_status.' change Sucess full');

    }


    public function approvedLeave(){
        $data['leave_requsts']= DB::table('leave_requsts')->select('*')
        ->join('profiles','profiles.profile_id','=','leave_requsts.leave_requsts_profile_id')
        ->join('user_leave_setups','user_leave_setups.user_leave_setups_id','=','leave_requsts.leave_requsts_user_leave_setups_rule_id')
        ->join('enrolment_leave_setups','enrolment_leave_setups.enrolment_leave_setups_id','=','user_leave_setups.user_leave_setups_rule')
        ->join('employee_enrolment_types','employee_enrolment_types.employee_enrolment_types_id','=','enrolment_leave_setups.enrolment_employee_enrolment_types_id')
        //->join('employee_enrolment_types','employee_enrolment_types.employee_enrolment_types_id','=','enrolment_leave_setups.enrolment_employee_enrolment_types_id')
        ->join('leave_types','leave_types.leave_types_id','=','enrolment_leave_setups.enrolment_leave_types_id')
        ->where('leave_requsts.leave_requsts_status','=','Approved')
        ->where('leave_requsts.leave_requsts_head_profile_id','=',Auth::user()->profile_id)
        ->get();

        $data['setup_leave_view']= DB::table('user_leave_setups')->select('*')
        ->join('enrolment_leave_setups','enrolment_leave_setups.enrolment_leave_setups_id','=','user_leave_setups.user_leave_setups_rule')
        ->join('leave_types','leave_types.leave_types_id','=','enrolment_leave_setups.enrolment_leave_types_id')
        ->where('user_leave_setups.profile_id','=',Auth::user()->profile_id)
         ->where('user_leave_setups.user_leave_setups_status','=','Active')
        ->get();



        $data['usr_head_list']= DB::table('job_working')->select('*')
        ->join('profiles','profiles.profile_id','=','job_working.profile_job_work_head_of_sbu')
         ->where('profiles.profile_head_of_departmrnt_this_account','=','on')
        ->where('profiles.profile_status','=','Active')
        ->get();


         $data['title'] = 'Approved Leave';
         $data['template'] = 'leave/index';
         return view('template/template', compact('data'));

    }





    public function rejectLeave(){
        $data['leave_requsts']= DB::table('leave_requsts')->select('*')
        ->join('profiles','profiles.profile_id','=','leave_requsts.leave_requsts_profile_id')
        ->join('user_leave_setups','user_leave_setups.user_leave_setups_id','=','leave_requsts.leave_requsts_user_leave_setups_rule_id')
        ->join('enrolment_leave_setups','enrolment_leave_setups.enrolment_leave_setups_id','=','user_leave_setups.user_leave_setups_rule')
        ->join('employee_enrolment_types','employee_enrolment_types.employee_enrolment_types_id','=','enrolment_leave_setups.enrolment_employee_enrolment_types_id')
        //->join('employee_enrolment_types','employee_enrolment_types.employee_enrolment_types_id','=','enrolment_leave_setups.enrolment_employee_enrolment_types_id')
        ->join('leave_types','leave_types.leave_types_id','=','enrolment_leave_setups.enrolment_leave_types_id')
        ->where('leave_requsts.leave_requsts_status','=','Rejected')
        ->where('leave_requsts.leave_requsts_head_profile_id','=',Auth::user()->profile_id)
        ->get();

        $data['setup_leave_view']= DB::table('user_leave_setups')->select('*')
        ->join('enrolment_leave_setups','enrolment_leave_setups.enrolment_leave_setups_id','=','user_leave_setups.user_leave_setups_rule')
        ->join('leave_types','leave_types.leave_types_id','=','enrolment_leave_setups.enrolment_leave_types_id')
        ->where('user_leave_setups.profile_id','=',Auth::user()->profile_id)
         ->where('user_leave_setups.user_leave_setups_status','=','Active')
        ->get();



        $data['usr_head_list']= DB::table('job_working')->select('*')
        ->join('profiles','profiles.profile_id','=','job_working.profile_job_work_head_of_sbu')
         ->where('profiles.profile_head_of_departmrnt_this_account','=','on')
        ->where('profiles.profile_status','=','Active')
        ->get();


         $data['title'] = 'Rejected Leave';
         $data['template'] = 'leave/index';
         return view('template/template', compact('data'));

    }



    public static function leaveCalculate($profile_id,$leave_requsts_user_leave_setups_rule_id,$leaveStatus,$user_leave_setups_start_date,$user_leave_setups_end_date,$enrolment_leave_date_calculation,$profile_job_join_date){

   echo   DB::table('leave_requsts')->select('*')
        ->where('leave_requsts_profile_id','=',$profile_id)
        ->where('leave_requsts_user_leave_setups_rule_id','=',$leave_requsts_user_leave_setups_rule_id)
        ->where('leave_requsts_status','=',$leaveStatus)
       // ->where('leave_requsts_date','like','%'.date('Y') .'%')
        ->where('leave_requsts_start_date','>=',$user_leave_setups_start_date)
        ->where('leave_requsts_start_date','<=',$user_leave_setups_end_date)
        ->get()
        ->sum("leave_requsts_need_date");

    }


    public static function leaveBalance($profile_id,$leave_requsts_user_leave_setups_rule_id,$leaveStatus,$user_leave_setups_start_date,$user_leave_setups_end_date,$enrolment_leave_date_calculation,$profile_job_join_date,$enrolment_leave_total){

        echo $enrolment_leave_total -   DB::table('leave_requsts')->select('*')
        ->where('leave_requsts_profile_id','=',$profile_id)
        ->where('leave_requsts_user_leave_setups_rule_id','=',$leave_requsts_user_leave_setups_rule_id)
        ->where('leave_requsts_status','=',$leaveStatus)
        // ->where('leave_requsts_date','like','%'.date('Y') .'%')
        ->where('leave_requsts_start_date','>=',$user_leave_setups_start_date)
        ->where('leave_requsts_start_date','<=',$user_leave_setups_end_date)
        ->get()
        ->sum("leave_requsts_need_date");





         }




    public function leveallorg($year){
         $data['year']=$year;
         $data['allorg']= DB::table('subsidiaries')->select('*')->orderBy('subsidiaries_name', 'asc')->get();
         $data['leaverule']= DB::table('leave_types')->select('*')->orderBy('leave_types_name', 'asc')->get();
         $data['title'] = 'Leave Report';
         $data['template'] = 'leave/orgleaveall';
         return view('template/template', compact('data'));

    }


    public static function reportsone($sbu,$leave_types,$date){
        $data=DB::table('job_working')->select('*')
        ->join('leave_requsts','leave_requsts.leave_requsts_profile_id','=','job_working.profile_id')
        ->join('user_leave_setups','user_leave_setups.user_leave_setups_id','=','leave_requsts.leave_requsts_user_leave_setups_rule_id')
        ->join('enrolment_leave_setups','enrolment_leave_setups.enrolment_leave_setups_id','=','user_leave_setups.user_leave_setups_rule')
        ->where('job_working.profile_job_work_sbu','=',$sbu)
        ->where('enrolment_leave_setups.enrolment_leave_types_id','=',$leave_types)
        ->where('leave_requsts.leave_requsts_start_date','like','%'.$date.'%')
        ->where('leave_requsts.leave_requsts_status','=','Approved')
        ->get()
        ->sum("leave_requsts_need_date");

       if($data == 0){
              Echo 'No';
        }
        else{
           echo  $data;
        }

    }

        public function subdiaryleavereport($org,$date){
            $data['profile']=DB::table('job_working')->select('*')
                            ->join('profiles','profiles.profile_id','=','job_working.profile_id')
                            ->where('job_working.profile_job_work_sbu','=',$org)
                            ->where('job_working.profile_job_work_status','=','Active')
                            ->get();

            $data['date']=$date;
            $data['leaverule']= DB::table('leave_types')->select('*')->orderBy('leave_types_name', 'asc')->get();
            $data['title'] = 'Org Active Profile Leave Report';
            $data['template'] = 'leave/oneorgleave';
            return view('template/template', compact('data'));

        }



        public static function reportsonesbu($date,$profile_id,$leave_types,$status){
            $data=DB::table('job_working')->select('*')
            ->join('leave_requsts','leave_requsts.leave_requsts_profile_id','=','job_working.profile_id')
            ->join('user_leave_setups','user_leave_setups.user_leave_setups_id','=','leave_requsts.leave_requsts_user_leave_setups_rule_id')
            ->join('enrolment_leave_setups','enrolment_leave_setups.enrolment_leave_setups_id','=','user_leave_setups.user_leave_setups_rule')
            ->where('job_working.profile_job_work_status','=','Active')
            ->where('job_working.profile_id','=',$profile_id)
            ->where('leave_requsts.leave_requsts_status','=',$status)

            ->where('enrolment_leave_setups.enrolment_leave_types_id','=',$leave_types)
            ->where('leave_requsts.leave_requsts_start_date','like','%'.$date.'%')
            ->get()
            ->sum("leave_requsts_need_date");

           if($data == 0){
                  Echo 'No';
            }
            else{
               echo  $data;
            }

        }







}
