<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FrontHomeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\UserModel;
use App\Models;
use Image;
Use Alert;
use Illuminate\Support\Carbon;






class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
{
    $this->middleware('auth');
}




    public function index()
    {


   


       $data['tiket_issued']= DB::table('issues')
       ->select('*')       
       ->get();




        $data['sbucount']=DB::table('subsidiaries')->where('assetsubsidiarie','=','yes')->count();
        $data['profile_count']=DB::table('profiles')->where('profile_status','=','Active')->count();
        $data['profile_count_total']=DB::table('profiles')->count();

        $data['leave_requsts']= DB::table('leave_requsts')->select('*')
        ->join('profiles','profiles.profile_id','=','leave_requsts.leave_requsts_profile_id')
        ->join('user_leave_setups','user_leave_setups.user_leave_setups_id','=','leave_requsts.leave_requsts_user_leave_setups_rule_id')
        ->join('enrolment_leave_setups','enrolment_leave_setups.enrolment_leave_setups_id','=','user_leave_setups.user_leave_setups_rule')
        ->join('employee_enrolment_types','employee_enrolment_types.employee_enrolment_types_id','=','enrolment_leave_setups.enrolment_employee_enrolment_types_id')
        //->join('employee_enrolment_types','employee_enrolment_types.employee_enrolment_types_id','=','enrolment_leave_setups.enrolment_employee_enrolment_types_id')
        ->join('leave_types','leave_types.leave_types_id','=','enrolment_leave_setups.enrolment_leave_types_id')
        ->where('leave_requsts.leave_requsts_status','=','Pending')
        ->where('leave_requsts.leave_requsts_date','=',date('Y-m-d'))
        ->get();

        $data['profile_birth_day']=DB::table('profiles')
        ->where('profile_bith_day', 'like', '%'.date('m').'%')
        ->where('profile_status','=','Active')
        ->orderBy(DB::raw("DATE_FORMAT(profile_bith_day,'%d-%M-%Y')"), 'ASC')
        ->get();



        $data['profile_birth_day_today']=DB::table('profiles')
        ->where('profile_bith_day', 'like', '%'.date('m').'-'.date('d').'%')
        ->where('profile_status','=','Active')
        ->orderBy(DB::raw("DATE_FORMAT(profile_bith_day,'%d-%M-%Y')"), 'ASC')
        ->get();


        $data['Upcoming_profile_birth_day']=DB::table('profiles')
       ->where('profile_bith_day', 'like', '%'.Carbon::today()->format('m').'%')
       //>whereDay('profile_bith_day', Carbon::now())->whereMonth('profile_bith_day', Carbon::now())
     // ->whereBetween('profile_bith_day', [Carbon::today()->format('m-d'), Carbon::today()->addDays(7)->format('m-d')])
        ->where('profile_status','=','Active')
        ->orderBy(DB::raw("DATE_FORMAT(profile_bith_day,'%d-%M-%Y')"), 'ASC')
        ->get();



        $data['pendingtiketUser']= DB::table('tickets')
          
        ->join('subsidiaries','subsidiaries.subsidiaries_id','=','tickets.ticket_organization')
        
        
        ->where('tickets.ticket_owner','=',Auth::user()->profile_id) 
        ->where('tickets.ticket_status','Crate')
       ->orwhere('tickets.ticket_status','View')
        ->orwhere('tickets.ticket_status','Process')        
        ->get();


        $data['equpment_types']= DB::table('equpment_types')->select('*')->orderBy('equpment_name', 'asc')->get();
        $data['invoicebel_ticket_this_month']=  DB::table('tickets')
                                                ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'tickets.ticket_organization')
                                                ->whereNotNull('ticket_invoice_amount')->get();
       $data['sbu_names'] =  DB::table('subsidiaries')->select('*')->orderBy('subsidiaries_name', 'asc')->get();

       $data['repirRecive']=  DB::table('repair_receives')
       ->join('tickets', 'tickets.tickets_id', '=', 'repair_receives.repair_receives_ticket_id')  
       ->whereNull('repair_receives.repair_receives_status')           
       ->get();



       $data['ticketDetails']= DB::table('tickets')
       ->select('*')
       ->join('subsidiaries','subsidiaries.subsidiaries_id','=','tickets.ticket_organization')
       ->join('departments','departments.department_id','=','tickets.ticket_department_name')
       ->join('equpment_types','equpment_types.equpment_types_id','=','tickets.ticket_equpment_types')
       ->join('issues','issues.issues_id','=','tickets.ticket_issues_id')
       ->where('tickets.ticket_status','=','Finish')
       ->where('tickets.ticket_invoisable','=','Yes')
       ->where('tickets.ticket_invoice_amount','>=',0)
       ->get();

       $data['myprofile']=DB::table('profiles')
       ->select('*')
       ->join('job_join_history','job_join_history.profile_id','=','profiles.profile_id')
       ->join('job_working','job_working.profile_id','=','profiles.profile_id')
       ->join('subsidiaries','subsidiaries.subsidiaries_id','=','job_working.profile_job_work_sbu')
       ->join('designations','designations.designations_id','=','job_working.profile_job_work_designation')
       ->join('departments','departments.department_id','=','job_working.profile_job_work_department')
       ->join('job_descriptions','job_descriptions.job_descriptions_id','=','job_working.profile_job_work_jd')
       ->join('office_locations','office_locations.office_locations_id','=','job_working.profile_job_work_office_location')
       ->join('religions','religions.religion_id','=','profiles.religion_id')
       ->where('profiles.profile_id','=',Auth::user()->profile_id)     
       ->get();



    $data['workingJobportal']= DB::table('job_working')->select('*')
    ->join('profiles','profiles.profile_id','=','job_working.profile_id')
    ->join('job_join_history','job_join_history.profile_id','=','job_working.profile_id')
    ->join('subsidiaries','subsidiaries.subsidiaries_id','=','job_working.profile_job_work_sbu')
    ->join('designations','designations.designations_id','=','job_working.profile_job_work_designation')
    ->join('departments','departments.department_id','=','job_working.profile_job_work_department')
    ->join('job_descriptions','job_descriptions.job_descriptions_id','=','job_working.profile_job_work_jd')
    ->join('office_locations','office_locations.office_locations_id','=','job_working.profile_job_work_office_location')
    ->where('profiles.profile_id','=',Auth::user()->profile_id)     
    ->where('job_working.profile_job_work_status','Active')
    ->orderBy('job_working.job_working_profile_id', 'DESC')
    ->get();

    $data['busnus'] = DB::table('subsidiaries')
    ->select('*')
    ->get();
$data['departments'] = DB::table('departments')
    ->select('*')
    ->get();
$data['equpment_types'] = DB::table('equpment_types')
    ->select('*')
    ->get();
$data['issues'] = DB::table('issues')
    ->select('*')
    ->get();

    


      $data['title'] = 'Dashbord';
      $data['template'] = 'dashbord/index';
      return view('template/template', compact('data'));


    }
}
