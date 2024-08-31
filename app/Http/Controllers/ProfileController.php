<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Mail\ResignationApproveHr;
use App\Mail\ResignationHrApprovel;
use App\Mail\Resignationnotapproved;
use App\Mail\ResignationNotification;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Image; // aprovel notification send to HR
use Mail;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['title'] = 'Profile';
        $data['profile'] = DB::table('profiles')->select('*')->get();
        $data['template'] = 'profile/index';

        return view('template/template', compact('data'));
    }

    public function create()
    {

        $sbuHead = DB::table('profiles')->select('*')
            ->where('profile_head_of_departmrnt_this_account', '=', 'on')->where('profile_status', 'Active')->orderBy('profile_Full_name', 'asc')->get();
        $data['title'] = 'New Profile';
        $data['religions'] = DB::table('religions')->select('*')->orderBy('religion_name', 'asc')->get();
        $data['profile'] = DB::table('profiles')->select('*')->orderBy('profile_Full_name', 'asc')->get();
        $data['subsidiaries'] = DB::table('subsidiaries')->select('*')->orderBy('subsidiaries_name', 'asc')->get(); //sbu
        $data['designations'] = DB::table('designations')->select('*')->orderBy('designations_name', 'asc')->get(); // desgnation
        $data['departments'] = DB::table('departments')->select('*')->orderBy('department_name', 'asc')->get(); // department
        $data['job_descriptions'] = DB::table('job_descriptions')->select('*')->orderBy('job_descriptions_name', 'asc')->get(); // Job Discription
        $data['office_locations'] = DB::table('office_locations')->select('*')->orderBy('office_locations_name', 'asc')->get(); // office_locations
        $data['sbu_head'] = $sbuHead;
        $data['template'] = 'profile/newprofile';

        return view('template/template', compact('data'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProfileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (! empty(DB::table('profiles')->orderBy('profile_number', 'desc')->value('profile_number'))) {
            $pnumber = str_pad(DB::table('profiles')->orderBy('profile_number', 'desc')->value('profile_number') + 1, 8, '0', STR_PAD_LEFT);
        } else {
            $pnumber = str_pad(1, 8, '0', STR_PAD_LEFT);
        }

        $request->validate([
            'profile_Full_name' => ['required', 'string', 'max:255', 'unique:profiles'],
            'profile_first_name' => ['required', 'string', 'max:255', 'unique:profiles'],
            'profile_last_name' => ['required', 'string', 'max:255', 'unique:profiles'],
            'profile_bith_day' => ['required', 'string', 'max:255'],
            'profile_nic' => ['required', 'string', 'max:255'],
            'profile_living_province' => ['required', 'string', 'max:255'],
            'profile_marital_status' => ['required', 'string', 'max:255'],
            'profile_gender' => ['required', 'string', 'max:255'],
            'profile_permant_address' => ['required', 'string', 'max:255'],
            'profile_current_address' => ['required', 'string', 'max:255'],
            'profile_mobile_number' => ['required', 'string', 'max:255'],
            'profile_email' => ['email'],
            'religion_id' => ['required', 'string', 'max:255'],
            'profile_emergency_contact_person_name' => ['required', 'string', 'max:255'],
            'profile_relationship' => ['required', 'string', 'max:255'],
            'profile_emergency_mobile_number' => ['required', 'digits:10'],
            'profile_job_join_epf_number' => ['unique:job_join_history', 'max:255'],
            'profile_job_join_mobile' => ['digits:10'],
            'profile_job_join_email' => ['email'],
            'religion_id' => ['required', 'string', 'max:255'],
            'profile_job_join_basic_salary' => ['string', 'max:255'],
            //'profile_job_work_employee_index_number'=>['unique:job_working', 'string', 'max:255'],

        ]);

        // profile table
        $data = [
            'profile_number' => $pnumber,
            'profile_sug' => str_slug($request->profile_Full_name),
            'profile_Full_name' => $request->profile_Full_name,
            'profile_first_name' => $request->profile_first_name,
            'profile_last_name' => $request->profile_last_name,
            'profile_bith_day' => $request->profile_bith_day,
            'profile_gender' => $request->profile_gender,
            'profile_nic' => $request->profile_nic,
            'profile_living_province' => $request->profile_living_province,
            'profile_marital_status' => $request->profile_marital_status,
            'profile_permant_address' => $request->profile_permant_address,
            'profile_current_address' => $request->profile_current_address,
            'profile_mobile_number' => $request->profile_mobile_number,
            'profile_emergency_contact_person_name' => $request->profile_emergency_contact_person_name,
            'profile_relationship' => $request->profile_relationship,
            'profile_emergency_mobile_number' => $request->profile_emergency_mobile_number,
            'profile_email' => $request->profile_email,
            'religion_id' => $request->religion_id,
            'profile_status' => 'Active',
            'profile_head_of_departmrnt_this_account' => $request->profile_head_of_departmrnt_this_account,
            'reasons_for_request_to_change' => 'New Account',
            'profile_crate_by' => Auth::user()->name,
            'profile_crate_date' => date('Y-m-d H:i:s'),
        ];
        DB::table('profiles')->insert($data); //profile
        $profile_id = DB::getPdo()->lastInsertId();

        $joinjobs = [
            'profile_id' => $profile_id,
            'profile_job_join_epf_number' => $request->profile_job_join_epf_number,
            'profile_job_join_date' => $request->profile_job_join_date,
            'profile_job_join_sbu' => $request->profile_job_join_sbu,
            'profile_job_join_department' => $request->profile_job_join_department,
            'profile_job_join_designation' => $request->profile_job_join_designation,
            'profile_job_join_jd' => $request->profile_job_join_jd,
            'profile_job_join_office_location' => $request->profile_job_join_office_location,
            'profile_job_join_head_of_sbu' => $request->profile_job_join_head_of_sbu,
            'profile_job_join_email' => $request->profile_job_join_email,
            'profile_job_join_employee_index_numbe' => $request->profile_job_join_epf_number,
            'profile_job_join_mobile' => $request->profile_job_join_mobile,
            'job_join_profile_crate_by' => Auth::user()->name,
            'job_join_profile_crate_date' => date('Y-m-d H:i:s'),
        ];
        DB::table('job_join_history')->insert($joinjobs); //join job id
        $job_join_profile_id = DB::getPdo()->lastInsertId(); //joinjob id

        $working = [
            'profile_job_join_profile_id' => $job_join_profile_id,
            'profile_id' => $profile_id,
            'profile_job_work_epf_number' => $request->profile_job_join_epf_number,
            'profile_job_work_join_date' => $request->profile_job_join_date,
            'profile_job_work_sbu' => $request->profile_job_join_sbu,
            'profile_job_work_department' => $request->profile_job_join_department,
            'profile_job_work_designation' => $request->profile_job_join_designation,
            'profile_job_work_email' => $request->profile_job_join_email,
            'profile_job_work_mobile' => $request->profile_job_join_mobile,
            'profile_job_work_jd' => $request->profile_job_join_jd,
            'profile_job_work_head_of_sbu' => $request->profile_job_join_head_of_sbu,
            'profile_job_work_employee_index_number' => $request->profile_job_join_epf_number,
            'profile_job_work_office_location' => $request->profile_job_join_office_location,
            'profile_job_work_status' => 'Active',
            'profile_job_work_status_reson' => 'New Recruitment',
            'job_work_profile_crate_by' => Auth::user()->name,
            'job_work_profile_crate_date' => date('Y-m-d H:i:s'),
        ];
        DB::table('job_working')->insert($working); //now working

        $allowance = [
            'profile_id' => $profile_id,
            'allowances_salary' => $request->profile_job_join_basic_salary,
            'allowances_reson' => 'Basic Salary at the start',
            'allowances_add_by' => Auth::user()->name,
            'allowances_add_date' => date('Y-m-d H:i:s'),
            'allowances_update_reson' => $request->profile_job_join_sbu,
            'allowances_update_by' => Auth::user()->name,
            'allowances_update_date' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
        ];
        AllowanceController::create($allowance);

        //salary
        $salary = [
            'profile_id' => $profile_id,
            'salary_salary' => $request->profile_job_join_basic_salary,
            'salary_reson' => 'Basic Salary at the start',
            'salary_add_by' => Auth::user()->name,
            'salary_add_date' => date('Y-m-d H:i:s'),
            'salary_update_reson' => $request->profile_job_join_sbu,
            'salary_update_by' => Auth::user()->name,
            'salary_update_date' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        DB::table('salaries')->insert($salary); //salary

        return redirect('/new-profile')->with('success', $request->profile_first_name.'&nbsp;&nbsp; Save Sucess Full');

    }

    public function show(Request $request)
    {

        // dd($request);

        $check = DB::table('profiles')->select('*')
            ->where('profile_sug', '=', $request->profile_sug)->count();

        //  dd($request->profile_sug);

        if ($check == 1) {

            $all = DB::table('profiles')
                ->select('*')
                ->join('job_join_history', 'job_join_history.profile_id', '=', 'profiles.profile_id')
                ->join('job_working', 'job_working.profile_id', '=', 'profiles.profile_id')
                ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'job_working.profile_job_work_sbu')
                ->join('designations', 'designations.designations_id', '=', 'job_working.profile_job_work_designation')
                ->join('departments', 'departments.department_id', '=', 'job_working.profile_job_work_department')
                ->join('job_descriptions', 'job_descriptions.job_descriptions_id', '=', 'job_working.profile_job_work_jd')
                ->join('office_locations', 'office_locations.office_locations_id', '=', 'job_working.profile_job_work_office_location')
                ->join('religions', 'religions.religion_id', '=', 'profiles.religion_id')
                ->where('profiles.profile_sug', '=', $request->profile_sug)
                ->limit(1)
                ->get();

            //dd( $all);

            $data['equipment'] = DB::table('equipment')
                ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'equipment.equipment_organization')
                ->join('equpment_types', 'equpment_types.equpment_types_id', '=', 'equipment.equipment_type')
                ->join('profiles', 'profiles.profile_id', '=', 'equipment.equipment_user')
                ->orderBy('equipment.equipment_number', 'asc')
            //->whereNull('equipment.equipment_user')
                ->get();
            // ;//sbu

            $sbuHead = DB::table('profiles')->select('*')
                ->where('profile_head_of_departmrnt_this_account', '=', 'Yes')
                ->where('profile_status', 'Active')
                ->orderBy('profiles.profile_Full_name', 'asc')
                ->get();

            $setup_leave = DB::table('enrolment_leave_setups')->select('*')
                ->join('employee_enrolment_types', 'employee_enrolment_types.employee_enrolment_types_id', '=', 'enrolment_leave_setups.enrolment_employee_enrolment_types_id')
                ->join('leave_types', 'leave_types.leave_types_id', '=', 'enrolment_leave_setups.enrolment_leave_types_id')
                ->get();

            $setup_leave_view = DB::table('user_leave_setups')->select('*')
                ->join('enrolment_leave_setups', 'enrolment_leave_setups.enrolment_leave_setups_id', '=', 'user_leave_setups.user_leave_setups_rule')
                ->join('leave_types', 'leave_types.leave_types_id', '=', 'enrolment_leave_setups.enrolment_leave_types_id')
                ->where('user_leave_setups.profile_id', '=', Auth::user()->profile_id)
                ->where('user_leave_setups.user_leave_setups_status', '=', 'Active')
                ->get();

            $usr_head_list = DB::table('job_working')->select('*')
                ->join('profiles', 'profiles.profile_id', '=', 'job_working.profile_job_work_head_of_sbu')
                ->join('religions', 'religions.religion_id', '=', 'profiles.religion_id')
                               // ->where('job_working.profile_id','=',Auth::user()->profile_id)
                               // ->where('job_working.profile_job_work_status','=','Active')
                ->where('profiles.profile_head_of_departmrnt_this_account', '=', 'Active')
                ->where('profiles.profile_status', '=', 'Active')
                ->orderBy('profiles.profile_Full_name', 'asc')
                ->get();

            $data['workingprofile'] = DB::table('job_working')
                ->join('profiles', 'profiles.profile_id', '=', 'job_working.profile_id')
                ->where('profiles.profile_status', '=', 'Active')
                ->orderBy('profiles.profile_Full_name', 'asc')
                ->get();

            $data['workingJobportal'] = DB::table('job_working')->select('*')
                ->join('profiles', 'profiles.profile_id', '=', 'job_working.profile_id')
                ->join('job_join_history', 'job_join_history.profile_id', '=', 'job_working.profile_id')
                ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'job_working.profile_job_work_sbu')
                ->join('designations', 'designations.designations_id', '=', 'job_working.profile_job_work_designation')
                ->join('departments', 'departments.department_id', '=', 'job_working.profile_job_work_department')
                ->join('job_descriptions', 'job_descriptions.job_descriptions_id', '=', 'job_working.profile_job_work_jd')
                ->join('office_locations', 'office_locations.office_locations_id', '=', 'job_working.profile_job_work_office_location')
                ->where('profiles.profile_sug', '=', $request->profile_sug)
                ->where('job_working.profile_job_work_status', 'Active')
                ->orderBy('job_working.job_working_profile_id', 'DESC')
                ->get();

            $data['lastworkscompani'] = DB::table('job_working')->select('*')
                ->join('profiles', 'profiles.profile_id', '=', 'job_working.profile_id')
                ->join('job_join_history', 'job_join_history.profile_id', '=', 'job_working.profile_id')
                ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'job_working.profile_job_work_sbu')
                ->join('designations', 'designations.designations_id', '=', 'job_working.profile_job_work_designation')
                ->join('departments', 'departments.department_id', '=', 'job_working.profile_job_work_department')
                ->join('job_descriptions', 'job_descriptions.job_descriptions_id', '=', 'job_working.profile_job_work_jd')
                ->join('office_locations', 'office_locations.office_locations_id', '=', 'job_working.profile_job_work_office_location')
                ->where('profiles.profile_sug', '=', $request->profile_sug)
                                        //->where('job_working.profile_job_work_status','Stopped')
                ->orderBy('job_working.job_working_profile_id', 'DESC')
                ->get();

            $data['accountdetails'] = DB::table('account_details')
                ->join('profiles', 'profiles.profile_id', '=', 'account_details.account_profile_id')
                                        //->where('account_profile_id','=',$profile[0]->profile_id)
                ->where('profiles.profile_sug', '=', $request->profile_sug)
                ->orderBy('account_status', 'ASC')->get();

            $data['profileNotes'] = DB::table('notes')
                ->join('profiles', 'profiles.profile_id', '=', 'notes.new_note_profile_id')
                                        //->where('account_profile_id','=',$profile[0]->profile_id)
                ->where('profiles.profile_sug', '=', $request->profile_sug)
                ->orderBy('notes.notes_id', 'DESC')->get();

            /*
    $data['reporting_manager'] =  DB::table('job_working')->select('*')
            ->join('job_working','job_working.profile_id','=','profiles.profile_id')
                               // ->where('job_working.profile_id','=',$request->profile_sug)
                               // ->where('job_working.profile_job_work_status','=','Active')
            ->get();
*/

            $data['title'] = 'New Profile';
            // $data['religions']= DB::table('religions')->select('*')->get();
            //  $data['profile']= DB::table('profiles')->select('*')->get();

            // $data['subsidiaries']= DB::table('subsidiaries')->select('*')->get();//sbu
            // $data['designations']= DB::table('designations')->select('*')->get();// desgnation
            // $data['departments']= DB::table('departments')->select('*')->get();// department
            // $data['job_descriptions']= DB::table('job_descriptions')->select('*')->get();// Job Discription
            //$data['office_locations']= DB::table('office_locations')->select('*')->get();// office_locations
            $data['document_types'] = DB::table('document_types')->select('*')->orderBy('document_types_name', 'asc')->get();
            $data['religions'] = DB::table('religions')->select('*')->orderBy('religion_name', 'asc')->get();
            $data['profile'] = DB::table('profiles')->select('*')->orderBy('profile_Full_name', 'asc')->get();
            $data['subsidiaries'] = DB::table('subsidiaries')->select('*')->orderBy('subsidiaries_name', 'asc')->get(); //sbu
            $data['designations'] = DB::table('designations')->select('*')->orderBy('designations_name', 'asc')->get(); // desgnation
            $data['departments'] = DB::table('departments')->select('*')->orderBy('department_name', 'asc')->get(); // department
            $data['job_descriptions'] = DB::table('job_descriptions')->select('*')->orderBy('job_descriptions_name', 'asc')->get(); // Job Discription
            $data['office_locations'] = DB::table('office_locations')->select('*')->orderBy('office_locations_name', 'asc')->get(); // office_locations

            $data['sbu_head'] = $sbuHead;
            $data['leave_rule'] = $setup_leave;
            $data['setup_leave_view'] = $setup_leave_view;
            $data['usr_head_list'] = $usr_head_list;

            $data['title'] = 'Profile';
            $data['profile'] = $all;
            $data['template'] = 'profile/profile-view';

            return view('template/template', compact('data'));

        } else {
            return redirect('/home')->with('success', '&nbsp;&nbsp; No Like this Profile');
        }
    }

    /// new profile
    public function showp(Request $request)
    {

        $check = DB::table('profiles')->select('*')
            ->where('profile_sug', '=', $request->profile_sug)->count();

        if ($check == 1) {

            $all[] = DB::table('profiles')
                ->select('*')
                ->join('job_join_history', 'job_join_history.profile_id', '=', 'profiles.profile_id')
                ->join('job_working', 'job_working.profile_id', '=', 'profiles.profile_id')
                ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'job_working.profile_job_work_sbu')
                ->join('designations', 'designations.designations_id', '=', 'job_working.profile_job_work_designation')
                ->join('departments', 'departments.department_id', '=', 'job_working.profile_job_work_department')
                ->join('job_descriptions', 'job_descriptions.job_descriptions_id', '=', 'job_working.profile_job_work_jd')
                ->join('office_locations', 'office_locations.office_locations_id', '=', 'job_working.profile_job_work_office_location')
                ->join('religions', 'religions.religion_id', '=', 'profiles.religion_id')
                ->where('profiles.profile_sug', '=', $request->profile_sug)
                ->limit(1)
                ->get();

            $data['equpment_types'] = DB::table('equpment_types')
                ->select('*')
                ->orderBy('equpment_name', 'asc')
                ->get();

            $sbuHead = DB::table('profiles')->select('*')
                ->where('profile_head_of_departmrnt_this_account', '=', 'Yes')
                ->where('profile_status', 'Active')
                ->orderBy('profiles.profile_Full_name', 'asc')
                ->get();

            $setup_leave = DB::table('enrolment_leave_setups')->select('*')
                ->join('employee_enrolment_types', 'employee_enrolment_types.employee_enrolment_types_id', '=', 'enrolment_leave_setups.enrolment_employee_enrolment_types_id')
                ->join('leave_types', 'leave_types.leave_types_id', '=', 'enrolment_leave_setups.enrolment_leave_types_id')
                ->get();

            $setup_leave_view = DB::table('user_leave_setups')->select('*')
                ->join('enrolment_leave_setups', 'enrolment_leave_setups.enrolment_leave_setups_id', '=', 'user_leave_setups.user_leave_setups_rule')
                ->join('leave_types', 'leave_types.leave_types_id', '=', 'enrolment_leave_setups.enrolment_leave_types_id')
                ->where('user_leave_setups.profile_id', '=', Auth::user()->profile_id)
                ->where('user_leave_setups.user_leave_setups_status', '=', 'Active')
                ->get();

            $usr_head_list = DB::table('job_working')->select('*')
                ->join('profiles', 'profiles.profile_id', '=', 'job_working.profile_job_work_head_of_sbu')
                ->join('religions', 'religions.religion_id', '=', 'profiles.religion_id')
                               // ->where('job_working.profile_id','=',Auth::user()->profile_id)
                               // ->where('job_working.profile_job_work_status','=','Active')
                ->where('profiles.profile_head_of_departmrnt_this_account', '=', 'Active')
                ->where('profiles.profile_status', '=', 'Active')
                ->orderBy('profiles.profile_Full_name', 'asc')
                ->get();

            $data['workingJobportal'] = DB::table('job_working')->select('*')
                ->join('profiles', 'profiles.profile_id', '=', 'job_working.profile_id')
                ->join('job_join_history', 'job_join_history.profile_id', '=', 'job_working.profile_id')
                ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'job_working.profile_job_work_sbu')
                ->join('designations', 'designations.designations_id', '=', 'job_working.profile_job_work_designation')
                ->join('departments', 'departments.department_id', '=', 'job_working.profile_job_work_department')
                ->join('job_descriptions', 'job_descriptions.job_descriptions_id', '=', 'job_working.profile_job_work_jd')
                ->join('office_locations', 'office_locations.office_locations_id', '=', 'job_working.profile_job_work_office_location')
                ->where('profiles.profile_sug', '=', $request->profile_sug)
                ->where('job_working.profile_job_work_status', 'Active')
                ->orderBy('job_working.job_working_profile_id', 'DESC')
                ->get();

            $data['lastworkscompani'] = DB::table('job_working')->select('*')
                ->join('profiles', 'profiles.profile_id', '=', 'job_working.profile_id')
                ->join('job_join_history', 'job_join_history.profile_id', '=', 'job_working.profile_id')
                ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'job_working.profile_job_work_sbu')
                ->join('designations', 'designations.designations_id', '=', 'job_working.profile_job_work_designation')
                ->join('departments', 'departments.department_id', '=', 'job_working.profile_job_work_department')
                ->join('job_descriptions', 'job_descriptions.job_descriptions_id', '=', 'job_working.profile_job_work_jd')
                ->join('office_locations', 'office_locations.office_locations_id', '=', 'job_working.profile_job_work_office_location')
                ->where('profiles.profile_sug', '=', $request->profile_sug)
                                       // ->where('job_working.profile_job_work_status','Stopped')
                ->orderBy('job_working.job_working_profile_id', 'DESC')
                ->get();

            $data['accountdetails'] = DB::table('account_details')
                ->join('profiles', 'profiles.profile_id', '=', 'account_details.account_profile_id')
                                        //->where('account_profile_id','=',$profile[0]->profile_id)
                ->where('profiles.profile_sug', '=', $request->profile_sug)
                ->orderBy('account_status', 'ASC')->get();

            $data['profileNotes'] = DB::table('notes')
                ->join('profiles', 'profiles.profile_id', '=', 'notes.new_note_profile_id')
                                        //->where('account_profile_id','=',$profile[0]->profile_id)
                ->where('profiles.profile_sug', '=', $request->profile_sug)
                ->orderBy('notes.notes_id', 'DESC')->get();

            $data['title'] = 'New Profile';
            // $data['religions']= DB::table('religions')->select('*')->get();
            //  $data['profile']= DB::table('profiles')->select('*')->get();

            // $data['subsidiaries']= DB::table('subsidiaries')->select('*')->get();//sbu
            // $data['designations']= DB::table('designations')->select('*')->get();// desgnation
            // $data['departments']= DB::table('departments')->select('*')->get();// department
            // $data['job_descriptions']= DB::table('job_descriptions')->select('*')->get();// Job Discription
            //$data['office_locations']= DB::table('office_locations')->select('*')->get();// office_locations
            $data['document_types'] = DB::table('document_types')->select('*')->orderBy('document_types_name', 'asc')->get();
            $data['religions'] = DB::table('religions')->select('*')->orderBy('religion_name', 'asc')->get();
            $data['profile'] = DB::table('profiles')->select('*')->orderBy('profile_Full_name', 'asc')->get();
            $data['subsidiaries'] = DB::table('subsidiaries')->select('*')->orderBy('subsidiaries_name', 'asc')->get(); //sbu
            $data['designations'] = DB::table('designations')->select('*')->orderBy('designations_name', 'asc')->get(); // desgnation
            $data['departments'] = DB::table('departments')->select('*')->orderBy('department_name', 'asc')->get(); // department
            $data['job_descriptions'] = DB::table('job_descriptions')->select('*')->orderBy('job_descriptions_name', 'asc')->get(); // Job Discription
            $data['office_locations'] = DB::table('office_locations')->select('*')->orderBy('office_locations_name', 'asc')->get(); // office_locations

            $data['sbu_head'] = $sbuHead;
            $data['leave_rule'] = $setup_leave;
            $data['setup_leave_view'] = $setup_leave_view;
            $data['usr_head_list'] = $usr_head_list;

            $data['title'] = 'Profile';
            $data['profile'] = $all;
            $data['template'] = 'profile/new_profile-view';

            return view('template/template', compact('data'));

        } else {
            return redirect('/home')->with('success', '&nbsp;&nbsp; No Like this Profile');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function jobjoin(Request $request)
    {

        $request->validate([
            'profile_job_join_sbu' => ['required'],
            'profile_job_join_department' => ['required'],
            'profile_job_join_designation' => ['required'],
            'profile_job_join_jd' => ['required'],
            'profile_job_join_epf_number' => ['max:255'],
            'profile_job_join_mobile' => ['required', 'digits:10'],
            'profile_job_join_email' => ['email'],

        ]);

        $joinjobs = [

            'profile_job_join_head_of_sbu' => $request->profile_job_work_head_of_sbu,
            'profile_job_join_epf_number' => $request->profile_job_join_epf_number,
            'profile_job_join_date' => $request->profile_job_join_date,
            'profile_job_join_head_of_sbu' => $request->profile_job_join_head_of_sbu,
            'profile_job_join_projctnames' => $request->profile_job_join_head_of_sbu,

            'profile_job_join_department' => $request->profile_job_join_department,
            'profile_job_join_designation' => $request->profile_job_join_designation,
            'profile_job_join_jd' => $request->profile_job_join_jd,
            'profile_job_join_office_location' => $request->profile_job_join_office_location,
            'profile_job_join_email' => $request->profile_job_join_email,
            'profile_job_join_mobile' => $request->profile_job_join_mobile,
            'job_join_profile_last_upate_by' => Auth::user()->name,
            'job_join_profile_last_update_date' => date('Y-m-d H:i:s'),

        ];

        DB::table('job_join_history')->where('profile_id', $request->profile_id)->update($joinjobs);

        // dd($joinjobs);
        return redirect('/view-profile'.'/'.$request->profile_sug)->with('success', '&nbsp;&nbsp; Save Sucess Full');
    }

    public function update(UpdateProfileRequest $request, Profile $profile)
    {
        //
    }

    public static function reportingManager($profile_job_work_head_of_sbu)
    {

        echo DB::table('profiles')
            ->where('profile_id', '=', $profile_job_work_head_of_sbu)
            ->pluck('profile_first_name')
            ->first();

    }

    public function jobworkupdate(Request $request)
    {

        // dd($request);

        $request->validate([
            'profile_job_work_epf_number' => ['max:255'],
            'profile_job_work_join_date' => ['required', 'string', 'max:255'],
            'profile_job_work_sbu' => ['required', 'string', 'max:255'],
            'profile_job_work_email' => ['regex:/(.+)@(.+)\.(.+)/i'],
            'profile_job_work_department' => ['required', 'string', 'max:255'],
            'profile_job_work_designation' => ['required', 'string', 'max:255'],
            'profile_job_work_mobile' => ['required', 'digits:10'],
            'profile_job_work_jd' => ['required'],
            'profile_job_work_head_of_sbu' => ['max:255'],
            'profile_job_work_office_location' => ['string', 'numeric'],
            'profile_job_work_status' => ['required', 'string'],
            'profile_job_work_status_reson' => ['string', 'max:255'],
            'profile_job_work_employee_index_number' => ['required'],
        ]);

        $working = [

            'profile_job_work_epf_number' => $request->profile_job_work_epf_number,
            'profile_job_work_join_date' => $request->profile_job_work_join_date,
            'profile_job_work_sbu' => $request->profile_job_work_sbu,
            'profile_job_work_email' => $request->profile_job_work_email,
            'profile_job_work_department' => $request->profile_job_work_department,
            'profile_job_work_projctnames' => $request->projctnames_id,
            'profile_job_work_designation' => $request->profile_job_work_designation,
            'profile_job_work_mobile' => $request->profile_job_work_mobile,
            'profile_job_work_jd' => $request->profile_job_work_jd,
            'profile_job_work_head_of_sbu' => $request->profile_job_work_head_of_sbu,
            'profile_job_work_office_location' => $request->profile_job_work_office_location,
            'profile_job_work_status' => $request->profile_job_work_status,
            'profile_job_work_status_reson' => $request->profile_job_work_status_reson,
            'profile_job_work_epf_number' => $request->profile_job_work_epf_number,
            'profile_job_work_employee_index_number' => $request->profile_job_work_employee_index_number,
            'profile_head_of_job_work_departmrnt_this_account' => $request->profile_head_of_departmrnt_this_account,
            'job_work_last_update_by' => Auth::user()->name,
            'job_work_last_update_date' => date('Y-m-d H:i:s'),
        ];
        // dd($working);
        DB::table('job_working')->where('job_working_profile_id', $request->job_working_profile_id)->update($working);

        //profile status update
        $profile = [
            'profile_status' => $request->profile_job_work_status,
            'profile_head_of_departmrnt_this_account' => $request->profile_head_of_departmrnt_this_account, ];
        DB::table('profiles')->where('profile_sug', $request->profile_sug)->update($profile);
        //profile status update end

        if (! empty($request->profile_job_join_profile_id)) {
            $joinjobs = [
                'profile_job_join_epf_number' => $request->profile_job_work_epf_number,
                'profile_job_join_head_of_sbu' => $request->profile_job_work_head_of_sbu,
                'profile_job_join_date' => $request->profile_job_work_join_date,
                'profile_job_join_head_of_sbu' => $request->profile_job_work_head_of_sbu,
                'profile_job_join_department' => $request->profile_job_work_department,
                'profile_job_join_projctnames' => $request->projctnames_id,
                'profile_job_join_designation' => $request->profile_job_work_designation,
                'profile_job_join_jd' => $request->profile_job_work_jd,
                'profile_job_join_office_location' => $request->profile_job_work_office_location,
                'profile_job_join_email' => $request->profile_job_work_email,
                'profile_job_join_mobile' => $request->profile_job_work_mobile,
                'job_join_profile_last_upate_by' => Auth::user()->name,
                // 'profile_head_of_departmrnt_this_account'=>$request->profile_head_of_departmrnt_this_account,
                'job_join_profile_last_update_date' => date('Y-m-d H:i:s'),
            ];
            DB::table('job_join_history')->where('job_join_profile_id', $request->profile_job_join_profile_id)->update($joinjobs);

        }

        return redirect('/view-profile'.'/'.$request->profile_sug)->with('success', '&nbsp;&nbsp; Save Sucess Full');
    }

    public function newjobwork(Request $request)
    {

        $request->validate([
            'profile_job_work_epf_number' => ['max:255'],
            'profile_job_work_join_date' => ['required', 'string', 'max:255'],
            'profile_job_work_sbu' => ['required', 'string', 'max:255'],
            'profile_job_work_email' => ['email'],
            'profile_job_work_department' => ['required', 'string', 'max:255'],
            'profile_job_work_designation' => ['required', 'string', 'max:255'],
            'profile_job_work_mobile' => ['required', 'digits:10'],
            'profile_job_work_jd' => ['required'],
            // 'profile_job_work_head_of_sbu' => ['string', 'max:255'],
            'profile_job_work_office_location' => ['string', 'numeric'],
            //'profile_job_work_status' => ['required','string'],
            'profile_job_work_status_reson' => ['string', 'max:255'],
            'profile_job_work_employee_index_number' => ['required', 'max:255'],
        ]);

        $working = [
            'profile_id' => $request->profile_id,
            'profile_job_join_profile_id' => $request->profile_id,
            'profile_job_work_epf_number' => $request->profile_job_work_epf_number,
            'profile_job_work_join_date' => $request->profile_job_work_join_date,
            'profile_job_work_sbu' => $request->profile_job_work_sbu,
            'profile_job_work_projctnames' => $request->projctnames_id,
            'profile_job_work_email' => $request->profile_job_work_email,
            'profile_job_work_department' => $request->profile_job_work_department,
            'profile_job_work_designation' => $request->profile_job_work_designation,
            'profile_job_work_mobile' => $request->profile_job_work_mobile,
            'profile_job_work_jd' => $request->profile_job_work_jd,
            'profile_job_work_head_of_sbu' => $request->profile_job_work_head_of_sbu,
            'profile_job_work_office_location' => $request->profile_job_work_office_location,
            'profile_job_work_status' => 'Active',
            'profile_job_work_status_reson' => $request->profile_job_work_status_reson,
            'profile_job_work_employee_index_number' => $request->profile_job_work_employee_index_number,
            'job_work_profile_crate_by' => Auth::user()->name,
            'job_work_profile_crate_date' => date('Y-m-d H:i:s'),
        ];

        //  dd($working);
        DB::table('job_working')->insert($working); //salary

        //profile status update
        $profile = ['profile_status' => 'Active'];
        DB::table('profiles')->where('profile_sug', $request->profile_sug)->update($profile);
        //profile status update end

        return redirect('/view-profile'.'/'.$request->profile_sug)->with('success', '&nbsp;&nbsp;New organization saves successfully');

        //dd($request);
    }

    public function uplodeprofileimage(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $image = $request->file('profile_image');
        $filename = $request->profile_id.'-'.$request->profile_number.'.'.$image->getClientOriginalExtension();
        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize(500, 500);
        $image_resize->save(public_path('profile-image/'.$filename));
        $data = [
            'profile_image' => $filename,
            'profile_last_update_date' => date('Y-m-d H:i:s'),
            'profile_last_upate_by' => Auth::user()->name,
        ];
        DB::table('profiles')->where('profile_id', $request->profile_id)->update($data);

        return redirect('/view-profile'.'/'.$request->profile_sug)->with('success'.'&nbsp;&nbsp; Save Sucess Full');
    }

    public function deletprofileimage(Request $request)
    {

        if (! empty($request->profile_image)) {
            unlink('profile-image/'.$request->profile_image);
        }
        $data = [
            'profile_image' => '',
            'profile_last_update_date' => date('Y-m-d H:i:s'),
            'profile_last_upate_by' => Auth::user()->name,
        ];
        DB::table('profiles')->where('profile_id', $request->profile_id)->update($data);

        return redirect('/view-profile'.'/'.$request->profile_sug)->with('success'.'&nbsp;&nbsp; Save Sucess Full');

    }

    public static function getreligion($religion_id)
    {
        echo DB::table('religions')->where('religion_id', '=', $religion_id)->value('religion_name');
    }

    public function profilePersonaldetailsUpdate(Request $request)
    {

        $request->validate([
            'profile_Full_name' => ['required', 'string', 'max:255'],
            'profile_first_name' => ['required', 'string', 'max:255'],
            'profile_last_name' => ['required', 'string', 'max:255'],
            'profile_gender' => ['required', 'string', 'max:255'],
            'religion_id' => ['required', 'string', 'max:255'],
            'profile_living_province' => ['required', 'string', 'max:255'],
            'profile_marital_status' => ['required', 'string', 'max:255'],
            'profile_nic' => ['required', 'string', 'max:255'],
            'profile_bith_day' => ['required', 'string', 'max:255'],
            'profile_mobile_number' => ['required', 'string', 'max:255'],
            'profile_email' => ['email'],
            'profile_permant_address' => ['required', 'string', 'max:255'],
            'profile_current_address' => ['required', 'string', 'max:255'],
            'profile_emergency_contact_person_name' => ['required', 'string', 'max:255'],
            'profile_relationship' => ['required', 'string', 'max:255'],
            'profile_emergency_mobile_number' => ['required', 'digits:10'],
            'reasons_for_request_to_change' => ['required', 'string'],
        ]);

        $profile_data = DB::table('profiles')->select('*')
            ->where('profile_id', $request->profile_id)
            ->get();

        foreach ($profile_data as $Prow) {

            $phistory = [
                'history_profile_number' => $Prow->profile_number,
                'history_profile_sug' => $Prow->profile_sug,
                'history_profile_image' => $Prow->profile_image,
                'history_profile_profile_id' => $Prow->profile_id,
                'history_profile_Full_name' => $Prow->profile_Full_name,
                'history_profile_first_name' => $Prow->profile_first_name,
                'history_profile_last_name' => $Prow->profile_last_name,
                'history_profile_bith_day' => $Prow->profile_bith_day,
                'history_profile_gender' => $Prow->profile_gender,
                'history_profile_nic' => $Prow->profile_nic,
                'history_profile_living_province' => $Prow->profile_living_province,
                'history_profile_marital_status' => $Prow->profile_marital_status,
                'history_profile_permant_address' => $Prow->profile_permant_address,
                'history_profile_current_address' => $Prow->profile_current_address,
                'history_profile_mobile_number' => $Prow->profile_mobile_number,
                'history_profile_emergency_contact_person_name' => $Prow->profile_emergency_contact_person_name,
                'history_profile_relationship' => $Prow->profile_relationship,
                'history_profile_emergency_mobile_number' => $Prow->profile_emergency_mobile_number,
                'history_profile_email' => $Prow->profile_email,
                'history_religion_id' => $Prow->religion_id,
                'history_profile_status' => $Prow->profile_status,
                'history_reasons_for_request_to_change' => $Prow->reasons_for_request_to_change,
                'history_profile_head_of_departmrnt_this_account' => $Prow->profile_head_of_departmrnt_this_account,
                'history_profile_crate_by' => $Prow->profile_crate_by,
                'history_profile_crate_date' => $Prow->profile_crate_date,
                'history_profile_approvel_by' => $Prow->profile_approvel_by,
                'history_profile_approvel_date' => $Prow->profile_approvel_date,
            ];
            DB::table('profiles_history')->insert($phistory);

            $approvel_waiting = [
                'waiting_approvel_profile_profile_id' => $request->profile_id,
                'waiting_approvel_profile_number' => $request->profile_number,
                'waiting_approvel_profile_sug' => str_slug($request->profile_Full_name),
                'waiting_approvel_profile_image' => $Prow->profile_image,
                'waiting_approvel_profile_Full_name' => $request->profile_Full_name,
                'waiting_approvel_profile_first_name' => $request->profile_first_name,
                'waiting_approvel_profile_last_name' => $request->profile_last_name,
                'waiting_approvel_profile_bith_day' => $request->profile_bith_day,
                'waiting_approvel_profile_nic' => $request->profile_nic,
                'waiting_approvel_profile_living_province' => $request->profile_living_province,
                'waiting_approvel_profile_marital_status' => $request->profile_marital_status,
                'waiting_approvel_profile_gender' => $request->profile_gender,
                'waiting_approvel_profile_permant_address' => $request->profile_permant_address,
                'waiting_approvel_profile_current_address' => $request->profile_current_address,
                'waiting_approvel_profile_mobile_number' => $request->profile_mobile_number,
                'waiting_approvel_profile_emergency_contact_person_name' => $request->profile_emergency_contact_person_name,
                'waiting_approvel_profile_relationship' => $request->profile_relationship,
                'waiting_approvel_profile_emergency_mobile_number' => $request->profile_emergency_mobile_number,
                'waiting_approvel_profile_email' => $request->profile_email,
                'waiting_approvel_religion_id' => $request->religion_id,
                'waiting_approvel_profile_status' => $Prow->profile_status,
                'waiting_approvel_profile_head_of_departmrnt_this_account' => $request->profile_head_of_departmrnt_this_account,
                'waiting_approvel_profile_crate_by' => $Prow->profile_crate_by,
                'waiting_approvel_profile_crate_date' => $Prow->profile_crate_date,
                'waiting_approvel_profile_by' => Auth::user()->name,
                'waiting_approvel_profile_date' => date('Y-m-d H:i:s'),
                'waiting_reasons_for_request_to_change' => $request->reasons_for_request_to_change,
            ];
            DB::table('profiles_change_waiting_approvel')->insert($approvel_waiting);
        }

        /*
        $data=array(
           'profile_number'=>$request->profile_id,
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
            'profile_head_of_departmrnt_this_account'=>$request->profile_head_of_departmrnt_this_account,
            'profile_crate_by'=>Auth::user()->name,
            'profile_crate_date'=>date('Y-m-d H:i:s'),
         );
        /*
                   $data=array(
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
                 );
        */
        //  DB::table('profiles')->where('profile_id', $request->profile_id)->update($data);
        return redirect('/view-profile'.'/'.str_slug($request->profile_Full_name))->with('success', ' Send to HR for Approval Sucess Full');

    }

    public static function joincompani($profile_id)
    {

        DB::table('job_working')->select('*')
            ->join('profiles', 'profiles.profile_id', '=', 'job_working.profile_id')
            ->join('job_join_history', 'job_join_history.profile_id', '=', 'job_working.profile_id')
            ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'job_working.profile_job_work_sbu')
            ->join('designations', 'designations.designations_id', '=', 'job_working.profile_job_work_designation')
            ->join('departments', 'departments.department_id', '=', 'job_working.profile_job_work_department')
            ->join('job_descriptions', 'job_descriptions.job_descriptions_id', '=', 'job_working.profile_job_work_jd')
            ->join('office_locations', 'office_locations.office_locations_id', '=', 'job_working.profile_job_work_office_location')
            ->where('profiles.profile_sug', '=', $profile_id)
            ->where('job_working.profile_job_work_status', 'Active')
            ->orderBy('job_working.job_working_profile_id', 'DESC')
            ->get();
    }

    public function addtoAllowance(Request $request)
    {

        //  dd($request);

        $request->validate([
            'allowances_salary' => ['string', 'max:255'],
            'allowances_update_reson' => ['required', 'string', 'max:255'],
            'salary_add_date' => ['required', 'string', 'max:255'],
        ]);

        //Allowance
        $allowance = [
            'profile_id' => $request->profile_id,
            'allowances_salary' => $request->allowances_salary,
            'allowances_reson' => $request->allowances_update_reson,
            'allowances_add_by' => Auth::user()->name,
            'allowances_add_date' => date('Y-m-d H:i:s'),
            'allowances_update_reson' => $request->allowances_update_reson,
            'allowances_update_by' => Auth::user()->name,
            'allowances_update_date' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
        ];
        AllowanceController::create($allowance);

        return redirect('/view-profile'.'/'.$request->profile_sug)->with('success'.$request->allowances_salary.'&nbsp;&nbsp; Save Sucess Full');

    }

    public static function activeorganizationusers($subsidiaries_id)
    {

        $data = DB::table('job_working')->select('*')
            ->join('profiles', 'profiles.profile_id', '=', 'job_working.profile_id')
            ->join('job_join_history', 'job_join_history.profile_id', '=', 'job_working.profile_id')
            ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'job_working.profile_job_work_sbu')
            ->join('designations', 'designations.designations_id', '=', 'job_working.profile_job_work_designation')
            ->join('departments', 'departments.department_id', '=', 'job_working.profile_job_work_department')
            ->join('job_descriptions', 'job_descriptions.job_descriptions_id', '=', 'job_working.profile_job_work_jd')
            ->join('office_locations', 'office_locations.office_locations_id', '=', 'job_working.profile_job_work_office_location')
            ->where('subsidiaries.subsidiaries_id', '=', $subsidiaries_id)
            ->where('job_working.profile_job_work_status', 'Active')
            ->orderBy('job_working.job_working_profile_id', 'DESC')
            ->get();

        foreach ($data as $key => $row) {

            echo '<div class="row">
            <div class="col">#</div>
            <div class="col">Employees Name</div>
            <div class="col"></div>
            <div class="col"></div>
          </div>';

        }

    }

    public static function reportingManagerList($profile_id)
    {
        $reporting_manager = DB::table('job_working')->select('*')
            ->join('profiles', 'profiles.profile_id', '=', 'job_working.profile_job_work_head_of_sbu')
            ->where('job_working.profile_id', '=', $profile_id)
            ->where('job_working.profile_job_work_status', '=', 'Active')
            ->get();
        foreach ($reporting_manager as $reporting_manager) {
            echo '<option value="'.$reporting_manager->profile_id.'">'.$reporting_manager->profile_Full_name.'</option>';
        }

    }

    public static function leaveoraganazation($profile_id)
    {

        $leaveoraganazation = DB::table('job_working')->select('*')
            ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'job_working.profile_job_work_sbu')
            ->where('job_working.profile_id', '=', $profile_id)
            ->where('job_working.profile_job_work_status', '=', 'Active')
            ->get();
        foreach ($leaveoraganazation as $row) {
            echo '<option value="'.$row->subsidiaries_id.'">'.$row->subsidiaries_name.'</option>';
        }

    }

    public static function workingCompanyDepartment($profile_id)
    {
        $department = DB::table('job_working')->select('*')
            ->join('departments', 'departments.department_id', '=', 'job_working.profile_job_work_department')
            ->where('job_working.profile_id', '=', $profile_id)
            ->where('job_working.profile_job_work_status', '=', 'Active')
            ->get();
        foreach ($department as $department) {
            echo '<option value="'.$department->department_id.'">'.$department->department_name.'</option>';
        }
    }

    public static function workingCompanys($profile_id)
    {
        $jobworking = DB::table('job_working')->select('*')
            ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'job_working.profile_job_work_sbu')
            ->where('job_working.profile_id', '=', $profile_id)
            ->where('job_working.profile_job_work_status', '=', 'Active')
            ->get();
        foreach ($jobworking as $jobworking) {
            echo '<option value="'.$jobworking->subsidiaries_id.'">'.$jobworking->subsidiaries_name.'</option>';
        }
    }

    public static function employeequlist($profile_id)
    {

        DB::table('equipment_histories')
            ->join('equipment', 'equipment.equipment_id', '=', 'equipment_histories.equipment_histories_equipment_number')
            ->join('equpment_types', 'equpment_types.equpment_types_id', '=', 'equipment.equipment_type')
            ->join('profiles', 'profiles.profile_id', '=', 'equipment_histories.equipment_user')
            ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'equipment.equipment_organization')
            ->orderBy('equipment.equipment_number', 'asc')
            ->where('equipment_histories.equipment_user', '=', $profile_id)
  //profile_id
  //->whereNull('equipment.equipment_user')
            ->get();
    }

    public function allprofileupdaterequst()
    {

        $data['profile'] = DB::table('profiles_change_waiting_approvel')
            ->select('*')
            ->join('religions', 'religions.religion_id', '=', 'profiles_change_waiting_approvel.waiting_approvel_religion_id')
            ->get();

        $data['religions'] = DB::table('religions')->select('*')->get();
        $data['title'] = 'Personal profile update request';
        $data['template'] = 'profile/allprofileupdaterequst';

        return view('template/template', compact('data'));
    }

    public function updaterequst(Request $request)
    {

        $waiting_approvel_pro = DB::table('profiles_change_waiting_approvel')
            ->select('*')
            ->where('waiting_approvel_profile_id', '=', $request->waiting_approvel_profile_id)
            ->get();

        //  dd($request);

        foreach ($waiting_approvel_pro as $row) {

            $data = [
                // 'profile_number'=>$pnumber,
                'profile_sug' => str_slug($row->waiting_approvel_profile_Full_name),
                'profile_Full_name' => $row->waiting_approvel_profile_Full_name,
                'profile_first_name' => $row->waiting_approvel_profile_first_name,
                'profile_last_name' => $row->waiting_approvel_profile_last_name,
                'profile_bith_day' => $row->waiting_approvel_profile_bith_day,
                'profile_gender' => $row->waiting_approvel_profile_gender,
                'profile_nic' => $row->waiting_approvel_profile_nic,
                'profile_living_province' => $row->waiting_approvel_profile_living_province,
                'profile_marital_status' => $row->waiting_approvel_profile_marital_status,
                'profile_permant_address' => $row->waiting_approvel_profile_permant_address,
                'profile_current_address' => $row->waiting_approvel_profile_current_address,
                'profile_mobile_number' => $row->waiting_approvel_profile_mobile_number,
                'profile_emergency_contact_person_name' => $row->waiting_approvel_profile_emergency_contact_person_name,
                'profile_relationship' => $row->waiting_approvel_profile_relationship,
                'profile_emergency_mobile_number' => $row->waiting_approvel_profile_emergency_mobile_number,
                'profile_email' => $row->waiting_approvel_profile_email,
                'religion_id' => $row->waiting_approvel_religion_id,
                'profile_status' => $row->waiting_approvel_profile_status,
                'profile_head_of_departmrnt_this_account' => $row->waiting_approvel_profile_head_of_departmrnt_this_account,
                'reasons_for_request_to_change' => $row->waiting_reasons_for_request_to_change,
                'profile_crate_by' => $row->waiting_approvel_profile_crate_by,
                'profile_crate_date' => $row->waiting_approvel_profile_crate_date,
                'profile_approvel_by' => Auth::user()->name,
                'profile_approvel_date' => date('Y-m-d H:i:s'),
                'profile_last_upate_by' => Auth::user()->name,
                'profile_last_update_date' => date('Y-m-d H:i:s'),
            ];

            DB::table('profiles')->where('profile_id', $row->waiting_approvel_profile_profile_id)->update($data);
            DB::table('profiles_change_waiting_approvel')->where('waiting_approvel_profile_id', $row->waiting_approvel_profile_id)->delete();

            return redirect('/allprofileupdaterequst')->with('success', ' Update Success full.......');
        }

    }

    public static function usersOrg($profile_id)
    {

        $jobworking = DB::table('job_working')->select('*')
            ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'job_working.profile_job_work_sbu')
            ->where('job_working.profile_id', '=', $profile_id)
            ->where('job_working.profile_job_work_status', '=', 'Active')
            ->get();

    }

    public function resignation(Request $request)
    {

        $request->validate(
            ['file' => 'required|mimes:pdf|max:100000'],
            ['resignation_date' => 'required'],
            ['resignation_text' => 'required']
        );

        $file = $request->file('file');
        $filename = str::slug('Re'.'-'.$request->profile_sug.'-').'-'.date('Y-m-d-H-i-s').'.'.$file->getClientOriginalExtension();
        $file->move('resignation_document/', $filename);

        $data = [
            'resignation_date' => $request->resignation_date,
            'resignation_letter' => $filename,
            'resignation_text' => $request->resignation_text,
            'resignation_request_date' => date('Y-m-d H:i:s'),
        ];

        $sbu_head = DB::table('job_working')
            ->select('*')
            ->join('profiles', 'profiles.profile_id', '=', 'job_working.profile_job_work_head_of_sbu')
            ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'job_working.profile_job_work_sbu')
            ->where('job_working.profile_id', '=', $request->profile_id)
            ->where('job_working.profile_job_work_status', '=', 'Active')
            ->get();

        foreach ($sbu_head as $key => $sbuhead) {
            $mailData = [
                'appname' => config('app.name'),
                'base_url' => config('app.url'),
                'title' => 'Your Login Details For ASSET HR',
                'sbu' => $sbuhead->subsidiaries_name,
                'reportingManager' => $sbuhead->profile_first_name.' '.$sbuhead->profile_last_name,
                'fname' => $request->profile_Full_name,
                'resignation_text' => $request->resignation_text,
                'resignation_letter' => config('app.url').'/resignation_document/'.$filename,
                'resignation_date' => $request->resignation_date,
                'empname' => Auth::user()->name,
                'profile_sug' => config('app.url').'/view-profile/'.$request->profile_sug,
            ];
            Mail::mailer('hr')->to($sbuhead->profile_job_work_email)->send(new ResignationNotification($mailData));
        }
        DB::table('profiles')->where('profile_id', $request->profile_id)->update($data);

        return redirect('/view-profile'.'/'.$request->profile_sug)->with('success', '&nbsp;&nbsp; Your request was sent Successfully');
    }

    public function resignationStatus(Request $request)
    {

        $request->validate(
            ['resignation_approved' => 'required'],
            ['resignation_approved_note' => 'required']
        );

        if (! empty($request->resignation_approved == 1)) {

            $data = [
                'resignation_approved' => $request->resignation_approved,
                'resignation_approved_note' => $request->resignation_approved_note,
                'resignation_approval_date' => $request->resignation_approval_date,
                'resignation_approved_by' => Auth::user()->name,
                'resignation_approved_date' => date('Y-m-d H:i:s'),

            ];

            // copanyname
            $copanyname = DB::table('job_working')
                ->select('*')
      // ->join('profiles','profiles.profile_id','=','job_working.profile_job_work_head_of_sbu')
                ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'job_working.profile_job_work_sbu')
                ->where('job_working.profile_id', '=', $request->profile_id)
                ->where('job_working.profile_job_work_status', '=', 'Active')
                ->get();

            foreach ($copanyname as $copanyname) {
                $mailData = [
                    'profile_Full_name' => $request->profile_Full_name,
                    'resignation_request_date' => $request->resignation_request_date,
                    'resignation_approval_date' => $request->resignation_approval_date,
                    'companyName' => $copanyname->subsidiaries_name,
                ];
                Mail::mailer('hr')->to($copanyname->profile_job_work_email)->send(new ResignationApproveHr($mailData));
            }

            $hrmailData = [
                'profile_Full_name' => $request->profile_Full_name,
                'resignation_request_date' => $request->resignation_request_date,
                'resignation_approval_date' => $request->resignation_approval_date,
                'userName' => Auth::user()->name,
                'profile_sug' => config('app.url').'/view-profile/'.$request->profile_sug,
            ];

            Mail::mailer('hr')->to(env('MAIL_HR_ADDRESS'))->send(new ResignationHrApprovel($hrmailData));
            DB::table('profiles')->where('profile_id', $request->profile_id)->update($data);

            return redirect('/view-profile'.'/'.$request->profile_sug)->with('success', '&nbsp;&nbsp; Your Approval, we will inform related persons.');

        } else {

            $copanyname = DB::table('job_working')
                ->select('*')
     // ->join('profiles','profiles.profile_id','=','job_working.profile_job_work_head_of_sbu')
                ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'job_working.profile_job_work_sbu')
                ->where('job_working.profile_id', '=', $request->profile_id)
                ->where('job_working.profile_job_work_status', '=', 'Active')
                ->get();

            foreach ($copanyname as $copanyname) {
                $mailData = [
                    'profile_Full_name' => $request->profile_Full_name,
                    'resignation_request_date' => $request->resignation_request_date,
                    'resignation_approval_date' => $request->resignation_approval_date,
                    'companyName' => $copanyname->subsidiaries_name,
                ];
                Mail::mailer('hr')->to($copanyname->profile_job_work_email)->send(new Resignationnotapproved($mailData));
            }

            return redirect('/view-profile'.'/'.$request->profile_sug)->with('success', '&nbsp;&nbsp; You have emailed your decision.');

        }

    }

    public static function profile_slug($profile_id)
    {

        echo DB::table('profiles')->where('profile_id', '=', $profile_id)->value('profile_sug');
    }
}
