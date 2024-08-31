<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Http\Requests\StoreSalaryRequest;
use App\Http\Requests\UpdateSalaryRequest;
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

class SalaryController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {



        $request->validate([
            'salary_salary' => ['required', 'string', 'max:255'],
            'salary_reson' => ['required', 'string', 'max:255'],
            'salary_add_date' => ['required', 'string', 'max:255'],
             ]);


             $salary_details =array(
                'profile_id'=>$request->profile_id,
                'salary_salary'=>$request->salary_salary,
                'salary_reson'=>$request->salary_reson,
                'salary_add_by'=>Auth::user()->name,
                'salary_add_date'=>$request->salary_add_date,
                'salary_update_reson'=>$request->salary_reson,
                'salary_update_by'=>Auth::user()->name,
                'salary_update_date'=>date('Y-m-d H:i:s'),
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
             );


             DB::table('salaries')->insert( $salary_details); //account_details
             return redirect('/view-profile'.'/'.$request->profile_sug)->with('success'.'&nbsp;&nbsp; Save Success Full');
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSalaryRequest  $request
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $request->validate([
            'salary_salary' => ['required', 'string', 'max:255'],
            'salary_add_date' => ['required', 'string', 'max:255'],
            'salary_update_reson' => ['required', 'string', 'max:255'],
             ]);

             $salary_details =array(

                'salary_salary'=>$request->salary_salary,
                'salary_add_date'=>$request->salary_add_date,
                'salary_update_reson'=>$request->salary_update_reson,
                'salary_update_by'=>Auth::user()->name,
                'salary_update_date'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
             );

             DB::table('salaries')->where('salary_id', $request->salary_id)->update($salary_details);
           //  DB::table('salaries')->insert( $salary_details); //account_details
             return redirect('/view-profile'.'/'.$request->profile_sug)->with('success'.'&nbsp;&nbsp; Save Success Full');

    }




    public function edit($salary_id)
    {
        $data['title'] = 'Salary Edit';
        $data['salary'] =   DB::table('salaries')->select('*')
        ->join('profiles','profiles.profile_id','=','salaries.profile_id')
         ->where('salaries.salary_id','=',$salary_id)
        ->get();
        $data['template'] = 'salary/salary_edit';
        return view('template/template', compact('data'));
    }


    // salary
    public static function salaryone($profile_id){
       echo number_format(DB::table('salaries')
        ->where('profile_id','=',$profile_id)
        ->get()
        ->sum('salary_salary'), 2, '.', ',');
     }

/*
       // Allowance
    public static function allowance($profile_id){
        echo DB::table('salaries')
        ->where('profile_id','=',$profile_id)
        ->get()
        ->sum('salary_salary');
     }

*/

       // Increment






     /// salary details
     public static function salarydetails($profile_id){
       $data= DB::table('salaries')
        ->where('profile_id','=',$profile_id)
        ->get();
        foreach($data as $row){
            echo '
            <tr>
            <td>'.$row->salary_add_date.'&nbsp;&nbsp;/&nbsp;&nbsp;'.$row->salary_reson.'</td>
            <td>'.env('APP_CURRENCY').'&nbsp;&nbsp; '.number_format($row->salary_salary, 2, '.', ',').'</td>
            <td><a href="/editsalary/'.$row->salary_id.'"><i class="fa fa-pencil-square-o text-success fa-2x" aria-hidden="true"></i></a></td>
          </tr>';
         }
     }




 public function SalaryReport(){


    $data['title'] = 'Salary Report';
    $data['organization'] =   DB::table('subsidiaries')->select('*')->orderBy('subsidiaries_name', 'asc') ->where('assetsubsidiarie','=','Yes')->get();
    $data['template'] = 'salary/salaryReport';
    return view('template/template', compact('data'));
 }


 public static function organizationCount($subsidiaries_id){
      echo DB::table('job_working')->select('*')
      ->join('subsidiaries','subsidiaries.subsidiaries_id','=','job_working.profile_job_work_sbu')
      ->where('profile_job_work_sbu','=',$subsidiaries_id)
      ->where('subsidiaries.assetsubsidiarie','=','Yes')
     ->where('profile_job_work_status','=','Active')
     ->count();
 }


 public static function organizationsalarysum($subsidiaries_id){

 echo   number_format(DB::table('job_working')->select('*')
     ->join('allowances','allowances.profile_id','=','job_working.profile_id')
     ->join('subsidiaries','subsidiaries.subsidiaries_id','=','job_working.profile_job_work_sbu')
     ->where('job_working.profile_job_work_sbu','=',$subsidiaries_id)
     ->where('job_working.profile_job_work_status','=','Active')
     ->where('subsidiaries.assetsubsidiarie','=','Yes')
     ->get()
     ->sum('allowances_salary')

        +

    DB::table('job_working')->select('*')
    ->join('salaries','salaries.profile_id','=','job_working.profile_id')
    ->join('subsidiaries','subsidiaries.subsidiaries_id','=','job_working.profile_job_work_sbu')
    ->where('profile_job_work_sbu','=',$subsidiaries_id)
    ->where('profile_job_work_status','=','Active')
    ->get()
    ->sum('salary_salary')

    +

    DB::table('job_working')->select('*')
    ->join('incresments','incresments.profile_id','=','job_working.profile_id')
    ->join('subsidiaries','subsidiaries.subsidiaries_id','=','job_working.profile_job_work_sbu')
    ->where('profile_job_work_sbu','=',$subsidiaries_id)
    ->where('profile_job_work_status','=','Active')
    ->where('subsidiaries.assetsubsidiarie','=','Yes')
    ->get()
    ->sum('incresments_salary'), 2, '.', ',');




/*
     foreach($data as $row){


      $sum_tot_Price =DB::table('allowances')
        ->where('profile_id','=',$row->profile_id)
        ->get()
        ->sum('allowances_salary');


     }
*/



    /*

    DB::table('allowances')
        ->where('profile_id','=',$profile_id)
        ->get()
        ->sum('allowances_salary');

        */
 }



 public static function activeorganizationusers($subsidiaries_id){

    $data=  DB::table('job_working')->select('*')
      ->join('profiles','profiles.profile_id','=','job_working.profile_id')
      ->join('job_join_history','job_join_history.profile_id','=','job_working.profile_id')
      ->join('subsidiaries','subsidiaries.subsidiaries_id','=','job_working.profile_job_work_sbu')
      ->join('designations','designations.designations_id','=','job_working.profile_job_work_designation')
      ->join('departments','departments.department_id','=','job_working.profile_job_work_department')
      ->join('job_descriptions','job_descriptions.job_descriptions_id','=','job_working.profile_job_work_jd')
      ->join('office_locations','office_locations.office_locations_id','=','job_working.profile_job_work_office_location')
      ->where('subsidiaries.subsidiaries_id','=',$subsidiaries_id)
      ->where('job_working.profile_job_work_status','Active')
      ->orderBy('job_working.job_working_profile_id', 'DESC')
      ->get();




      foreach($data as $key=>$row){

          echo '<div class="row">
          <div class="col-sm-1">#</div>
          <div class="col">'.$row->profile_Full_name.'</div>
          <div class="col">'.SalaryController::salaryone($row->profile_id).'</div>
          <div class="col">Allowances</div>
          <div class="col"></div>
        </div>';
      }


  }




}
